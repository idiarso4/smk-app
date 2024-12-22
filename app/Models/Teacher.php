<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'user_id',
        'nip',
        'position',
        'subjects'
    ];

    protected $casts = [
        'subjects' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attendances()
    {
        return $this->hasMany(TeacherAttendance::class);
    }

    public function internships()
    {
        return $this->hasMany(Internship::class);
    }
} 