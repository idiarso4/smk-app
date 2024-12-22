<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerGuidance extends Model
{
    protected $fillable = [
        'student_id',
        'academic_year_id',
        'interest_test_result',
        'talent_test_result',
        'personality_test_result',
        'recommended_majors',
        'career_recommendations',
        'counselor_notes',
        'parent_approval',
        'final_decision',
        'counselor_id'
    ];

    protected $casts = [
        'interest_test_result' => 'array',
        'talent_test_result' => 'array',
        'personality_test_result' => 'array',
        'recommended_majors' => 'array',
        'career_recommendations' => 'array',
        'parent_approval' => 'datetime'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function counselor()
    {
        return $this->belongsTo(Teacher::class, 'counselor_id');
    }
} 