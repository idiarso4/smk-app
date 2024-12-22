<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationMeeting extends Model
{
    protected $fillable = [
        'student_organization_id',
        'title',
        'type', // rutin/khusus/darurat
        'date',
        'start_time',
        'end_time',
        'location',
        'agenda',
        'attendees',
        'minutes',
        'decisions',
        'action_items',
        'attachments',
        'status' // scheduled/completed/cancelled
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'agenda' => 'array',
        'attendees' => 'array',
        'decisions' => 'array',
        'action_items' => 'array',
        'attachments' => 'array'
    ];

    public function organization()
    {
        return $this->belongsTo(StudentOrganization::class, 'student_organization_id');
    }

    public function attendance()
    {
        return $this->hasMany(OrganizationMeetingAttendance::class);
    }
} 