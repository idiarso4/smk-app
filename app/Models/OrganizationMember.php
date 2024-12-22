<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationMember extends Model
{
    protected $fillable = [
        'student_organization_id',
        'student_id',
        'position', // ketua/wakil/sekretaris/bendahara/koordinator/anggota
        'department', // bidang/seksi
        'start_date',
        'end_date',
        'election_votes', // jumlah suara saat pemilihan
        'status', // active/inactive/alumni
        'responsibilities',
        'achievements'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'responsibilities' => 'array',
        'achievements' => 'array'
    ];

    public function organization()
    {
        return $this->belongsTo(StudentOrganization::class, 'student_organization_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
} 