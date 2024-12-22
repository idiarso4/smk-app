<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permit extends Model
{
    protected $fillable = [
        'student_id',
        'subject_id',
        'teacher_id',
        'supervisor_id',
        'permit_date',
        'start_time',
        'end_time',
        'reason',
        'type',
        'proof_file',
        'status',
        'teacher_notes',
        'supervisor_notes',
        'teacher_approved_at',
        'supervisor_approved_at'
    ];

    protected $casts = [
        'permit_date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'teacher_approved_at' => 'datetime',
        'supervisor_approved_at' => 'datetime'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(Teacher::class, 'supervisor_id');
    }

    public function isPendingTeacher()
    {
        return $this->status === 'pending_teacher';
    }

    public function isPendingSupervisor()
    {
        return $this->status === 'pending_supervisor';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    public function canProceedToSupervisor()
    {
        return $this->teacher_approved_at !== null;
    }
} 