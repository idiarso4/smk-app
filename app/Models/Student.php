<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'class_id',
        'nis',
        'nisn'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function class()
    {
        return $this->belongsTo(ClassRoom::class, 'class_id');
    }

    public function permits()
    {
        return $this->hasMany(Permit::class);
    }

    public function internship()
    {
        return $this->hasOne(Internship::class);
    }
} 