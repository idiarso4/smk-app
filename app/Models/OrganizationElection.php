<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationElection extends Model
{
    protected $fillable = [
        'student_organization_id',
        'election_date',
        'registration_start',
        'registration_end',
        'campaign_start',
        'campaign_end',
        'voting_start',
        'voting_end',
        'status', // preparation/registration/campaign/voting/completed
        'total_voters',
        'election_committee',
        'supervisor_id',
        'results',
        'documentation'
    ];

    protected $casts = [
        'election_date' => 'date',
        'registration_start' => 'datetime',
        'registration_end' => 'datetime',
        'campaign_start' => 'datetime',
        'campaign_end' => 'datetime',
        'voting_start' => 'datetime',
        'voting_end' => 'datetime',
        'election_committee' => 'array',
        'results' => 'array',
        'documentation' => 'array'
    ];

    public function organization()
    {
        return $this->belongsTo(StudentOrganization::class);
    }

    public function supervisor()
    {
        return $this->belongsTo(Teacher::class, 'supervisor_id');
    }

    public function candidates()
    {
        return $this->hasMany(OrganizationCandidate::class);
    }

    public function votes()
    {
        return $this->hasMany(OrganizationVote::class);
    }
} 