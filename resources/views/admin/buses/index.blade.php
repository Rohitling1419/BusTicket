@extends('admin.layout')

@section('content')
    <h2 class="text-xl font-bold mb-4">Manage Buses</h2>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.buses.create') }}" class="btn btn-primary mb-3">Add New Bus</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Bus Name</th>
                <th>From</th>
                <th>To</th>
                <th>Departure Date</th>
                <th>Available Seats</th>
                <th>Bus Types</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($buses as $bus)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $bus->bus_name }}</td>
                    <td>{{ $bus->from_location }}</td>
                    <td>{{ $bus->to_location }}</td>
                    <td>{{ $bus->departure_date }}</td>
                    <td>{{ $bus->available_seats }}</td>
                    <td>{{ $bus->bus_type }}</td>

                    <td>
                        <a href="{{ route('admin.buses.edit', $bus->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.buses.destroy', $bus->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
