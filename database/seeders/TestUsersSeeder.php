<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class TestUsersSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'Admin')->first();
        $accountantRole = Role::where('name', 'Accountant')->first();
        $assistantRole = Role::where('name', 'Assistant')->first();
        $auditorRole = Role::where('name', 'Auditor')->first();

        // Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@filecr.com'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('password'),
                'mfa_enabled' => false,
            ]
        );
        if (!$admin->hasRole('Admin')) {
            $admin->assignRole($adminRole);
        }

        // Accountant User
        $accountant = User::firstOrCreate(
            ['email' => 'accountant@filecr.com'],
            [
                'name' => 'John Accountant',
                'password' => Hash::make('password'),
                'mfa_enabled' => false,
            ]
        );
        if (!$accountant->hasRole('Accountant')) {
            $accountant->assignRole($accountantRole);
        }

        // Assistant User
        $assistant = User::firstOrCreate(
            ['email' => 'assistant@filecr.com'],
            [
                'name' => 'Jane Assistant',
                'password' => Hash::make('password'),
                'mfa_enabled' => false,
            ]
        );
        if (!$assistant->hasRole('Assistant')) {
            $assistant->assignRole($assistantRole);
        }

        // Auditor User
        $auditor = User::firstOrCreate(
            ['email' => 'auditor@filecr.com'],
            [
                'name' => 'Michael Auditor',
                'password' => Hash::make('password'),
                'mfa_enabled' => false,
            ]
        );
        if (!$auditor->hasRole('Auditor')) {
            $auditor->assignRole($auditorRole);
        }

        $this->command->info('Test users created successfully!');
        $this->command->info('');
        $this->command->info('Login Credentials:');
        $this->command->info('Admin:      admin@filecr.com / password');
        $this->command->info('Accountant: accountant@filecr.com / password');
        $this->command->info('Assistant:  assistant@filecr.com / password');
        $this->command->info('Auditor:    auditor@filecr.com / password');
    }
}