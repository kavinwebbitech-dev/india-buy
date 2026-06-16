@extends('frontend.layouts.app')
@section('content')
    <!-- Page Header Section Start -->
    <section class="ux-hero-banner-area">
        <div class="ux-hero-overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header-box">
                        <h1 class="text-anime-style-3" data-cursor="-opaque">Contact Us</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">home |</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Page Header Section End -->

    <!-- Page Contact Us Start -->
    <div class="page-contact-us">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <!-- Content Us Box Start -->
                    <div class="contact-us-box">
                        <!-- Content Us Box Content Start -->
                        <div class="contact-us-box-content wow fadeInUp">
                            <h3>Get In Touch</h3>
                            <p>We'd love to hear from you! Whether you have questions, need a consultation, or want to discuss a new project.</p>
                        </div>
                        <!-- Content Us Box Content End -->

                        <!-- Contact Info List Start -->
                        <div class="contact-info-list">
                            <!-- Contact Info Item Start  -->
                            <div class="contact-info-item wow fadeInUp" data-wow-delay="0.2s">
                                <div class="icon-box">
                                    <img src="{{ asset('asset/frontend/images/icon-phone-accent.svg')}}" alt="">
                                </div>
                                <div class="contact-info-item-content">
                                    <h3>Phone Number</h3>
                                    <p><a href="tel:+91 98405 64600">+(91) 98405 64600</a></p>
                                </div>
                            </div>
                            <!-- Contact Info Item End  -->

                            <!-- Contact Info Item Start  -->
                            <div class="contact-info-item wow fadeInUp" data-wow-delay="0.4s">
                                <div class="icon-box">
                                    <img src="{{ asset('asset/frontend/images/icon-mail-accent.svg')}}" alt="">
                                </div>
                                <div class="contact-info-item-content">
                                    <h3>Email Address</h3>
                                    <p><a href="mailto:sureshkumar@sherenewindows.com">sureshkumar@sherenewindows.com</a></p>
                                </div>
                            </div>
                            <!-- Contact Info Item End  -->

                            <!-- Contact Info Item Start  -->
                            <div class="contact-info-item wow fadeInUp" data-wow-delay="0.6s">
                                <div class="icon-box">
                                    <img src="{{ asset('asset/frontend/images/icon-location-accent.svg')}}" alt="">
                                </div>
                                <div class="contact-info-item-content">
                                    <h3>Our Location</h3>
                                    <p>Sherene uPVC Windows
                                        No.10, Samuvel Nagar, Vadaperumbakkam,
                                        Chennai - 600 060</p>
                                </div>
                            </div>
                            <!-- Contact Info Item End  -->
                        </div>
                        <!-- Contact Info List End -->
                    </div>
                    <!-- Content Us Box End -->
                </div>

                <div class="col-xl-7">
                    <!-- Contact Us Form Start -->
                    <div class="contact-us-form">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Get In Touch</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">Send Us A Message</h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">Have a question, project idea, or design inquiry? We'd love to hear from you! Whether you're looking for expert advice, a consultation, or just want to explore design possibilities.</p>
                        </div>
                        <!-- Section Title End -->

                        <!-- Contact Form Start -->
                        <div class="contact-form">
                            <form id="contactForm" action="{{ route('contact.store')}}" method="POST" class="wow fadeInUp" data-wow-delay="0.4s">
                                @csrf
                                <div class="row">
                                    <div id="alertContainer" class="mt-3"></div>
                                    <div class="form-group col-md-6 mb-4">
                                        <label class="form-label">First Name *</label>
                                        <input type="text" name="fname" class="form-control" id="fname" placeholder="Enter Your First Name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="form-label">Last Name *</label>
                                        <input type="text" name="lname" class="form-control" id="lname" placeholder="Enter Your Last Name" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="form-label">Phone Number *</label>
                                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter Your Phone Number" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-6 mb-4">
                                        <label class="form-label">Email Address *</label>
                                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter Your Email Address" required>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group col-md-12 mb-5">
                                        <label class="form-label">Message</label>
                                        <textarea name="message" class="form-control" id="message" rows="10" placeholder="Any Additional Message...."></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="contact-form-btn">
                                            <button type="submit" class="btn-default submit_btn"><span>Submit Message</span></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Contact Form End -->
                    </div>
                    <!-- Contact Us Form End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Contact Us End -->

    <!-- Google Map Start -->
    <div class="google-map">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Our Location</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">Experience Our Design Studio Crafted for Creativity</h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Google Map Start -->
                    <div class="google-map-iframe wow fadeInUp" data-wow-delay="0.2s">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3884.836874648154!2d80.218384!3d13.1726832!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a527b3070140f59%3A0xe7089598b30686ec!2sSherene%20uPVC%20Windows!5e0!3m2!1sen!2sin!4v1771838582667!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <!-- Google Map End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Google Map End -->
@endsection
@push('scripts')
    <!-- 1. jQuery FIRST -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- 2. jQuery Validation Plugin (REQUIRED for .validate()) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- 3. Optional: Additional methods (phone, etc.) -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/additional-methods.min.js"></script>
    <script>
        $(document).ready(function () {

            $("#contactForm").validate({
                rules: {
                    fname: {
                        required: true,
                        minlength: 2
                    },
                    lname: {
                        required: true,
                        minlength: 1
                    },
                    phone: {
                        required: true,
                        digits: true,
                        minlength: 10,
                        maxlength: 15
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    message: {
                        maxlength: 500
                    }
                },
                messages: {
                    fname: {
                        required: "First name is required",
                        minlength: "First name must be at least 2 characters"
                    },
                    lname: {
                        required: "Last name is required",
                        minlength: "Last name must be at least 1 characters"
                    },
                    phone: {
                        required: "Phone number is required",
                        digits: "Only numbers are allowed",
                        minlength: "Phone number must be at least 10 digits",
                        maxlength: "Phone number must not exceed 15 digits"
                    },
                    email: {
                        required: "Email address is required",
                        email: "Enter a valid email address"
                    },
                    message: {
                        maxlength: "Message cannot exceed 500 characters"
                    }
                },
                errorElement: "span",
                errorClass: "text-danger",
                highlight: function (element) {
                    $(element).addClass("is-invalid");
                },
                unhighlight: function (element) {
                    $(element).removeClass("is-invalid");
                },
                submitHandler: function (form) {

                    var btn = $(".submit_btn");

                    btn.prop("disabled", true);
                    btn.find("span").text("Submitting...");

                    $.ajax({
                        url: "{{ route('contact.store') }}",
                        type: "POST",
                        data: $(form).serialize(),
                        success: function (response) {

                            // Bootstrap Success Alert
                            $('#alertContainer').html(`
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Message submitted successfully!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            `);

                            form.reset();
                        },
                        error: function () {

                            // Bootstrap Error Alert
                            $('#alertContainer').html(`
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Something went wrong! Please try again.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            `);
                        },
                        complete: function () {
                            btn.prop("disabled", false);
                            btn.find("span").text("Submit Message");

                            // Auto close after 5 seconds
                            setTimeout(function () {
                                let alert = document.querySelector('#alertContainer .alert');
                                if (alert) {
                                    let bsAlert = new bootstrap.Alert(alert);
                                    bsAlert.close();
                                }
                            }, 5000);
                        }
                    });

                    return false;
                }
            });

        });
    </script>
@endpush