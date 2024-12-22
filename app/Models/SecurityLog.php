<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecurityLog extends Model
{
    protected $fillable = [
        'security_shift_id',
        'time',
        'location',
        'category', // kejadian/patroli/tamu/kehilangan/kerusakan/lainnya
        'description',
        'severity_level', // rendah/sedang/tinggi/kritis
        'action_taken',
        'reported_by',
        'witnesses',
        'attachments', // foto/video kejadian
        'follow_up_needed',
        'follow_up_notes',
        'status', // open/in_progress/resolved/closed
        'resolved_at',
        'resolved_by'
    ];

    protected $casts = [
        'time' => 'datetime',
        'attachments' => 'array',
        'witnesses' => 'array',
        'follow_up_needed' => 'boolean',
        'resolved_at' => 'datetime'
    ];

    public function shift()
    {
        return $this->belongsTo(SecurityShift::class, 'security_shift_id');
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    public function resolver()
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }
} 