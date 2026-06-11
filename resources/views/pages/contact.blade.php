@extends('frontend.Master')
@section('content')

<!-- Contact and FAQ Section Side by Side -->
<div class="container mt-5">
    <div class="row g-4" style="margin-top: 5rem;">
        <!-- Section Title -->
        <div class="col-12 text-center mb-4">
            <h1 class="section-title">Get In Touch</h1>
            <div class="section-divider"></div>
            <p class="section-subtitle">We're here to help with any questions you might have</p>
        </div>

        <!-- Contact Form Section -->
        <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="contact-container">
                <div class="contact-header">
                    <div class="contact-icon">
                        <i class="bi bi-envelope-paper-fill"></i>
                    </div>
                    <h2 class="contact-heading">Contact Us</h2>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form method="POST" action="{{ route('contact.submit') }}" class="contact-form">
                    @csrf
                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control" id="floatingName" placeholder="Your Name" required>
                                <label for="floatingName"><i class="bi bi-person-fill me-2"></i>Your Name</label>
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="Your Email" required>
                                <label for="floatingEmail"><i class="bi bi-envelope-fill me-2"></i>Your Email</label>
                            </div>
                        </div>
                    </div>
                    <!-- Subject -->
                    <div class="mb-3">
                        <div class="form-floating">
                            <input type="text" name="subject" class="form-control" id="floatingSubject" placeholder="Subject" required>
                            <label for="floatingSubject"><i class="bi bi-chat-square-text-fill me-2"></i>Subject</label>
                        </div>
                    </div>
                    <!-- Message -->
                    <div class="mb-4">
                        <div class="form-floating">
                            <textarea rows="5" name="message" class="form-control" id="floatingMessage" placeholder="Your Message" style="height: 150px" required></textarea>
                            <label for="floatingMessage"><i class="bi bi-pencil-square me-2"></i>Your Message</label>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg submitbtn" style="color: white;">
                            <span>Send Message</span>
                            <i class="bi bi-send-fill ms-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="col-lg-6">
            <div class="faq-container">
                <div class="faq-header">
                    <div class="faq-icon">
                        <i class="bi bi-question-circle-fill"></i>
                    </div>
                    <h3 class="faq-heading">Frequently Asked Questions</h3>
                </div>

                <div class="accordion" id="faqAccordion">
                    <!-- FAQ Item 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <i class="bi bi-chat-dots-fill me-2"></i>How can I contact support?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>You can reach our support team through multiple channels:</p>
                                <ul>
                                    <li>Fill out the contact form on this page</li>
                                    <li>Email us directly at <strong>info@chittobus.com</strong></li>
                                    <li>Call our customer service at <strong>+977 9811111111</strong></li>
                                </ul>
                                <p>We aim to respond to all inquiries within 24 hours.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <i class="bi bi-clock-fill me-2"></i>What are your working hours?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Our office hours are:</p>
                                <ul>
                                    <li><strong>Sunday to Friday:</strong> 9:00 AM - 6:00 PM</li>
                                    <li><strong>Saturday:</strong> Closed</li>
                                </ul>
                                <p>Our online booking system is available 24/7 for your convenience.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <i class="bi bi-geo-alt-fill me-2"></i>Where is your office located?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>Our main office is located at:</p>
                                <address class="mb-3">
                                    <strong>ChittoBus Headquarters</strong><br>
                                    Koteshwor, Kathmandu<br>
                                    Nepal<br>
                                </address>
                                <p>We're conveniently located near major transportation hubs and landmarks.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 4 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <i class="bi bi-credit-card-fill me-2"></i>What payment methods do you accept?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                <p>We accept various payment methods for your convenience:</p>
                                <ul>
                                    <li>eSewa, Khalti</li>
                                    <li>Bank transfers</li>
                                    <li>Cash payments at our office</li>
                                </ul>
                                <p>All online transactions are secure and encrypted.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="additional-contact mt-4">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="contact-info-card">
                                <i class="bi bi-telephone-fill"></i>
                                <h5>Call Us</h5>
                                <p>+977 9811111111</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="contact-info-card">
                                <i class="bi bi-envelope-fill"></i>
                                <h5>Email Us</h5>
                                <p>info@chittobus.com</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection