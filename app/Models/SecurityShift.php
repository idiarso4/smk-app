<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecurityShift extends Model
{
    protected $fillable = [
        'user_id',
        'shift_name', // Pagi/Siang/Malam
        'start_time',
        'end_time',
        'date',
        'status', // scheduled/on_duty/completed/absent
        'check_in_time',
        'check_out_time',
        'check_in_photo',
        'check_out_photo',
        'notes',
        'replacement_guard_id' // jika ada pergantian petugas
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime'
    ];

    public function guard()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replacementGuard()
    {
        return $this->belongsTo(User::class, 'replacement_guard_id');
    }

    public function logs()
    {
        return $this->hasMany(SecurityLog::class);
    }

    public function patrols()
    {
        return $this->hasMany(SecurityPatrol::class);
    }
} 