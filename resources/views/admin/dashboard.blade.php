<x-app-layout>
    <main id="main" class="main py-4">

        <div class="pagetitle mb-4">
            <h1 class="fw-bold">Dashboard</h1>
        </div>

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row g-4">

                        <!-- Number of Buses Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-semibold text-secondary mb-4">Number of Buses</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary-subtle p-3 me-3">
                                            <i class="bi bi-bus-front text-primary fs-4"></i>
                                        </div>
                                        <div class="ps-2">
                                            <h6 class="fs-2 fw-bold mb-0">{{ $numBuses }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Number of Users Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-semibold text-secondary mb-4">Number of Users</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success-subtle p-3 me-3">
                                            <i class="bi bi-person text-success fs-4"></i>
                                        </div>
                                        <div class="ps-2">
                                            <h6 class="fs-2 fw-bold mb-0">{{ $numUsers }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Number of Cities Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                                <div class="card-body p-4">
                                    <h5 class="card-title fw-semibold text-secondary mb-4">Number of Cities</h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-info-subtle p-3 me-3">
                                            <i class="bi bi-geo-alt text-info fs-4"></i>
                                        </div>
                                        <div class="ps-2">
                                            <h6 class="fs-2 fw-bold mb-0">{{ $numCities }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>

    </main>

    <style>
        /* Custom CSS for enhanced UI */
        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
        }

        .card-icon {
            width: 64px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Bootstrap 5 utility classes that might be missing */
        .bg-primary-subtle {
            background-color: rgba(13, 110, 253, 0.1);
        }

        .bg-success-subtle {
            background-color: rgba(25, 135, 84, 0.1);
        }

        .bg-info-subtle {
            background-color: rgba(13, 202, 240, 0.1);
        }

        .text-primary {
            color: #0d6efd;
        }

        .text-success {
            color: #198754;
        }

        .text-info {
            color: #0dcaf0;
        }

        .rounded-4 {
            border-radius: 0.75rem;
        }

        .fs-4 {
            font-size: 1.5rem;
        }

        .fs-2 {
            font-size: 2rem;
        }
    </style>
</x-app-layout>