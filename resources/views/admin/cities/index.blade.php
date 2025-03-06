@extends('admin.layout')

@section('content')
<h1>Manage Cities</h1>

<!-- Add City Button -->
<a href="{{ route('admin.cities.create') }}" class="btn btn-success mb-3">
    <i class="fas fa-plus"></i> Add City
</a>

<!-- Search Form -->
<form action="{{ route('admin.cities.index') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search City" value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i> Search
        </button>
    </div>
</form>

<!-- Success or Error Message -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@elseif (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<!-- Cities Table -->
<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>City Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cities as $city)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $city->name }}</td>
                <td>
                    <!-- Edit Button -->
                    <a href="{{ route('admin.cities.edit', $city->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>

                    <!-- Delete Button with Confirmation -->
                    <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this city?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection