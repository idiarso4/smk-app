<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    protected $fillable = [
        'name',
        'code',
        'type', // komputer/kimia/fisika/biologi/bahasa/dll
        'capacity',
        'location',
        'description',
        'facilities',
        'status', // available/maintenance/under_repair
        'head_teacher_id', // kepala lab
        'technician_id', // teknisi lab
        'maintenance_schedule',
        'safety_equipment'
    ];

    protected $casts = [
        'facilities' => 'array',
        'maintenance_schedule' => 'array',
        'safety_equipment' => 'array'
    ];

    public function headTeacher()
    {
        return $this->belongsTo(Teacher::class, 'head_teacher_id');
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function schedules()
    {
        return $this->hasMany(LabSchedule::class);
    }

    public function equipment()
    {
        return $this->hasMany(LabEquipment::class);
    }
} 