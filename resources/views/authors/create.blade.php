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

        <form action="{{ route('authors.store') }}" method="POST">
            @csrf

            <div>
                <label for="author">Author</label>
                <input type="text" name="author" id="author" value="{{ old('author', $author->name) }}" required>
            </div>
            <button type="submit">Save author</button>
            <a href="{{ route('authors.index') }}">Cancel</a>
        </form>
    </div>
@endsection
