@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Borrowing Details</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>Book:</strong> {{ $borrowing->book->title ?? 'N/A' }}</p>
            <p><strong>Borrower:</strong> {{ $borrowing->borrower_name }}</p>
            <p><strong>Borrowed At:</strong> {{ $borrowing->borrowed_at }}</p>
            <p><strong>Returned At:</strong> {{ $borrowing->returned_at ?? 'Not returned yet' }}</p>
        </div>
    </div>

    <a href="{{ route('borrowings.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
