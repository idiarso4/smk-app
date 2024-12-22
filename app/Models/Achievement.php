<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'student_id',
        'title',
        'category', // akademik/non-akademik/olahraga/seni/dll
        'level', // sekolah/kota/provinsi/nasional/internasional
        'competition_name',
        'organizer',
        'achievement_date',
        'rank', // juara 1/2/3/harapan/finalis
        'coach_id', // pembimbing
        'description',
        'certificate',
        'photos',
        'medal_photo',
        'news_links',
        'points' // poin prestasi
    ];

    protected $casts = [
        'achievement_date' => 'date',
        'photos' => 'array',
        'news_links' => 'array'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function coach()
    {
        return $this->belongsTo(Teacher::class, 'coach_id');
    }

    public function team()
    {
        return $this->belongsToMany(Student::class, 'achievement_team_members');
    }
} 