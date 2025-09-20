@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Book</h1>

    <form method="POST" action="{{ route('books.update', $book) }}">
        @csrf
        @method('PUT')

        <div>
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title', $book->title) }}" required>
        </div>

        <div>
            <label>Author</label>
            <select name="author_id" required>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Category</label>
            <input type="text" name="category" value="{{ old('category', $book->category) }}">
        </div>

        <div>
            <label>Published Year</label>
            <input type="number" name="published_year" value="{{ old('published_year', $book->published_year) }}">
        </div>

        <div>
            <label>ISBN</label>
            <input type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}">
        </div>

        <div>
            <label>Status</label>
            <select name="status">
                <option value="available" {{ $book->status == 'available' ? 'selected' : '' }}>Available</option>
                <option value="borrowed" {{ $book->status == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
            </select>
        </div>

        <button type="submit">Update</button>
        <a href="{{ route('books.index') }}">Cancel</a>
    </form>
</div>
@endsection
