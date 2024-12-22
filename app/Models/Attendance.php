<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'student_id',
        'class_id',
        'academic_year_id',
        'date',
        'status', // hadir/sakit/izin/alpha
        'notes',
        'attachment',
        'verified_by'
    ];

    protected $casts = [
        'date' => 'date'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function class()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }
} 