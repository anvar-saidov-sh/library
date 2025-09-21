@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Author</h1>

    <form action="{{ route('authors.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Author Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="country" class="form-label">Country</label>
            <input type="text" name="country" id="country" class="form-control">
        </div>

        <button type="submit" class="btn btn-success">Save Author</button>
        <a href="{{ route('authors.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
