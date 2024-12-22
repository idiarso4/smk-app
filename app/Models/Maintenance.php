<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = [
        'item_id',
        'scheduled_date',
        'completed_date',
        'type', // routine/repair
        'description',
        'status',
        'cost',
        'technician_name',
        'attachments',
        'user_id'
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'completed_date' => 'date',
        'attachments' => 'array',
        'cost' => 'decimal:2'
    ];

    public function item()
    {
        return $this->belongsTo(InventoryItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 