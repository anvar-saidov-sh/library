<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $user_id
 * @property int $book_id
 * @property string|null $notes
 * @property Carbon|null $borrowed_at
 * @property Carbon|null $due_date
 * @property Carbon|null $returned_at
 *
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Book $book
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
        'due_date'    => 'datetime',
        'returned_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function isOverdue(): bool
    {
        return $this->returned_at === null
            && $this->due_date !== null
            && Carbon::parse($this->due_date)->isPast();
    }
}
