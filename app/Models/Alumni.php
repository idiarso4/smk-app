<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    protected $fillable = [
        'student_id',
        'graduation_year',
        'certificate_number',
        'graduation_date',
        'final_grade',
        'current_activity', // kuliah/kerja/wirausaha
        'institution_name',
        'position',
        'contact_info',
        'social_media',
        'achievements'
    ];

    protected $casts = [
        'graduation_date' => 'date',
        'contact_info' => 'array',
        'social_media' => 'array',
        'achievements' => 'array'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
} 