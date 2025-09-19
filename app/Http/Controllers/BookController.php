<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $books = Book::with('author')
            ->search($search)
            ->orderBy('title')
            ->paginate(10);

        return response()->json($books);
    }

    // POST /api/books
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'author_id'      => 'required|exists:authors,id',
            'category'       => 'nullable|string|max:255',
            'published_year' => 'nullable|integer|min:0',
            'isbn'           => 'nullable|string|max:255|unique:books,isbn',
            'status'         => 'in:available,borrowed',
        ]);

        $book = Book::create($validated);

        return response()->json($book, 201);
    }

    // GET /api/books/{id}
    public function show($id)
    {
        $book = Book::with('author', 'borrowings')->findOrFail($id);

        return response()->json($book);
    }

    // PUT /api/books/{id}
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title'          => 'sometimes|required|string|max:255',
            'author_id'      => 'sometimes|required|exists:authors,id',
            'category'       => 'nullable|string|max:255',
            'published_year' => 'nullable|integer|min:0',
            'isbn'           => 'nullable|string|max:255|unique:books,isbn,' . $book->id,
            'status'         => 'in:available,borrowed',
        ]);

        $book->update($validated);

        return response()->json($book);
    }

    // DELETE /api/books/{id}
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(null, 204);
    }
}
