@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit author</h1>

    <form action="{{ route('authors.update', $author->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="author">Author</label>
            <input type="text" name="author" id="author"
                   value="{{ old('author', $author->name) }}" required>
        </div>
        <button type="submit">Update Author</button>
    </form>
</div>
@endsection
