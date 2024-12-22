<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'content',
        'category', // akademik/non-akademik/darurat/umum
        'priority', // rendah/sedang/tinggi/penting
        'target_audience', // semua/guru/siswa/wali_kelas/kelas_tertentu
        'publisher_id',
        'publish_date',
        'expiry_date',
        'attachments',
        'is_published',
        'is_pinned',
        'requires_confirmation'
    ];

    protected $casts = [
        'publish_date' => 'datetime',
        'expiry_date' => 'datetime',
        'attachments' => 'array',
        'is_published' => 'boolean',
        'is_pinned' => 'boolean',
        'requires_confirmation' => 'boolean'
    ];

    public function publisher()
    {
        return $this->belongsTo(User::class, 'publisher_id');
    }

    public function targetClasses()
    {
        return $this->belongsToMany(ClassRoom::class, 'announcement_class');
    }

    public function confirmations()
    {
        return $this->hasMany(AnnouncementConfirmation::class);
    }
} 