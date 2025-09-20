@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Book</h1>

    @if ($errors->any())
        <div>
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div>
            <label for="title">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required>
        </div>

        <div>
            <label for="author_id">Author</label>
            <select name="author_id" required>
                <option value="">-- Select Author --</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="category">Category</label>
            <input type="text" name="category" value="{{ old('category') }}">
        </div>

        <div>
            <label for="published_year">Published Year</label>
            <input type="number" name="published_year" value="{{ old('published_year') }}">
        </div>

        <div>
            <label for="isbn">ISBN</label>
            <input type="text" name="isbn" value="{{ old('isbn') }}">
        </div>

        <div>
            <label for="status">Status</label>
            <select name="status">
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="borrowed" {{ old('status') == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
            </select>
        </div>

        <button type="submit">Save Book</button>
        <a href="{{ route('books.index') }}">Cancel</a>
    </form>
</div>
@endsection
