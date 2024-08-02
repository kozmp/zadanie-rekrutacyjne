@extends('layouts.app')

@section('title', 'Pet List')

@section('content')
<div class="container">
    <h1>Pet List</h1>
    <a href="{{ route('pets.create') }}" class="btn btn-primary mb-2">Add New Pet</a>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Załóżmy, że mamy zmienną $pets przekazaną do widoku -->
            @forelse($pets as $pet)
                <tr>
                    <td>{{ $pet['id'] }}</td>
                    <td>{{ $pet['name'] }}</td>
                    <td>{{ $pet['category']['name'] }}</td>
                    <td>{{ $pet['status'] }}</td>
                    <td>
                        <a href="{{ route('pets.show', $pet['id']) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('pets.edit', $pet['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pets.destroy', $pet['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No pets found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection