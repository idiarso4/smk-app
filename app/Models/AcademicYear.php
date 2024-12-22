<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'semester', // 1/2
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean'
    ];

    public function classes()
    {
        return $this->hasMany(ClassRoom::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
} 