<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'code',
        'specifications',
        'minimum_stock'
    ];

    protected $casts = [
        'specifications' => 'array'
    ];

    public function category()
    {
        return $this->belongsTo(InventoryCategory::class);
    }

    public function stocks()
    {
        return $this->hasMany(InventoryStock::class, 'item_id');
    }

    public function transactions()
    {
        return $this->hasMany(InventoryTransaction::class, 'item_id');
    }
} 