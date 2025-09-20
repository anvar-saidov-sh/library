<?php

namespace App\Http\Controllers;

use App\Models\Author;
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

        if ($request->wantsJson()) {
            return response()->json($books);
        }

        return view('books.index', compact('books'));
    }
    public function create()
    {
        $authors = \App\Models\Author::all();
        return view('books.create', compact('authors'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'          => 'required|string|max:255',
            'author_name'    => 'required|string|max:255',
            'category'       => 'nullable|string|max:255',
            'published_year' => 'nullable|integer|min:0',
            'isbn'           => 'nullable|string|max:255|unique:books,isbn',
            'status'         => 'in:available,borrowed',
        ]);

        // Find or create author by name
        $author = Author::firstOrCreate(['name' => $validated['author_name']]);

        // Create book with author_id
        $book = Book::create([
            'title'          => $validated['title'],
            'author_id'      => $author->id,
            'category'       => $validated['category'] ?? null,
            'published_year' => $validated['published_year'] ?? null,
            'isbn'           => $validated['isbn'] ?? null,
            'status'         => $validated['status'] ?? 'available',
        ]);

        if ($request->wantsJson()) {
            return response()->json($book, 201);
        }

        return redirect()->route('books.index')
            ->with('success', 'Book created successfully.');
    }

    public function show(Request $request, $id)
    {
        $book = Book::with('author', 'borrowings')->findOrFail($id);

        if ($request->wantsJson()) {
            return response()->json($book);
        }

        return view('books.show', compact('book'));
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title'          => 'nullable|string|max:255',
            'author_name'    => 'nullable|string|max:255',
            'category'       => 'nullable|string|max:255',
            'published_year' => 'nullable|integer|min:0',
            'isbn'           => 'nullable|string|max:255|unique:books,isbn,' . $book->id,
            'status'         => 'nullable|in:available,borrowed',
        ]);

        // Handle author
        if (!empty($validated['author_name'])) {
            $author = Author::firstOrCreate(['name' => $validated['author_name']]);
            $book->author_id = $author->id;
        }

        // Update other fields if provided
        if (!empty($validated['title'])) {
            $book->title = $validated['title'];
        }
        if (!empty($validated['category'])) {
            $book->category = $validated['category'];
        }
        if (!empty($validated['published_year'])) {
            $book->published_year = $validated['published_year'];
        }
        if (!empty($validated['isbn'])) {
            $book->isbn = $validated['isbn'];
        }
        if (!empty($validated['status'])) {
            $book->status = $validated['status'];
        }

        $book->save();

        if ($request->wantsJson()) {
            return response()->json($book);
        }

        return redirect()->route('books.index')
            ->with('success', 'Book updated successfully.');
    }



    public function destroy(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        if ($request->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('books.index')
            ->with('success', 'Book deleted successfully.');
    }
}
