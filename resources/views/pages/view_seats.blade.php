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
                            <option value="Airport">Naya Thimi</option>
                            <option value="Railway Station">Satdobato </option>
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
:root {
    --primary-color: #4361ee;
    --primary-light: #eef2ff;
    --secondary-color: #3f37c9;
    --success-color: #4cc9f0;
    --warning-color: #f72585;
    --danger-color: #ff4d6d;
    --light-color: #f8f9fa;
    --dark-color: #212529;
    --available-color: #4ade80;
    --booked-color: #f87171;
    --reserved-color: #facc15;
    --selected-color: #60a5fa;
}

.journey-line {
    height: 2px;
    background-color: #e9ecef;
    width: 60px;
}

/* Seat Layout Styling */
.bus-layout {
    background-color: #f8f9fa;
    border-radius: 0.5rem;
    padding: 1rem;
    width: 80%;
}

.driver-section {
    border-bottom: 2px solid #dee2e6;
    padding-bottom: 1rem;
    margin-bottom: 1.5rem;
}

.driver-icon {
    background-color: #e9ecef;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.steering-wheel {
    width: 40px;
    height: 40px;
    border: 2px solid #dee2e6;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.entry-door {
    width: 40px;
    height: 40px;
    background-color: #e9ecef;
    border-radius: 0.25rem;
    position: relative;
}

.door-indicator {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 20px;
    height: 2px;
    background-color: #adb5bd;
}

.seat {
    width: 100%;
    aspect-ratio: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.25rem;
    font-weight: 600;
    font-size: 0.8rem;
    cursor: pointer;
    transition: all 0.2s ease;
    user-select: none;
}

.seat.available {
    background-color: var(--available-color);
    color: #fff;
}

.seat.booked {
    background-color: var(--booked-color);
    color: #fff;
    cursor: not-allowed;
    opacity: 0.8;
}

.seat.reserved {
    background-color: var(--reserved-color);
    color: #212529;
    cursor: not-allowed;
}

.seat.selected {
    background-color: var(--selected-color);
    color: #fff;
    transform: scale(0.95);
}

.seat-indicator {
    width: 16px;
    height: 16px;
    border-radius: 4px;
}

.seat-indicator.available {
    background-color: var(--available-color);
}

.seat-indicator.booked {
    background-color: var(--booked-color);
}

.seat-indicator.reserved {
    background-color: var(--reserved-color);
}

.seat-indicator.selected {
    background-color: var(--selected-color);
}

/* Responsive adjustments */
@media (max-width: 992px) {
    .sticky-lg-top {
        position: relative !important;
        top: 0 !important;
    }
}

@media (max-width: 768px) {
    .seat-info {
        flex-wrap: wrap;
        gap: 0.5rem !important;
    }
   
    .card-header {
        flex-direction: column;
        align-items: flex-start !important;
    }
   
    .seat-info {
        margin-top: 0.5rem;
    }
}

@media (max-width: 576px) {
    .bus-layout {
        padding: 1rem;
    }
   
    .seat {
        font-size: 0.7rem;
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