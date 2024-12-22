<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryStock extends Model
{
    protected $fillable = [
        'item_id',
        'quantity',
        'condition',
        'location'
    ];

    public function item()
    {
        return $this->belongsTo(InventoryItem::class);
    }
} 