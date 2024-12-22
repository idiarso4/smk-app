<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternshipJournal extends Model
{
    protected $fillable = [
        'internship_id',
        'date',
        'activities',
        'photos',
        'status',
        'feedback'
    ];

    protected $casts = [
        'date' => 'date',
        'photos' => 'array'
    ];

    public function internship()
    {
        return $this->belongsTo(Internship::class);
    }
} 