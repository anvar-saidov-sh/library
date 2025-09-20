@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Book</h1>

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="title">Title</label>
            <input type="text" name="title" id="title"
                   value="{{ old('title', $book->title) }}" required>
        </div>

        <div>
            <label for="author_name">Author</label>
            <input type="text" name="author_name" id="author_name"
                   value="{{ old('author_name', $book->author->name ?? '') }}" required>
        </div>

        <div>
            <label for="category">Category</label>
            <input type="text" name="category" id="category"
                   value="{{ old('category', $book->category) }}">
        </div>

        <div>
            <label for="published_year">Published Year</label>
            <input type="number" name="published_year" id="published_year"
                   value="{{ old('published_year', $book->published_year) }}">
        </div>

        <div>
            <label for="isbn">ISBN</label>
            <input type="text" name="isbn" id="isbn"
                   value="{{ old('isbn', $book->isbn) }}">
        </div>

        <div>
            <label for="status">Status</label>
            <select name="status" id="status">
                <option value="available" {{ old('status', $book->status) == 'available' ? 'selected' : '' }}>
                    Available
                </option>
                <option value="borrowed" {{ old('status', $book->status) == 'borrowed' ? 'selected' : '' }}>
                    Borrowed
                </option>
            </select>
        </div>

        <button type="submit">Update Book</button>
    </form>
</div>
@endsection
