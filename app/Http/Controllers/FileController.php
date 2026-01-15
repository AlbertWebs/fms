<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Models\File;
use App\Models\Client;
use App\Models\Category;
use App\Services\AuditLogService;
use App\Services\StorageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Str;

class FileController extends Controller
{
    public function __construct(
        protected AuditLogService $auditLogService
    ) {}

    public function index(Request $request): View
    {
        $this->authorize('files.view');

        $query = File::with(['client', 'category', 'uploader'])->latest();

        // Advanced Search
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filters
        if ($request->filled('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('financial_year')) {
            $query->where('financial_year', $request->financial_year);
        }

        if ($request->filled('status')) {
            $query->byStatus($request->status);
        }

        if ($request->filled('uploaded_by')) {
            $query->where('uploaded_by', $request->uploaded_by);
        }

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->byDateRange($request->date_from, $request->date_to);
        }

        if ($request->filled('is_locked')) {
            $request->is_locked === '1' ? $query->locked() : $query->unlocked();
        }

        $files = $query->paginate(20)->withQueryString();
        $clients = Client::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $users = \App\Models\User::orderBy('name')->get();

        return view('files.index', compact('files', 'clients', 'categories', 'users'));
    }

    public function create(Request $request): View
    {
        $this->authorize('files.upload');

        $clients = Client::where('status', 'active')->orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $financialYears = $this->generateFinancialYears();

        return view('files.create', compact('clients', 'categories', 'financialYears'));
    }

    protected function generateFinancialYears(): array
    {
        $years = [];
        $currentYear = now()->year;
        
        // Generate financial years from 5 years back to 2 years ahead
        for ($i = -5; $i <= 2; $i++) {
            $startYear = $currentYear + $i;
            $endYear = $startYear + 1;
            $years[] = "{$startYear}-{$endYear}";
        }
        
        return $years;
    }

    public function store(StoreFileRequest $request): RedirectResponse
    {
        $uploadedFile = $request->file('file');
        $clientId = $request->client_id;
        $financialYear = $request->financial_year ?? null;
        $categoryId = $request->category_id;

        $originalName = $uploadedFile->getClientOriginalName();
        $storedName = Str::uuid() . '.' . $uploadedFile->getClientOriginalExtension();
        
        // Build path with optional financial year
        $s3Path = $financialYear 
            ? "clients/{$clientId}/{$financialYear}/{$categoryId}/{$storedName}"
            : "clients/{$clientId}/{$categoryId}/{$storedName}";

        // Generate file hash for duplicate detection
        $fileHash = hash_file('sha256', $uploadedFile->getRealPath());

        // Check for duplicate files by hash
        $duplicateFile = File::where('client_id', $clientId)
            ->where('file_hash', $fileHash)
            ->where('id', '!=', $request->input('duplicate_override'))
            ->first();

        // Check if file with same name exists for versioning
        $existingFileQuery = File::where('client_id', $clientId)
            ->where('category_id', $categoryId)
            ->where('original_name', $originalName)
            ->whereNull('parent_file_id');
            
        if ($financialYear) {
            $existingFileQuery->where('financial_year', $financialYear);
        } else {
            $existingFileQuery->whereNull('financial_year');
        }
        
        $existingFile = $existingFileQuery->first();

        $version = 1;
        $parentFileId = null;

        if ($existingFile) {
            $maxVersion = File::where('parent_file_id', $existingFile->id)->max('version');
            $version = ($maxVersion ? $maxVersion + 1 : 2);
            $parentFileId = $existingFile->id;
        }

        // Upload file
        StorageService::disk()->putFileAs(
            dirname($s3Path),
            $uploadedFile,
            basename($s3Path),
            'private'
        );

        $file = File::create([
            'client_id' => $clientId,
            'category_id' => $categoryId,
            'uploaded_by' => $request->user()->id,
            'original_name' => $originalName,
            'title' => $request->title,
            'stored_name' => $storedName,
            's3_path' => $s3Path,
            'mime_type' => $uploadedFile->getMimeType(),
            'size' => $uploadedFile->getSize(),
            'financial_year' => $financialYear,
            'version' => $version,
            'parent_file_id' => $parentFileId,
            'status' => 'uploaded',
            'file_hash' => $fileHash,
        ]);

        $this->auditLogService->log('file_uploaded', File::class, $file->id, "File '{$originalName}' uploaded for client {$clientId}");

        if ($duplicateFile) {
            return redirect()->route('files.index')->with('warning', 'File uploaded successfully. Note: A duplicate file was detected.');
        }

        return redirect()->route('files.index')->with('success', 'File uploaded successfully.');
    }

    public function show(File $file): View
    {
        $this->authorize('files.view');

        $file->load(['client', 'category', 'uploader', 'versions', 'parentFile', 'notes.user']);

        return view('files.show', compact('file'));
    }

    public function preview(File $file)
    {
        $this->authorize('files.preview');

        try {
            $disk = StorageService::disk();
            
            if (env('USE_AWS', false)) {
                // For S3, use temporary URL
                $url = $disk->temporaryUrl($file->s3_path, now()->addMinutes(10));
            } else {
                // For local storage, use a route to serve the file
                $url = route('files.serve', ['file' => $file->id]);
            }

            $this->auditLogService->log('file_previewed', File::class, $file->id, "File '{$file->original_name}' previewed");

            return response()->json([
                'url' => $url,
                'mime_type' => $file->mime_type,
                'name' => $file->original_name,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to generate preview link.'], 500);
        }
    }
    
    public function serve(File $file)
    {
        $this->authorize('files.preview');

        try {
            $disk = StorageService::disk();
            
            if (!$disk->exists($file->s3_path)) {
                abort(404, 'File not found.');
            }

            $this->auditLogService->log('file_served', File::class, $file->id, "File '{$file->original_name}' served for preview");

            return response($disk->get($file->s3_path))
                ->header('Content-Type', $file->mime_type)
                ->header('Content-Disposition', 'inline; filename="' . $file->original_name . '"');
        } catch (\Exception $e) {
            abort(500, 'Failed to serve file.');
        }
    }

    public function previewPage(File $file): View
    {
        $this->authorize('files.preview');

        try {
            $disk = StorageService::disk();
            
            if (env('USE_AWS', false)) {
                // For S3, use temporary URL
                $url = $disk->temporaryUrl($file->s3_path, now()->addMinutes(60));
            } else {
                // For local storage, use serve route
                $url = route('files.serve', ['file' => $file->id]);
            }

            $this->auditLogService->log('file_previewed', File::class, $file->id, "File '{$file->original_name}' previewed in new page");

            return view('files.preview', compact('file', 'url'));
        } catch (\Exception $e) {
            abort(500, 'Failed to generate preview link.');
        }
    }

    public function updateStatus(Request $request, File $file): RedirectResponse
    {
        $this->authorize('files.status.change');

        $validated = $request->validate([
            'status' => 'required|in:uploaded,pending_review,approved,needs_correction,archived',
        ]);

        $oldStatus = $file->status;
        $file->update(['status' => $validated['status']]);

        // Auto-lock approved files
        if ($validated['status'] === 'approved' && !$file->is_locked) {
            $file->update(['is_locked' => true]);
            $this->auditLogService->log('file_locked', File::class, $file->id, "File '{$file->original_name}' auto-locked upon approval");
        }

        $this->auditLogService->log(
            'file_status_changed',
            File::class,
            $file->id,
            "File '{$file->original_name}' status changed from {$oldStatus} to {$validated['status']}"
        );

        return redirect()->back()->with('success', 'File status updated successfully.');
    }

    public function toggleLock(File $file): RedirectResponse
    {
        if ($file->is_locked) {
            $this->authorize('files.unlock');
            $file->update(['is_locked' => false]);
            $action = 'unlocked';
        } else {
            $this->authorize('files.lock');
            $file->update(['is_locked' => true]);
            $action = 'locked';
        }

        $this->auditLogService->log(
            "file_{$action}",
            File::class,
            $file->id,
            "File '{$file->original_name}' {$action}"
        );

        return redirect()->back()->with('success', "File {$action} successfully.");
    }

    public function bulkAction(Request $request): RedirectResponse
    {
        $this->authorize('files.bulk');

        $validated = $request->validate([
            'action' => 'required|in:download,archive,delete,change_category,change_financial_year',
            'file_ids' => 'required|array',
            'file_ids.*' => 'exists:files,id',
            'category_id' => 'required_if:action,change_category|exists:categories,id',
            'financial_year' => 'required_if:action,change_financial_year|string',
        ]);

        $files = File::whereIn('id', $validated['file_ids'])->get();

        switch ($validated['action']) {
            case 'archive':
                foreach ($files as $file) {
                    $file->update(['status' => 'archived', 'archived_at' => now()]);
                    $this->auditLogService->log('file_archived', File::class, $file->id, "File '{$file->original_name}' archived via bulk action");
                }
                $message = count($files) . ' files archived successfully.';
                break;

            case 'delete':
                foreach ($files as $file) {
                    try {
                        StorageService::disk()->delete($file->s3_path);
                    } catch (\Exception $e) {
                        \Log::error("Failed to delete file from storage: " . $e->getMessage());
                    }
                    $this->auditLogService->log('file_deleted', File::class, $file->id, "File '{$file->original_name}' deleted via bulk action");
                    $file->delete();
                }
                $message = count($files) . ' files deleted successfully.';
                break;

            case 'change_category':
                foreach ($files as $file) {
                    $oldCategory = $file->category->name;
                    $file->update(['category_id' => $validated['category_id']]);
                    $this->auditLogService->log('file_category_changed', File::class, $file->id, "File '{$file->original_name}' category changed from {$oldCategory} via bulk action");
                }
                $message = count($files) . ' files category updated successfully.';
                break;

            case 'change_financial_year':
                foreach ($files as $file) {
                    $oldYear = $file->financial_year;
                    $file->update(['financial_year' => $validated['financial_year']]);
                    $this->auditLogService->log('file_financial_year_changed', File::class, $file->id, "File '{$file->original_name}' financial year changed from {$oldYear} to {$validated['financial_year']} via bulk action");
                }
                $message = count($files) . ' files financial year updated successfully.';
                break;

            case 'download':
                // This will be handled by a separate method that creates a ZIP
                return $this->bulkDownload($validated['file_ids']);
        }

        $this->auditLogService->log(
            'bulk_action_performed',
            File::class,
            null,
            "Bulk action '{$validated['action']}' performed on " . count($files) . " files"
        );

        return redirect()->route('files.index')->with('success', $message);
    }

    protected function bulkDownload(array $fileIds)
    {
        $files = File::whereIn('id', $fileIds)->get();
        
        // Create temp directory if it doesn't exist
        $tempDir = storage_path('app/temp');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0755, true);
        }
        
        // Create ZIP file
        $zipPath = $tempDir . '/' . Str::uuid() . '.zip';
        $zip = new \ZipArchive();
        
        if ($zip->open($zipPath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) !== TRUE) {
            return redirect()->back()->with('error', 'Failed to create ZIP file.');
        }

        $tempFiles = [];
        foreach ($files as $file) {
            try {
                $tempFile = tempnam(sys_get_temp_dir(), 'file_');
                $content = StorageService::disk()->get($file->s3_path);
                file_put_contents($tempFile, $content);
                $zip->addFile($tempFile, $file->original_name);
                $tempFiles[] = $tempFile;
            } catch (\Exception $e) {
                \Log::error("Failed to add file to ZIP: " . $e->getMessage());
            }
        }

        $zip->close();

        // Clean up temp files
        foreach ($tempFiles as $tempFile) {
            @unlink($tempFile);
        }

        $this->auditLogService->log(
            'bulk_download',
            File::class,
            null,
            "Bulk download performed on " . count($files) . " files"
        );

        return response()->download($zipPath)->deleteFileAfterSend(true);
    }

    public function download(File $file)
    {
        $this->authorize('files.download');

        try {
            $disk = StorageService::disk();
            
            if (env('USE_AWS', false)) {
                // For S3, use temporary URL
                $url = $disk->temporaryUrl($file->s3_path, now()->addMinutes(5));
                $this->auditLogService->log('file_downloaded', File::class, $file->id, "File '{$file->original_name}' downloaded");
                return redirect($url);
            } else {
                // For local storage, serve file directly
                if (!$disk->exists($file->s3_path)) {
                    return redirect()->back()->with('error', 'File not found.');
                }
                
                $this->auditLogService->log('file_downloaded', File::class, $file->id, "File '{$file->original_name}' downloaded");
                
                return $disk->download($file->s3_path, $file->original_name);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to generate download link.');
        }
    }

    public function uploadVersion(Request $request, File $file): RedirectResponse
    {
        $this->authorize('files.upload');

        $validated = $request->validate([
            'file' => ['required', 'file', 'max:10240'], // 10MB max
        ]);

        // Determine the parent file
        // If current file is a version, use its parent; otherwise use current file as parent
        $parentFile = $file->parent_file_id ? $file->parentFile : $file;

        // Calculate next version number
        $maxVersion = File::where('parent_file_id', $parentFile->id)->max('version');
        $nextVersion = ($maxVersion ? $maxVersion + 1 : 2);

        $uploadedFile = $request->file('file');
        $storedName = Str::uuid() . '.' . $uploadedFile->getClientOriginalExtension();
        
        // Build path with optional financial year
        $s3Path = $parentFile->financial_year 
            ? "clients/{$parentFile->client_id}/{$parentFile->financial_year}/{$parentFile->category_id}/{$storedName}"
            : "clients/{$parentFile->client_id}/{$parentFile->category_id}/{$storedName}";

        // Generate file hash for duplicate detection
        $fileHash = hash_file('sha256', $uploadedFile->getRealPath());

        // Upload file
        StorageService::disk()->putFileAs(
            dirname($s3Path),
            $uploadedFile,
            basename($s3Path),
            'private'
        );

        $newVersion = File::create([
            'client_id' => $parentFile->client_id,
            'category_id' => $parentFile->category_id,
            'uploaded_by' => $request->user()->id,
            'original_name' => $parentFile->original_name, // Keep same original name
            'stored_name' => $storedName,
            's3_path' => $s3Path,
            'mime_type' => $uploadedFile->getMimeType(),
            'size' => $uploadedFile->getSize(),
            'financial_year' => $parentFile->financial_year,
            'version' => $nextVersion,
            'parent_file_id' => $parentFile->id,
            'status' => 'uploaded',
            'file_hash' => $fileHash,
        ]);

        $this->auditLogService->log(
            'file_version_uploaded',
            File::class,
            $newVersion->id,
            "Version {$nextVersion} of file '{$parentFile->original_name}' uploaded"
        );

        return redirect()->route('files.show', $file)->with('success', "Version {$nextVersion} uploaded successfully.");
    }

    public function destroy(Request $request, File $file): RedirectResponse
    {
        $this->authorize('files.delete');

        // Verify password
        if (!\Hash::check($request->password, auth()->user()->password)) {
            return redirect()->route('files.index')
                ->withErrors(['password' => 'The provided password is incorrect.'])
                ->with('delete_file_id', $file->id)
                ->with('delete_file_name', $file->original_name);
        }

        $fileName = $file->original_name;
        $fileId = $file->id;

        // Delete from storage
        try {
            StorageService::disk()->delete($file->s3_path);
        } catch (\Exception $e) {
            \Log::error("Failed to delete file from storage: " . $e->getMessage());
        }

        $file->delete();

        $this->auditLogService->log('file_deleted', File::class, $fileId, "File '{$fileName}' deleted");

        return redirect()->route('files.index')->with('success', 'File deleted successfully.');
    }
}