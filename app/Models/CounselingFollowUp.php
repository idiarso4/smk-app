<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CounselingFollowUp extends Model
{
    protected $fillable = [
        'counseling_id',
        'date',
        'action_taken',
        'progress_notes',
        'next_steps',
        'attachments',
        'status'
    ];

    protected $casts = [
        'date' => 'datetime',
        'attachments' => 'array'
    ];

    public function counseling()
    {
        return $this->belongsTo(Counseling::class);
    }
} 