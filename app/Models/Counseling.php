<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Counseling extends Model
{
    protected $fillable = [
        'student_id',
        'counselor_id',
        'type', // individual/group/career/academic
        'date',
        'problem_category',
        'description',
        'action_taken',
        'recommendations',
        'follow_up_needed',
        'next_session_date',
        'parent_involvement',
        'confidentiality_level', // public/private/restricted
        'attachments',
        'status' // ongoing/completed/referred
    ];

    protected $casts = [
        'date' => 'datetime',
        'next_session_date' => 'datetime',
        'attachments' => 'array',
        'follow_up_needed' => 'boolean',
        'parent_involvement' => 'boolean'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function counselor()
    {
        return $this->belongsTo(Teacher::class, 'counselor_id');
    }

    public function followUps()
    {
        return $this->hasMany(CounselingFollowUp::class);
    }
} 