<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabEquipment extends Model
{
    protected $fillable = [
        'laboratory_id',
        'name',
        'code',
        'type',
        'specifications',
        'quantity',
        'condition', // baik/rusak_ringan/rusak_berat
        'purchase_date',
        'last_maintenance',
        'next_maintenance',
        'manual_book',
        'status', // available/in_use/maintenance/broken
        'notes'
    ];

    protected $casts = [
        'specifications' => 'array',
        'purchase_date' => 'date',
        'last_maintenance' => 'date',
        'next_maintenance' => 'date'
    ];

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function maintenanceLogs()
    {
        return $this->hasMany(LabEquipmentMaintenance::class);
    }

    public function usageLogs()
    {
        return $this->hasMany(LabEquipmentUsage::class);
    }
} 