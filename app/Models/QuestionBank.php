<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{
    protected $fillable = [
        'subject_id',
        'teacher_id',
        'title',
        'description',
        'grade_level',
        'difficulty_level',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
} 