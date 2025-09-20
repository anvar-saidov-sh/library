@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Book</h1>

    <form method="POST" action="{{ route('books.store') }}">
        @csrf

        <div>
            <label>Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required>
            @error('title') <p style="color:red">{{ $message }}</p> @enderror
        </div>

        <div>
            <label>Author</label>
            <select name="author_id" id="author_id" required>
                <option value="">-- Select Author --</option>
                @foreach($authors as $author)
                    {{-- <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option> --}}
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
            @error('author_id') <p style="color:red">{{ $message }}</p> @enderror
        </div>

        <div>
            <label>Category</label>
            <input type="text" name="category" value="{{ old('category') }}">
        </div>

        <div>
            <label>Published Year</label>
            <input type="number" name="published_year" value="{{ old('published_year') }}">
        </div>

        <div>
            <label>ISBN</label>
            <input type="text" name="isbn" value="{{ old('isbn') }}">
        </div>

        <div>
            <label>Status</label>
            <select name="status">
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                <option value="borrowed" {{ old('status') == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
            </select>
        </div>

        <button type="submit">Save</button>
        <a href="{{ route('books.index') }}">Cancel</a>
    </form>
</div>
@endsection
