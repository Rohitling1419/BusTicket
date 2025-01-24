@extends('frontend.Master')
@section('content')

<!-- Hero Section -->
<div class="hero-section position-relative" style="height: 100vh; overflow: hidden;">
    <!-- Background Image -->
    <div class="hero-background" style="background-image: url('{{ asset('Photos/bg1.jpeg') }}'); background-size: cover; background-position: center; height: 100%; position: absolute; top: 0; left: 0; width: 100%; z-index: 1; filter: brightness(0.6); ">
    </div>

    <!-- Content Overlay -->
    <div class="container position-relative text-white text-center d-flex flex-column justify-content-center align-items-center" style="z-index: 2; height: 100%;">
        <div style="margin-top:-50px ;">
            <h1 class="hero-title display-4 fw-bold" >Welcome to ChittoBus</h1>
            <p class="hero-subtitle lead">Your reliable travel partner for bus bookings and charter services.</p>
        </div>

        <div class="search-bar mt-4 w-100">
            <form>
                <div class="row justify-content-center g-2">
                    <!-- From Input -->
                    <div class="col-md-3 col-sm-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="From" style="height: 2.9rem;" />
                        </div>
                    </div>

                    <!-- To Input -->
                    <div class="col-md-3 col-sm-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fas fa-location-arrow"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="To" style="height: 2.9rem;" />
                        </div>
                    </div>

                    <!-- Date Input -->
                    <div class="col-md-3 col-sm-6">
                        <div class="input-group">
                            <span class="input-group-text bg-light">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                            <input type="date" class="form-control" style="height: 2.9rem;" />
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="col-md-2 col-sm-6">
                        <button type="submit" class="w-75 btns-search" style="line-height: 1.4rem; border-radius:8px;">
                            <i class="fas fa-search"></i> Search
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </div>
</div>

<!-- Services Section -->
<div class="services-section py-5" style="background-color: #f9f9f9;">
    <div class="container text-center">
        <h2 class="section-title mb-3">Our Services</h2>
        <p class="section-description mb-5">Explore the range of services we offer for a comfortable and safe journey.</p>
        <div class="row mt-4">
            <!-- Service 1 -->
            <div class="col-md-4">
                <div class="service-card p-4 bg-white rounded shadow-sm">
                    <div class="icon-container mb-3">
                        <i class="fas fa-bus-alt fa-3x" style="color:rgb(147,7,231);"></i>
                    </div>
                    <h4 class="mt-2">Bus Rentals</h4>
                    <p class="mt-2">Reliable and affordable charter bus rental services for your group travel needs.</p>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="col-md-4">
                <div class="service-card p-4 bg-white rounded shadow-sm">
                    <div class="icon-container mb-3">
                        <i class="fas fa-ticket-alt fa-3x" style="color:rgb(147,7,231);"></i>
                    </div>
                    <h4 class="mt-2">Online Ticket Booking</h4>
                    <p class="mt-2">Conveniently book your tickets online from the comfort of your home.</p>
                </div>
            </div>

            <!-- Service 3 -->
            <div class="col-md-4">
                <div class="service-card p-4 bg-white rounded shadow-sm">
                    <div class="icon-container mb-3">
                        <i class="fas fa-users fa-3x" style="color:rgb(147,7,231);"></i>
                    </div>
                    <h4 class="mt-2">Group Tours</h4>
                    <p class="mt-2">Join our organized group tours to explore beautiful destinations with ease.</p>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- Testimonials Section -->
<div class="testimonials-section py-5">
    <div class="container text-center">
        <h2>What Our Customers Say</h2>
        <p>Here's what some of our satisfied customers have to say about their experience.</p>
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="testimonial-card">
                    <div class="testimonial-icon">
                        <i class="fa fa-quote-left"></i>
                    </div>
                    <p>"ChittoBus made our trip hassle-free and enjoyable. Highly recommend their services!"</p>
                    <h5>- Sarah L.</h5>
                    <p>Customer</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <div class="testimonial-icon">
                        <i class="fa fa-quote-left"></i>
                    </div>
                    <p>"Easy booking process and excellent customer support. Great job, ChittoBus!"</p>
                    <h5>- James T.</h5>
                    <p>Customer</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial-card">
                    <div class="testimonial-icon">
                        <i class="fa fa-quote-left"></i>
                    </div>
                    <p>"The bus was clean and comfortable. Thank you for a smooth journey!"</p>
                    <h5>- Maria K.</h5>
                    <p>Customer</p>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Contact Section -->
<div class="contact-section py-5 bg-dark text-white">
    <div class="container text-center">
        <h2>Contact Us</h2>
        <p>Have any questions? Reach out to us, and we'll be happy to assist you!</p>
        <a href="{{ route('contact') }}" class="btn btn-light">Get in Touch</a>
    </div>
</div>

@endsection