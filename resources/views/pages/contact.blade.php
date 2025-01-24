@extends('frontend.Master')
@section('content')
<!-- Contact and FAQ Section Side by Side -->
<div class="container mt-4">
    <div class="row">
        <!-- Contact Form Section -->
        <div class="col-md-6 contact-container" style="margin-top: 4rem;">
            <h2 class="contact-heading" style="color: rgb(147, 7, 231);">Contact Us</h2>
            
            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('contact.submit') }}">
            @csrf <!-- Add CSRF Token -->
                <div class="row mb-4">
                    <!-- Name -->
                    <div class="col-md-6 mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                    </div>
                    <!-- Email -->
                    <div class="col-md-6 mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                    </div>
                </div>
                <!-- Subject -->
                <div class="mb-4">
                    <input type="text" name="subject" class="form-control" placeholder="Subject" required>
                </div>
                <!-- Message -->
                <div class="mb-4">
                    <textarea rows="5" name="message" class="form-control" placeholder="Your Message" required></textarea>
                </div>
                <!-- Submit Button -->
                <div class="d-grid" style="justify-content: center;">
                    <style>
                        .submitbtn {
                            color: white;
                            background-color: rgb(147, 7, 231);
                            transition: transform 0.3s ease;
                        }

                        .submitbtn:hover {
                            color: white;
                            transform: translateY(-5px);
                            background-color: rgb(147, 7, 231);
                        }
                    </style>
                    <button type="submit" class="btn btn-contact submitbtn">Send Message</button>
                </div>
            </form>
        </div>

        <!-- FAQ Section -->
        <div class="col-md-6 faq-container" style="margin-top: 2.5rem; width: 40%;">
            <h3 class="faq-heading">Frequently Asked Questions</h3>
            <div class="accordion" id="faqAccordion">
                <!-- FAQ Item 1 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            1. How can I contact support?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            You can fill out the contact form or email us directly.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            2. What are your working hours?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            We are available from 9 AM to 6 PM, Monday to Friday.
                        </div>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            3. Where is your office located?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Our office is in Putalisadak, Kathmandu, Nepal.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
