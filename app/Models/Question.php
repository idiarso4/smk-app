<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    protected $fillable = [
        'exam_id',
        'question_type',
        'question_text',
        'attachments',
        'points',
        'choices',
        'correct_answer_boolean',
        'answer_key',
        'matching_pairs',
        'difficulty',
        'explanation',
    ];

    protected $casts = [
        'attachments' => 'array',
        'choices' => 'array',
        'correct_answer_boolean' => 'boolean',
        'matching_pairs' => 'array',
        'points' => 'integer',
    ];

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }
} 