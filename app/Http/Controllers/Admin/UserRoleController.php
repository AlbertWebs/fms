<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuditLogService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function __construct(
        protected AuditLogService $auditLogService
    ) {}

    public function index(Request $request): View
    {
        $this->authorize('users.manage');
        
        $query = User::with('roles')->orderBy('name');

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if ($request->has('role')) {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('name', $request->role);
            });
        }

        $users = $query->paginate(20);
        $roles = Role::orderBy('name')->get();

        return view('admin.users.index', compact('users', 'roles'));
    }

    public function create(): View
    {
        $this->authorize('users.manage');
        
        $roles = Role::orderBy('name')->get();

        return view('admin.users.create', compact('roles'));
    }

    public function updateRoles(Request $request, User $user): RedirectResponse
    {
        $this->authorize('users.manage');
        
        $validated = $request->validate([
            'roles' => 'array',
            'roles.*' => 'exists:roles,id',
        ]);

        $roles = !empty($validated['roles']) 
            ? Role::whereIn('id', $validated['roles'])->get()
            : collect();
        
        $user->syncRoles($roles);

        $this->auditLogService->log(
            'user_roles_updated',
            User::class,
            $user->id,
            "Roles updated for user '{$user->name}'"
        );

        return redirect()->route('admin.users.index')->with('success', 'User roles updated successfully.');
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('users.manage');
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'roles' => 'array',
            'roles.*' => 'exists:roles,id',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'mfa_enabled' => true,
        ]);

        if (!empty($validated['roles'])) {
            $roles = Role::whereIn('id', $validated['roles'])->get();
            $user->syncRoles($roles);
        }

        $this->auditLogService->log(
            'user_created',
            User::class,
            $user->id,
            "User '{$user->name}' created"
        );

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->authorize('users.manage');
        
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot delete your own account.');
        }

        $userName = $user->name;
        $userId = $user->id;
        $user->delete();

        $this->auditLogService->log(
            'user_deleted',
            User::class,
            $userId,
            "User '{$userName}' deleted"
        );

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
