<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryCategory extends Model
{
    protected $fillable = [
        'name',
        'code'
    ];

    public function items()
    {
        return $this->hasMany(InventoryItem::class, 'category_id');
    }
} 