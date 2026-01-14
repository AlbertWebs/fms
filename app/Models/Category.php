<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'retention_days',
    ];

    protected function casts(): array
    {
        return [
            'retention_days' => 'integer',
        ];
    }

    public function setRetentionDaysAttribute($value)
    {
        $this->attributes['retention_days'] = $value === null || $value === '' ? null : (int) $value;
    }

    public function getRetentionDaysAttribute($value)
    {
        return $value === null ? null : (int) $value;
    }

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }
}