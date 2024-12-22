<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    protected $fillable = [
        'student_id',
        'teacher_id',
        'company_name',
        'company_address',
        'supervisor_name',
        'supervisor_contact',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function journals()
    {
        return $this->hasMany(InternshipJournal::class);
    }

    public function visits()
    {
        return $this->hasMany(InternshipVisit::class);
    }
} 