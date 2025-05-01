@extends('admin.layout')

@section('content')
<x-app-layout>
    <main id="main" class="main py-3 py-md-5">
        <div class="container-fluid px-3 px-md-4">
            <div class="d-flex flex-column flex-md-row justify
-content-between align-items-start align-items-md-center gap-3 mb-4">
                <h2 class="fw-bold fs-3 fs-md-2" style="color: #4f46e5;">
                    <i class="fas fa-bus me-2"></i> Manage Buses
                </h2>

                <!-- Add Bus Button -->
                <a href="{{ route('admin.buses.create') }}" class="btn px-3 px-md-4 py-2 shadow-sm w-100 w-md-auto"
                   style="background-color: #4f46e5; color: white; border-radius: 8px; font-weight: 500;">
                    <i class="fas fa-plus me-2"></i> Add New Bus
                </a>
            </div>

            <!-- Success Message -->
            @if(session('success'))
            <div class="alert alert-dismissible fade show mb-4 border-0" role="alert"
                 style="background-color: #f0fdf4; color: #166534; border-left: 4px solid #22c55e; animation: slideIn 0.3s ease-out;">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card border-0 shadow-sm mb-4" style="border-radius: 12px; overflow: hidden;">
                <div class="card-header bg-white p-3 p-md-4 border-0">
                    <!-- Search Form -->
                    <form action="{{ route('admin.buses.index') }}" method="GET">
                        <div class="input-group">
                            <span class="input-group-text border-end-0" style="background-color: #f9fafb; border-top-left-radius: 8px; border-bottom-left-radius: 8px;">
                                <i class="fas fa-search" style="color: #6b7280;"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0 ps-0"
                                placeholder="Search bus by name, route..." value="{{ request('search') }}"
                                style="background-color: #f9fafb; border-color: #e5e7eb;">
                            <button type="submit" class="btn d-none d-sm-block px-4"
                                    style="background-color: #4f46e5; color: white; border-top-right-radius: 8px; border-bottom-right-radius: 8px;">
                                Search
                            </button>
                            <button type="submit" class="btn d-block d-sm-none px-3"
                                    style="background-color: #4f46e5; color: white; border-top-right-radius: 8px; border-bottom-right-radius: 8px;">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-body p-0">
                    <!-- Buses Table -->
                    <div class="table-responsive">
                        <table class="table align-middle mb-0" style="--bs-table-hover-bg: rgba(79, 70, 229, 0.03);">
                            <thead style="background-color: #f9fafb;">
                                <tr>
                                    <th class="fw-semibold ps-3 ps-md-4" style="color: #4b5563; font-size: 0.875rem;">#</th>
                                    <th class="fw-semibold" style="color: #4b5563; font-size: 0.875rem;">Bus Name</th>
                                    <th class="fw-semibold" style="color: #4b5563; font-size: 0.875rem;">Route</th>
                                    <th class="fw-semibold d-none d-md-table-cell" style="color: #4b5563; font-size: 0.875rem;">Departure</th>
                                    <th class="fw-semibold d-none d-md-table-cell" style="color: #4b5563; font-size: 0.875rem;">Arrival</th>
                                    <th class="fw-semibold d-none d-lg-table-cell" style="color: #4b5563; font-size: 0.875rem;">Seats</th>
                                    <th class="fw-semibold d-none d-lg-table-cell" style="color: #4b5563; font-size: 0.875rem;">Type</th>
                                    <th class="fw-semibold" style="color: #4b5563; font-size: 0.875rem;">Price</th>
                                    <th class="fw-semibold text-end pe-3 pe-md-4" style="color: #4b5563; font-size: 0.875rem;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($buses as $bus)
                                <tr class="border-bottom" style="border-color: #f3f4f6;">
                                    <td class="py-3 ps-3 ps-md-4">{{ $loop->iteration }}</td>
                                    <td class="py-3" style="font-weight: 500;">{{ $bus->bus_name }}</td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center">
                                            <span class="d-inline-block text-truncate" style="max-width: 100px;">{{ $bus->from_location }}</span>
                                            <i class="fas fa-arrow-right mx-2 text-muted"></i>
                                            <span class="d-inline-block text-truncate" style="max-width: 100px;">{{ $bus->to_location }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 d-none d-md-table-cell">
                                        <div>{{ \Carbon\Carbon::parse($bus->departure_date)->format('M d, Y') }}</div>
                                        <div class="text-muted" style="font-size: 0.875rem;">{{ \Carbon\Carbon::parse($bus->departure_time)->format('h:i A') }}</div>
                                    </td>
                                    <td class="py-3 d-none d-md-table-cell">
                                        <div>{{ \Carbon\Carbon::parse($bus->arrival_date)->format('M d, Y') }}</div>
                                        <div class="text-muted" style="font-size: 0.875rem;">{{ \Carbon\Carbon::parse($bus->arrival_time)->format('h:i A') }}</div>
                                    </td>
                                    <td class="py-3 d-none d-lg-table-cell">
                                        <span class="badge bg-light text-dark border" style="font-weight: 500;">{{ $bus->available_seats }}</span>
                                    </td>
                                    <td class="py-3 d-none d-lg-table-cell">
                                        <span class="badge" style="background-color: #f3f4f6; color: #4b5563;">{{ $bus->bus_type }}</span>
                                    </td>
                                    <td class="py-3">
                                        <span class="fw-semibold" style="color: #4f46e5;">{{ $bus->price }}</span>
                                    </td>
                                    <td class="py-3 text-end pe-3 pe-md-4">
                                        <div class="d-flex flex-column flex-sm-row gap-2 justify-content-end">
                                            <!-- Edit Button -->
                                            <a href="{{ route('admin.buses.edit', $bus->id) }}" class="btn btn-sm"
                                               style="border: 1.5px solid #4f46e5; color: #4f46e5; background-color: transparent; border-radius: 6px; font-weight: 500; padding: 0.375rem 1rem;">
                                                <i class="fas fa-edit me-1"></i> <span class="d-none d-sm-inline">Edit</span>
                                            </a>

                                            <!-- Delete Button with Confirmation -->
                                            <form action="{{ route('admin.buses.destroy', $bus->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm delete-btn w-100"
                                                        data-id="{{ $bus->id }}"
                                                        style="border: 1.5px solid #ef4444; color: #ef4444; background-color: transparent; border-radius: 6px; font-weight: 500; padding: 0.375rem 1rem;">
                                                    <i class="fas fa-trash-alt me-1"></i> <span class="d-none d-sm-inline">Delete</span>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5" style="color: #6b7280;">
                                        <div style="padding: 2rem 0;">
                                            <div style="width: 60px; height: 60px; margin: 0 auto 1rem; background-color: #f3f4f6; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-bus fs-3" style="color: #9ca3af;"></i>
                                            </div>
                                            <p class="mb-3" style="font-size: 1.125rem; font-weight: 500;">No buses found</p>
                                            <p class="mb-4" style="font-size: 0.875rem;">Add your first bus to get started</p>
                                            <a href="{{ route('admin.buses.create') }}" class="btn btn-sm"
                                               style="background-color: #4f46e5; color: white; border-radius: 6px; font-weight: 500; padding: 0.5rem 1.5rem;">
                                                <i class="fas fa-plus me-2"></i> Add Bus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination if it exists -->
                    <div class="p-3 p-md-4">
                        {{ $buses->links() }}
                    </div>
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

        .btn {
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .btn:active {
            transform: translateY(0);
        }

        .card {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
            border-color: #4f46e5;
        }

        .input-group .form-control:focus {
            border-color: #e5e7eb;
            box-shadow: none;
        }

        .table thead th {
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .table tbody tr {
            transition: background-color 0.15s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(79, 70, 229, 0.03);
        }

        /* Animation for alerts */
        .alert {
            animation: slideIn 0.3s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-8px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Custom pagination styling */
        .pagination {
            gap: 0.25rem;
            flex-wrap: wrap;
        }

        .page-item .page-link {
            border-radius: 6px;
            color: #4b5563;
            border-color: #e5e7eb;
        }

        .page-item.active .page-link {
            background-color: #4f46e5;
            border-color: #4f46e5;
        }

        /* Focus styles */
        a:focus, button:focus, input:focus {
            outline: 2px solid rgba(79, 70, 229, 0.5);
            outline-offset: 2px;
        }

        /* Responsive styles */
        @media (max-width: 767.98px) {
            .table {
                font-size: 0.9rem;
            }

            .card-header {
                padding: 1rem;
            }

            .btn {
                padding-left: 0.75rem;
                padding-right: 0.75rem;
            }
        }

        @media (max-width: 575.98px) {
            .d-flex.flex-column.flex-sm-row {
                width: 100%;
            }

            form.d-inline {
                display: block !important;
                width: 100%;
                margin-top: 0.5rem;
            }
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function () {
                    if (confirm('Are you sure you want to delete this bus?')) {
                        this.closest('form').submit();
                    }
                });
            });
        });
    </script>
</x-app-layout>
@endsection