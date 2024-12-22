<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentOrganization extends Model
{
    protected $fillable = [
        'name',
        'code', // OSIS/MPK/Pramuka/dll
        'type', // organisasi/ekstrakurikuler
        'description',
        'vision',
        'mission',
        'period_start',
        'period_end',
        'advisor_id', // pembina
        'logo',
        'status', // active/inactive
        'social_media',
        'contact_info'
    ];

    protected $casts = [
        'period_start' => 'date',
        'period_end' => 'date',
        'social_media' => 'array',
        'contact_info' => 'array'
    ];

    public function advisor()
    {
        return $this->belongsTo(Teacher::class, 'advisor_id');
    }

    public function members()
    {
        return $this->hasMany(OrganizationMember::class);
    }

    public function activities()
    {
        return $this->hasMany(OrganizationActivity::class);
    }

    public function meetings()
    {
        return $this->hasMany(OrganizationMeeting::class);
    }
} 