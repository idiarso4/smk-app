<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpressionComment extends Model
{
    protected $fillable = [
        'student_expression_id',
        'user_id',
        'content',
        'parent_id', // untuk reply comments
        'attachments',
        'is_approved',
        'approved_by'
    ];

    protected $casts = [
        'attachments' => 'array',
        'is_approved' => 'boolean'
    ];

    public function expression()
    {
        return $this->belongsTo(StudentExpression::class, 'student_expression_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(ExpressionComment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(ExpressionComment::class, 'parent_id');
    }
} 