<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // GET /api/borrowings
    public function index()
    {
        $borrowings = Borrowing::with(['book', 'user'])
            ->orderByDesc('borrowed_at')
            ->paginate(10);

        return response()->json($borrowings);
    }

    // POST /api/borrow/{book}
    public function borrow(Request $request, Book $book)
    {
        if (!$book->isAvailable()) {
            return response()->json(['message' => 'Book not available'], 400);
        }

        $validated = $request->validate([
            'user_id'   => 'required|exists:users,id',
            'days'      => 'nullable|integer|min:1|max:60', // default 14 days
            'notes'     => 'nullable|string|max:255',
        ]);

        $borrowing = Borrowing::create([
            'user_id'    => $validated['user_id'],
            'book_id'    => $book->id,
            'borrowed_at'=> Carbon::now(),
            'due_date'   => Carbon::now()->addDays($validated['days'] ?? 14),
            'notes'      => $validated['notes'] ?? null,
        ]);

        // update book status
        $book->update(['status' => 'borrowed']);

        return response()->json($borrowing, 201);
    }

    // POST /api/return/{book}
    public function returnBook(Request $request, Book $book)
    {
        $borrowing = Borrowing::where('book_id', $book->id)
            ->whereNull('returned_at')
            ->latest('borrowed_at')
            ->first();

        if (!$borrowing) {
            return response()->json(['message' => 'This book is not currently borrowed'], 400);
        }

        $borrowing->update([
            'returned_at' => Carbon::now(),
        ]);

        // update book status
        $book->update(['status' => 'available']);

        // increase read count
        $book->increment('read_count');

        return response()->json(['message' => 'Book returned successfully']);
    }

    // GET /api/borrowings/{id}
    public function show($id)
    {
        $borrowing = Borrowing::with(['book', 'user'])->findOrFail($id);

        return response()->json($borrowing);
    }

    // DELETE /api/borrowings/{id}
    public function destroy($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->delete();

        return response()->json(null, 204);
    }
}
