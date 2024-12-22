<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends Model
{
    protected $fillable = [
        'exam_type_id',
        'subject_id',
        'date',
        'start_time',
        'end_time',
        'duration',
        'question_bank_id',
        'total_questions',
        'passing_score',
        'is_randomized',
        'is_active'
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'is_randomized' => 'boolean',
        'is_active' => 'boolean'
    ];

    public function examType()
    {
        return $this->belongsTo(ExamType::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function questionBank()
    {
        return $this->belongsTo(QuestionBank::class);
    }

    public function participants()
    {
        return $this->hasMany(ExamParticipant::class);
    }
} 