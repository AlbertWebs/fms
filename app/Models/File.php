<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class File extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'client_id',
        'category_id',
        'uploaded_by',
        'original_name',
        'stored_name',
        's3_path',
        'mime_type',
        'size',
        'financial_year',
        'version',
        'parent_file_id',
        'status',
        'is_locked',
        'file_hash',
        'archived_at',
    ];

    protected function casts(): array
    {
        return [
            'size' => 'integer',
            'version' => 'integer',
            'is_locked' => 'boolean',
            'archived_at' => 'datetime',
        ];
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function parentFile(): BelongsTo
    {
        return $this->belongsTo(File::class, 'parent_file_id');
    }

    public function versions(): HasMany
    {
        return $this->hasMany(File::class, 'parent_file_id')->orderBy('version', 'desc');
    }

    public function notes(): HasMany
    {
        return $this->hasMany(FileNote::class)->orderBy('created_at', 'desc');
    }

    public function isLocked(): bool
    {
        return $this->is_locked;
    }

    public function canBeEdited(): bool
    {
        return !$this->is_locked || auth()->user()?->can('files.unlock');
    }

    // Query Scopes for Advanced Search
    public function scopeSearch($query, string $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('original_name', 'like', "%{$search}%")
              ->orWhere('financial_year', 'like', "%{$search}%")
              ->orWhereHas('client', function ($q) use ($search) {
                  $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
              })
              ->orWhereHas('category', function ($q) use ($search) {
                  $q->where('name', 'like', "%{$search}%");
              })
              ->orWhereHas('uploader', function ($q) use ($search) {
                  $q->where('name', 'like', "%{$search}%");
              });
        });
    }

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('created_at', [$startDate, $endDate]);
    }

    public function scopeLocked($query)
    {
        return $query->where('is_locked', true);
    }

    public function scopeUnlocked($query)
    {
        return $query->where('is_locked', false);
    }

    public function scopeNeedsArchiving($query)
    {
        $driver = DB::getDriverName();
        
        return $query->join('categories', 'files.category_id', '=', 'categories.id')
            ->whereNotNull('categories.retention_days')
            ->where('files.status', '!=', 'archived')
            ->whereNull('files.archived_at')
            ->when($driver === 'sqlite', function ($q) {
                // SQLite syntax - use julianday for date arithmetic
                $q->whereRaw("julianday(files.created_at) + CAST(categories.retention_days AS INTEGER) <= julianday('now')");
            }, function ($q) {
                // MySQL/PostgreSQL syntax
                $q->whereRaw('DATE_ADD(files.created_at, INTERVAL CAST(categories.retention_days AS UNSIGNED) DAY) <= NOW()');
            })
            ->select('files.*');
    }
}