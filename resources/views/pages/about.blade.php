@extends('frontend.Master')
@section('content')
<section id="about-us" class="py-5 bg-light">
    <style>
        .counter-section i {
            display: block;
            margin: 0 0 10px;
            font-size: 50px; /* Increased icon size */
        }

        .counter-section span.counter {
            font-size: 40px;
            color: #000;
            line-height: 60px;
            display: block;
            font-family: "Oswald", sans-serif;
            letter-spacing: 2px;
        }

        .counter-title {
            font-size: 14px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .container {
            margin-top: 4rem;
        }

        .counter-section {
            margin-bottom: 30px; /* Space between counters */
        }

        /* Center the entire counter section */
        .counter-container {
            text-align: center;
        }
    </style>
    <div class="container" style="margin-top: 2.3rem;">
        <div class="row align-items-center">
            <!-- Image Section -->
            <div class="col-md-6">
                <img src="{{asset('Photos/about.png')}}" alt="About Us Image" class="img-fluid rounded">
            </div>

            <!-- Text Section -->
            <div class="col-md-6">
                <h2 class="mb-4">About Us</h2>
                <p class="lead">
                    Welcome to ChittoBus, your trusted travel companion. We are committed to providing safe, reliable, and comfortable journeys to our valued passengers.
                </p>
                <p>
                    Our mission is to connect people and places with excellence, offering top-notch service that ensures your satisfaction. Whether you're traveling for work or leisure, ChittoBus is here to make your journey seamless and enjoyable.
                </p>
            </div>
        </div>
    </div>
    <section>
        <div class="container counter-container">
            <div class="row justify-content-center">
                <!-- counter -->
                <div class="col-md-3 col-sm-6 text-center counter-section">
                    <i class="fa fa-calendar-check medium-icon" style="color: rgb(147,7,231);"></i> <!-- Changed icon -->
                    <span class="counter" data-to="4" >0</span>
                    <p class="counter-title">Years of Experience</p>
                </div>
                <!-- counter -->
                <div class="col-md-3 col-sm-6 text-center counter-section">
                    <i class="fa fa-users medium-icon" style="color: rgb(147,7,231);"></i> <!-- Changed icon -->
                    <span class="counter" data-to="1000">0</span>
                    <p class="counter-title">Happy Clients</p>
                </div>
                <!-- counter -->
                <div class="col-md-3 col-sm-6 text-center counter-section">
                    <i class="fa fa-handshake medium-icon" style="color: rgb(147,7,231);"></i> <!-- Changed icon -->
                    <span class="counter" data-to="1200">0</span>
                    <span class="counter-title">Clients Served</span>
                </div>
            </div>
        </div>
    </section>
</section>

@endsection
