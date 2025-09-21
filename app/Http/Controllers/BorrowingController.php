<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BorrowingController extends Controller
{
    /**
     * Display a listing of the borrowings.
     */
    public function index(Request $request)
    {
        $borrowings = Borrowing::with(['book', 'user'])
            ->orderByDesc('borrowed_at')
            ->paginate(10);

        if ($request->wantsJson()) {
            return response()->json($borrowings);
        }

        return view('borrowings.index', compact('borrowings'));
    }

    /**
     * Show a single borrowing.
     */
    public function show(Request $request, $id)
    {
        $borrowing = Borrowing::with(['book', 'user'])->findOrFail($id);

        if ($request->wantsJson()) {
            return response()->json($borrowing);
        }

        return view('borrowings.show', compact('borrowing'));
    }

    /**
     * Borrow a book.
     */
    public function borrow(Request $request, Book $book)
    {
        if (!$book->isAvailable()) {
            return $request->wantsJson()
                ? response()->json(['message' => 'Book not available'], 400)
                : back()->withErrors('Book not available.');
        }

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'days'    => 'nullable|integer|min:1|max:60',
            'notes'   => 'nullable|string|max:255',
        ]);

        $borrowing = Borrowing::create([
            'user_id'    => $validated['user_id'],
            'book_id'    => $book->id,
            'borrowed_at'=> Carbon::now(),
            'due_date'   => Carbon::now()->addDays($validated['days'] ?? 14),
            'notes'      => $validated['notes'] ?? null,
        ]);

        $book->update(['status' => 'borrowed']);

        if ($request->wantsJson()) {
            return response()->json($borrowing, 201);
        }

        return redirect()->route('borrowings.index')
            ->with('success', 'Book borrowed successfully.');
    }

    /**
     * Return a borrowed book.
     */
    public function returnBook(Request $request, Book $book)
    {
        $borrowing = Borrowing::where('book_id', $book->id)
            ->whereNull('returned_at')
            ->latest('borrowed_at')
            ->first();

        if (!$borrowing) {
            return $request->wantsJson()
                ? response()->json(['message' => 'This book is not currently borrowed'], 400)
                : back()->withErrors('This book is not currently borrowed.');
        }

        $borrowing->update([
            'returned_at' => Carbon::now(),
        ]);

        $book->update(['status' => 'available']);
        $book->increment('read_count');

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Book returned successfully']);
        }

        return redirect()->route('borrowings.index')
            ->with('success', 'Book returned successfully.');
    }

    /**
     * Delete a borrowing record.
     */
    public function destroy(Request $request, $id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->delete();

        if ($request->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('borrowings.index')
            ->with('success', 'Borrowing deleted successfully.');
    }
}
