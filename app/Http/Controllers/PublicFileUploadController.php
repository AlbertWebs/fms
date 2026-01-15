<?php

namespace App\Http\Controllers;

use App\Models\FileRequest;
use App\Models\File;
use App\Models\Client;
use App\Models\Category;
use App\Services\AuditLogService;
use App\Services\StorageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PublicFileUploadController extends Controller
{
    public function __construct(
        protected AuditLogService $auditLogService
    ) {}

    public function show(string $token): View|RedirectResponse
    {
        $fileRequest = FileRequest::where('token', $token)->firstOrFail();

        if ($fileRequest->status === 'completed') {
            return view('file-requests.upload', compact('fileRequest'))->with('success', 'This file request has already been completed.');
        }

        if ($fileRequest->isExpired()) {
            $fileRequest->update(['status' => 'expired']);
            return view('file-requests.upload', compact('fileRequest'))->with('error', 'This file request has expired.');
        }

        $fileRequest->load(['client', 'category']);

        return view('file-requests.upload', compact('fileRequest'));
    }

    public function store(Request $request, string $token): RedirectResponse
    {
        $fileRequest = FileRequest::where('token', $token)
            ->where('status', 'pending')
            ->firstOrFail();

        if ($fileRequest->isExpired()) {
            $fileRequest->update(['status' => 'expired']);
            return back()->with('error', 'This file request has expired.');
        }

        $validated = $request->validate([
            'file' => 'required|file|max:10240', // 10MB max
        ]);

        $uploadedFile = $request->file('file');
        $clientId = $fileRequest->client_id;
        $financialYear = $fileRequest->financial_year ?? null;
        $categoryId = $fileRequest->category_id;

        if (!$categoryId) {
            return back()->with('error', 'Category is required. Please contact support.');
        }

        $originalName = $uploadedFile->getClientOriginalName();
        $storedName = Str::uuid() . '.' . $uploadedFile->getClientOriginalExtension();
        
        // Build path with optional financial year
        $s3Path = $financialYear 
            ? "clients/{$clientId}/{$financialYear}/{$categoryId}/{$storedName}"
            : "clients/{$clientId}/{$categoryId}/{$storedName}";

        // Check for existing file for versioning
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
        try {
            StorageService::disk()->putFileAs(
                dirname($s3Path),
                $uploadedFile,
                basename($s3Path),
                'private'
            );
        } catch (\Exception $e) {
            \Log::error('Failed to upload file: ' . $e->getMessage());
            return back()->with('error', 'Failed to upload file. Please try again.');
        }

        $file = File::create([
            'client_id' => $clientId,
            'category_id' => $categoryId,
            'uploaded_by' => $fileRequest->requested_by, // Use the user who requested the file upload
            'original_name' => $originalName,
            'stored_name' => $storedName,
            's3_path' => $s3Path,
            'mime_type' => $uploadedFile->getMimeType(),
            'size' => $uploadedFile->getSize(),
            'financial_year' => $financialYear,
            'version' => $version,
            'parent_file_id' => $parentFileId,
        ]);

        // Mark file request as completed
        $fileRequest->markAsCompleted();

        $this->auditLogService->log(
            'file_uploaded_via_request',
            File::class,
            $file->id,
            "File '{$originalName}' uploaded via file request '{$fileRequest->title}'"
        );

        return redirect()->route('file-requests.upload', $token)
            ->with('success', 'File uploaded successfully. Thank you!');
    }
}
