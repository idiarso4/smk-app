<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningMaterial extends Model
{
    protected $fillable = [
        'subject_id',
        'teacher_id',
        'title',
        'description',
        'content',
        'attachments',
        'publish_date',
        'is_published'
    ];

    protected $casts = [
        'attachments' => 'array',
        'publish_date' => 'datetime',
        'is_published' => 'boolean'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
} 