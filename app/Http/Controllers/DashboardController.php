<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\File;
use App\Models\AuditLog;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalClients = Client::count();
        $filesThisMonth = File::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        
        $recentActivity = AuditLog::with('user')
            ->latest()
            ->limit(10)
            ->get();

        $storageUsage = File::sum('size'); // In bytes

        return view('dashboard', compact(
            'totalClients',
            'filesThisMonth',
            'recentActivity',
            'storageUsage'
        ));
    }
}