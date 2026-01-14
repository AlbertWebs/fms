<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
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
        $admin->givePermissionTo(Permission::all());

        $accountant = Role::firstOrCreate(['name' => 'Accountant']);
        $accountant->givePermissionTo([
            'clients.create',
            'clients.view',
            'clients.update',
            'files.upload',
            'files.view',
            'files.download',
            'files.delete',
            'files.archive',
        ]);

        $assistant = Role::firstOrCreate(['name' => 'Assistant']);
        $assistant->givePermissionTo([
            'clients.view',
            'files.upload',
            'files.view',
            'files.download',
        ]);

        $auditor = Role::firstOrCreate(['name' => 'Auditor']);
        $auditor->givePermissionTo([
            'clients.view',
            'files.view',
            'files.download',
            'audit.view',
        ]);
    }
}