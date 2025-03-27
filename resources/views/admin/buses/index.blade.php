@extends('admin.layout')

@section('content')
<x-app-layout>
    <main id="main" class="main">
        <h2 class="text-xl font-bold mb-4">Manage Buses</h2>

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('admin.buses.create') }}" class="btn btn-primary">Add New Bus</a>
            <form action="{{ route('admin.buses.index') }}" method="GET">
                <input type="text" name="search" class="form-control" placeholder="Search bus..." value="{{ request('search') }}">
            </form>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Bus Name</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Departure Date</th>
                    <th>Departure Time</th>
                    <th>Arrival Date</th>
                    <th>Arrival Time</th>
                    <th>Available Seats</th>
                    <th>Bus Type</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($buses as $bus)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $bus->bus_name }}</td>
                    <td>{{ $bus->from_location }}</td>
                    <td>{{ $bus->to_location }}</td>
                    <td>{{ \Carbon\Carbon::parse($bus->departure_date)->format('Y-m-d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($bus->departure_time)->format('h:i A') }}</td>
                    <td>{{ \Carbon\Carbon::parse($bus->arrival_date)->format('Y-m-d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($bus->arrival_time)->format('h:i A') }}</td>
                    <td>{{ $bus->available_seats }}</td>
                    <td>{{ $bus->bus_type }}</td>
                    <td>{{ $bus->price }}</td>
                    <td>
                        <a href="{{ route('admin.buses.edit', $bus->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.buses.destroy', $bus->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="{{ $bus->id }}">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="12" class="text-center">No buses found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $buses->links() }} <!-- Pagination links -->
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                document.querySelectorAll('.delete-btn').forEach(button => {
                    button.addEventListener('click', function () {
                        if (confirm('Are you sure you want to delete this bus?')) {
                            this.closest('form').submit();
                        }
                    });
                });
            });
        </script>

    </main>
</x-app-layout>
@endsection
