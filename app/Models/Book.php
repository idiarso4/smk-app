<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [
        'title',
        'isbn',
        'author',
        'publisher',
        'category',
        'publication_year',
        'edition',
        'pages',
        'stock',
        'shelf_location',
        'description',
        'cover',
        'is_available',
        'notes',
    ];

    protected $casts = [
        'publication_year' => 'integer',
        'pages' => 'integer',
        'stock' => 'integer',
        'is_available' => 'boolean',
    ];

    public function loans(): HasMany
    {
        return $this->hasMany(BookLoan::class);
    }
} 