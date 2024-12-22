<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpressionLike extends Model
{
    protected $fillable = [
        'student_expression_id',
        'user_id',
        'type' // like/love/wow/support
    ];

    public function expression()
    {
        return $this->belongsTo(StudentExpression::class, 'student_expression_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 