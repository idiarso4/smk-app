<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeVisit extends Model
{
    protected $fillable = [
        'student_id',
        'counselor_id',
        'visit_date',
        'purpose',
        'findings',
        'parent_response',
        'recommendations',
        'follow_up_plan',
        'attachments',
        'status', // planned/completed/cancelled
        'parent_present',
        'address_confirmed'
    ];

    protected $casts = [
        'visit_date' => 'datetime',
        'attachments' => 'array',
        'parent_present' => 'boolean',
        'address_confirmed' => 'boolean'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function counselor()
    {
        return $this->belongsTo(Teacher::class, 'counselor_id');
    }
} 