<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientActivityController extends Controller
{
    public function timeline(Client $client, Request $request): View
    {
        $this->authorize('clients.view');

        $query = AuditLog::with('user')
            ->where(function ($q) use ($client) {
                // Direct client actions
                $q->where(function ($subQ) use ($client) {
                    $subQ->where('model_type', Client::class)
                         ->where('model_id', $client->id);
                })
                // File actions for this client
                ->orWhere(function ($subQ) use ($client) {
                    $subQ->where('model_type', \App\Models\File::class)
                         ->whereIn('model_id', $client->files()->pluck('id'));
                });
            })
            ->latest();

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $activities = $query->paginate(50);

        return view('clients.timeline', compact('client', 'activities'));
    }
}
