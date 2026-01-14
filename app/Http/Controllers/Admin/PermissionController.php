<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct(
        protected AuditLogService $auditLogService
    ) {}

    public function index(): View
    {
        $this->authorize('users.manage');
        
        $permissions = Permission::orderBy('name')->get();
        
        // Group permissions by prefix
        $grouped = $permissions->groupBy(function ($permission) {
            return explode('.', $permission->name)[0] ?? 'other';
        });

        return view('admin.permissions.index', compact('permissions', 'grouped'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('users.manage');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        $permission = Permission::create(['name' => $validated['name']]);

        $this->auditLogService->log(
            'permission_created',
            Permission::class,
            $permission->id,
            "Permission '{$permission->name}' created"
        );

        return redirect()->route('admin.permissions.index')->with('success', 'Permission created successfully.');
    }

    public function update(Request $request, Permission $permission): RedirectResponse
    {
        $this->authorize('users.manage');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
        ]);

        $oldName = $permission->name;
        $permission->update(['name' => $validated['name']]);

        $this->auditLogService->log(
            'permission_updated',
            Permission::class,
            $permission->id,
            "Permission '{$oldName}' updated to '{$permission->name}'"
        );

        return redirect()->route('admin.permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission): RedirectResponse
    {
        $this->authorize('users.manage');
        
        $permissionName = $permission->name;
        $permissionId = $permission->id;
        $permission->delete();

        $this->auditLogService->log(
            'permission_deleted',
            Permission::class,
            $permissionId,
            "Permission '{$permissionName}' deleted"
        );

        return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
