<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternshipVisit extends Model
{
    protected $fillable = [
        'internship_id',
        'visit_date',
        'report',
        'photos',
        'evaluation',
        'recommendations'
    ];

    protected $casts = [
        'visit_date' => 'date',
        'photos' => 'array'
    ];

    public function internship()
    {
        return $this->belongsTo(Internship::class);
    }
} 