@extends('frontend.Master')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Booking Confirmation</div>

                    <div class="card-body">
                        <h4>Your Booking is Confirmed!</h4>

                        <h5>Bus Details</h5>
                        <p><strong>Bus Name:</strong> {{ $bus->name }}</p>
                        <p><strong>Bus Type:</strong> {{ $bus->type }}</p>
                        <p><strong>Departure Time:</strong> {{ $bus->departure_time }}</p>
                        <p><strong>Departure Date:</strong> {{ $bus->departure_date }}</p>

                        <h5>Selected Seats</h5>
                        <ul>
                            @foreach($seats as $seat)
                                <li>Seat Number: {{ $seat->seat_number }} - Price: Rs. {{ $seat->price }}</li>
                            @endforeach
                        </ul>

                        <h5>Boarding Point</h5>
                        <p>{{ $booking->boarding_point }}</p>

                        <h5>Total Fare</h5>
                        <p>Rs. {{ $booking->total_amount }}</p>

                        <hr>

                        <h5>Next Steps</h5>
                        <p>You can proceed to make your payment or contact us for more details.</p>

                        <a href="{{ route('payment.index', ['bookingId' => $booking->id]) }}" class="btn btn-primary">Proceed to Payment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
