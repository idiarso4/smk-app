<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'title',
        'type', // rapat_guru/rapat_wali_kelas/rapat_komite/rapat_osis/dll
        'date',
        'start_time',
        'end_time',
        'location',
        'agenda',
        'organizer_id',
        'attendees', // array of user_ids
        'attachments',
        'status', // scheduled/ongoing/completed/cancelled
        'minutes_of_meeting',
        'attendance_proof',
        'follow_up_tasks'
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'agenda' => 'array',
        'attendees' => 'array',
        'attachments' => 'array',
        'minutes_of_meeting' => 'array',
        'follow_up_tasks' => 'array'
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function attendanceRecords()
    {
        return $this->hasMany(MeetingAttendance::class);
    }
} 