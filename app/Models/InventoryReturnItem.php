<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryReturnItem extends Model
{
    protected $fillable = [
        'inventory_return_id',
        'inventory_request_item_id',
        'quantity_returned',
        'condition',
        'damage_notes',
        'replacement_cost'
    ];

    protected $casts = [
        'replacement_cost' => 'decimal:2'
    ];

    public function return()
    {
        return $this->belongsTo(InventoryReturn::class, 'inventory_return_id');
    }

    public function requestItem()
    {
        return $this->belongsTo(InventoryRequestItem::class, 'inventory_request_item_id');
    }
} 