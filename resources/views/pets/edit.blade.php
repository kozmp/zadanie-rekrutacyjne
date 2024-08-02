@extends('layouts.app')

@section('title', 'Edit Pet')

@section('content')
<div class="container">
    <h1>Edit Pet</h1>
    <form action="{{ route('pets.update', $pet['id']) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $pet['name'] }}" required>
        </div>
        <div class="form-group">
            <label for="category_id">Category ID</label>
            <input type="number" name="category_id" id="category_id" class="form-control" value="{{ $pet['category']['id'] }}" required>
        </div>
        <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" name="category_name" id="category_name" class="form-control" value="{{ $pet['category']['name'] }}" required>
        </div>
        <div class="form-group">
            <label for="photoUrls">Photo URLs (comma separated)</label>
            <input type="text" name="photoUrls" id="photoUrls" class="form-control" value="{{ implode(',', $pet['photoUrls']) }}" required>
        </div>
        <div class="form-group">
            <label for="tags">Tags (comma separated)</label>
            <input type="text" name="tags" id="tags" class="form-control" value="{{ implode(',', array_column($pet['tags'], 'name')) }}" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="available" {{ $pet['status'] == 'available' ? 'selected' : '' }}>Available</option>
                <option value="pending" {{ $pet['status'] == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="sold" {{ $pet['status'] == 'sold' ? 'selected' : '' }}>Sold</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Pet</button>
    </form>
</div>