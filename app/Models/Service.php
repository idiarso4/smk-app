<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    protected $fillable = [
        'production_unit_id',
        'name',
        'category',
        'price',
        'duration',
        'description',
        'is_available',
        'photos',
        'notes',
    ];

    protected $casts = [
        'photos' => 'array',
        'is_available' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function productionUnit(): BelongsTo
    {
        return $this->belongsTo(ProductionUnit::class);
    }
} 