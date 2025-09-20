@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Book Details</h1>

    <div class="card">
        <div class="card-body">
            <h3 class="card-title">{{ $book->title }}</h3>
            <p class="card-text"><strong>Author:</strong> {{ $book->author }}</p>
            <p class="card-text"><strong>Published Year:</strong> {{ $book->published_year }}</p>
            <p class="card-text"><strong>Description:</strong> {{ $book->description }}</p>
        </div>
    </div>

    <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning mt-3">Edit</a>

    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger mt-3" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
</div>
@endsection
