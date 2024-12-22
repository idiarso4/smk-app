<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DailyScore extends Model
{
    protected $fillable = [
        'student_id',
        'subject_id',
        'academic_year_id',
        'semester',
        'assessment_date',
        'assessment_type', // tugas/kuis/praktik/proyek
        'score',
        'weight',
        'notes',
        'teacher_id'
    ];

    protected $casts = [
        'assessment_date' => 'date',
        'score' => 'decimal:2',
        'weight' => 'decimal:2'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
} 