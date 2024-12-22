<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingAttendance extends Model
{
    protected $fillable = [
        'meeting_id',
        'user_id',
        'status', // hadir/izin/sakit/alpha
        'check_in_time',
        'check_out_time',
        'notes',
        'proof' // foto/tanda tangan digital
    ];

    protected $casts = [
        'check_in_time' => 'datetime',
        'check_out_time' => 'datetime'
    ];

    public function meeting()
    {
        return $this->belongsTo(Meeting::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 