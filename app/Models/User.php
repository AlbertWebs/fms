<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'mfa_enabled',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $attributes = [
        'mfa_enabled' => true,
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'mfa_enabled' => 'boolean',
        ];
    }

    public function mfaVerifications()
    {
        return $this->hasMany(MfaVerification::class);
    }

    public function files()
    {
        return $this->hasMany(File::class, 'uploaded_by');
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }
}
