<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeachingJournal extends Model
{
    protected $fillable = [
        'teacher_attendance_id',
        'material',
        'method',
        'notes',
        'attachments'
    ];

    protected $casts = [
        'attachments' => 'array'
    ];

    public function attendance()
    {
        return $this->belongsTo(TeacherAttendance::class, 'teacher_attendance_id');
    }
} 