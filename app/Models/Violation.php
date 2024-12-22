<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
    protected $fillable = [
        'student_id',
        'violation_type_id',
        'date',
        'description',
        'point',
        'action_taken',
        'counselor_id',
        'parent_notification',
        'attachments',
        'follow_up',
        'status' // open/in_progress/closed
    ];

    protected $casts = [
        'date' => 'datetime',
        'attachments' => 'array',
        'parent_notification' => 'datetime'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function violationType()
    {
        return $this->belongsTo(ViolationType::class);
    }

    public function counselor()
    {
        return $this->belongsTo(Teacher::class, 'counselor_id');
    }
} 