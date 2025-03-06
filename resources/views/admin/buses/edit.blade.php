@extends('admin.layout')

@section('content')
    <h2 class="text-xl font-bold mb-4">Edit Bus</h2>

    <form action="{{ route('admin.buses.update', $bus->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Bus Name</label>
        <input type="text" name="bus_name" value="{{ $bus->bus_name }}" class="form-control mb-2" required>

        <label>From Location</label>
        <input type="text" name="from_location" value="{{ $bus->from_location }}" class="form-control mb-2" required>

        <label>To Location</label>
        <input type="text" name="to_location" value="{{ $bus->to_location }}" class="form-control mb-2" required>

        <label>Departure Date</label>
        <input type="date" name="departure_date" value="{{ $bus->departure_date }}" class="form-control mb-2" required>

        <label>Available Seats</label>
        <input type="number" name="available_seats" value="{{ $bus->available_seats }}" class="form-control mb-2" required>

        <label>Bus Type</label>
        <input type="text" name="bus_type" value="{{ $bus->bus_type }}" class="form-control mb-2" required>

        <button type="submit" class="btn btn-warning mt-3">Update Bus</button>
    </form>
@endsection
