<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author_id',
        'category',
        'published_year',
        'isbn',
        'status',
        'read_count',
    ];

    protected $casts = [
        'published_year' => 'integer',
        'read_count' => 'integer',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function scopeSearch($query, $term)
    {
        if (!$term) {
            return $query;
        }

        $term = "%{$term}%";

        return $query->where('title', 'like', $term)->orWhereHas('author', fn($q) => $q->where('name', 'like', $term));
    }

    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }
}
