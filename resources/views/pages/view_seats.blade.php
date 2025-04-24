@extends('frontend.Master')

@section('content')
<div class="container py-4" style="margin-top: 3rem;">
    <form action="{{ route('booking.submit') }}" method="POST" id="seatBookingForm">
        @csrf
        <input type="hidden" name="bus_id" value="{{ $bus->id }}">
        <div class="row g-4">
            <!-- Bus Details Summary -->
            <div class="col-12 mb-4">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <h5 class="fw-bold mb-1">{{ $bus->bus_name }}</h5>
                                <div class="d-flex flex-wrap gap-3 mb-2">
                                    <div class="text-muted small">
                                        <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($bus->departure_date)->format('D, M d, Y') }}
                                    </div>
                                    <div class="text-muted small">
                                        <i class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($bus->departure_time)->format('h:i A') }}
                                    </div>
                                    <div class="text-muted small">
                                        <span class="badge rounded-pill {{ $bus->bus_type == 'AC' ? 'bg-info' : ($bus->bus_type == 'Tourist' ? 'bg-success' : 'bg-secondary') }}">
                                            {{ $bus->bus_type }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                <div class="text-muted small">Price Per Seat</div>
                                <div class="fs-4 fw-bold" style="color: #954ab4;">NPR {{ $bus->price }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seat Selection Area -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-header bg-light p-4 border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="bi bi-grid-3x3-gap me-2"></i>Select Your Seats</h5>
                            <div class="seat-info d-flex gap-3">
                                <div class="d-flex align-items-center">
                                    <div class="seat-indicator available me-2"></div>
                                    <span class="small">Available</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="seat-indicator booked me-2"></div>
                                    <span class="small">Booked</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="seat-indicator reserved me-2"></div>
                                    <span class="small">Reserved</span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="seat-indicator selected me-2"></div>
                                    <span class="small">Selected</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="bus-layout">
                            

                            <!-- Static Seat Layout -->
                            <div class="bus-container">
    <!-- Driver's area -->
    <div class="row g-2 mb-4">
        <div class="col-12">
            <div class="driver-area">
                <div class="steering-wheel">
                    <i class="fas fa-steering-wheel"></i>
                </div>
                <div class="driver-text">Driver</div>
            </div>
        </div>
    </div>
    
    <!-- Front door/entrance -->
    <div class="row g-2 mb-4">
        <div class="col-12">
            <div class="bus-entrance">
                <div class="door"></div>
                <div class="steps"></div>
            </div>
        </div>
    </div>

    <!-- First row of seats -->
    <div class="row g-2 mb-3">
        <!-- Left side (window seats) -->
        <div class="col-3">
            <div class="seat {{ in_array('A1', $bookedSeatsArray) ? 'booked' : 'available' }}" 
                 data-seat="A1" 
                 data-price="{{ $bus->price }}" 
                 {{ in_array('A1', $bookedSeatsArray) ? 'disabled' : '' }}>
                 A1
            </div>
        </div>
        <div class="col-3">
            <div class="seat {{ in_array('A2', $bookedSeatsArray) ? 'booked' : 'available' }}" 
                 data-seat="A2" 
                 data-price="{{ $bus->price }}" 
                 {{ in_array('A2', $bookedSeatsArray) ? 'disabled' : '' }}>
                 A2
            </div>
        </div>
        
        <!-- Aisle -->
        <div class="col-2">
            <div class="aisle"></div>
        </div>
        
        <!-- Right side (window seats) -->
        <div class="col-2">
            <div class="seat {{ in_array('A3', $bookedSeatsArray) ? 'booked' : 'available' }}" 
                 data-seat="B1" 
                 data-price="{{ $bus->price }}" 
                 {{ in_array('B1', $bookedSeatsArray) ? 'disabled' : '' }}>
                 B1
            </div>
        </div>
        <div class="col-2">
            <div class="seat {{ in_array('A4', $bookedSeatsArray) ? 'booked' : 'available' }}" 
                 data-seat="B2" 
                 data-price="{{ $bus->price }}" 
                 {{ in_array('B2', $bookedSeatsArray) ? 'disabled' : '' }}>
                 B2
            </div>
        </div>
    </div>

    <!-- Second row of seats -->
    <div class="row g-2 mb-3">
        <!-- Left side (window seats) -->
        <div class="col-3">
            <div class="seat {{ in_array('B1', $bookedSeatsArray) ? 'booked' : 'available' }}" 
                 data-seat="A3" 
                 data-price="{{ $bus->price }}" 
                 {{ in_array('A3', $bookedSeatsArray) ? 'disabled' : '' }}>
                 A3
            </div>
        </div>
        <div class="col-3">
            <div class="seat {{ in_array('B2', $bookedSeatsArray) ? 'booked' : 'available' }}" 
                 data-seat="A4" 
                 data-price="{{ $bus->price }}" 
                 {{ in_array('A4', $bookedSeatsArray) ? 'disabled' : '' }}>
                 A4
            </div>
        </div>
        
        <!-- Aisle -->
        <div class="col-2">
            <div class="aisle"></div>
        </div>
        
        <!-- Right side (window seats) -->
        <div class="col-2">
            <div class="seat {{ in_array('B3', $bookedSeatsArray) ? 'booked' : 'available' }}" 
                 data-seat="B3" 
                 data-price="{{ $bus->price }}" 
                 {{ in_array('B3', $bookedSeatsArray) ? 'disabled' : '' }}>
                 B3
            </div>
        </div>
        <div class="col-2">
            <div class="seat {{ in_array('B4', $bookedSeatsArray) ? 'booked' : 'available' }}" 
                 data-seat="B4" 
                 data-price="{{ $bus->price }}" 
                 {{ in_array('B4', $bookedSeatsArray) ? 'disabled' : '' }}>
                 B4
            </div>
        </div>
    </div>

    <!-- Third row of seats -->
    <div class="row g-2 mb-3">
        <!-- Left side (window seats) -->
        <div class="col-3">
            <div class="seat {{ in_array('C1', $bookedSeatsArray) ? 'booked' : 'available' }}" 
                 data-seat="A5" 
                 data-price="{{ $bus->price }}" 
                 {{ in_array('A5', $bookedSeatsArray) ? 'disabled' : '' }}>
                 A5
            </div>
        </div>
        <div class="col-3">
            <div class="seat {{ in_array('C2', $bookedSeatsArray) ? 'booked' : 'available' }}" 
                 data-seat="A6" 
                 data-price="{{ $bus->price }}" 
                 {{ in_array('A6', $bookedSeatsArray) ? 'disabled' : '' }}>
                 A6
            </div>
        </div>
        
        <!-- Aisle -->
        <div class="col-2">
            <div class="aisle"></div>
        </div>
        
        <!-- Right side (window seats) -->
        <div class="col-2">
            <div class="seat {{ in_array('C3', $bookedSeatsArray) ? 'booked' : 'available' }}" 
                 data-seat="B5" 
                 data-price="{{ $bus->price }}" 
                 {{ in_array('B5', $bookedSeatsArray) ? 'disabled' : '' }}>
                 B5
            </div>
        </div>
        <div class="col-2">
            <div class="seat {{ in_array('C4', $bookedSeatsArray) ? 'booked' : 'available' }}" 
                 data-seat="B6" 
                 data-price="{{ $bus->price }}" 
                 {{ in_array('B6', $bookedSeatsArray) ? 'disabled' : '' }}>
                 B6
            </div>
        </div>
    </div>

    <!-- Fourth row of seats -->
    <div class="row g-2 mb-3">
        <!-- Left side (window seats) -->
        <div class="col-3">
            <div class="seat {{ in_array('D1', $bookedSeatsArray) ? 'booked' : 'available' }}" 
                 data-seat="A7" 
                 data-price="{{ $bus->price }}" 
                 {{ in_array('A7', $bookedSeatsArray) ? 'disabled' : '' }}>
                 A7
            </div>
        </div>
        <div class="col-3">
            <div class="seat {{ in_array('D2', $bookedSeatsArray) ? 'booked' : 'available' }}" 
                 data-seat="A8" 
                 data-price="{{ $bus->price }}" 
                 {{ in_array('A8', $bookedSeatsArray) ? 'disabled' : '' }}>
                 A8
            </div>
        </div>
        
        <!-- Aisle -->
        <div class="col-2">
            <div class="aisle"></div>
        </div>
        
        <!-- Right side (window seats) -->
        <div class="col-2">
            <div class="seat {{ in_array('D3', $bookedSeatsArray) ? 'booked' : 'available' }}" 
                 data-seat="B7" 
                 data-price="{{ $bus->price }}" 
                 {{ in_array('B7', $bookedSeatsArray) ? 'disabled' : '' }}>
                 B7
            </div>
        </div>
        <div class="col-2">
            <div class="seat {{ in_array('D4', $bookedSeatsArray) ? 'booked' : 'available' }}" 
                 data-seat="B8" 
                 data-price="{{ $bus->price }}" 
                 {{ in_array('B8', $bookedSeatsArray) ? 'disabled' : '' }}>
                 B8
            </div>
        </div>
    </div>

    <!-- Back row (optional - could be a full width back seat) -->
    <div class="row g-2">
        <div class="col-12">
            <div class="back-row">
                <!-- You could add more seats here for the back row -->
            </div>
        </div>
    </div>
</div>

<!-- CSS to add to your stylesheet -->

                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Summary & Form -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 sticky-lg-top" style="top:20px;">
                    <div class="card-header text-white p-4 border-0" style="background-color:#954ab4;">
                        <h5 class="mb-0"><i class="bi bi-ticket-perforated-fill me-2"></i>Booking Summary</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Boarding Point</label>
                            <select class="form-select" name="boarding_point" id="boardingPoint" required>
                                <option value="">Select boarding point</option>
                                <option value="Main Bus Terminal">Kalanki</option>
                                <option value="City Center">Naya Bus Park</option>
                            </select>
                        </div>

                        <div class="booking-details mb-3">
                            <input type="hidden" name="selected_seats" id="selectedSeatsInput">
                            <input type="hidden" name="total_amount" id="totalAmountInput">

                            <div class="d-flex justify-content-between mb-2"><span class="fw-bold">Seat(s):</span><span id="selectedSeatsDisplay">-</span></div>
                            <div class="d-flex justify-content-between mb-2"><span class="fw-bold">Fare:</span><span id="fareDisplay">Rs.0</span></div>
                            <div class="d-flex justify-content-between"><span class="fw-bold">Total Amount:</span><span id="totalAmountDisplay" class="fw-bold text-primary">Rs.0</span></div>
                        </div>

                        <button type="submit" id="continueBtn" class="btn btn-success btn-lg w-100" disabled>
                            <i class="bi bi-arrow-right-circle me-2"></i>Continue
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
// JS: select seats and populate form inputs
document.addEventListener('DOMContentLoaded', function() {
    const seats = document.querySelectorAll('.seat.available');
    const selectedSeatsDisplay = document.getElementById('selectedSeatsDisplay');
    const fareDisplay = document.getElementById('fareDisplay');
    const totalAmountDisplay = document.getElementById('totalAmountDisplay');
    const selectedSeatsInput = document.getElementById('selectedSeatsInput');
    const totalAmountInput = document.getElementById('totalAmountInput');
    const continueBtn = document.getElementById('continueBtn');
    const boardingPointSelect = document.getElementById('boardingPoint');

    let selectedSeats = [];
    const maxSeats = 10;

    seats.forEach(seat => {
        seat.addEventListener('click', () => {
            const number = seat.getAttribute('data-seat');
            const price = parseFloat(seat.getAttribute('data-price'));
            const idx = selectedSeats.findIndex(s => s.number === number);
            if (idx > -1) {
                seat.classList.remove('selected');
                selectedSeats.splice(idx,1);
            } else if (selectedSeats.length < maxSeats) {
                seat.classList.add('selected');
                selectedSeats.push({number, price});
            } else {
                alert(`You can only select up to ${maxSeats} seats.`);
            }
            updateSummary();
        });
    });

    boardingPointSelect.addEventListener('change', updateContinueButton);

    function updateSummary() {
        const count = selectedSeats.length;
        if (count) {
            const seatsStr = selectedSeats.map(s=>s.number).join(',');
            const sum = selectedSeats.reduce((a,s)=>a+s.price,0);
            selectedSeatsDisplay.textContent = seatsStr;
            fareDisplay.textContent = `Rs.${sum}`;
            totalAmountDisplay.textContent = `Rs.${sum}`;
            selectedSeatsInput.value = seatsStr;
            totalAmountInput.value = sum.toFixed(2);
        } else {
            selectedSeatsDisplay.textContent = '-';
            fareDisplay.textContent = 'Rs.0';
            totalAmountDisplay.textContent = 'Rs.0';
            selectedSeatsInput.value = '';
            totalAmountInput.value = '';
        }
        updateContinueButton();
    }

    function updateContinueButton() {
        continueBtn.disabled = !(boardingPointSelect.value && selectedSeats.length);
    }
});
</script>



<style>
.bus-container {
    background-color: #f8f9fa;
    border: 2px solid #343a40;
    border-radius: 10px;
    padding: 20px;
    max-width: 600px;
    margin: 0 auto;
}

.driver-area {
    background-color: #e9ecef;
    height: 60px;
    border-radius: 50% 50% 0 0;
    position: relative;
    border: 1px solid #ced4da;
}

.steering-wheel {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #6c757d;
    position: absolute;
    top: 15px;
    right: 110px;
}

.driver-text {
    position: absolute;
    top: 20px;
    right: 70px;
    font-size: 12px;
}

.bus-entrance {
    height: 40px;
    width: 80px;
    background-color: grey;
    position: relative;
}

.door {
    height: 100%;
    width: 60px;
    border: 1px dashed #6c757d;
    position: absolute;
    left: 20px;
}

.steps {
    height: 100%;
    width: 40px;
    border-left: 1px solid #6c757d;
    position: absolute;
    left: 80px;
}

.seat {
    height: 50px;
    width: 90px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 5px;
    font-weight: bold;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.available {
    background-color: #28a745;
    color: white;
}
.reserved {
    background-color: yellow;
    color: white;
}

.booked {
    background-color: #dc3545;
    color: white;
    cursor: not-allowed;
    opacity: 0.7;
}

.aisle {
    height: 50px;
    background-color: transparent;
}

.back-row {
    height: 20px;
    background-color: #e9ecef;
    border-radius: 0 0 8px 8px;
}

.seat:hover:not(.booked) {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}
</style>




@endsection
