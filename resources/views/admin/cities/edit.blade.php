@extends('admin.layout')

@section('content')
<x-app-layout>
    <main id="main" class="main py-4">
        <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fw-bold text-primary">
                    <i class="fas fa-city me-2"></i> Edit City
                </h1>

                <a href="{{ route('admin.cities.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                    <i class="fas fa-arrow-left me-2"></i> Back to Cities
                </a>
            </div>


            @if ($errors->any())
            <div class="alert alert-danger border-0 shadow-sm mb-4" style="border-left: 4px solid #dc3545 !important; background-color: #fff1f2;">
                <h5 class="alert-heading fw-bold mb-2"><i class="fas fa-exclamation-circle me-2"></i>Please fix the following errors:</h5>
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card border-0 shadow-sm rounded-3 mb-4">
                <div class="card-header bg-light py-3 px-4 border-0">
                    <h5 class="card-title mb-0 text-secondary">
                        <i class="fas fa-edit me-2"></i> City Information
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.cities.update', $city->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="cityName" class="form-label fw-medium">City Name</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="fas fa-map-marker-alt"></i></span>
                                <input
                                    type="text"
                                    id="cityName"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $city->name) }}"
                                    placeholder="Enter city name"
                                    required
                                >
                            </div>
                            @error('name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted mt-2">
                                <i class="fas fa-info-circle me-1"></i> The city name should be unique and properly capitalized.
                            </small>
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('admin.cities.index') }}" class="btn btn-light rounded-pill px-4">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-5">
                                <i class="fas fa-save me-2"></i> Update City
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <style>
        /* Custom styles for enhanced UI */
        .form-control:focus, .btn:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
            border-color: #86b7fe;
        }

        .input-group-text {
            border-right: 0;
        }

        .input-group .form-control {
            border-left: 0;
        }

        .input-group .form-control:focus {
            border-color: #ced4da;
            box-shadow: none;
        }

        .form-label {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
            color: #495057;
        }

        .btn {
            transition: all 0.3s;
            font-weight: 500;
        }

        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card {
            transition: all 0.3s;
        }

        .card:hover {
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1) !important;
        }

        .fw-medium {
            font-weight: 500;
        }

        .text-primary {
            color: #0d6efd !important;
        }

        .text-secondary {
            color: #6c757d !important;
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

        /* Card header styling */
        .card-header {
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
    </style>
</x-app-layout>
@endsection