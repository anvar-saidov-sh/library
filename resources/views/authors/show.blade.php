@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Author Details</h1>

    <div class="card">
        <div class="card-body">
            <h3>{{ $author->name }}</h3>
            <p><strong>Country:</strong> {{ $author->country }}</p>
        </div>
    </div>

    <a href="{{ route('authors.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
