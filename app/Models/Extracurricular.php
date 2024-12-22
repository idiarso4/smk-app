<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Extracurricular extends Model
{
    protected $fillable = [
        'name',
        'coach_id', // ID guru pembina
        'schedule',
        'location',
        'description',
        'max_participants'
    ];

    protected $casts = [
        'schedule' => 'array'
    ];

    public function coach()
    {
        return $this->belongsTo(Teacher::class, 'coach_id');
    }

    public function participants()
    {
        return $this->belongsToMany(Student::class, 'extracurricular_student')
            ->withPivot('joined_at', 'status')
            ->withTimestamps();
    }
} 