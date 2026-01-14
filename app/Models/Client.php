<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'kra_pin',
        'status',
        'company_name',
        'company_address',
        'company_website',
        'company_registration_number',
        'contact_name',
        'contact_email',
        'contact_phone',
        'contact_position',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'string',
        ];
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }

    public function fileRequests(): HasMany
    {
        return $this->hasMany(FileRequest::class);
    }
}