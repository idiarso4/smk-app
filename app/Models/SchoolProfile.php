<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolProfile extends Model
{
    protected $fillable = [
        'name',
        'npsn',
        'address',
        'phone',
        'email',
        'website',
        'principal_name',
        'accreditation',
        'vision',
        'mission',
        'logo',
        'facilities',
        'extracurricular_programs',
        'operational_hours'
    ];

    protected $casts = [
        'facilities' => 'array',
        'extracurricular_programs' => 'array',
        'operational_hours' => 'array'
    ];
} 