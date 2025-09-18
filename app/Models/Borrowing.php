<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property Carbon|null $borrowed_at
 * @property Carbon|null $due_date
 * @property Carbon|null $returned_at
 */
class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'borrowed_at',
        'due_date',
        'returned_at',
        'notes',
    ];

    protected $casts = [
        'borrowed_at' => 'datetime',
        'due_date' => 'date',
        'returned_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function isOverdue(): bool
    {
        return is_null($this->returned_at)
            && $this->due_date
            && $this->due_date->isPast();
    }
}
