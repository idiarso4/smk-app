<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecurityPatrol extends Model
{
    protected $fillable = [
        'security_shift_id',
        'start_time',
        'end_time',
        'route', // rute patroli
        'checkpoints', // titik-titik yang harus dicek
        'findings', // temuan selama patroli
        'status', // scheduled/in_progress/completed
        'attachments',
        'notes'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'checkpoints' => 'array',
        'findings' => 'array',
        'attachments' => 'array'
    ];

    public function shift()
    {
        return $this->belongsTo(SecurityShift::class, 'security_shift_id');
    }

    public function checkpointLogs()
    {
        return $this->hasMany(PatrolCheckpoint::class);
    }
} 