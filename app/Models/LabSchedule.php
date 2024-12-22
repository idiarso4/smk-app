<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabSchedule extends Model
{
    protected $fillable = [
        'laboratory_id',
        'teacher_id',
        'subject_id',
        'class_id',
        'date',
        'start_time',
        'end_time',
        'purpose',
        'materials_needed',
        'status', // pending/approved/rejected/completed
        'approved_by',
        'notes',
        'actual_start_time',
        'actual_end_time',
        'attendance_proof',
        'activity_report'
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'actual_start_time' => 'datetime',
        'actual_end_time' => 'datetime',
        'materials_needed' => 'array'
    ];

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function class()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
} 