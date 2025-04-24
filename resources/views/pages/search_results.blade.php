@extends('frontend.Master')

@section('content')

<div class="container-fluid py-4" style="margin-top: 4rem;">
    <!-- Hero Section with Search -->
    <div class="search-container rounded-4 mb-4 p-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <h2 class="text-center mb-4 text-white">Find Your Perfect Journey</h2>
                <div class="container my-5">
    <div class="card shadow rounded-4 p-4">
        <h4 class="mb-4 text-center">Search for Buses</h4>
        <form action="{{ route('search.buses') }}" method="GET">
            <div class="row g-3">
                <!-- From -->
                <div class="col-md-4">
                    <label for="from" class="form-label">From</label>
                    <select name="from" id="from" class="form-select" required>
                        <option value="" disabled selected>Select departure city</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}" {{ (old('from', $from) == $city) ? 'selected' : '' }}>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- To -->
                <div class="col-md-4">
                    <label for="to" class="form-label">To</label>
                    <select name="to" id="to" class="form-select" required>
                        <option value="" disabled selected>Select destination city</option>
                        @foreach($cities as $city)
                            <option value="{{ $city }}" {{ (old('to', $to) == $city) ? 'selected' : '' }}>{{ $city }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Date -->
                <div class="col-md-4">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ old('date', $date) }}" required>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-5 py-2 rounded-pill shadow-sm">
                    <i class="bi bi-search me-2"></i>Find Buses
                </button>
            </div>
        </form>
    </div>


                </div>

            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Filter Section -->
        <div class="col-lg-3">
            <div class="filter-card sticky-lg-top" style="top: 20px;">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header border-0">
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

                            <button type="submit" class="btn btn-primary w-100 d-flex align-items-center justify-content-center filter-btn">
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
                <h5 class="mb-0 route-title">
                    @if(request('from') && request('to'))
                    <span class="text-primary">{{ request('from') }}</span> to
                    <span class="text-primary">{{ request('to') }}</span>
                    @else
                    Available Buses
                    @endif
                </h5>
                <div class="text-muted small results-count">
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
                                        <i class="bi bi-bus-front"></i>
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
                        <div class="col-lg-4">
                            <div class="h-100 p-4 d-flex flex-column justify-content-between price-section">
                                <div>
                                    <div class="text-center mb-3">
                                        <div class="text-muted small">Price Per Seat</div>
                                        <div class="price fs-3 fw-bold">NPR {{ $bus->price }}</div>
                                    </div>

                                    <div class="text-center mb-3">
                                        <div class="seat-availability
                                                    {{ $bus->available_seats > 10 ? 'text-success' :
                                                      ($bus->available_seats > 5 ? 'text-warning' : 'text-danger') }}">
                                            <i class="bi bi-person-fill me-1"></i>
                                            <span class="fw-bold">{{ $bus->available_seats }}</span> Total Seats 
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-auto">
                                    <a href="{{ route('view.seats', $bus->id) }}" class="btn btn-lg w-100 mb-2 d-flex align-items-center justify-content-center select-seat-btn">
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
        --primary-color: #2c3e50;
        --primary-dark: #994bb7;
        --primary-light: #dbeafe;
        --secondary-color: #0ea5e9;
        --secondary-light: #e0f2fe;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --danger-color: #ef4444;
        --light-color: #f8fafc;
        --dark-color: #1e293b;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --gray-900: #0f172a;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-md: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        --shadow-xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        --transition-fast: all 0.2s ease;
        --transition: all 0.3s ease;
        --transition-slow: all 0.5s ease;
    }

    body {
        font-family: 'Inter', 'Segoe UI', Roboto, -apple-system, BlinkMacSystemFont, sans-serif;
        background-color: var(--light-color);
        color: var(--gray-700);
        line-height: 1.6;
    }

    /* Enhanced Search Container */
    .search-container {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        padding: 2.5rem;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .search-container::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 70%);
        animation: pulse 15s infinite linear;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 0.3;
        }

        50% {
            transform: scale(1.1);
            opacity: 0.5;
        }

        100% {
            transform: scale(1);
            opacity: 0.3;
        }
    }

    .search-container h2 {
        font-weight: 800;
        font-size: 2.25rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        margin-bottom: 1.5rem;
        position: relative;
        display: inline-block;
        left: 50%;
        transform: translateX(-50%);
    }

    .search-container h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background-color: white;
        border-radius: 3px;
    }

    .rounded-4 {
        border-radius: 1rem !important;
    }

    .search-card {
        border-radius: 1rem;
        box-shadow: var(--shadow-xl);
        transition: var(--transition);
        transform: translateY(0);
    }

    .search-card:hover {
        transform: translateY(-5px);
    }

    .form-control,
    .input-group-text {
        border-radius: 0.75rem;
        padding: 0.75rem 1rem;
        font-size: 1rem;
        border: 1px solid var(--gray-200);
        transition: var(--transition-fast);
    }

    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(37, 99, 235, 0.25);
        border-color: var(--primary-color);
    }

    .input-group-text {
        color: var(--primary-color);
    }

    .form-label {
        color: var(--gray-700);
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }

    /* Enhanced Buttons */
    .btn {
        border-radius: 0.75rem;
        font-weight: 600;
        padding: 0.75rem 1.5rem;
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }

    .btn::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: var(--transition);
    }

    .btn:hover::after {
        left: 100%;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        border: none;
        box-shadow: 0 4px 6px rgba(37, 99, 235, 0.2);
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary-color));
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(37, 99, 235, 0.3);
    }

    .btn-outline-primary {
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
        background: transparent;
    }

    .btn-outline-primary:hover {
        background-color: var(--primary-color);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(37, 99, 235, 0.2);
    }

    .search-btn {
        background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        font-size: 1.1rem;
    }

    .search-btn:hover {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    }

    .filter-btn {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    }

    .select-seat-btn {
        background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
        color: white;
        font-weight: 600;
        box-shadow: 0 4px 6px rgba(14, 165, 233, 0.2);
    }

    .select-seat-btn:hover {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        transform: translateY(-3px);
        box-shadow: 0 6px 12px rgba(14, 165, 233, 0.3);
    }

    /* Enhanced Cards */
    .card {
        border: none;
        border-radius: 1rem;
        overflow: hidden;
        transition: var(--transition);
        box-shadow: var(--shadow);
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
        font-weight: 600;
        padding: 1.25rem 1.5rem;
    }

    .bus-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 1rem;
        overflow: hidden;
    }

    .bus-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg) !important;
    }

    /* Enhanced Bus Info */
    .bus-icon {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--primary-light);
        border-radius: 50%;
        color: var(--primary-color);
    }

    .bus-icon i {
        font-size: 2rem;
    }

    .route-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gray-800);
    }

    .results-count {
        background: var(--gray-100);
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        font-weight: 500;
    }

    /* Enhanced Timeline */
    .journey-timeline {
        padding: 2rem 0;
        position: relative;
    }

    .timeline-line {
        position: absolute;
        top: 50%;
        left: 10%;
        right: 10%;
        height: 3px;
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        z-index: 1;
        border-radius: 3px;
    }

    .timeline-point {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: var(--primary-color);
        border: 3px solid white;
        box-shadow: 0 0 0 3px var(--primary-light);
        margin: 0 auto 12px;
        position: relative;
        z-index: 2;
        transition: var(--transition);
    }

    .timeline-point.start {
        margin-left: 0;
        background: var(--primary-color);
    }

    .timeline-point.end {
        margin-right: 0;
        margin-left: auto;
        background: var(--secondary-color);
    }

    .bus-card:hover .timeline-point {
        transform: scale(1.2);
    }

    .time-label {
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--gray-500);
        letter-spacing: 0.05em;
        margin-bottom: 0.25rem;
    }

    .location {
        font-size: 0.95rem;
        color: var(--gray-600);
        font-weight: 500;
    }

    .duration-badge {
        background: linear-gradient(135deg, var(--primary-light), var(--secondary-light));
        color: var(--primary-dark);
        padding: 0.6rem 1.2rem;
        border-radius: 2rem;
        font-size: 0.9rem;
        font-weight: 600;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
    }

    .bus-card:hover .duration-badge {
        transform: scale(1.05);
        box-shadow: var(--shadow);
    }

    /* Enhanced Price Section */
    .price-section {
        background: linear-gradient(135deg, var(--primary-light), var(--secondary-light));
        position: relative;
        overflow: hidden;
    }

    .price-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%232563eb' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.5;
    }

    .price {
        font-size: 2.5rem !important;
        font-weight: 800 !important;
        color: var(--primary-dark);
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        line-height: 1.2;
        display: inline-block;
        position: relative;
    }

    .price::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 2px;
        background: var(--primary-color);
        border-radius: 2px;
    }

    .seat-availability {
        font-size: 1rem;
        padding: 0.5rem 1rem;
        border-radius: 2rem;
        background: rgba(255, 255, 255, 0.5);
        display: inline-block;
    }

    /* Enhanced Amenities */
    .amenity-badge {
        background-color: var(--gray-100);
        padding: 0.4rem 0.8rem;
        border-radius: 2rem;
        font-size: 0.8rem;
        color: var(--gray-700);
        font-weight: 500;
        transition: var(--transition-fast);
        border: 1px solid var(--gray-200);
    }

    .amenity-badge:hover {
        background-color: var(--primary-light);
        color: var(--primary-dark);
        transform: translateY(-2px);
    }

    .amenity-badge i {
        color: var(--primary-color);
    }

    /* Enhanced Filter Section */
    .filter-card {
        transition: var(--transition);
    }

    .custom-radio .form-check-input {
        width: 1.2rem;
        height: 1.2rem;
        margin-top: 0.15rem;
        border: 2px solid var(--gray-300);
        transition: var(--transition-fast);
    }

    .custom-radio .form-check-input:checked {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        box-shadow: 0 0 0 2px var(--primary-light);
    }

    .custom-radio .form-check-label {
        font-size: 0.95rem;
        color: var(--gray-700);
        padding-left: 0.25rem;
        transition: var(--transition-fast);
    }

    .custom-radio:hover .form-check-label {
        color: var(--primary-color);
    }

    /* Enhanced Pagination */
    .pagination {
        gap: 0.25rem;
    }

    .page-link {
        border: none;
        padding: 0.5rem 0.75rem;
        color: var(--gray-700);
        border-radius: 0.5rem;
        transition: var(--transition-fast);
    }

    .page-link:hover {
        background-color: var(--primary-light);
        color: var(--primary-color);
    }

    .page-item.active .page-link {
        background-color: var(--primary-color);
        color: white;
    }

    .page-item.disabled .page-link {
        color: var(--gray-400);
        background-color: transparent;
    }

    /* Empty State */
    .empty-state {
        min-height: 350px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-state i {
        color: var(--gray-300);
        margin-bottom: 1rem;
    }

    /* Responsive Adjustments */
    @media (max-width: 1199px) {
        .search-container h2 {
            font-size: 2rem;
        }

        .price {
            font-size: 2.2rem !important;
        }
    }

    @media (max-width: 991px) {
        .search-container {
            padding: 2rem;
        }

        .search-container h2 {
            font-size: 1.75rem;
        }

        .sticky-lg-top {
            position: relative !important;
            top: 0 !important;
            margin-bottom: 1.5rem;
        }

        .journey-timeline {
            padding: 1.5rem 0;
        }

        .timeline-line {
            left: 5%;
            right: 5%;
        }

        .price {
            font-size: 2rem !important;
        }

        .journey-timeline .fw-bold {
            font-size: 1.5rem !important;
        }
    }

    @media (max-width: 768px) {
        .search-container {
            padding: 1.5rem;
        }

        .search-container h2 {
            font-size: 1.5rem;
        }

        .search-card {
            padding: 1.25rem !important;
        }

        .bus-card .card-body {
            padding: 1.25rem !important;
        }

        .price {
            font-size: 1.75rem !important;
        }

        .journey-timeline .fw-bold {
            font-size: 1.25rem !important;
        }

        .bus-icon {
            width: 50px;
            height: 50px;
        }

        .bus-icon i {
            font-size: 1.5rem;
        }

        .timeline-point {
            width: 16px;
            height: 16px;
        }
    }

    @media (max-width: 576px) {
        .search-container {
            padding: 1.25rem;
        }

        .search-container h2 {
            font-size: 1.35rem;
        }

        .amenity-badge {
            font-size: 0.7rem;
            padding: 0.3rem 0.6rem;
        }

        .timeline-point {
            width: 14px;
            height: 14px;
        }

        .journey-timeline .fw-bold {
            font-size: 1.1rem !important;
        }

        .duration-badge {
            padding: 0.4rem 0.8rem;
            font-size: 0.8rem;
        }

        .time-label {
            font-size: 0.7rem;
        }

        .location {
            font-size: 0.85rem;
        }
    }
</style>

<script>
    // Auto-submit filter form when radio buttons change
    document.addEventListener('DOMContentLoaded', function() {
        const filterRadios = document.querySelectorAll('.filter-radio');
        filterRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });
        });

        // Set minimum date for date picker to today
        const dateInput = document.querySelector('input[type="date"]');
        if (dateInput) {
            const today = new Date().toISOString().split('T')[0];
            dateInput.min = today;

            // If no date is selected, default to today
            if (!dateInput.value) {
                dateInput.value = today;
            }
        }
    });
</script>
@endsection