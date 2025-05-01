@extends('admin.layout')

@section('content')
<x-app-layout>
    <main id="main" class="main">
        <div class="container py-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h1 class="fs-4 mb-0">Add New City</h1>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.cities.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="cityName" class="form-label">City Name</label>
                            <input type="text" name="name" id="cityName" class="form-control" placeholder="Enter city name" required>
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.cities.index') }}" class="btn btn-secondary me-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Add City</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
@endsection