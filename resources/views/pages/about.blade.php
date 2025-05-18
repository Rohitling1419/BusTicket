@extends('frontend.Master')
@section('content')
<section id="about-us" class="py-5">
    
    <div class="container about-container" style="margin-top: 5rem;">
        <div class="row align-items-center">
            <!-- Image Section -->
            <div class="col-lg-6 col-md-12 img-section">
                <div class="img-wrapper">
                    <img src="{{ asset('Photos/about.png') }}" alt="About Us Image" class="img-fluid">
                </div>
            </div>

            <!-- Text Section -->
            <div class="col-lg-6 col-md-12 text-section">
                <h2 class="about-heading">About Us</h2>
                <p class="lead">
                    Welcome to ChittoBus, your trusted travel companion. We are committed to providing safe, reliable, and comfortable journeys to our valued passengers.
                </p>
                <p class="about-text">
                    Our mission is to connect people and places with excellence, offering top-notch service that ensures your satisfaction. Whether you're traveling for work or leisure, ChittoBus is here to make your journey seamless and enjoyable.
                </p>
            </div>
        </div>
    </div>

    <div class="container counter-container">
        <div class="counter-row row justify-content-center">
            <!-- Counter 1 -->
            <div class="col-lg-4 col-md-4 col-sm-12 text-center counter-section">
                <div class="counter-icon">
                    <i class="fa fa-calendar-check"></i>
                </div>
                <span class="counter" data-to="4">0</span>
                <p class="counter-title">Years of Experience</p>
            </div>
            <!-- Counter 2 -->
            <div class="col-lg-4 col-md-4 col-sm-12 text-center counter-section">
                <div class="counter-icon">
                    <i class="fa fa-users"></i>
                </div>
                <span class="counter" data-to="1000">0</span>
                <p class="counter-title">Happy Clients</p>
            </div>
            <!-- Counter 3 -->
            <div class="col-lg-4 col-md-4 col-sm-12 text-center counter-section">
                <div class="counter-icon">
                    <i class="fa fa-handshake"></i>
                </div>
                <span class="counter" data-to="1200">0</span>
                <p class="counter-title">Clients Served</p>
            </div>
        </div>
    </div>
</section>
<style>
        #about-us {
            background: linear-gradient(135deg, #f5f7fa 0%, #e8edf5 100%);
            padding: 100px 0;
            position: relative;
            overflow: hidden;
            margin-top: 50px;
        }
        
        #about-us::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(147, 7, 231, 0.1);
            z-index: 0;
        }
        
        #about-us::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(147, 7, 231, 0.05);
            z-index: 0;
        }
        
        .about-container {
            position: relative;
            z-index: 1;
        }
        
        .about-heading {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            background: linear-gradient(90deg, #8e2de2, #4a00e0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }
        
        .lead {
            font-size: 1.35rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            color: #444;
            line-height: 1.6;
        }
        
        .about-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #555;
        }
        
        .img-wrapper {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            transform: perspective(1000px) rotateY(-5deg);
            transition: all 0.5s ease;
        }
        
        .img-wrapper:hover {
            transform: perspective(1000px) rotateY(0deg);
        }
        
        .img-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(147, 7, 231, 0.2) 0%, rgba(0, 0, 0, 0) 100%);
            z-index: 1;
        }
        
        .img-fluid {
            transition: transform 0.7s ease;
            width: 100%;
        }
        
        .img-wrapper:hover .img-fluid {
            transform: scale(1.05);
        }
        
        .counter-container {
            margin-top: 6rem;
            position: relative;
        }
        
        .counter-row {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 40px 20px;
            position: relative;
            overflow: hidden;
        }
        
        .counter-row::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #8e2de2, #4a00e0);
        }
        
        .counter-section {
            position: relative;
            padding: 20px;
            transition: all 0.3s ease;
        }
        
        .counter-section:hover {
            transform: translateY(-10px);
        }
        
        .counter-section::after {
            content: '';
            position: absolute;
            top: 50%;
            right: 0;
            height: 50px;
            width: 1px;
            background: #eee;
            transform: translateY(-50%);
        }
        
        .counter-section:last-child::after {
            display: none;
        }
        
        .counter-icon {
            display: inline-block;
            width: 80px;
            height: 80px;
            line-height: 80px;
            text-align: center;
            border-radius: 50%;
            background: linear-gradient(135deg, #f5f7fa 0%, #e8edf5 100%);
            margin-bottom: 20px;
            box-shadow: 0 10px 20px rgba(147, 7, 231, 0.1);
        }
        
        .counter-section i {
            font-size: 35px;
            color: #8e2de2;
            line-height: 80px;
        }
        
        .counter-section span.counter {
            font-size: 48px;
            font-weight: 700;
            background: linear-gradient(90deg, #8e2de2, #4a00e0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            line-height: 1.2;
            margin-bottom: 10px;
            display: block;
            font-family: "Poppins", sans-serif;
        }
        
        .counter-title {
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #555;
            font-weight: 600;
        }
        
        @media (max-width: 991px) {
            .counter-section::after {
                display: none;
            }
            
            .counter-section {
                margin-bottom: 30px;
            }
            
            .about-heading {
                font-size: 2.5rem;
            }
        }
        
        @media (max-width: 768px) {
            .about-heading {
                font-size: 2.2rem;
                text-align: center;
            }
            
            .text-section {
                text-align: center;
                margin-top: 3rem;
                order: 2;
            }
            
            .img-section {
                order: 1;
                margin-bottom: 2rem;
            }
            
            .counter-icon {
                width: 70px;
                height: 70px;
                line-height: 70px;
            }
            
            .counter-section i {
                font-size: 30px;
                line-height: 70px;
            }
        }
    </style>
@endsection