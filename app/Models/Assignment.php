<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
        'learning_material_id',
        'title',
        'description',
        'attachments',
        'start_date',
        'due_date',
        'max_score',
        'is_published'
    ];

    protected $casts = [
        'attachments' => 'array',
        'start_date' => 'datetime',
        'due_date' => 'datetime',
        'is_published' => 'boolean'
    ];

    public function material()
    {
        return $this->belongsTo(LearningMaterial::class, 'learning_material_id');
    }

    public function submissions()
    {
        return $this->hasMany(AssignmentSubmission::class);
    }
} 