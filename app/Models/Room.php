<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'code',
        'type',
        'capacity',
        'description'
    ];

    public function qrCodes()
    {
        return $this->hasMany(QrCode::class);
    }

    public function teacherAttendances()
    {
        return $this->hasMany(TeacherAttendance::class);
    }

    public function inventoryStocks()
    {
        return $this->hasMany(InventoryStock::class, 'location');
    }
} 