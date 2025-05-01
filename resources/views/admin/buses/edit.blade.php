@extends('admin.layout')

@section('content')
    <x-app-layout>
        <main id="main" class="main py-4">
            <div class="container-fluid px-3 px-md-4">
                <div

                    class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4">
                    <h2 class="fw-bold fs-3 fs-md-2" style="color: #4f46e5;">
                        <i class="fas fa-bus me-2"></i> Edit Bus Details
                    </h2>

                    <a href="{{ route('admin.buses.index') }}"
                        class="btn btn-outline-secondary rounded-pill px-3 px-md-4 py-2 shadow-sm w-100 w-md-auto">
                        <i class="fas fa-arrow-left me-2"></i> Back to Buses
                    </a>
                </div>

                @if ($errors->any())
                    <div class="alert border-0 shadow-sm mb-4"
                        style="border-left: 4px solid #ef4444 !important; background-color: #fef2f2; color: #991b1b;">
                        <h5 class="alert-heading fw-bold mb-2"><i class="fas fa-exclamation-circle me-2"></i>Please fix the
                            following errors:</h5>
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card border-0 shadow-sm rounded-lg mb-4 overflow-hidden">
                    <div class="card-header bg-white p-3 p-md-4 border-0">
                        <h4 class="card-title mb-0" style="color: #4f46e5;">
                            <i class="fas fa-edit me-2"></i> Bus Information Form
                        </h4>
                    </div>
                    <div class="card-body p-3 p-md-4">
                        <form action="{{ route('admin.buses.update', $bus->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Bus Information Section -->
                                <div class="col-12 mb-4">
                                    <div class="d-flex align-items-center">
                                        <div
                                            style="width: 30px; height: 30px; background-color: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                                            <i class="fas fa-info-circle" style="color: #4f46e5;"></i>
                                        </div>
                                        <h5 class="fw-bold mb-0" style="color: #4b5563;">Bus Information</h5>
                                    </div>
                                    <hr class="mt-3 mb-4" style="border-color: #f3f4f6; opacity: 0.7;">
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-medium">Bus Name</label>
                                    <div class="input-group shadow-sm rounded overflow-hidden">
                                        <span class="input-group-text"
                                            style="background-color: #f9fafb; border-color: #e5e7eb;"><i class="fas fa-bus"
                                                style="color: #6b7280;"></i></span>
                                        <input type="text" name="bus_name" class="form-control"
                                            value="{{ $bus->bus_name }}" required
                                            style="border-color: #e5e7eb; padding: 0.6rem 1rem;">
                                    </div>
                                    <small class="text-muted mt-2 d-block"><i class="fas fa-info-circle me-1"></i> Enter the
                                        official name of the bus</small>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-medium">Bus Type</label>
                                    <div class="input-group shadow-sm rounded overflow-hidden">
                                        <span class="input-group-text"
                                            style="background-color: #f9fafb; border-color: #e5e7eb;"><i class="fas fa-tag"
                                                style="color: #6b7280;"></i></span>
                                        <select name="bus_type" class="form-select" required
                                            style="border-color: #e5e7eb; padding: 0.6rem 1rem; border-left: 0;">
                                            <option value="Luxury" {{ $bus->bus_type == 'Luxury' ? 'selected' : '' }}>Luxury
                                            </option>
                                            <option value="Standard" {{ $bus->bus_type == 'Standard' ? 'selected' : '' }}>
                                                Standard</option>
                                            <option value="Express" {{ $bus->bus_type == 'Express' ? 'selected' : '' }}>
                                                Express</option>
                                            <option value="Sleeper" {{ $bus->bus_type == 'Sleeper' ? 'selected' : '' }}>
                                                Sleeper</option>
                                            <option value="Mini" {{ $bus->bus_type == 'Mini' ? 'selected' : '' }}>Mini
                                            </option>
                                        </select>
                                    </div>
                                    <small class="text-muted mt-2 d-block"><i class="fas fa-info-circle me-1"></i> Select
                                        the type of bus service</small>
                                </div>

                                <!-- Route Information Section -->
                                <div class="col-12 mb-4 mt-2">
                                    <div class="d-flex align-items-center">
                                        <div
                                            style="width: 30px; height: 30px; background-color: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                                            <i class="fas fa-route" style="color: #4f46e5;"></i>
                                        </div>
                                        <h5 class="fw-bold mb-0" style="color: #4b5563;">Route Information</h5>
                                    </div>
                                    <hr class="mt-3 mb-4" style="border-color: #f3f4f6; opacity: 0.7;">
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-medium">From Location</label>
                                    <div class="input-group shadow-sm rounded overflow-hidden">
                                        <span class="input-group-text"
                                            style="background-color: #f9fafb; border-color: #e5e7eb;"><i
                                                class="fas fa-map-marker-alt" style="color: #6b7280;"></i></span>
                                        <input type="text" name="from_location" class="form-control"
                                            value="{{ $bus->from_location }}" required
                                            style="border-color: #e5e7eb; padding: 0.6rem 1rem;">
                                    </div>
                                    <small class="text-muted mt-2 d-block"><i class="fas fa-info-circle me-1"></i> Starting
                                        point of the journey</small>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-medium">To Location</label>
                                    <div class="input-group shadow-sm rounded overflow-hidden">
                                        <span class="input-group-text"
                                            style="background-color: #f9fafb; border-color: #e5e7eb;"><i
                                                class="fas fa-map-pin" style="color: #6b7280;"></i></span>
                                        <input type="text" name="to_location" class="form-control"
                                            value="{{ $bus->to_location }}" required
                                            style="border-color: #e5e7eb; padding: 0.6rem 1rem;">
                                    </div>
                                    <small class="text-muted mt-2 d-block"><i class="fas fa-info-circle me-1"></i>
                                        Destination of the journey</small>
                                </div>

                                <!-- Schedule Information Section -->
                                <div class="col-12 mb-4 mt-2">
                                    <div class="d-flex align-items-center">
                                        <div
                                            style="width: 30px; height: 30px; background-color: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                                            <i class="fas fa-calendar-alt" style="color: #4f46e5;"></i>
                                        </div>
                                        <h5 class="fw-bold mb-0" style="color: #4b5563;">Schedule Information</h5>
                                    </div>
                                    <hr class="mt-3 mb-4" style="border-color: #f3f4f6; opacity: 0.7;">
                                </div>

                                <div class="col-md-6 col-lg-3 mb-4">
                                    <label class="form-label fw-medium">Departure Date</label>
                                    <div class="input-group shadow-sm rounded overflow-hidden">
                                        <span class="input-group-text"
                                            style="background-color: #f9fafb; border-color: #e5e7eb;"><i
                                                class="fas fa-calendar" style="color: #6b7280;"></i></span>
                                        <input type="date" name="departure_date" class="form-control"
                                            value="{{ $bus->departure_date }}" required
                                            style="border-color: #e5e7eb; padding: 0.6rem 1rem;">
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-3 mb-4">
                                    <label class="form-label fw-medium">Departure Time</label>
                                    <div class="input-group shadow-sm rounded overflow-hidden">
                                        <span class="input-group-text"
                                            style="background-color: #f9fafb; border-color: #e5e7eb;"><i
                                                class="fas fa-clock" style="color: #6b7280;"></i></span>
                                        <input type="time" name="departure_time" id="departure_time"
                                            value="{{ old('departure_time', \Carbon\Carbon::parse($bus->departure_time)->format('H:i')) }}"
                                            class="form-control" required
                                            style="border-color: #e5e7eb; padding: 0.6rem 1rem;">
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-3 mb-4">
                                    <label class="form-label fw-medium">Arrival Date</label>
                                    <div class="input-group shadow-sm rounded overflow-hidden">
                                        <span class="input-group-text"
                                            style="background-color: #f9fafb; border-color: #e5e7eb;"><i
                                                class="fas fa-calendar-check" style="color: #6b7280;"></i></span>
                                        <input type="date" name="arrival_date" class="form-control"
                                            value="{{ old('arrival_date', $bus->arrival_date) }}" required
                                            style="border-color: #e5e7eb; padding: 0.6rem 1rem;">
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-3 mb-4">
                                    <label class="form-label fw-medium">Arrival Time</label>
                                    <div class="input-group shadow-sm rounded overflow-hidden">
                                        <span class="input-group-text"
                                            style="background-color: #f9fafb; border-color: #e5e7eb;"><i
                                                class="fas fa-hourglass-end" style="color: #6b7280;"></i></span>
                                        <input type="time" name="arrival_time" id="arrival_time"
                                            value="{{ old('arrival_time', \Carbon\Carbon::parse($bus->arrival_time)->format('H:i')) }}"
                                            class="form-control" required
                                            style="border-color: #e5e7eb; padding: 0.6rem 1rem;">
                                    </div>
                                </div>

                                <!-- Additional Information Section -->
                                <div class="col-12 mb-4 mt-2">
                                    <div class="d-flex align-items-center">
                                        <div
                                            style="width: 30px; height: 30px; background-color: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 10px;">
                                            <i class="fas fa-cog" style="color: #4f46e5;"></i>
                                        </div>
                                        <h5 class="fw-bold mb-0" style="color: #4b5563;">Additional Information</h5>
                                    </div>
                                    <hr class="mt-3 mb-4" style="border-color: #f3f4f6; opacity: 0.7;">
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-medium">Total Seats</label>
                                    <div class="input-group shadow-sm rounded overflow-hidden">
                                        <span class="input-group-text"
                                            style="background-color: #f9fafb; border-color: #e5e7eb;"><i
                                                class="fas fa-chair" style="color: #6b7280;"></i></span>
                                        <input type="number" name="available_seats" class="form-control"
                                            value="{{ $bus->available_seats }}" required
                                            style="border-color: #e5e7eb; padding: 0.6rem 1rem;">
                                    </div>
                                    <small class="text-muted mt-2 d-block"><i class="fas fa-info-circle me-1"></i> Total
                                        number of available seats</small>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-medium">Price</label>
                                    <div class="input-group shadow-sm rounded overflow-hidden">
                                        <span class="input-group-text"
                                            style="background-color: #f9fafb; border-color: #e5e7eb;"><i
                                                class="fas fa-dollar-sign" style="color: #6b7280;"></i></span>
                                        <input type="number" name="price" class="form-control"
                                            value="{{ $bus->price }}" required
                                            style="border-color: #e5e7eb; padding: 0.6rem 1rem;">
                                        <span class="input-group-text"
                                            style="background-color: #f9fafb; border-color: #e5e7eb;">NRs</span>
                                    </div>
                                    <small class="text-muted mt-2 d-block"><i class="fas fa-info-circle me-1"></i> Ticket
                                        price per passenger</small>
                                </div>
                                <div class="d-flex flex-column flex-sm-row justify-content-end gap-3 mt-4 pt-3"
                                    style="border-top: 1px solid #f3f4f6;">
                                    <a href="{{ route('admin.buses.index') }}"
                                        class="btn btn-light rounded-pill px-4 py-2 shadow-sm order-2 order-sm-1 w-100 w-sm-auto"
                                        style="font-weight: 500;">
                                        <i class="fas fa-times me-2"></i> Cancel
                                    </a>
                                    <button type="submit"
                                        class="btn rounded-pill px-5 py-2 shadow-sm order-1 order-sm-2 w-100 w-sm-auto"
                                        style="background-color: #4f46e5; color: white; font-weight: 500;">
                                        <i class="fas fa-save me-2"></i> Update Bus
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>

        <style>
            /* Custom styles for enhanced UI */
            body {
                background-color: #f9fafb;
                color: #1f2937;
            }

            .form-control:focus,
            .form-select:focus,
            .form-check-input:focus {
                box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
                border-color: #4f46e5 !important;
            }

            .btn:focus {
                box-shadow: 0 0 0 0.25rem rgba(79, 70, 229, 0.25);
            }

            .input-group-text {
                border-right: 0;
            }

            .input-group .form-control {
                border-left: 0;
            }

            .form-label {
                font-size: 0.875rem;
                margin-bottom: 0.5rem;
                color: #4b5563;
                font-weight: 500;
            }

            .btn {
                transition: all 0.2s ease;
                font-weight: 500;
            }

            .btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
            }

            .btn:active {
                transform: translateY(0);
            }

            .card {
                transition: all 0.3s ease;
            }

            .card:hover {
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
            }

            .text-muted {
                color: #6b7280 !important;
            }

            /* Animation for alerts */
            .alert {
                animation: slideIn 0.3s ease-out;
            }

            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Input focus animation */
            .input-group:focus-within {
                transform: translateY(-1px);
                transition: all 0.2s ease;
            }

            /* Form check styling */
            .form-check-input:checked {
                background-color: #4f46e5;
                border-color: #4f46e5;
            }

            .form-check-label {
                cursor: pointer;
                user-select: none;
            }

            /* Custom scrollbar */
            ::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }

            ::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            ::-webkit-scrollbar-thumb {
                background: #c5c5c5;
                border-radius: 4px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: #a8a8a8;
            }

            /* Responsive styles */
            @media (max-width: 767.98px) {
                .card-body {
                    padding: 1.25rem;
                }

                .btn {
                    padding: 0.5rem 1rem;
                }
            }
        </style>
    </x-app-layout>
@endsection