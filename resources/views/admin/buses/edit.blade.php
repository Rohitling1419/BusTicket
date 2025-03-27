@extends('admin.layout')

@section('content')
<x-app-layout>
    <main id="main" class="main">
        <h2 class="text-xl font-bold mb-4">Edit Bus</h2>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.buses.update', $bus->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Bus Name</label>
                <input type="text" name="bus_name" class="form-control" value="{{ $bus->bus_name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">From Location</label>
                <input type="text" name="from_location" class="form-control" value="{{ $bus->from_location }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">To Location</label>
                <input type="text" name="to_location" class="form-control" value="{{ $bus->to_location }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Departure Date</label>
                <input type="date" name="departure_date" class="form-control" value="{{ $bus->departure_date }}" required>
            </div>

            <div class="mb-3">
                <label for="departure_time">Departure Time</label>
                <input type="time" name="departure_time" id="departure_time"
                    value="{{ old('departure_time', \Carbon\Carbon::parse($bus->departure_time)->format('H:i')) }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Arrival Date</label>
                <input type="date" name="arrival_date" class="form-control" value="{{ old('arrival_date', $bus->arrival_date) }}" required>
            </div>

            <div class="mb-3">
                <label for="arrival_time">Arrival Time</label>
                <input type="time" name="arrival_time" id="arrival_time"
                    value="{{ old('arrival_time', \Carbon\Carbon::parse($bus->arrival_time)->format('H:i')) }}"
                    class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Available Seats</label>
                <input type="number" name="available_seats" class="form-control" value="{{ $bus->available_seats }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Bus Type</label>
                <input type="text" name="bus_type" class="form-control" value="{{ $bus->bus_type }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" name="price" class="form-control" value="{{ $bus->price }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Bus</button>
        </form>
    </main>
</x-app-layout>
@endsection
