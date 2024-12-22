<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'academic_year_id',
        'semester',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function examSchedules()
    {
        return $this->hasMany(ExamSchedule::class);
    }
} 