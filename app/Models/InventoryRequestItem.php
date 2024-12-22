<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryRequestItem extends Model
{
    protected $fillable = [
        'inventory_request_id',
        'item_id',
        'quantity_requested',
        'quantity_approved',
        'return_date', // untuk peminjaman
        'actual_return_date',
        'condition_before',
        'condition_after',
        'status' // pending/in_use/returned/lost
    ];

    protected $casts = [
        'return_date' => 'date',
        'actual_return_date' => 'date'
    ];

    public function request()
    {
        return $this->belongsTo(InventoryRequest::class, 'inventory_request_id');
    }

    public function item()
    {
        return $this->belongsTo(InventoryItem::class);
    }
} 