<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductionUnit extends Model
{
    protected $fillable = [
        'name',
        'category',
        'supervisor_id',
        'location',
        'open_time',
        'close_time',
        'operational_days',
        'description',
        'is_active',
        'photos',
        'notes',
    ];

    protected $casts = [
        'operational_days' => 'array',
        'photos' => 'array',
        'is_active' => 'boolean',
    ];

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'supervisor_id');
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function staff(): HasMany
    {
        return $this->hasMany(UnitStaff::class);
    }
} 