<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamAnswer extends Model
{
    protected $fillable = [
        'exam_participant_id',
        'question_id',
        'answer',
        'is_correct',
        'score',
        'teacher_notes'
    ];

    protected $casts = [
        'is_correct' => 'boolean'
    ];

    public function participant()
    {
        return $this->belongsTo(ExamParticipant::class, 'exam_participant_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
} 