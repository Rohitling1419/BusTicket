@extends('frontend.Master')

@section('content')
<div class="container py-4" style="margin-top: 3rem;">
    <!-- Hero Section with Search -->
    <div class="search-container rounded-4 mb-4 p-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="text-center mb-4 text-white">Find Your Perfect Journey</h2>
                <div class="search-card bg-white p-4 rounded-4 shadow">
                    <form action="{{ route('search.buses') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-md-6 col-lg-3">
                                <label class="form-label small fw-bold">From</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="bi bi-geo-alt-fill text-primary"></i>
                                    </span>
                                    <input type="text" name="from" class="form-control border-start-0"
                                        placeholder="Departure city" value="{{ request('from') }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <label class="form-label small fw-bold">To</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="bi bi-geo-fill text-primary"></i>
                                    </span>
                                    <input type="text" name="to" class="form-control border-start-0"
                                        placeholder="Destination city" value="{{ request('to') }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <label class="form-label small fw-bold">Travel Date</label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="bi bi-calendar-date-fill text-primary"></i>
                                    </span>
                                    <input type="date" name="date" class="form-control border-start-0"
                                        value="{{ request('date') }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <label class="form-label small fw-bold">&nbsp;</label>
                                <button class="btn btn-primary btn-lg w-100 d-flex align-items-center justify-content-center" type="submit">
                                    <i class="bi bi-search me-2"></i>Find Buses
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Filter Section -->
        <div class="col-lg-3">
            <div class="filter-card sticky-lg-top" style="top: 20px;">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-primary text-white border-0">
                        <h5 class="mb-0"><i class="bi bi-funnel-fill me-2"></i>Filter Results</h5>
                    </div>
                    <div class="card-body p-4">
                        <form id="filterForm" action="{{ route('search.buses') }}" method="GET">
                            <!-- Preserve search parameters -->
                            <input type="hidden" name="from" value="{{ request('from') }}">
                            <input type="hidden" name="to" value="{{ request('to') }}">
                            <input type="hidden" name="date" value="{{ request('date') }}">
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold">Bus Type</label>
                                <div class="d-flex flex-wrap gap-2">
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input filter-radio" type="radio" name="bus_type" id="all" value=""
                                            {{ request('bus_type') == '' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="all">All Types</label>
                                    </div>
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input filter-radio" type="radio" name="bus_type" id="ac" value="AC"
                                            {{ request('bus_type') == 'AC' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="ac">AC</label>
                                    </div>
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input filter-radio" type="radio" name="bus_type" id="tourist" value="Tourist"
                                            {{ request('bus_type') == 'Tourist' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="tourist">Tourist</label>
                                    </div>
                                    <div class="form-check custom-radio">
                                        <input class="form-check-input filter-radio" type="radio" name="bus_type" id="nonac" value="Non AC"
                                            {{ request('bus_type') == 'Non AC' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="nonac">Non AC</label>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                                <i class="bi bi-filter-square-fill me-2"></i>Apply Filters
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bus List Section -->
        <div class="col-lg-9">
            <!-- Results Summary -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">
                    @if(request('from') && request('to'))
                    <span class="text-primary">{{ request('from') }}</span> to
                    <span class="text-primary">{{ request('to') }}</span>
                    @else
                    Available Buses
                    @endif
                </h5>
                <div class="text-muted small">
                    {{ $buses->count() }} {{ Str::plural('result', $buses->count()) }} found
                </div>
            </div>

            @if ($buses->isEmpty())
            <div class="empty-state card border-0 shadow-sm rounded-4 p-4 text-center">
                <div class="py-5">
                    <i class="bi bi-bus-front display-1 text-muted"></i>
                    <h4 class="mt-4">No buses found</h4>
                    <p class="text-muted">Try adjusting your search criteria or date</p>
                    <a href="{{ route('search.buses') }}" class="btn btn-outline-primary mt-3">
                        <i class="bi bi-arrow-left me-2"></i>Back to Search
                    </a>
                </div>
            </div>
            @else
            @foreach ($buses as $bus)
            <div class="bus-card card border-0 shadow-sm rounded-4 mb-4 overflow-hidden">
                <div class="card-body p-0">
                    <!-- Bus Type Badge -->
                    <div class="position-absolute top-0 end-0 m-3">
                        <span class="badge rounded-pill
                                    {{ $bus->bus_type == 'AC' ? 'bg-info' :
                                      ($bus->bus_type == 'Tourist' ? 'bg-success' : 'bg-secondary') }}">
                            {{ $bus->bus_type }}
                        </span>
                    </div>

                    <div class="row g-0">
                        <!-- Bus Info Section -->
                        <div class="col-lg-8">
                            <div class="p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="bus-icon me-3">
                                        <i class="bi bi-bus-front text-primary" style="font-size: 2rem;"></i>
                                    </div>
                                    <div>
                                        <h5 class="fw-bold mb-0">{{ $bus->bus_name }}</h5>
                                        <div class="text-muted small">
                                            <i class="bi bi-star-fill text-warning me-1"></i>
                                            <i class="bi bi-star-fill text-warning me-1"></i>
                                            <i class="bi bi-star-fill text-warning me-1"></i>
                                            <i class="bi bi-star-fill text-warning me-1"></i>
                                            <i class="bi bi-star-half text-warning"></i>
                                            <span class="ms-1">4.5</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="journey-timeline position-relative my-4 py-3">
                                    <div class="timeline-line"></div>
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="timeline-point start"></div>
                                            <div class="time-label">DEPARTURE</div>
                                            <div class="fw-bold fs-4">{{ \Carbon\Carbon::parse($bus->departure_time)->format('h:i A') }}</div>
                                            <div class="location">{{ $bus->from_location }}</div>
                                        </div>
                                        <div class="col-2 d-flex align-items-center justify-content-center">
                                            @php
                                            $departureTime = \Carbon\Carbon::parse($bus->departure_time);
                                            $arrivalTime = \Carbon\Carbon::parse($bus->arrival_time);
                                            $journeyDuration = $departureTime->diff($arrivalTime);
                                            $journeyTime = $journeyDuration->format('%h Hours');
                                            @endphp
                                            <div class="duration-badge">
                                                <i class="bi bi-clock me-1"></i>{{ $journeyTime }}
                                            </div>
                                        </div>
                                        <div class="col-5 text-end">
                                            <div class="timeline-point end"></div>
                                            <div class="time-label">ARRIVAL</div>
                                            <div class="fw-bold fs-4">{{ \Carbon\Carbon::parse($bus->arrival_time)->format('h:i A') }}</div>
                                            <div class="location">{{ $bus->to_location }}</div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <!-- Price & Booking Section -->
                        <div class="col-lg-4 bg-light">
                            <div class="h-100 p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <div class="text-center mb-3">
                                        <div class="text-muted small">Price Per Seat</div>
                                        <div class="price fs-3 fw-bold text-primary">NPR {{ $bus->price }}</div>

                                    </div>

                                    <div class="text-center mb-3">
                                        <div class="seat-availability
                                                    {{ $bus->available_seats > 10 ? 'text-success' :
                                                      ($bus->available_seats > 5 ? 'text-warning' : 'text-danger') }}">
                                            <i class="bi bi-person-fill me-1"></i>
                                            <span class="fw-bold">{{ $bus->available_seats }}</span> Seats Available
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-auto">
                                    <a href="{{ route('view.seats', $bus->id) }}" class="btn btn-primary btn-lg w-100 mb-2 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-grid-3x3-gap me-2"></i>Select Seats
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Pagination -->
            <nav aria-label="Page navigation" class="mt-4 d-flex justify-content-center">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-label="Previous">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            @endif
        </div>
    </div>
</div>

<style>
    /* Enhanced Custom CSS for better UI */
    :root {
        --primary-color: #4361ee;
        --primary-light: #eef2ff;
        --secondary-color: #3f37c9;
        --success-color: #4cc9f0;
        --warning-color: #f72585;
        --danger-color: #ff4d6d;
        --light-color: #f8f9fa;
        --dark-color: #212529;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }

    .search-container {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        padding: 2rem;
    }

    .rounded-4 {
        border-radius: 1rem !important;
    }

    .search-card {
        border-radius: 1rem;
    }

    .form-control,
    .input-group-text,
    .btn {
        border-radius: 0.5rem;
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        border-color: var(--primary-color);
    }

    .btn-primary {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background-color: var(--secondary-color);
        border-color: var(--secondary-color);
    }

    .btn-outline-primary {
        color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-outline-primary:hover {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .text-primary {
        color: var(--primary-color) !important;
    }

    .bg-primary {
        background-color: var(--primary-color) !important;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }

    .bus-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
    }

    .timeline-line {
        position: absolute;
        top: 50%;
        left: 10%;
        right: 10%;
        height: 2px;
        background: #e9ecef;
        z-index: 1;
    }

    .timeline-point {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: var(--primary-color);
        margin: 0 auto 10px;
        position: relative;
        z-index: 2;
    }

    .timeline-point.start {
        margin-left: 0;
    }

    .timeline-point.end {
        margin-right: 0;
        margin-left: auto;
    }

    .time-label {
        font-size: 0.7rem;
        font-weight: 600;
        color: #6c757d;
        margin-bottom: 0.25rem;
    }

    .location {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .duration-badge {
        background-color: var(--primary-light);
        color: var(--primary-color);
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .amenity-badge {
        background-color: #f8f9fa;
        padding: 0.25rem 0.75rem;
        border-radius: 2rem;
        font-size: 0.8rem;
        color: #6c757d;
    }

    .custom-radio .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .empty-state {
        min-height: 300px;
    }

    .sticky-lg-top {
        top: 20px;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .sticky-lg-top {
            position: relative !important;
            top: 0 !important;
        }

        .journey-timeline {
            padding: 1rem 0;
        }

        .timeline-line {
            left: 5%;
            right: 5%;
        }
    }

    @media (max-width: 768px) {
        .search-container {
            padding: 1rem;
        }

        .search-card {
            padding: 1rem !important;
        }

        .bus-card .card-body {
            padding: 1rem !important;
        }

        .price {
            font-size: 1.5rem !important;
        }

        .journey-timeline .fw-bold {
            font-size: 1.25rem !important;
        }
    }

    @media (max-width: 576px) {
        .amenity-badge {
            font-size: 0.7rem;
            padding: 0.2rem 0.5rem;
        }

        .timeline-point {
            width: 12px;
            height: 12px;
        }
    }
</style>


@endsection