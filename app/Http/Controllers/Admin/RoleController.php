<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct(
        protected AuditLogService $auditLogService
    ) {}

    public function index(): View
    {
        $this->authorize('users.manage');
        
        $roles = Role::with('permissions')->orderBy('name')->get();
        $permissions = Permission::orderBy('name')->get();

        return view('admin.roles.index', compact('roles', 'permissions'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('users.manage');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        $role = Role::create(['name' => $validated['name']]);

        $this->auditLogService->log(
            'role_created',
            Role::class,
            $role->id,
            "Role '{$role->name}' created"
        );

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $this->authorize('users.manage');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
        ]);

        $oldName = $role->name;
        $role->update(['name' => $validated['name']]);

        $this->auditLogService->log(
            'role_updated',
            Role::class,
            $role->id,
            "Role '{$oldName}' updated to '{$role->name}'"
        );

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }

    public function updatePermissions(Request $request, Role $role): RedirectResponse
    {
        $this->authorize('users.manage');
        
        $validated = $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,id',
        ]);

        $role->syncPermissions($validated['permissions'] ?? []);

        $this->auditLogService->log(
            'role_permissions_updated',
            Role::class,
            $role->id,
            "Permissions updated for role '{$role->name}'"
        );

        return redirect()->route('admin.roles.index')->with('success', 'Role permissions updated successfully.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $this->authorize('users.manage');
        
        if ($role->name === 'Admin') {
            return redirect()->route('admin.roles.index')->with('error', 'Cannot delete the Admin role.');
        }

        $roleName = $role->name;
        $roleId = $role->id;
        $role->delete();

        $this->auditLogService->log(
            'role_deleted',
            Role::class,
            $roleId,
            "Role '{$roleName}' deleted"
        );

        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }
}
