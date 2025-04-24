@extends('admin.layout')


@section('content')
<x-app-layout>

<main id="main" class="main">
    <div class="container mt-5">
        <h2>Booking History</h2>

        <!-- Search Form -->
        <form method="GET" action="{{ route('bookingHistory') }}" class="mb-3">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="search" placeholder="Search by Customer Name or Booking ID" value="{{ request()->get('search') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <!-- Booking History Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Booking ID</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Bus Details</th>
                    <th scope="col">Seat No.</th>
                    <th scope="col">Booking Date</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dynamic Data: Replace the static rows with actual data from the database -->
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->bus_id }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->bus->bus_name }}</td>
                        <td>{{ $booking->seats_booked }}</td>
                        <td>{{ $booking->booking_date }}</td>
                        <td>
                            <span class="badge bg-{{ $booking->status == 'Confirmed' ? 'success' : ($booking->status == 'Pending' ? 'warning' : 'danger') }}">
                                {{ $booking->status }}
                            </span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination (if applicable) -->
        <div class="d-flex justify-content-center">
            {{ $bookings->links() }}
        </div>
    </div>
</main>
</x-app-layout>
@endsection
