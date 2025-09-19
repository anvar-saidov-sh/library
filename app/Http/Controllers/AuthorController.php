<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
   /**
     * Display a listing of authors.
     */
    public function index()
    {
        // return paginated list
        $authors = Author::paginate(10);
        return response()->json($authors);
    }

    /**
     * Store a newly created author.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio'  => 'nullable|string',
        ]);

        $author = Author::create($validated);

        return response()->json($author, 201);
    }

    /**
     * Display a single author with their books.
     */
    public function show($id)
    {
        $author = Author::with('books')->findOrFail($id);
        return response()->json($author);
    }

    /**
     * Update an existing author.
     */
    public function update(Request $request, $id)
    {
        $author = Author::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'bio'  => 'nullable|string',
        ]);

        $author->update($validated);

        return response()->json($author);
    }

    /**
     * Delete an author.
     */
    public function destroy($id)
    {
        $author = Author::findOrFail($id);
        $author->delete();

        return response()->json(['message' => 'Author deleted successfully']);
    }
}
