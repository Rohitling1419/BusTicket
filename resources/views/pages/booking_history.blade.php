@extends('frontend.Master')

@section('content')
<div class="booking-history-container" style="margin-top: 40px;">
    <div class="container">
        <div class="booking-card">
            <div class="booking-header text-center">
                <h2><i class="bi bi-calendar-check booking-icon"></i>My Booking History</h2>
            </div>

            @if($bookings->isEmpty())
            <div class="no-booking-container">
                <div class="no-booking">
                    <div class="no-booking-icon">
                        <i class="bi bi-calendar-x"></i>
                    </div>
                    <div class="no-booking-text">
                        You haven't made any bookings yet.
                    </div>
                    <a href="{{ route('home') }}" class="btn book-now-btn">
                        <i class="bi bi-search me-2"></i>Find Buses
                    </a>
                </div>
            </div>
            @else

            <!-- Desktop Table View -->
            <div class="booking-table-container d-none d-md-block">
                <table class="booking-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Bus Details</th>
                            <th>Schedule</th>
                            <th>Seats</th>
                            <th>Booking Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $index => $booking)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>
                                <div class="bus-name">{{ $booking->bus->bus_name }}</div>
                                <div class="bus-type mt-1">{{ $booking->bus->bus_type }}</div>
                            </td>
                            <td>
                                <div class="time-badge mb-2">
                                    <i class="bi bi-clock time-icon"></i>
                                    {{ \Carbon\Carbon::parse($booking->bus->departure_time)->format('h:i A') }}
                                </div>
                                <div class="date-badge">
                                    <i class="bi bi-calendar-date date-icon"></i>
                                    {{ \Carbon\Carbon::parse($booking->bus->departure_date)->format('d M Y') }}
                                </div>
                            </td>
                            <td>
                                @if($booking->seat_number)
                                @foreach (explode(',', $booking->seat_number) as $seat)
                                <span class="seat-badge">{{ $seat }}</span>
                                @endforeach
                                @else
                                <span class="text-muted">No Seats</span>
                                @endif
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                                <div class="text-muted small">
                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('h:i A') }}
                                </div>
                            </td>
                            <td>
                                @if($booking->status == 'confirmed')
                                <div class="status-confirmed mb-2">
                                    <i class="bi bi-check-circle me-1"></i>Confirmed
                                </div>
                                <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="cancel-btn">
                                        <i class="bi bi-x-circle"></i>Cancel
                                    </button>
                                </form>
                                @elseif($booking->status == 'cancelled')
                                <div class="status-cancelled">
                                    <i class="bi bi-x-circle me-1"></i>Cancelled
                                </div>
                                @elseif($booking->status == 'pending')
                                <div class="status-pending mb-2">
                                    <i class="bi bi-hourglass-split me-1"></i>Pending
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <!-- Mobile Card View -->
            <div class="booking-table-mobile d-md-none">
                @foreach ($bookings as $index => $booking)
                <div class="booking-item">
                    <div class="item-header">
                        <div class="bus-name">{{ $booking->bus->bus_name }}</div>
                        <div class="bus-type">{{ $booking->bus->bus_type }}</div>
                    </div>

                    <div class="item-detail">
                        <div class="detail-label">Departure</div>
                        <div class="detail-value time-badge">
                            <i class="bi bi-clock time-icon"></i>
                            {{ \Carbon\Carbon::parse($booking->bus->departure_time)->format('h:i A') }}
                        </div>
                    </div>

                    <div class="item-detail">
                        <div class="detail-label">Date</div>
                        <div class="detail-value date-badge">
                            <i class="bi bi-calendar-date date-icon"></i>
                            {{ \Carbon\Carbon::parse($booking->bus->departure_date)->format('d M Y') }}
                        </div>
                    </div>

                    <div class="item-detail">
                        <div class="detail-label">Seats</div>
                        <div class="detail-value">
                            @if($booking->seat_number)
                            @foreach (explode(',', $booking->seat_number) as $seat)
                            <span class="seat-badge">{{ $seat }}</span>
                            @endforeach
                            @else
                            <span class="text-muted">No Seats</span>
                            @endif
                        </div>
                    </div>

                    <div class="item-detail">
                        <div class="detail-label">Booked On</div>
                        <div class="detail-value">
                            {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y, h:i A') }}
                        </div>
                    </div>

                    <div class="item-footer">
                        @if($booking->status == 'confirmed')
                        <div class="status-confirmed">
                            <i class="bi bi-check-circle me-1"></i>Confirmed
                        </div>
                        <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking?');">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="cancel-btn">
                                <i class="bi bi-x-circle"></i>Cancel
                            </button>
                        </form>
                        @elseif($booking->status == 'cancelled')
                        <div class="status-cancelled">
                            <i class="bi bi-x-circle me-1"></i>Cancelled
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
<style>
    /* Main container styling */
    .booking-history-container {
        padding: 3rem 1.5rem;
        background-color: #f8f9fa;
        min-height: calc(100vh - 100px);
        margin-top: 40px;
    }

    /* Card styling */
    .booking-card {
        background-color: #ffffff;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .booking-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    /* Header styling */
    .booking-header {
        background: linear-gradient(135deg, #3d4060 0%, #8e4aad 100%);
        color: white;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
    }

    .booking-header h2 {
        margin: 0;
        font-weight: 700;
        font-size: 1.75rem;
        position: relative;
        z-index: 2;
    }

    .booking-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 100%;
        height: 200%;
        background: rgba(255, 255, 255, 0.1);
        transform: rotate(30deg);
        z-index: 1;
    }

    .booking-icon {
        font-size: 1.5rem;
        margin-right: 0.75rem;
        vertical-align: middle;
    }

    /* Table styling */
    .booking-table-container {
        padding: 1.5rem;
    }

    .booking-table {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .booking-table th {
        background-color: #f8f9fa;
        color: #495057;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        padding: 1rem;
        border-bottom: 2px solid #e9ecef;
    }

    .booking-table td {
        padding: 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #e9ecef;
        font-size: 0.95rem;
    }

    .booking-table tbody tr {
        transition: background-color 0.2s ease;
    }

    .booking-table tbody tr:hover {
        background-color: #f8f9fa;
    }

    /* Bus info styling */
    .bus-name {
        font-weight: 600;
        color: #212529;
    }

    .bus-type {
        display: inline-block;
        padding: 0.25rem 0.75rem;
        border-radius: 1rem;
        font-size: 0.8rem;
        font-weight: 500;
        background-color: #e9ecef;
        color: #495057;
    }

    /* Time and date styling */
    .time-badge {
        display: inline-flex;
        align-items: center;
        background-color: #e8f4ff;
        color: #0d6efd;
        padding: 0.4rem 0.75rem;
        border-radius: 0.5rem;
        font-weight: 500;
    }

    .date-badge {
        display: inline-flex;
        align-items: center;
        background-color: #e8f5e9;
        color: #198754;
        padding: 0.4rem 0.75rem;
        border-radius: 0.5rem;
        font-weight: 500;
    }

    .time-icon,
    .date-icon {
        margin-right: 0.4rem;
        font-size: 0.9rem;
    }

    /* Seat styling */
    .seat-badge {
        display: inline-block;
        background-color: #945cb0;
        color: white;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.8rem;
        font-weight: 500;
        margin: 0.1rem;
        box-shadow: 0 2px 4px rgba(78, 115, 223, 0.2);
        transition: transform 0.2s ease;
    }

    .seat-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px rgba(78, 115, 223, 0.3);
    }

    /* Status styling */
    .status-confirmed {
        background-color: #e8f5e9;
        color: #198754;
        border-left: 3px solid #198754;
        padding: 0.5rem 0.75rem;
        border-radius: 0.25rem;
        font-weight: 500;
        display: inline-block;
        margin-bottom: 0.5rem;
    }

    .status-cancelled {
        background-color: #ffebee;
        color: #dc3545;
        border-left: 3px solid #dc3545;
        padding: 0.5rem 0.75rem;
        border-radius: 0.25rem;
        font-weight: 500;
        display: inline-block;
    }

    .status-pending{
        background-color: #ffebee;
        color: black;
        border-left: 3px solid yellow;
        padding: 0.5rem 0.75rem;
        border-radius: 0.25rem;
        font-weight: 500;
        display: inline-block;
    }

    /* Button styling */
    .cancel-btn {
        background-color: white;
        color: #dc3545;
        border: 1px solid #dc3545;
        border-radius: 0.5rem;
        padding: 0.4rem 0.75rem;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .cancel-btn:hover {
        background-color: #dc3545;
        color: white;
        box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
    }

    .cancel-btn i {
        margin-right: 0.3rem;
    }

    /* Empty state styling */
    .no-booking-container {
        padding: 3rem 1.5rem;
        text-align: center;
    }

    .no-booking {
        background-color: white;
        border-radius: 1rem;
        padding: 3rem 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        display: inline-block;
        max-width: 500px;
    }

    .no-booking-icon {
        font-size: 4rem;
        color: #ffc107;
        margin-bottom: 1.5rem;
    }

    .no-booking-text {
        font-size: 1.2rem;
        color: #6c757d;
        margin-bottom: 1.5rem;
    }

    .book-now-btn {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        color: white;
        border: none;
        border-radius: 0.5rem;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .book-now-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(78, 115, 223, 0.3);
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {

        .booking-table th,
        .booking-table td {
            padding: 0.75rem 0.5rem;
        }
    }

    @media (max-width: 768px) {
        .booking-card {
            border-radius: 0.75rem;
        }

        .booking-header {
            padding: 1.25rem;
        }

        .booking-header h2 {
            font-size: 1.5rem;
        }

        .booking-table-container {
            padding: 1rem;
        }

        /* Mobile-optimized table */
        .booking-table-mobile .booking-item {
            background-color: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 1rem;
            padding: 1rem;
            border-left: 4px solid #4e73df;
        }

        .booking-table-mobile .item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #e9ecef;
        }

        .booking-table-mobile .item-detail {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .booking-table-mobile .detail-label {
            font-weight: 500;
            color: #6c757d;
            font-size: 0.85rem;
        }

        .booking-table-mobile .detail-value {
            text-align: right;
            font-weight: 500;
        }

        .booking-table-mobile .item-footer {
            margin-top: 1rem;
            padding-top: 0.75rem;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    }
</style>
@endsection