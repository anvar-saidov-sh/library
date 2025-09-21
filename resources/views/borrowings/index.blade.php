@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Borrowings</h1>
    <a href="{{ route('borrowings.create') }}" class="btn btn-primary mb-3">Add Borrowing</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Book</th>
                <th>Borrower</th>
                <th>Borrowed At</th>
                <th>Returned At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($borrowings as $borrowing)
                <tr>
                    <td>{{ $borrowing->id }}</td>
                    <td>{{ $borrowing->book->title ?? 'N/A' }}</td>
                    <td>{{ $borrowing->borrower_name }}</td>
                    <td>{{ $borrowing->borrowed_at }}</td>
                    <td>{{ $borrowing->returned_at ?? 'Not returned' }}</td>
                    <td>
                        <a href="{{ route('borrowings.edit', $borrowing->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('borrowings.destroy', $borrowing->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this borrowing?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No borrowings found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
