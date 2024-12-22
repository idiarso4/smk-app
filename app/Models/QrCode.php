<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrCode extends Model
{
    protected $fillable = [
        'room_id',
        'code',
        'valid_until'
    ];

    protected $casts = [
        'valid_until' => 'datetime'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
} 