<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryRequest extends Model
{
    protected $fillable = [
        'user_id',
        'type', // pengambilan/peminjaman
        'status', // pending/approved/rejected/completed
        'request_date',
        'approval_date',
        'notes',
        'approved_by'
    ];

    protected $casts = [
        'request_date' => 'datetime',
        'approval_date' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function items()
    {
        return $this->hasMany(InventoryRequestItem::class);
    }
} 