@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Books</h1>

        @if (session('success'))
            <div class="alert alert-success"
                style="margin: 10px 0; padding: 10px; border: 1px solid #c3e6cb; background: #d4edda; color: #155724;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger"
                style="margin: 10px 0; padding: 10px; border: 1px solid #f5c6cb; background: #f8d7da; color: #721c24;">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger"
                style="margin: 10px 0; padding: 10px; border: 1px solid #f5c6cb; background: #f8d7da; color: #721c24;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="GET" action="{{ route('authors.index') }}">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search books...">
            <button type="submit">Search</button>
        </form>

        <a href="{{ route('authors.create') }}">+ Add New Author</a>

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
                @foreach ($authors as $author)
                    <tr>
                        <td>{{ $author->title }}</td>
                        <td>{{ $author->name }}</td>
                        <td>{{ $author->status }}</td>
                        <td>
                            <a href="{{ route('authors.show', $author) }}">View</a>
                            <a href="{{ route('authors.edit', $author) }}">Edit</a>
                            <form action="{{ route('authors.destroy', $author) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this author?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $authors->links() }}
    </div>
@endsection
