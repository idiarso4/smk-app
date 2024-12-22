<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatrolCheckpoint extends Model
{
    protected $fillable = [
        'security_patrol_id',
        'checkpoint_name',
        'check_time',
        'status', // checked/skipped/issue_found
        'condition', // normal/perlu_perhatian/rusak
        'photo',
        'notes'
    ];

    protected $casts = [
        'check_time' => 'datetime'
    ];

    public function patrol()
    {
        return $this->belongsTo(SecurityPatrol::class);
    }
} 