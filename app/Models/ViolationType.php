<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ViolationType extends Model
{
    protected $fillable = [
        'name',
        'category', // ringan/sedang/berat
        'point',
        'sanctions',
        'description'
    ];

    protected $casts = [
        'sanctions' => 'array'
    ];

    public function violations()
    {
        return $this->hasMany(Violation::class);
    }
} 