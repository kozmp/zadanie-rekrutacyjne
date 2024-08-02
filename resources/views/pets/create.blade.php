@extends('layouts.app')

@section('title', 'Add New Pet')

@section('content')
<div class="container">
    <h1>Add New Pet</h1>
    <form action="{{ route('pets.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="category_id">Category ID</label>
            <input type="number" name="category_id" id="category_id" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="category_name">Category Name</label>
            <input type="text" name="category_name" id="category_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="photoUrls">Photo URLs (comma separated)</label>
            <input type="text" name="photoUrls" id="photoUrls" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tags">Tags (comma separated)</label>
            <input type="text" name="tags" id="tags" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control" required>
                <option value="available">Available</option>
                <option value="pending">Pending</option>
                <option value="sold">Sold</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Pet</button>
    </form>
</div>