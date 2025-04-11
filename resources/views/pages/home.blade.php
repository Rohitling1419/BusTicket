@extends('frontend.Master')
@section('content')
<style>
.search-bar {
  max-width: 800px;
  margin: 1rem auto;
  padding: 1.5rem;
  background-color: rgba(255, 255, 255, 0.9);
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.search-bar form {
  display: flex;
  flex-direction: row;
  align-items: flex-end;
  flex-wrap: wrap;
  gap: 1rem;
}

.search-bar label {
  display: block;
  font-weight: 600;
  margin-bottom: 0.5rem;
  color: #333;
}

.search-bar select,
.search-bar input[type="date"] {
  flex: 1;
  min-width: 150px;
  padding: 0.75rem;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 1rem;
  transition: border-color 0.3s;
}

.search-bar select:focus,
.search-bar input[type="date"]:focus {
  border-color: orange;
  outline: none;
  box-shadow: 0 0 0 2px rgba(255, 165, 0, 0.2);
}

.search-bar button {
  background-color: orange;
  color: black;
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 4px;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.2s;
  height: 45px;
  align-self: flex-end;
}

.search-bar button:hover {
  background-color: #ffa500;
  transform: translateY(-2px);
}

.search-bar button:active {
  transform: translateY(0);
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .search-bar form {
    flex-direction: column;
    align-items: stretch;
  }
  
  .search-bar select,
  .search-bar input[type="date"] {
    width: 100%;
    margin-bottom: 1rem;
  }
  
  .search-bar button {
    width: 100%;
    margin-top: 0.5rem;
  }
}
    </style>
<!-- Hero Section -->
<div class="hero-section position-relative" style="height: 100vh; overflow: hidden;">
    <!-- Background Image -->
    <div class="hero-background" style="background-image: url('{{ asset('Photos/bg1.jpeg') }}'); background-size: cover; background-position: center; height: 100%; position: absolute; top: 0; left: 0; width: 100%; z-index: 1; filter: brightness(0.6); ">
    </div>

    <!-- Content Overlay -->
    <div class="container position-relative text-white text-center d-flex flex-column justify-content-center align-items-center" style="z-index: 2; height: 100%;">
        <div style="margin-top:-50px ;">
            <h1 class="hero-title display-4 fw-bold">Welcome to ChittoBus</h1>
            <p class="hero-subtitle lead">Your reliable travel partner for bus bookings and charter services.</p>
        </div>

        <div class="search-bar mt-4 w-100">
    <form action="{{ route('search.buses') }}" method="GET">
        <div>
            <label>From</label>
            <select name="from" required>
                <option value="" disabled selected>Select departure city</option>
                @foreach($cities as $City)
                <option value="{{ $City }}">{{ $City }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>To</label>
            <select name="to" required>
                <option value="" disabled selected>Select destination city</option>
                @foreach($cities as $City)
                <option value="{{ $City }}">{{ $City }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Date</label>
            <input type="date" name="date" required id="date">

        </div>

        <button type="submit">Search</button>
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