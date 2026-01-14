<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SystemSettingsController extends Controller
{
    public function __construct(
        protected AuditLogService $auditLogService
    ) {}

    public function index(): View
    {
        $this->authorize('users.manage');
        
        $settings = [
            'app_name' => Setting::get('app_name', config('app.name')),
            'company_name' => Setting::get('company_name'),
            'company_email' => Setting::get('company_email'),
            'company_phone' => Setting::get('company_phone'),
            'company_address' => Setting::get('company_address'),
            'company_website' => Setting::get('company_website'),
            'logo_path' => Setting::get('logo_path'),
        ];
        
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $this->authorize('users.manage');
        
        $validated = $request->validate([
            'app_name' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'company_email' => 'nullable|email|max:255',
            'company_phone' => 'nullable|string|max:255',
            'company_address' => 'nullable|string|max:500',
            'company_website' => 'nullable|url|max:255',
            'logo' => 'nullable|image|max:2048', // 2MB max
        ]);

        // Save text settings
        foreach (['app_name', 'company_name', 'company_email', 'company_phone', 'company_address', 'company_website'] as $key) {
            if (isset($validated[$key])) {
                Setting::set($key, $validated[$key]);
            } else {
                Setting::set($key, null);
            }
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoPath = $logo->store('logos', 'public');
            Setting::set('logo_path', $logoPath);
        }

        $this->auditLogService->log(
            'system_settings_updated',
            null,
            null,
            'System settings updated'
        );

        return redirect()->route('admin.settings.index')->with('success', 'Settings updated successfully.');
    }
}
