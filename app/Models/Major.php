<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'head_of_major_id' // ID guru kepala jurusan
    ];

    public function headOfMajor()
    {
        return $this->belongsTo(Teacher::class, 'head_of_major_id');
    }

    public function classes()
    {
        return $this->hasMany(ClassRoom::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
} 