<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentRecord extends Model
{
    protected $fillable = [
        'student_id',
        'academic_year_id',
        'class_id',
        'registration_status', // baru/pindahan/mengulang
        'previous_school',
        'entry_date',
        'graduation_date',
        'family_card_no',
        'birth_certificate_no',
        'parent_data',
        'guardian_data',
        'achievement_history',
        'violation_history',
        'health_history'
    ];

    protected $casts = [
        'entry_date' => 'date',
        'graduation_date' => 'date',
        'parent_data' => 'array',
        'guardian_data' => 'array',
        'achievement_history' => 'array',
        'violation_history' => 'array',
        'health_history' => 'array'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function class()
    {
        return $this->belongsTo(ClassRoom::class);
    }
} 