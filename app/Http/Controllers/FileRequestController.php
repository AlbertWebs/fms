<?php

namespace App\Http\Controllers;

use App\Models\FileRequest;
use App\Models\Client;
use App\Models\Category;
use App\Models\User;
use App\Mail\FileRequestMail;
use App\Mail\FileRequestAdminNotificationMail;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Illuminate\Support\Str;

class FileRequestController extends Controller
{
    public function __construct(
        protected AuditLogService $auditLogService
    ) {}

    public function index(Request $request): View
    {
        $this->authorize('files.view');

        $query = FileRequest::with(['client', 'requester', 'category'])->latest();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('client_id')) {
            $query->where('client_id', $request->client_id);
        }

        $fileRequests = $query->paginate(20);
        $clients = Client::orderBy('name')->get();

        return view('file-requests.index', compact('fileRequests', 'clients'));
    }

    public function create(Request $request): View
    {
        $this->authorize('files.upload');

        $clients = Client::where('status', 'active')->orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $financialYears = $this->generateFinancialYears();

        return view('file-requests.create', compact('clients', 'categories', 'financialYears'));
    }

    protected function generateFinancialYears(): array
    {
        $years = [];
        $currentYear = now()->year;
        
        for ($i = -5; $i <= 2; $i++) {
            $startYear = $currentYear + $i;
            $endYear = $startYear + 1;
            $years[] = "{$startYear}-{$endYear}";
        }
        
        return $years;
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('files.upload');

        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'category_id' => 'nullable|exists:categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'financial_year' => 'nullable|string',
            'expires_in_days' => ['nullable', 'integer', 'min:1', 'max:90'],
        ]);

        // Ensure expires_in_days is cast to int
        if (isset($validated['expires_in_days']) && $validated['expires_in_days'] !== null) {
            $validated['expires_in_days'] = (int) $validated['expires_in_days'];
        }

        $expiresAt = $validated['expires_in_days'] 
            ? now()->addDays($validated['expires_in_days'])
            : now()->addDays(30);

        $fileRequest = FileRequest::create([
            'client_id' => $validated['client_id'],
            'requested_by' => auth()->id(),
            'category_id' => $validated['category_id'] ?? null,
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'financial_year' => $validated['financial_year'] ?? null,
            'expires_at' => $expiresAt,
            'status' => 'pending',
        ]);

        // Load relationships for email
        $fileRequest->load(['client', 'requester', 'category']);

        // Send email to client
        $clientEmail = $fileRequest->client->contact_email ?? $fileRequest->client->email;
        if ($clientEmail) {
            try {
                Mail::to($clientEmail)->send(new FileRequestMail($fileRequest));
            } catch (\Exception $e) {
                \Log::error('Failed to send file request email to client: ' . $e->getMessage());
            }
        }

        // Send email notification to all admins
        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', 'Admin');
        })->get();

        foreach ($admins as $admin) {
            try {
                Mail::to($admin->email)->send(new FileRequestAdminNotificationMail($fileRequest));
            } catch (\Exception $e) {
                \Log::error('Failed to send file request admin notification email: ' . $e->getMessage());
            }
        }

        $this->auditLogService->log(
            'file_request_created',
            FileRequest::class,
            $fileRequest->id,
            "File request '{$fileRequest->title}' created for client {$fileRequest->client->name}"
        );

        return redirect()->route('file-requests.index')->with('success', 'File request sent successfully.');
    }

    public function show(FileRequest $fileRequest): View
    {
        $this->authorize('files.view');

        $fileRequest->load(['client', 'requester', 'category']);

        return view('file-requests.show', compact('fileRequest'));
    }

    public function destroy(FileRequest $fileRequest): RedirectResponse
    {
        $this->authorize('files.delete');

        $title = $fileRequest->title;
        $fileRequest->delete();

        $this->auditLogService->log(
            'file_request_deleted',
            FileRequest::class,
            $fileRequest->id,
            "File request '{$title}' deleted"
        );

        return redirect()->route('file-requests.index')->with('success', 'File request deleted successfully.');
    }
}
