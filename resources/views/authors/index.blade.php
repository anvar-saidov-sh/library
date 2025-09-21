@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Authors</h1>
    <a href="{{ route('authors.create') }}" class="btn btn-primary mb-3">Add Author</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Country</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($authors as $author)
                <tr>
                    <td>{{ $author->id }}</td>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->country }}</td>
                    <td>
                        <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure you want to delete this author?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No authors found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
