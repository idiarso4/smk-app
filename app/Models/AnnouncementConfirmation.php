<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnouncementConfirmation extends Model
{
    protected $fillable = [
        'announcement_id',
        'user_id',
        'read_at',
        'confirmed_at',
        'response', // untuk pengumuman yang membutuhkan tanggapan
        'device_info'
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'confirmed_at' => 'datetime',
        'device_info' => 'array'
    ];

    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 