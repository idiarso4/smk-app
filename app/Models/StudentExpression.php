<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentExpression extends Model
{
    protected $fillable = [
        'student_id',
        'type', // artikel/puisi/cerpen/lukisan/foto/video/musik
        'title',
        'content',
        'description',
        'category',
        'tags',
        'attachments',
        'publish_date',
        'status', // draft/review/published/rejected
        'reviewer_id',
        'review_notes',
        'likes_count',
        'comments_count',
        'is_featured'
    ];

    protected $casts = [
        'tags' => 'array',
        'attachments' => 'array',
        'publish_date' => 'datetime',
        'is_featured' => 'boolean'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(Teacher::class, 'reviewer_id');
    }

    public function likes()
    {
        return $this->hasMany(ExpressionLike::class);
    }

    public function comments()
    {
        return $this->hasMany(ExpressionComment::class);
    }
} 