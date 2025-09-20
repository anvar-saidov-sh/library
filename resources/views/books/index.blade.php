@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Books</h1>

    @if(session('success'))
        <div class="alert alert-success" style="margin: 10px 0; padding: 10px; border: 1px solid #c3e6cb; background: #d4edda; color: #155724;">
            {{ session('success') }}
        </div>
    @endif


    <form method="GET" action="{{ route('books.index') }}">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search books...">
        <button type="submit">Search</button>
    </form>

    <a href="{{ route('books.create') }}">+ Add New Book</a>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($books as $book)
            <tr>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author->name }}</td>
                <td>{{ $book->status }}</td>
                <td>
                    <a href="{{ route('books.show', $book) }}">View</a>
                    <a href="{{ route('books.edit', $book) }}">Edit</a>
                    <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this book?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $books->links() }}
</div>
@endsection

