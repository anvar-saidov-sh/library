@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Borrowing</h1>

    <form action="{{ route('borrowings.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="book_id" class="form-label">Book</label>
            <select name="book_id" id="book_id" class="form-control" required>
                <option value="">-- Select Book --</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="borrower_name" class="form-label">Borrower Name</label>
            <input type="text" name="borrower_name" id="borrower_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="borrowed_at" class="form-label">Borrowed At</label>
            <input type="date" name="borrowed_at" id="borrowed_at" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="returned_at" class="form-label">Returned At</label>
            <input type="date" name="returned_at" id="returned_at" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save Borrowing</button>
        <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
