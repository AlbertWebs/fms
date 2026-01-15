<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Services\AuditLogService;
use App\Services\StorageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function __construct(
        protected AuditLogService $auditLogService
    ) {}

    public function index(Request $request): View
    {
        $this->authorize('clients.view');

        $query = Client::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('kra_pin', 'like', "%{$search}%");
            });
        }

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $clients = $query->latest()->paginate(20);

        // Statistics
        $totalClients = Client::count();
        $activeClients = Client::where('status', 'active')->count();
        $dormantClients = Client::where('status', 'dormant')->count();
        $archivedClients = Client::where('status', 'archived')->count();

        return view('clients.index', compact('clients', 'totalClients', 'activeClients', 'dormantClients', 'archivedClients'));
    }

    public function create(): View
    {
        $this->authorize('clients.create');

        return view('clients.create');
    }

    public function store(StoreClientRequest $request): RedirectResponse
    {
        $client = Client::create($request->validated());

        // Create S3 folder structure for client
        $this->createClientFolder($client->id);

        $this->auditLogService->log('client_created', Client::class, $client->id, "Client '{$client->name}' created");

        return redirect()->route('clients.index')->with('success', 'Client created successfully.');
    }

    public function show(Client $client): View
    {
        $this->authorize('clients.view');

        $client->load(['files.category', 'files.uploader']);
        $files = $client->files()->with(['category', 'uploader'])->latest()->paginate(10);
        
        $totalFiles = $client->files()->count();
        $totalSize = $client->files()->sum('size');
        $categoriesCount = $client->files()->distinct('category_id')->count('category_id');

        return view('clients.show', compact('client', 'files', 'totalFiles', 'totalSize', 'categoriesCount'));
    }

    public function edit(Client $client): View
    {
        $this->authorize('clients.update');

        return view('clients.edit', compact('client'));
    }

    public function update(UpdateClientRequest $request, Client $client): RedirectResponse
    {
        $oldAttributes = $client->getOriginal();
        $client->update($request->validated());
        $changes = array_diff_assoc($client->getAttributes(), $oldAttributes);

        $this->auditLogService->log('client_updated', Client::class, $client->id, "Client '{$client->name}' updated.", $changes);

        return redirect()->route('clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(Client $client): RedirectResponse
    {
        $this->authorize('clients.delete');

        $clientName = $client->name;
        $client->delete();

        $this->auditLogService->log('client_deleted', Client::class, $client->id, "Client '{$clientName}' soft deleted.");

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully.');
    }

    protected function createClientFolder(int $clientId): void
    {
        $folderPath = "clients/{$clientId}/";
        try {
            $disk = StorageService::disk();
            if (!$disk->exists($folderPath)) {
                $disk->makeDirectory($folderPath);
            }
        } catch (\Exception $e) {
            \Log::error("Failed to create folder for client {$clientId}: " . $e->getMessage());
        }
    }
}