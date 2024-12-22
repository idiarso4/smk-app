<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryLoan extends Model
{
    protected $fillable = [
        'user_id',
        'item_id',
        'quantity',
        'loan_date',
        'expected_return_date',
        'actual_return_date',
        'purpose',
        'status',
        'notes',
        'approved_by'
    ];

    protected $casts = [
        'loan_date' => 'datetime',
        'expected_return_date' => 'date',
        'actual_return_date' => 'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(InventoryItem::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
} 