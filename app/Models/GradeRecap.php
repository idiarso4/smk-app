<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeRecap extends Model
{
    protected $fillable = [
        'student_id',
        'subject_id',
        'academic_year_id',
        'semester',
        'daily_average',
        'mid_exam_score',
        'final_exam_score',
        'final_score',
        'grade',
        'teacher_notes',
        'is_passed'
    ];

    protected $casts = [
        'daily_average' => 'decimal:2',
        'mid_exam_score' => 'decimal:2',
        'final_exam_score' => 'decimal:2',
        'final_score' => 'decimal:2',
        'is_passed' => 'boolean'
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
} 