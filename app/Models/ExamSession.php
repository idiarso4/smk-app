<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSession extends Model
{
    protected $fillable = [
        'name',
        'start_time',
        'end_time',
        'description'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];

    public function examRooms()
    {
        return $this->hasMany(ExamRoom::class);
    }
} 