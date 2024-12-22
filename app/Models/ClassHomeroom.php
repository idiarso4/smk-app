<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassHomeroom extends Model
{
    protected $fillable = [
        'class_id',
        'teacher_id',
        'academic_year_id',
        'semester',
        'start_date',
        'end_date',
        'status', // active/inactive
        'assignment_letter', // SK Wali Kelas
        'additional_tasks', // tugas tambahan sebagai wali kelas
        'notes'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'additional_tasks' => 'array'
    ];

    public function class()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    // Akses cepat ke daftar siswa
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id', 'class_id');
    }

    // Akses ke laporan wali kelas
    public function reports()
    {
        return $this->hasMany(HomeroomReport::class);
    }

    // Helper method untuk cek status aktif
    public function isActive()
    {
        return $this->status === 'active';
    }
} 