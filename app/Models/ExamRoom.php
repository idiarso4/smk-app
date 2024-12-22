<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamRoom extends Model
{
    protected $fillable = [
        'room_id',
        'exam_session_id',
        'capacity',
        'proctor_id', // ID pengawas
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function session()
    {
        return $this->belongsTo(ExamSession::class, 'exam_session_id');
    }

    public function proctor()
    {
        return $this->belongsTo(Teacher::class, 'proctor_id');
    }

    public function participants()
    {
        return $this->hasMany(ExamParticipant::class);
    }
} 