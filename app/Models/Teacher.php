<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Teacher extends Model
{
    protected $fillable = [
        'user_id',
        'nip',
        'nama_lengkap',
        'jenis_ptk',
        'mata_pelajaran',
        'tempat_lahir',
        'tanggal_lahir', 
        'jenis_kelamin',
        'alamat',
        'no_hp'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attendances()
    {
        return $this->hasMany(TeacherAttendance::class);
    }

    public function internships()
    {
        return $this->hasMany(Internship::class);
    }
} 