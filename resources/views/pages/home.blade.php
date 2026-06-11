@extends('frontend.Master')
@section('content')

<!-- Hero Section -->
<div class="hero-section">
    <!-- Background Image -->
    <div class="hero-background" style="background-image: url('{{ asset('Photos/bg1.jpeg') }}');"></div>

    <!-- Content Overlay -->
    <div class="container text-white text-center hero-content">
        <div>
            <h1 class="hero-title">Welcome to ChittoBus</h1>
            <p class="hero-subtitle">Your reliable travel partner for bus bookings and charter services.</p>
        </div>

        <!-- ===== Search Bar ===== -->
        <div class="search-bar">
            <form action="{{ route('search.buses') }}" method="GET">
                {{-- Departure --}}
                <div class="form-group">
                    <label>From</label>
                    <input name="from"
                        list="city-list"
                        class="city-input"
                        placeholder="Start typing departure city…"
                        required>
                </div>

                {{-- Destination --}}
                <div class="form-group">
                    <label>To</label>
                    <input name="to"
                        list="city-list"
                        class="city-input"
                        placeholder="Start typing destination city…"
                        required>
                </div>

                {{-- Shared datalist for both fields --}}
                <datalist id="city-list">
                    @foreach($cities as $city)
                    <option value="{{ $city }}"></option>
                    @endforeach
                </datalist>

                {{-- Travel Date --}}
                <div class="form-group">
                    <label>Date</label>
                    <input type="date" name="date" required id="date">
                </div>

                <button type="submit">Find Buses</button>
            </form>
        </div>
    </div>
</div>

<!-- Services Section -->
<div class="services-section">
    <div class="container text-center">
        <h2 class="section-title">Our Services</h2>
        <p class="section-description">Explore the range of services we offer for a comfortable and safe journey.</p>

        <div class="row">
            <!-- Service 1 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="service-card">
                    <div class="icon-container">
                        <i class="fas fa-bus-alt fa-3x"></i>
                    </div>
                    <h4>Bus Rentals</h4>
                    <p>Reliable and affordable charter bus rental services for your group travel needs, with experienced drivers and well‑maintained vehicles.</p>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="service-card">
                    <div class="icon-container">
                        <i class="fas fa-ticket-alt fa-3x"></i>
                    </div>
                    <h4>Online Ticket Booking</h4>
                    <p>Conveniently book your tickets online from the comfort of your home with our secure and easy‑to‑use booking platform.</p>
                </div>
            </div>

            <!-- Service 3 -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="service-card">
                    <div class="icon-container">
                        <i class="fas fa-users fa-3x"></i>
                    </div>
                    <h4>Group Tours</h4>
                    <p>Join our organized group tours to explore beautiful destinations with ease, accompanied by knowledgeable guides and inclusive packages.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Testimonials Section -->
<div class="testimonials-section">
    <div class="container text-center">
        <h2 class="section-title">What Our Customers Say</h2>
        <p class="section-description">Here's what some of our satisfied customers have to say about their experience.</p>

        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-icon">
                        <i class="fa fa-quote-left"></i>
                    </div>
                    <p>"ChittoBus made our trip hassle-free and enjoyable. The driver was professional and the bus was comfortable. Highly recommend their services for anyone looking for reliable transportation!"</p>
                    <h5>Sarah L.</h5>
                    <p>Frequent Traveler</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-icon">
                        <i class="fa fa-quote-left"></i>
                    </div>
                    <p>"Easy booking process and excellent customer support. When our plans changed, they were very accommodating and helped us reschedule without any hassle. Great job, ChittoBus!"</p>
                    <h5>James T.</h5>
                    <p>Business Traveler</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="testimonial-card">
                    <div class="testimonial-icon">
                        <i class="fa fa-quote-left"></i>
                    </div>
                    <p>"The bus was clean, comfortable and arrived on time. The online booking system was straightforward and user‑friendly. Thank you for a smooth journey!"</p>
                    <h5>Maria K.</h5>
                    <p>Family Traveler</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="contact-section">
    <div class="container text-center">
        <h2>Contact Us</h2>
        <p>Have any questions? Reach out to us, and we'll be happy to assist you with your travel needs!</p>
        <a href="{{ route('contact') }}" class="contact-btn">Get in Touch</a>
    </div>
</div>

<script>
    // Set minimum date for date picker to today
    document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date').min = today;

        // If no date is selected, default to today
        if (!document.getElementById('date').value) {
            document.getElementById('date').value = today;
        }
    });
</script>

@endsection