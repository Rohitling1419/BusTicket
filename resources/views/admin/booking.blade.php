@extends('admin.layout')

@section('content')
<x-app-layout>
<main id="main" class="main">
    <div class="container py-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary bg-gradient text-white d-flex justify-content-between align-items-center">
                <h2 class="fs-4 mb-0"><i class="bi bi-calendar-check me-2"></i>Booking History</h2>
                <a href="{{ route('dashboard') }}" class="btn btn-sm btn-light"><i class="bi bi-arrow-left me-1"></i>Back</a>
            </div>
            
            <div class="card-body">
                <!-- Search Form -->
                <form method="GET" action="{{ route('bookingHistory') }}" class="mb-4">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-5">
                            <label for="searchInput" class="form-label text-muted small">Search Bookings</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-search"></i></span>
                                <input type="text" class="form-control" id="searchInput" name="search" placeholder="Search by Customer Name or Booking ID" value="{{ request()->get('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="statusFilter" class="form-label text-muted small">Filter by Status</label>
                            <select class="form-select" id="statusFilter" name="status">
                                <option value="">All Statuses</option>
                                <option value="Confirmed" {{ request()->get('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="Pending" {{ request()->get('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Cancelled" {{ request()->get('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-grow-1">
                                    <i class="bi bi-filter me-1"></i>Apply Filters
                                </button>
                                <a href="{{ route('bookingHistory') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle me-1"></i>Clear
                                </a>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Booking History Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="fw-semibold">Booking ID</th>
                                <th scope="col" class="fw-semibold">Customer Name</th>
                                <th scope="col" class="fw-semibold">Bus Details</th>
                                <th scope="col" class="fw-semibold">Seat No.</th>
                                <th scope="col" class="fw-semibold">Booking Date</th>
                                <th scope="col" class="fw-semibold">Status</th>
                                <th scope="col" class="fw-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($bookings->count() > 0)
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td><span class="fw-medium">#{{ $booking->bus_id }}</span></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-circle bg-light text-primary me-2">
                                                    {{ substr($booking->user->name, 0, 1) }}
                                                </div>
                                                {{ $booking->user->name }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="fw-medium">{{ $booking->bus->bus_name }}</span>
                                                <small class="text-muted">{{ $booking->bus->route ?? 'N/A' }}</small>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-light text-dark border">{{ $booking->seats_booked }}</span></td>
                                        <td>{{ \Carbon\Carbon::parse($booking->booking_date)->format('M d, Y') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $booking->status == 'Confirmed' ? 'success' : ($booking->status == 'Pending' ? 'warning' : 'danger') }} bg-opacity-75 px-3 py-2">
                                                <i class="bi bi-{{ $booking->status == 'Confirmed' ? 'check-circle' : ($booking->status == 'Pending' ? 'hourglass' : 'x-circle') }} me-1"></i>
                                                {{ $booking->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="#" class="btn btn-sm btn-outline-primary" title="View Details">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="#" class="btn btn-sm btn-outline-secondary" title="Print Ticket">
                                                    <i class="bi bi-printer"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-calendar-x fs-1 text-muted mb-2"></i>
                                            <p class="mb-0">No booking records found</p>
                                            <small class="text-muted">Try adjusting your search criteria</small>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted small">
                        Showing {{ $bookings->firstItem() ?? 0 }} to {{ $bookings->lastItem() ?? 0 }} of {{ $bookings->total() }} entries
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    .avatar-circle {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
</style>
</x-app-layout>
@endsection