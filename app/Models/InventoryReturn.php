<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryReturn extends Model
{
    protected $fillable = [
        'inventory_request_id',
        'return_date',
        'received_by',
        'notes',
        'status', // complete/incomplete/damaged
        'damage_description',
        'fine_amount',
        'fine_paid'
    ];

    protected $casts = [
        'return_date' => 'datetime',
        'fine_amount' => 'decimal:2',
        'fine_paid' => 'boolean'
    ];

    public function request()
    {
        return $this->belongsTo(InventoryRequest::class, 'inventory_request_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    public function items()
    {
        return $this->hasMany(InventoryReturnItem::class);
    }
} 