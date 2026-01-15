<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Category;
use App\Models\Client;
use App\Models\EmailLog;
use App\Models\File;
use App\Models\FileNote;
use App\Models\FileRequest;
use App\Models\MfaVerification;
use App\Services\StorageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PurgeController extends Controller
{
    public function index(): View
    {
        $this->authorize('users.manage');

        // Get counts for display
        $counts = [
            'clients' => Client::count(),
            'files' => File::count(),
            'categories' => Category::count(),
            'file_requests' => FileRequest::count(),
            'audit_logs' => AuditLog::count(),
            'email_logs' => EmailLog::count(),
            'mfa_verifications' => MfaVerification::count(),
            'roles' => Role::count(),
            'permissions' => Permission::count(),
        ];

        return view('admin.purge.index', compact('counts'));
    }

    public function purge(): RedirectResponse
    {
        $this->authorize('users.manage');

        DB::beginTransaction();
        
        try {
            // Disable foreign key checks for SQLite
            $driver = DB::getDriverName();
            if ($driver === 'sqlite') {
                DB::statement('PRAGMA foreign_keys = OFF');
            }

            // Delete files from storage first (include soft-deleted files)
            $files = File::withTrashed()->get();
            foreach ($files as $file) {
                try {
                    StorageService::disk()->delete($file->s3_path);
                } catch (\Exception $e) {
                    \Log::warning("Failed to delete file from storage: {$file->s3_path} - " . $e->getMessage());
                }
            }

            // Delete all file notes (no soft deletes, so regular delete)
            FileNote::query()->delete();

            // Delete all files (force delete to bypass soft deletes and foreign key restrictions)
            File::withTrashed()->forceDelete();

            // Delete all file requests (no soft deletes, so regular delete)
            FileRequest::query()->delete();

            // Delete all clients (force delete to bypass soft deletes)
            Client::withTrashed()->forceDelete();

            // Delete all categories (now safe since files are deleted)
            Category::query()->delete();

            // Delete all audit logs
            AuditLog::query()->delete();

            // Delete all email logs
            EmailLog::query()->delete();

            // Delete all MFA verifications
            MfaVerification::query()->delete();

            // Delete roles and permissions (but keep users)
            DB::table('model_has_roles')->delete();
            DB::table('role_has_permissions')->delete();
            DB::table('model_has_permissions')->delete();
            Role::query()->delete();
            Permission::query()->delete();

            // Re-seed roles and permissions so admin users can still access the system
            $this->reseedRolesAndPermissions();

            // Re-enable foreign key checks for SQLite
            if ($driver === 'sqlite') {
                DB::statement('PRAGMA foreign_keys = ON');
            }

            // Clear storage directories (if using local storage)
            if (!env('USE_AWS', false)) {
                try {
                    $storagePath = storage_path('app/files');
                    if (is_dir($storagePath)) {
                        $this->deleteDirectory($storagePath);
                    }
                } catch (\Exception $e) {
                    \Log::warning("Failed to delete storage directory: " . $e->getMessage());
                }
            }

            DB::commit();

            return redirect()->route('admin.purge.index')
                ->with('success', 'All data has been purged successfully. Users have been preserved.');
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Re-enable foreign key checks in case of error
            try {
                if (DB::getDriverName() === 'sqlite') {
                    DB::statement('PRAGMA foreign_keys = ON');
                }
            } catch (\Exception $e2) {
                // Ignore
            }
            
            \Log::error("Purge failed: " . $e->getMessage());
            
            return redirect()->route('admin.purge.index')
                ->with('error', 'Failed to purge data: ' . $e->getMessage());
        }
    }

    protected function deleteDirectory(string $dir): bool
    {
        if (!is_dir($dir)) {
            return false;
        }

        $files = array_diff(scandir($dir), ['.', '..']);
        
        foreach ($files as $file) {
            $path = $dir . DIRECTORY_SEPARATOR . $file;
            is_dir($path) ? $this->deleteDirectory($path) : unlink($path);
        }
        
        return rmdir($dir);
    }

    protected function reseedRolesAndPermissions(): void
    {
        $permissions = [
            'users.manage',
            'clients.create',
            'clients.view',
            'clients.update',
            'clients.delete',
            'categories.manage',
            'files.upload',
            'files.view',
            'files.download',
            'files.delete',
            'files.archive',
            'files.preview',
            'files.bulk',
            'files.lock',
            'files.unlock',
            'files.status.change',
            'files.notes',
            'files.retention.manage',
            'audit.view',
            'mfa.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'Admin']);
        $admin->syncPermissions(Permission::all());

        // Assign Admin role to all existing users (since they were admins before purge)
        $users = \App\Models\User::all();
        foreach ($users as $user) {
            if (!$user->hasRole('Admin')) {
                $user->assignRole('Admin');
            }
        }
    }
}
