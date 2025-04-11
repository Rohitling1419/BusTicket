@extends('frontend.Master')

@section('content')
<div class="container py-4" style="margin-top: 3rem;">
    

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
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <div class="fw-bold">{{ $bus->from_location }}</div>
                                    <div class="text-muted small">{{ \Carbon\Carbon::parse($bus->departure_time)->format('h:i A') }}</div>
                                </div>
                                <div class="journey-line position-relative mx-3">
                                    <i class="bi bi-circle-fill text-primary position-absolute start-0 translate-middle-y" style="font-size: 8px; top: 50%;"></i>
                                    <i class="bi bi-circle-fill text-primary position-absolute end-0 translate-middle-y" style="font-size: 8px; top: 50%;"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $bus->to_location }}</div>
                                    <div class="text-muted small">{{ \Carbon\Carbon::parse($bus->arrival_time)->format('h:i A') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-md-end mt-3 mt-md-0">
                            <div class="text-muted small">Price Per Seat</div>
                            <div class="fs-4 fw-bold text-primary">NPR {{ $bus->price }}</div>
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
                        <!-- Driver Section -->
                        <div class="driver-section mb-4 d-flex justify-content-between align-items-center">
                            <div class="driver-icon">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <div class="steering-wheel">
                                <i class="bi bi-circle"></i>
                            </div>
                            <div class="entry-door">
                                <div class="door-indicator"></div>
                            </div>
                        </div>

                        <!-- Seat Layout -->
                        <div class="seat-container">
                        <div class="row g-2 mb-4">
                                <!-- Left Side Seats (A) -->
                                <div class="col-6">
                                    <div class="row g-2">
                                        <div class="col-3">
                                            <div class="seat available" data-seat="A1" data-price="{{ $bus->price }}">A1</div>
                                        </div>
                                        <div class="col-3">
                                            <div class="seat available" data-seat="A2" data-price="{{ $bus->price }}">A2</div>
                                        </div>
                                        
                                    </div>
                                </div>
                               
                                <!-- Right Side Seats (B) -->
                                <div class="col-6">
                                    <div class="row g-2">
                                        <div class="col-3">
                                            <div class="seat available" data-seat="B1" data-price="{{ $bus->price }}">B1</div>
                                        </div>
                                        <div class="col-3">
                                            <div class="seat available" data-seat="B2" data-price="{{ $bus->price }}">B2</div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="row g-2 mb-4">
                                <!-- Left Side Seats (A) -->
                                <div class="col-6">
                                    <div class="row g-2">
                                        <div class="col-3">
                                            <div class="seat available" data-seat="A5" data-price="{{ $bus->price }}">A3</div>
                                        </div>
                                        <div class="col-3">
                                            <div class="seat available" data-seat="A6" data-price="{{ $bus->price }}">A4</div>
                                        </div>
                                        
                                    </div>
                                </div>
                               
                                <!-- Right Side Seats (B) -->
                                <div class="col-6">
                                    <div class="row g-2">
                                        <div class="col-3">
                                            <div class="seat available" data-seat="B5" data-price="{{ $bus->price }}">B3</div>
                                        </div>
                                        <div class="col-3">
                                            <div class="seat available" data-seat="B6" data-price="{{ $bus->price }}">B4</div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="row g-2 mb-4">
                                <!-- Left Side Seats (A) -->
                                <div class="col-6">
                                    <div class="row g-2">
                                        <div class="col-3">
                                            <div class="seat available" data-seat="A9" data-price="{{ $bus->price }}">A5</div>
                                        </div>
                                        <div class="col-3">
                                            <div class="seat available" data-seat="A10" data-price="{{ $bus->price }}">A6</div>
                                        </div>
                                        
                                    </div>
                                </div>
                               
                                <!-- Right Side Seats (B) -->
                                <div class="col-6">
                                    <div class="row g-2">
                                        <div class="col-3">
                                            <div class="seat available" data-seat="B9" data-price="{{ $bus->price }}">B5</div>
                                        </div>
                                        <div class="col-3">
                                            <div class="seat available" data-seat="B10" data-price="{{ $bus->price }}">B6</div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <div class="row g-2 mb-4">
                                <!-- Left Side Seats (A) -->
                                <div class="col-6">
                                    <div class="row g-2">
                                        <div class="col-3">
                                            <div class="seat available" data-seat="A13" data-price="{{ $bus->price }}">A7</div>
                                        </div>
                                        <div class="col-3">
                                            <div class="seat available" data-seat="A14" data-price="{{ $bus->price }}">A8</div>
                                        </div>
                                        <div class="col-3">
                                            <div class="seat available" data-seat="A14" data-price="{{ $bus->price }}">A9</div>
                                        </div>
                                    </div>
                                </div>
                               
                                <!-- Right Side Seats (B) -->
                                <div class="col-6">
                                    <div class="row g-2">
                                        <div class="col-3">
                                            <div class="seat available" data-seat="B13" data-price="{{ $bus->price }}">B7</div>
                                        </div>
                                        <div class="col-3">
                                            <div class="seat available" data-seat="B14" data-price="{{ $bus->price }}">B8</div>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Summary -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 sticky-lg-top" style="top: 20px;">
                <div class="card-header bg-primary text-white p-4 border-0">
                    <h5 class="mb-0"><i class="bi bi-ticket-perforated-fill me-2"></i>Booking Summary</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Boarding Point</label>
                        <select class="form-select" id="boardingPoint">
                            <option value="">Select boarding point</option>
                            <option value="Main Bus Terminal">Kalanki</option>
                            <option value="City Center">Naya Bus Park</option>
                        
                        </select>
                    </div>

                    <div class="booking-details">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold">Seat(s):</span>
                                <span id="selectedSeats">-</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold">Fare:</span>
                                <span id="fare">Rs.0</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Total Amount:</span>
                                <span id="totalAmount" class="fw-bold text-primary">Rs.0</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <button id="continueBtn" class="btn btn-success btn-lg w-100 d-flex align-items-center justify-content-center" disabled>
                            <i class="bi bi-arrow-right-circle me-2"></i>Continue
                        </button>
                    </div>

                    <div class="mt-4">
                        <div class="alert alert-info p-3 mb-0">
                            <div class="d-flex">
                                <i class="bi bi-info-circle-fill me-2 fs-5"></i>
                                <div>
                                    <p class="mb-1 small">You can select up to 10 seats per booking.</p>
                                    <p class="mb-0 small">Boarding point selection is mandatory.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bus-layout {
        max-width: 100%;
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .seats {
        display: grid;
        grid-template-columns: repeat(5, 60px); /* 2 seats, aisle gap, 2 seats */
        gap: 15px;
        justify-content: center;
        position: relative;
    }

    .seats::before {
        content: '';
        grid-column: 3;
    }

    .seat {
        width: 60px;
        height: 60px;
        line-height: 60px;
        text-align: center;
        border-radius: 10px;
        font-weight: bold;
        background-color: #f1f1f1;
        color: #333;
        transition: 0.3s;
        cursor: pointer;
        user-select: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .seat:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
    }

    .seat.available {
        background-color: #d4edda;
        color: #155724;
    }

    .seat.selected {
        background-color: #007bff;
        color: white;
    }

    .seat.booked {
        background-color: #6c757d;
        color: white;
        cursor: not-allowed;
        pointer-events: none;
    }

    .seat.reserved {
        background-color: #ffc107;
        color: #212529;
        cursor: not-allowed;
        pointer-events: none;
    }

    .seat-legend {
        display: flex;
        justify-content: space-around;
        margin-top: 25px;
        font-size: 14px;
        flex-wrap: wrap;
    }

    .seat-legend div {
        display: flex;
        align-items: center;
        margin: 5px 10px;
    }

    .seat-legend .seat {
        width: 20px;
        height: 20px;
        margin-right: 8px;
        font-size: 0;
        box-shadow: none;
        transition: none;
        transform: none;
    }

    @media (max-width: 768px) {
        .seats {
            grid-template-columns: repeat(5, 50px);
            gap: 10px;
        }

        .seat {
            width: 50px;
            height: 50px;
            line-height: 50px;
        }
    }
</style>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const seats = document.querySelectorAll('.seat.available');
    const selectedSeatsElement = document.getElementById('selectedSeats');
    const fareElement = document.getElementById('fare');
    const totalAmountElement = document.getElementById('totalAmount');
    const continueBtn = document.getElementById('continueBtn');
    const boardingPointSelect = document.getElementById('boardingPoint');
   
    let selectedSeats = [];
    const maxSeats = 10;
   
    // Add click event to available seats
    seats.forEach(seat => {
        seat.addEventListener('click', function() {
            const seatNumber = this.getAttribute('data-seat');
            const seatPrice = parseFloat(this.getAttribute('data-price'));
           
            if (this.classList.contains('selected')) {
                // Deselect seat
                this.classList.remove('selected');
                selectedSeats = selectedSeats.filter(s => s.number !== seatNumber);
            } else {
                // Select seat if not at max
                if (selectedSeats.length < maxSeats) {
                    this.classList.add('selected');
                    selectedSeats.push({
                        number: seatNumber,
                        price: seatPrice
                    });
                } else {
                    alert(`You can only select up to ${maxSeats} seats.`);
                    return;
                }
            }
           
            updateSummary();
        });
    });
   
    // Update boarding point validation
    boardingPointSelect.addEventListener('change', function() {
        updateContinueButton();
    });
   
    function updateSummary() {
        if (selectedSeats.length > 0) {
            // Update selected seats display
            selectedSeatsElement.textContent = selectedSeats.map(s => s.number).join(', ');
           
            // Calculate total fare
            const totalFare = selectedSeats.reduce((sum, seat) => sum + seat.price, 0);
            fareElement.textContent = `Rs.${totalFare}`;
            totalAmountElement.textContent = `Rs.${totalFare}`;
        } else {
            // Reset if no seats selected
            selectedSeatsElement.textContent = '-';
            fareElement.textContent = 'Rs.0';
            totalAmountElement.textContent = 'Rs.0';
        }
       
        updateContinueButton();
    }
   
    function updateContinueButton() {
        // Enable continue button only if seats are selected and boarding point is chosen
        if (selectedSeats.length > 0 && boardingPointSelect.value) {
            continueBtn.disabled = false;
        } else {
            continueBtn.disabled = true;
        }
    }
   
    // Handle continue button click
    continueBtn.addEventListener('click', function() {
        if (selectedSeats.length === 0) {
            alert('Please select at least one seat.');
            return;
        }
       
        if (!boardingPointSelect.value) {
            alert('Please select a boarding point.');
            return;
        }
       
        // Prepare data for form submission
        const bookingData = {
            bus_id: '{{ $bus->id }}',
            selected_seats: selectedSeats.map(s => s.number),
            boarding_point: boardingPointSelect.value,
            total_amount: selectedSeats.reduce((sum, seat) => sum + seat.price, 0)
        };
       
        // Here you would normally submit the form or redirect to payment page
        console.log('Booking data:', bookingData);
       
        // Redirect to passenger details page (you would implement this)
        // window.location.href = "{{ route('passenger.details') }}?data=" + encodeURIComponent(JSON.stringify(bookingData));
       
        // For demo purposes, just show an alert
        alert('Proceeding to passenger details with selected seats: ' + selectedSeats.map(s => s.number).join(', '));
    });
});
</script>
@endsection