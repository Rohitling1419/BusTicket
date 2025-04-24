@extends('frontend.Master')

@section('content')
<div class="container py-5" style="margin-top: 3rem;">
    <h2 class="mb-4">My Booking History</h2>

    @if($bookings->isEmpty())
        <div class="alert alert-info">
            You have not made any bookings yet.
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Bus Name</th>
                        <th>Bus Type</th>
                        <th>Departure Time</th>
                        <th>Travel Date</th>
                        <th>Seat Numbers</th>
                        <th>Booked On</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $index => $booking)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $booking->bus->bus_name }}</td>
                            <td>{{ $booking->bus->bus_type }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->bus->departure_time)->format('h:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->bus->departure_date)->format('d M Y') }}</td>
                            <td>{{ $booking->seats_booked }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y, h:i A') }}</td>
                            <td>
                                @if($booking->status == 'confirmed')
                                    <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-sm">Cancel Booking</button>
                                    </form>
                                @elseif($booking->status == 'cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
