<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $table = 'classes';

    protected $fillable = [
        'name',
        'level',
        'major',
        'academic_year',
        'homeroom_teacher_id',
        'class_leader_id',
        'vice_class_leader_id',
        'room_id',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    public function homeroomTeacher()
    {
        return $this->belongsTo(Teacher::class, 'homeroom_teacher_id');
    }

    public function classLeader()
    {
        return $this->belongsTo(Student::class, 'class_leader_id');
    }

    public function viceClassLeader()
    {
        return $this->belongsTo(Student::class, 'vice_class_leader_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function hasClassLeader()
    {
        return !is_null($this->class_leader_id);
    }

    public function hasViceClassLeader()
    {
        return !is_null($this->vice_class_leader_id);
    }
} 