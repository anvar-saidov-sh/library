@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Borrowing</h1>

    <form action="{{ route('borrowings.update', $borrowing->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="book_id" class="form-label">Book</label>
            <select name="book_id" id="book_id" class="form-control" required>
                @foreach($books as $book)
                    <option value="{{ $book->id }}"
                        {{ $borrowing->book_id == $book->id ? 'selected' : '' }}>
                        {{ $book->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="borrower_name" class="form-label">Borrower Name</label>
            <input type="text" name="borrower_name" id="borrower_name" class="form-control"
                   value="{{ old('borrower_name', $borrowing->borrower_name) }}" required>
        </div>

        <div class="mb-3">
            <label for="borrowed_at" class="form-label">Borrowed At</label>
            <input type="date" name="borrowed_at" id="borrowed_at" class="form-control"
                   value="{{ old('borrowed_at', $borrowing->borrowed_at) }}" required>
        </div>

        <div class="mb-3">
            <label for="returned_at" class="form-label">Returned At</label>
            <input type="date" name="returned_at" id="returned_at" class="form-control"
                   value="{{ old('returned_at', $borrowing->returned_at) }}">
        </div>

        <button type="submit" class="btn btn-success">Update Borrowing</button>
        <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
