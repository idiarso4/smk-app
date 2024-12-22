<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationActivity extends Model
{
    protected $fillable = [
        'student_organization_id',
        'title',
        'description',
        'category',
        'start_date',
        'end_date',
        'location',
        'budget',
        'status', // planned/approved/ongoing/completed/cancelled
        'coordinator_id',
        'participants',
        'attachments',
        'documentation',
        'report',
        'approval_status',
        'approved_by'
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'budget' => 'decimal:2',
        'participants' => 'array',
        'attachments' => 'array',
        'documentation' => 'array',
        'report' => 'array'
    ];

    public function organization()
    {
        return $this->belongsTo(StudentOrganization::class, 'student_organization_id');
    }

    public function coordinator()
    {
        return $this->belongsTo(OrganizationMember::class, 'coordinator_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
} 