<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeroomReport extends Model
{
    protected $fillable = [
        'class_homeroom_id',
        'report_date',
        'report_type', // bulanan/semester/tahunan/khusus
        'attendance_summary',
        'academic_summary',
        'behavior_summary',
        'class_issues',
        'action_taken',
        'recommendations',
        'parent_meeting_notes',
        'attachments'
    ];

    protected $casts = [
        'report_date' => 'date',
        'attendance_summary' => 'array',
        'academic_summary' => 'array',
        'behavior_summary' => 'array',
        'attachments' => 'array'
    ];

    public function classHomeroom()
    {
        return $this->belongsTo(ClassHomeroom::class);
    }

    // Relasi ke rapat orang tua
    public function parentMeetings()
    {
        return $this->hasMany(ParentMeeting::class);
    }

    // Relasi ke kasus-kasus khusus yang ditangani
    public function specialCases()
    {
        return $this->hasMany(StudentSpecialCase::class);
    }
} 