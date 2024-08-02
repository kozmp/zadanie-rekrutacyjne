@extends('layouts.app')

@section('title', 'Pet Details')

@section('content')
<div class="container">
    <h1>Pet Details</h1>
    <ul class="list-group">
        <li class="list-group-item"><strong>ID:</strong> {{ $pet['id'] }}</li>
        <li class="list-group-item"><strong>Name:</strong> {{ $pet['name'] }}</li>
        <li class="list-group-item"><strong>Category:</strong> {{ $pet['category']['name'] }}</li>
        <li class="list-group-item"><strong>Status:</strong> {{ $pet['status'] }}</li>
        <li class="list-group-item"><strong>Photo URLs:</strong> {{ implode(', ', $pet['photoUrls']) }}</li>
        <li class="list-group-item"><strong>Tags:</strong> {{ implode(', ', array_column($pet['tags'], 'name')) }}</li>
    </ul>
    <a href="{{ route('pets.index') }}" class="btn btn-secondary mt-2">Back to List</a>
</div>
@endsection