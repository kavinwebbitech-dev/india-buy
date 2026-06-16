@include('frontend.layouts.header-link')


@include('frontend.layouts.top_bar')

@include('frontend.layouts.main_header')

@section('content')
    <!-- Page Header Section Start -->
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-3" data-cursor="-opaque">About us</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">home |</a></li>
                                <li class="breadcrumb-item active" aria-current="page">about us</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
   
    <div class="about-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5">
                    <!-- About Us Image Box Start -->
                    <div class="about-us-images wow fadeInUp">
                        <!-- About Us Image Box 1 Start -->
                        <div class="about-us-image-box-1">
                            <!-- About Us Image 1 Start -->
                            <div class="about-us-image">
                                <figure class="image-anime">
                                    <img src="{{ asset('asset/frontend/new/about-us-image-1.webp')}}" alt="">
                                </figure>
                            </div>
                            <!-- About Us Image 1 End -->
                        </div>
                        <!-- About Us Image Box 1 End -->

                        <!-- About Us Image Box 2 Start -->
                        <div class="about-us-image-box-2">
                            <!-- About Us Image Title Start -->
                            <div class="about-us-image-title">
                                <h2>Sherene</h2>
                            </div>
                            <!-- About Us Image Title End -->

                            <!-- About Us Image 2 Start -->
                            <div class="about-us-image">
                                <figure class="image-anime">
                                    <button type="button" id="open-popup" style="background:none; border:none; padding:0; cursor:zoom-in;">
                                        <img src="{{ asset('asset/frontend/new/certificate.webp')}}" alt="Certificate">
                                    </button>
                                </figure>
                            </div>

                            <dialog id="cert-popup" class="cert-modal">
                                <button id="close-popup" class="close-btn">&times;</button>
                                <img src="{{ asset('asset/frontend/new/certificate.webp')}}" alt="Certificate Large View">
                            </dialog>
                            <!-- About Us Image 2 End -->
                        </div>
                        <!-- About Us Image Box 2 Start -->
                    </div>
                    <!-- About Us Images End -->
                </div>

                <div class="col-xl-7">
                    <!-- About Us Content Start -->
                    <div class="about-us-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">About Us</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">
                                Premium uPVC & Aluminium Windows and Doors
                            </h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">
                                At Sherene uPVC Windows, we specialize in high-quality uPVC and aluminium windows and doors that combine durability, modern design, and superior performance. As an Authorized Dealer of Apollo Pipes Limited for Doors and Windows, we ensure certified quality products that enhance comfort, safety, and energy efficiency for homes and commercial spaces.
                            </p>
                        </div>
                        <!-- Section Title End -->

                        <!-- About Us Body Start -->
                        <div class="about-us-body">
                            <!-- About Us List Start -->
                            <div class="about-us-list wow fadeInUp" data-wow-delay="0.4s">
                                <ul>
                                    <li>We ensure every installation delivers strength, safety, elegant design, and certified quality assurance.</li>
                                    <li>We provide durable, energy-efficient window and door solutions backed by trusted industry standards.</li>
                                </ul>
                            </div>
                            <!-- About Us List End -->

                            <!-- About Us Item List Start -->
                            <div class="about-us-item-list wow fadeInUp" data-wow-delay="0.6s">
                                <!-- About Us Item Start -->
                                <div class="about-us-item">
                                    <div class="about-us-item-header">
                                        <div class="about-us-item-title">
                                            <h3>Our Mission</h3>
                                        </div>
                                        <div class="icon-box">
                                            <img src="{{ asset('asset/frontend/images/icon-about-item-1.svg')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="about-us-item-content">
                                        <p>
                                            Our mission is to deliver premium uPVC and aluminium windows and doors that combine strength, precision engineering, and modern aesthetics.
                                        </p>
                                        <ul>
                                            <li>To provide durable, energy-efficient, and secure solutions</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- About Us Item End -->

                                <!-- About Us Item Start -->
                                <div class="about-us-item">
                                    <div class="about-us-item-header">
                                        <div class="about-us-item-title">
                                            <h3>Our Vision</h3>
                                        </div>
                                        <div class="icon-box">
                                            <img src="{{asset('asset/frontend/images/icon-about-item-2.svg')}}" alt="">
                                        </div>
                                    </div>
                                    <div class="about-us-item-content">
                                        <p>
                                            Our vision is to become a trusted leader in uPVC and aluminium window and door solutions across residential and commercial spaces.
                                        </p>
                                        <ul>
                                            <li>To redefine modern living with quality, innovation, and reliability</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- About Us Item End -->
                            </div>

                            <!-- About Us Item List End -->
                        </div>
                        <!-- About Us Body End -->

                        <!-- About Us Footer Start -->
                        <div class="about-us-footer wow fadeInUp" data-wow-delay="0.8s">
                            <!-- About Us Button Start -->
                            <div class="about-us-btn">
                                <a href="{{ route('contact')}}" class="btn-default">Contact now</a>
                            </div>
                            <!-- About Us Button End -->

                            <!-- Section Footer Text Start -->
                            <div class="section-footer-text section-satisfy-img">
                                <!-- Satisfy Client Images Start -->
                                <div class="satisfy-client-images">
                                    <div class="satisfy-client-image">
                                        <!-- <figure class="image-anime">
                                            <img src="{{asset('asset/frontend/images/author-1.jpg')}}" alt="">
                                        </figure> -->
                                    </div>
                                    <div class="satisfy-client-image add-more">
                                        <img src="{{asset('asset/frontend/images/icon-phone-white.svg')}}" alt="">
                                    </div>
                                </div>
                                <!-- Satisfy Client Images End -->
                                <p>Let's make something great work together. <a href="{{ route('contact')}}">Get Free Quote</a></p>
                            </div>
                            <!-- Section Footer Text End -->
                        </div>
                        <!-- About Us Footer End -->
                    </div>
                    <!-- About Us Content End -->
                </div>
            </div>
        </div>
    </div>
   
    <div class="what-we-do">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">What We Do</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">
                            Premium uPVC & Aluminium Windows and Doors Solutions
                        </h2>
                    </div>
                    
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- What We Do Boxes Start -->
                    <div class="what-we-do-boxes">
                        <!-- What We Item List Start -->
                        <div class="what-we-item-list order-1">
                            <!-- What We Item Start -->
                            <div class="what-we-item wow fadeInUp">
                                <div class="icon-box">
                                    <img src="{{ asset('asset/frontend/new/window.svg')}}" alt="">
                                </div>
                                <div class="what-we-item-content">
                                    <h3>uPVC Windows & Doors</h3>
                                    <p>
                                        We manufacture and install high-quality uPVC windows and doors designed for durability, insulation, and modern aesthetics.
                                    </p>
                                    <ul>
                                        <li>Energy-efficient, sound-proof & low-maintenance solutions</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- What We Item End -->

                            <!-- What We Item Start -->
                            <div class="what-we-item wow fadeInUp" data-wow-delay="0.2s">
                                <div class="icon-box">
                                    <img src="{{ asset('asset/frontend/new/sketch.svg')}}" alt="">
                                </div>
                                <div class="what-we-item-content">
                                    <h3>Custom Design & Measurement</h3>
                                    <p>
                                        Every window and door is custom-designed to perfectly fit your space and architectural style.
                                    </p>
                                    <ul>
                                        <li>Precision measurement and tailored fabrication</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- What We Item End -->
                        </div>
                        <!-- What We Item List End -->

                        <!-- What We Image Box Start -->
                        <div class="what-we-image-box order-xl-2 order-3">
                            <!-- What We Image Box-1 Start -->
                            <div class="what-we-image-box-1">
                                <div class="what-we-image">
                                    <figure class="image-anime">
                                        <img src="{{ asset('asset/frontend/new/arch1.webp')}}" alt="">
                                    </figure>
                                </div>
                            </div>
                            <!-- What We Image Box-1 End -->

                            <!-- What We Image Box-2 Start -->
                            <div class="what-we-image-box-2">
                                <div class="contact-us-circle">
                                    <a href="{{ route('contact')}}">
                                        <img src="{{asset('asset/frontend/images/get-in-touch-circle-elite.svg')}}" alt="">
                                    </a>
                                </div>

                                <div class="what-we-image">
                                    <figure class="image-anime">
                                        <img src="{{ asset('asset/frontend/new/abt-2.webp')}}" alt="">
                                    </figure>
                                </div>
                            </div>
                            <!-- What We Image Box-2 End -->
                        </div>
                        <!-- What We Image Box End -->

                        <!-- What We Item List Start -->
                        <div class="what-we-item-list order-xl-3 order-2">
                            <!-- What We Item Start -->
                            <div class="what-we-item wow fadeInUp">
                                <div class="icon-box">
                                    <img src="{{ asset('asset/frontend/new/doors.svg')}}" alt="">
                                </div>
                                <div class="what-we-item-content">
                                    <h3>Aluminium Windows & Doors</h3>
                                    <p>
                                        Our aluminium systems offer sleek profiles, superior strength, and premium finishes for modern homes and projects.
                                    </p>
                                    <ul>
                                        <li>Strong, corrosion-resistant & elegant designs</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- What We Item End -->

                            <!-- What We Item Start -->
                            <div class="what-we-item wow fadeInUp" data-wow-delay="0.2s">
                                <div class="icon-box">
                                    <img src="{{ asset('asset/frontend/new/service.svg')}}" alt="">
                                </div>
                                <div class="what-we-item-content">
                                    <h3>End-to-End Installation & Support</h3>
                                    <p>
                                        From consultation to installation, we ensure a smooth, timely, and hassle-free experience.
                                    </p>
                                    <ul>
                                        <li>Professional installation with after-sales support</li>
                                    </ul>
                                </div>
                            </div>
                            <!-- What We Item End -->
                        </div>
                        <!-- What We Item List End -->
                    </div>
                    <!-- What We Do Boxes End -->
                </div>
            </div>
        </div>
    </div>

    <!-- What We Do Section End -->

    <!-- Why Choose Us Section Start -->
    <div class="why-choose-us">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6">
                    <!-- Why Choose Content Start -->
                    <div class="why-choose-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Why Choose Us</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">
                                Your Trusted Partner in uPVC & Aluminium Solutions
                            </h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">
                                At Sherene uPVC Windows, we guide you from consultation to installation with transparency, precision, and professional care—ensuring long-lasting performance and peace of mind.
                            </p>
                        </div>
                        <!-- Section Title End -->

                        <!-- Why Choose Items List Start -->
                        <div class="why-choose-items-list wow fadeInUp" data-wow-delay="0.4s">
                            <!-- Why Choose Item Start -->
                            <div class="why-choose-item">
                                <div class="icon-box">
                                    <img src="{{ asset('asset/frontend/new/high-quality.svg')}}" alt="">
                                </div>
                                <div class="why-choose-item-content">
                                    <h3>Proven Expertise & Quality</h3>
                                    <p>
                                        With decades of experience, Sherene delivers premium uPVC and aluminium windows and doors engineered for strength, insulation, safety, and modern aesthetics.
                                    </p>
                                </div>
                            </div>
                            <!-- Why Choose Item End -->
                        </div>
                        <!-- Why Choose Items List End -->

                        <!-- Why Choose Progress List Start -->
                        <div class="why-choose-progress-list">
                            <!-- Skills Progress Bar Start -->
                            <div class="skills-progress-bar">
                                <div class="skillbar" data-percent="95%">
                                    <div class="skill-data">
                                        <div class="skill-title">uPVC Windows & Doors</div>
                                        <div class="skill-no">95%</div>
                                    </div>
                                    <div class="skill-progress">
                                        <div class="count-bar"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Skills Progress Bar End -->

                            <!-- Skills Progress Bar Start -->
                            <div class="skills-progress-bar">
                                <div class="skillbar" data-percent="90%">
                                    <div class="skill-data">
                                        <div class="skill-title">Aluminium Windows & Doors</div>
                                        <div class="skill-no">90%</div>
                                    </div>
                                    <div class="skill-progress">
                                        <div class="count-bar"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Skills Progress Bar End -->
                        </div>
                        <!-- Why Choose Progress List End -->

                        <!-- Why Choose Button Start -->
                        <div class="why-choose-btn wow fadeInUp" data-wow-delay="0.6s">
                            <a href="{{ route('contact')}}" class="btn-default">Get in Touch</a>
                        </div>
                        <!-- Why Choose Button End -->
                    </div>
                    <!-- Why Choose Content End -->
                </div>

                <div class="col-xl-6">
                    <!-- Why Choose Image Box Start -->
                    <div class="why-choose-images wow fadeInUp" data-wow-delay="0.2s">
                        <!-- Why Choose Image Box 1 Start -->
                        <div class="why-choose-image-box-1">
                            <div class="contact-us-circle">
                                <a href="{{ route('contact')}}">
                                    <img src="{{asset('asset/frontend/images/get-in-touch-circle-elite.svg')}}" alt="">
                                </a>
                            </div>

                            <div class="why-choose-image">
                                <figure class="image-anime">
                                    <img src="{{ asset('asset/frontend/new/abt-3.webp')}}" alt="">
                                </figure>
                            </div>
                        </div>
                        <!-- Why Choose Image Box 1 End -->

                        <!-- Why Choose Image Box 2 Start -->
                        <div class="why-choose-image-box-2">
                            <div class="why-choose-image">
                                <figure class="image-anime">
                                    <img src="{{ asset('asset/frontend/new/ab-alu-dor.webp')}}" alt="">
                                </figure>
                            </div>

                            <!-- <div class="why-choose-counter-box">
                                <h2><span class="counter">2000</span>+</h2>
                                <h3>Successful Installations</h3>
                            </div> -->
                        </div>
                        <!-- Why Choose Image Box 2 End -->
                    </div>
                    <!-- Why Choose Image Box End -->
                </div>

                <div class="col-lg-12">
                    <!-- Section Footer Text Start -->
                    <div class="section-footer-text section-satisfy-img wow fadeInUp" data-wow-delay="0.8s">
                        <div class="satisfy-client-images">
                            <div class="satisfy-client-image">
                                <!-- <figure class="image-anime">
                                    <img src="{{asset('asset/frontend/images/author-1.jpg')}}" alt="">
                                </figure> -->
                            </div>
                            <div class="satisfy-client-image add-more">
                                <img src="{{asset('asset/frontend/images/icon-phone-white.svg')}}" alt="">
                            </div>
                        </div>
                        <p>
                            Let’s upgrade your space with premium windows & doors.
                            <a href="{{ route('contact')}}">Get Free Quote</a>
                        </p>
                    </div>
                    <!-- Section Footer Text End -->
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose Us Section End -->

    <!-- Our Features Section Start -->
    <div class="our-features">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-xl-7">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Our Features</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">
                            Engineering Durable, Stylish & High-Performance Windows
                        </h2>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="col-xl-5">
                    <!-- Feature Counter List Start -->
                    <div class="feature-counter-list wow fadeInUp" data-wow-delay="0.2s">
                        <!-- Feature Counter Item Start -->
                        <!-- <div class="feature-counter-item">
                            <h2><span class="counter">200000</span>+</h2>
                            <h3>Successful Installations</h3>
                        </div> -->
                        <div class="why-choose-counter-box m-0">
                            <h2><span class="counter">200000</span>+</h2>
                            <h3>Successful Installations</h3>
                        </div>
                        <!-- Feature Counter Item End -->

                        <!-- Feature Counter Item Start -->
                        <div class="feature-counter-item pt-3">
                            <h2><span class="counter">100</span>+</h2>
                            <h3>Locations Across Tamil Nadu</h3>
                        </div>
                        <!-- Feature Counter Item End -->
                    </div>
                    <!-- Feature Counter List End -->
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <!-- Feature Video Box Start -->
                    <div class="feature-video-box wow fadeInUp">
                        <!-- Feature Image Start -->
                        <div class="feature-image">
                            <figure>
                                <img src="{{ asset('asset/frontend/new/abt-5.webp')}}" alt="">
                            </figure>
                        </div>
                        <!-- Feature Image End -->

                        <!-- Watch Our Video Circle Start -->
                        <!-- <div class="watch-our-video-circle">
                            <a href="https://www.youtube.com/watch?v=Y-x0efG1seA" class="popup-video" data-cursor-text="Play">
                                <img src="{{asset('asset/frontend/images/watch-our-video-circle.svg')}}" alt="">
                            </a>
                        </div> -->
                        <!-- Watch Our Video Circle End -->
                    </div>
                    <!-- Feature Video Box End -->
                </div>

                <div class="col-xl-6">
                    <!-- Feature Item List Start -->
                    <div class="feature-item-list">
                        <!-- Feature Item Start -->
                        <div class="feature-item wow fadeInUp" data-wow-delay="0.2s">
                            <!-- Feature Item Header Start -->
                            <div class="feature-item-header">
                                <div class="icon-box">
                                    <img src="{{ asset('asset/frontend/new/window-new.svg')}}" alt="">
                                </div>

                                <div class="feature-item-content">
                                    <h3>Advanced uPVC & Aluminium Technology</h3>
                                    <p>Manufactured using Hi-UV formulation and premium-grade materials.</p>
                                </div>
                            </div>
                            <!-- Feature Item Header End -->

                            <!-- Feature Item Body Start -->
                            <div class="feature-item-body">
                                <ul>
                                    <li>Sound-proof, termite-proof & corrosion-resistant</li>
                                </ul>
                            </div>
                            <!-- Feature Item Body End -->
                        </div>
                        <!-- Feature Item End -->

                        <!-- Feature Item Start -->
                        <div class="feature-item wow fadeInUp" data-wow-delay="0.4s">
                            <!-- Feature Item Header Start -->
                            <div class="feature-item-header">
                                <div class="icon-box">
                                    <img src="{{ asset('asset/frontend/new/speedy.svg')}}" alt="">
                                </div>

                                <div class="feature-item-content">
                                    <h3>Precision Installation & Timely Delivery</h3>
                                    <p>Expert installation teams ensuring perfect fit and finish.</p>
                                </div>
                            </div>
                            <!-- Feature Item Header End -->

                            <!-- Feature Item Body Start -->
                            <div class="feature-item-body">
                                <ul>
                                    <li>Zero painting, low maintenance & long-lasting performance</li>
                                </ul>
                            </div>
                            <!-- Feature Item Body End -->
                        </div>
                        <!-- Feature Item End -->
                    </div>
                    <!-- Feature Item List End -->
                </div>

                <div class="col-lg-12">
                    <!-- Our Feature Footer Start -->
                    <div class="our-feature-footer wow fadeInUp" data-wow-delay="0.4s">
                        <!-- Our Feature Footer List Start -->
                        <div class="our-feature-footer-list">
                            <ul>
                                <li>Hi-UV Formulation</li>
                                <li>Superior Sound Insulation</li>
                                <li>Energy Efficient Systems</li>
                                <li>Internationally Certified Products</li>
                            </ul>
                        </div>
                        <!-- Our Feature Footer List End -->

                        <!-- Section Footer Text Start -->
                        <div class="section-footer-text section-satisfy-img">
                            <!-- Satisfy Client Images Start -->
                            <div class="satisfy-client-images">
                                <div class="satisfy-client-image">
                                    <!-- <figure class="image-anime">
                                        <img src="{{asset('asset/frontend/images/author-1.jpg')}}" alt="">
                                    </figure> -->
                                </div>
                                <div class="satisfy-client-image add-more">
                                    <img src="{{asset('asset/frontend/images/icon-phone-white.svg')}}" alt="">
                                </div>
                            </div>
                            <!-- Satisfy Client Images End -->
                            <p>
                                Let’s build better living spaces together.
                                <a href="{{ route('contact')}}">Get Free Consultation</a>
                            </p>
                        </div>
                        <!-- Section Footer Text End -->
                    </div>
                    <!-- Our Feature Footer End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Our Features Section End -->

    <!-- How It Works Section Start-->
    <div class="how-it-works">
        <div class="container">
            <div class="row section-row align-items-center">
                <div class="col-xl-6">
                    <!-- Section Title Start -->
                    <div class="section-title">
                        <h3 class="wow fadeInUp">Product Highlights</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">
                            Engineered for Superior Performance and Long-Term Value
                        </h2>
                    </div>
                    <!-- Section Title End -->
                </div>

                <div class="col-xl-6">
                    <!-- Section Content Button Start -->
                    <div class="section-content-btn">
                        <!-- Section Title Content Start -->
                        <div class="section-title-content wow fadeInUp" data-wow-delay="0.2s">
                            <p>
                                Our uPVC windows and doors are engineered for superior performance and long-term value.
                            </p>
                        </div>
                        <!-- Section Title Content End -->

                        <!-- Section Button Start -->
                        <div class="section-btn wow fadeInUp" data-wow-delay="0.4s">
                            <a href="{{ route('contact')}}" class="btn-default">Contact Us</a>
                        </div>
                        <!-- Section Button End -->
                    </div>
                    <!-- Section Content Button End -->
                </div>
            </div>

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="how-works-item wow fadeInUp">
                        <div class="icon-box">
                            <img src="{{ asset('asset/frontend/new/durable-fabric.svg')}}" alt="">
                        </div>
                        <div class="how-works-item-body">
                            <div class="how-works-item-content">
                                <h3>Durability & Design</h3>
                                <p>Built to last with elegant and modern designs.</p>
                                <ul>
                                    <li>Sturdy and long-lasting build</li>
                                    <li>Elegant and modern designs</li>
                                </ul>
                            </div>
                            <div class="how-works-item-no">
                                <h2>01</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="how-works-item wow fadeInUp" data-wow-delay="0.2s">
                        <div class="icon-box">
                            <img src="{{ asset('asset/frontend/new/property-maintenance.svg')}}" alt="">
                        </div>
                        <div class="how-works-item-body">
                            <div class="how-works-item-content">
                                <h3>Low Maintenance</h3>
                                <p>Designed for effortless care and long-term finish.</p>
                                <ul>
                                    <li>Hi-UV formulation</li>
                                    <li>Low maintenance and zero painting</li>
                                </ul>
                            </div>
                            <div class="how-works-item-no">
                                <h2>02</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="how-works-item wow fadeInUp" data-wow-delay="0.4s">
                        <div class="icon-box">
                            <img src="{{ asset('asset/frontend/new/home.svg')}}" alt="">
                        </div>
                        <div class="how-works-item-body">
                            <div class="how-works-item-content">
                                <h3>Comfort & Protection</h3>
                                <p>Enhanced comfort with advanced safety features.</p>
                                <ul>
                                    <li>Superior sound insulation</li>
                                    <li>Enhanced safety and security</li>
                                </ul>
                            </div>
                            <div class="how-works-item-no">
                                <h2>03</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="how-works-item wow fadeInUp" data-wow-delay="0.6s">
                        <div class="icon-box">
                            <img src="{{ asset('asset/frontend/new/search-engine-optimization.svg')}}" alt="">
                        </div>
                        <div class="how-works-item-body">
                            <div class="how-works-item-content">
                                <h3>Advanced Engineering</h3>
                                <p>Engineered for maximum resistance and efficiency.</p>
                                <ul>
                                    <li>Sound-proof and termite-proof</li>
                                    <li>High UV resistance</li>
                                    <li>Maintenance-free finish</li>
                                    <li>Advanced double drainage system</li>
                                </ul>
                            </div>
                            <div class="how-works-item-no">
                                <h2>04</h2>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="section-footer-text section-satisfy-img wow fadeInUp" data-wow-delay="0.4s">
                        <div class="satisfy-client-images">
                            <div class="satisfy-client-image">
                                <!-- <figure class="image-anime">
                                    <img src="{{asset('asset/frontend/images/author-1.jpg')}}" alt="">
                                </figure> -->
                            </div>
                            <div class="satisfy-client-image add-more">
                                <img src="{{asset('asset/frontend/images/icon-phone-white.svg')}}" alt="">
                            </div>
                        </div>
                        <p>
                            Let’s upgrade your home with premium windows & doors.
                            <a href="{{ route('contact')}}">Get Free Consultation</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section End-->

    <!-- CTA Box Section Start -->
    <div class="cta-box dark-section parallaxie">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6">
                    <!-- CTA Box Content Start -->
                    <div class="cta-box-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Contact Sherene uPVC Today!</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">
                                Connect With Our uPVC Experts Instantly
                            </h2>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">
                                Planning a new build, renovating your space, or looking for premium uPVC windows and doors? Our team is ready to provide expert guidance and solutions for your home or commercial project.
                            </p>
                        </div>
                        <!-- Section Title End -->

                        <!-- CTA Button Start -->
                        <div class="cta-btn wow fadeInUp" data-wow-delay="0.4s">
                            <a href="{{ route('contact')}}" class="btn-default">Contact Us</a>
                        </div>
                        <!-- CTA Button End -->
                    </div>
                    <!-- CTA Box Content End -->
                </div>

                <div class="col-xl-6">
                    <!-- CTA Client Box Start -->
                    <div class="cta-client-box wow fadeInUp" data-wow-delay="0.6s">
                        <h3>Trusted Excellence in uPVC Windows & Doors</h3>

                        <!-- Satisfy Client Images Start -->
                        <!-- <div class="satisfy-client-images">
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="{{asset('asset/frontend/images/author-1.jpg')}}" alt="uPVC Windows">
                                </figure>
                            </div>
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="{{asset('asset/frontend/images/author-2.jpg')}}" alt="uPVC Doors">
                                </figure>
                            </div>
                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="{{asset('asset/frontend/images/author-3.jpg')}}" alt="Sliding Windows">
                                </figure>
                            </div>

                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="{{asset('asset/frontend/images/author-4.jpg')}}" alt="Casement Windows">
                                </figure>
                            </div>

                            <div class="satisfy-client-image">
                                <figure class="image-anime">
                                    <img src="{{asset('asset/frontend/images/author-5.jpg')}}" alt="Aluminium Doors">
                                </figure>
                            </div>
                        </div> -->
                        <!-- Satisfy Client Images End -->

                        <p>Experience durable, elegant, and maintenance-free uPVC solutions trusted by over <strong>2,00,000+ happy clients</strong> across Tamil Nadu.</p>
                    </div>
                    <!-- CTA Client Box End -->
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- CTA Item List Start -->
                    <div class="cta-item-list">
                        <!-- CTA Item Start -->
                        <div class="cta-item wow fadeInUp">
                            <div class="icon-box">
                                <img src="{{asset('asset/frontend/images/icon-cta-1.svg')}}" alt="">
                            </div>
                            <div class="cta-item-content">
                                <h3>Prompt and Dedicated Support for Every uPVC Inquiry</h3>
                            </div>
                        </div>
                        <!-- CTA Item End -->

                        <!-- CTA Item Start -->
                        <div class="cta-item wow fadeInUp" data-wow-delay="0.2s">
                            <div class="icon-box">
                                <img src="{{asset('asset/frontend/images/icon-cta-2.svg')}}" alt="">
                            </div>
                            <div class="cta-item-content">
                                <h3>Expert Consultation to Choose the Perfect Windows & Doors</h3>
                            </div>
                        </div>
                        <!-- CTA Item End -->

                        <!-- CTA Item Start -->
                        <div class="cta-item wow fadeInUp" data-wow-delay="0.4s">
                            <div class="icon-box">
                                <img src="{{asset('asset/frontend/images/icon-cta-3.svg')}}" alt="">
                            </div>
                            <div class="cta-item-content">
                                <h3>Seamless Guidance Through Your Entire Installation Journey</h3>
                            </div>
                        </div>
                        <!-- CTA Item End -->
                    </div>
                    <!-- CTA Item List End -->
                </div>
            </div>
        </div>
    </div>

    

    <!-- Our Faqs Section Start -->
    <div class="our-faqs">
        <div class="container">
            <div class="row">
                <div class="col-xl-5">
                    <!-- Faqs Content Start -->
                    <div class="faqs-content">
                        <!-- Section Title Start -->
                        <div class="section-title">
                            <h3 class="wow fadeInUp">Frequently Asked Questions</h3>
                            <h2 class="text-anime-style-3" data-cursor="-opaque">
                                Common Questions About uPVC & Aluminium Windows and Doors
                            </h2>
                        </div>
                        <!-- Section Title End -->

                        <!-- Contact Us Circle Start -->
                        <div class="contact-us-circle wow fadeInUp" data-wow-delay="0.2s">
                            <a href="{{ route('contact')}}">
                                <img src="{{asset('asset/frontend/images/get-in-touch-circle-elite.svg')}}" alt="">
                            </a>
                        </div>
                        <!-- Contact Us Circle End -->
                    </div>
                    <!-- Faqs Content End -->
                </div>

                <div class="col-xl-7">
                    <!-- FAQ Accordion Start -->
                    <div class="faq-accordion" id="faqaccordion">
                        <!-- FAQ Item Start -->
                        <div class="accordion-item wow fadeInUp">
                            <h2 class="accordion-header" id="heading1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    Q1. What is the difference between uPVC and aluminium windows?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse show" role="region" aria-labelledby="heading1" data-bs-parent="#faqaccordion">
                                <div class="accordion-body">
                                    <p>uPVC windows offer excellent insulation, low maintenance, and cost efficiency, while aluminium windows provide a sleek look, high strength, and slim profiles ideal for modern architecture.</p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item End -->

                        <!-- FAQ Item Start -->
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.2s">
                            <h2 class="accordion-header" id="heading2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    Q2. Are uPVC and aluminium windows weather-resistant?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" role="region" aria-labelledby="heading2" data-bs-parent="#faqaccordion">
                                <div class="accordion-body">
                                    <p>Yes. Both uPVC and aluminium windows are designed to withstand harsh sunlight, rain, and humidity, making them suitable for Indian climate conditions.</p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item End -->

                        <!-- FAQ Item Start -->
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.4s">
                            <h2 class="accordion-header" id="heading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    Q3. Do these windows help in noise reduction?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" role="region" aria-labelledby="heading3" data-bs-parent="#faqaccordion">
                                <div class="accordion-body">
                                    <p>Yes. When paired with appropriate glazing, uPVC and aluminium windows provide superior sound insulation, significantly reducing external noise.</p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item End -->

                        <!-- FAQ Item Start -->
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.6s">
                            <h2 class="accordion-header" id="heading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    Q4. Do uPVC and aluminium windows require painting or polishing?
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" role="region" aria-labelledby="heading4" data-bs-parent="#faqaccordion">
                                <div class="accordion-body">
                                    <p>No. uPVC windows are completely maintenance-free, and aluminium windows come with durable powder-coated finishes that do not require repainting.</p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item End -->

                        <!-- FAQ Item Start -->
                        <div class="accordion-item wow fadeInUp" data-wow-delay="0.8s">
                            <h2 class="accordion-header" id="heading5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    Q5. Do you provide complete installation and after-sales service?
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" role="region" aria-labelledby="heading5" data-bs-parent="#faqaccordion">
                                <div class="accordion-body">
                                    <p>Yes. We handle everything from site measurement and manufacturing to professional installation and dependable after-sales support.</p>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item End -->
                    </div>
                    <!-- FAQ Accordion End -->
                </div>

                <div class="col-lg-12">
                    <!-- Faqs Counter List Start -->
                    <div class="faqs-counter-list wow fadeInUp" data-wow-delay="0.2s">
                        <!-- Faqs Counter Item Start -->
                        <div class="faqs-counter-item">
                            <h2><span class="counter">20</span>+</h2>
                            <p>Years of Experience</p>
                        </div>
                        <!-- Faqs Counter Item End -->

                        <!-- Faqs Counter Item Start -->
                        <div class="faqs-counter-item">
                            <h2><span class="counter">200000</span>+</h2>
                            <p>Windows & Doors Installed</p>
                        </div>
                        <!-- Faqs Counter Item End -->

                        <!-- Faqs Counter Item Start -->
                        <div class="faqs-counter-item">
                            <h2><span class="counter">12500</span>+</h2>
                            <p>Satisfied Customers</p>
                        </div>
                        <!-- Faqs Counter Item End -->

                        <!-- Faqs Counter Item Start -->
                        <div class="faqs-counter-item">
                            <h2><span class="counter">99</span>%</h2>
                            <p>Customer Satisfaction</p>
                        </div>
                        <!-- Faqs Counter Item End -->

                        <!-- Faqs Counter Item Start -->
                        <div class="faqs-counter-item">
                            <h2><span class="counter">10</span>+</h2>
                            <p>Authorized Channel Partners</p>
                        </div>
                        <!-- Faqs Counter Item End -->
                    </div>
                    <!-- Faqs Counter List End -->
                </div>
            </div>
        </div>
    </div>

    <!-- Our Faqs Section End -->

    <!-- Our Testimonials Section Start -->
    <div class="our-testimonials">
        <div class="container">
            <div class="row section-row">
                <div class="col-lg-12">
                    <!-- Section Title Start -->
                    <div class="section-title section-title-center">
                        <h3 class="wow fadeInUp">Our Testimonials</h3>
                        <h2 class="text-anime-style-3" data-cursor="-opaque">
                            Trusted by Homeowners & Businesses Across Tamil Nadu
                        </h2>
                    </div>
                    <!-- Section Title End -->
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <!-- Testimonial Image Box Start -->
                    <div class="testimonial-image-box wow fadeInUp">
                        <!-- Testimonial Image Start -->
                        <div class="testimonial-image">
                            <figure class="image-anime">
                                <img src="{{ asset('asset/frontend/new/testi-img.webp')}}" alt="">
                            </figure>
                        </div>
                        <!-- Testimonial Image End -->

                        <!-- Testimonial Client Box Start -->
                        <div class="testimonial-client-box">

                            <div class="testimonial-client-box-content">
                                <h3>Happy Customers Across Tamil Nadu</h3>
                            </div>
                        </div>
                        <!-- Testimonial Client Box End -->
                    </div>
                    <!-- Testimonial Image Box End -->
                </div>

                <div class="col-xl-8 col-md-6">
                    <!-- Testimonial Slider Start -->
                    <div class="testimonial-slider wow fadeInUp" data-wow-delay="0.2s">
                        <div class="swiper">
                            <div class="swiper-wrapper" data-cursor-text="Drag">

                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="testimonial-item-header">
                                            <div class="testimonial-item-quote">
                                                <img src="{{asset('asset/frontend/images/testimonial-item-quote.svg')}}" alt="">
                                            </div>
                                        </div>
                                        <div class="testimonial-item-body">
                                            <div class="testimonial-item-content">
                                                <p>
                                                    “ We installed uPVC windows in our home and the quality is excellent.
                                                    Noise reduction and smooth operation made a big difference. ”
                                                </p>
                                            </div>
                                            <div class="testimonial-author-content">
                                                <h3>K. Suresh Kumar</h3>
                                                <p>Homeowner</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial Slide End -->

                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="testimonial-item-header">
                                            <!-- <div class="testimonial-item-logo">
                                                <img src="{{asset('asset/frontend/images/testimonial-company-logo-2.svg')}}" alt="">
                                            </div> -->
                                            <div class="testimonial-item-quote">
                                                <img src="{{asset('asset/frontend/images/testimonial-item-quote.svg')}}" alt="">
                                            </div>
                                        </div>
                                        <div class="testimonial-item-body">
                                            <div class="testimonial-item-content">
                                                <p>
                                                    “ Aluminium sliding doors were installed in our office.
                                                    Premium finish, strong build, and timely installation. ”
                                                </p>
                                            </div>
                                            <div class="testimonial-author-content">
                                                <h3>R. Manikandan</h3>
                                                <p>Business Owner</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial Slide End -->

                                <!-- Testimonial Slide Start -->
                                <div class="swiper-slide">
                                    <div class="testimonial-item">
                                        <div class="testimonial-item-header">
                                            <div class="testimonial-item-quote">
                                                <img src="{{asset('asset/frontend/images/testimonial-item-quote.svg')}}" alt="">
                                            </div>
                                        </div>
                                        <div class="testimonial-item-body">
                                            <div class="testimonial-item-content">
                                                <p>
                                                    “ Professional team with great attention to detail.
                                                    The windows are secure, weatherproof, and maintenance-free. ”
                                                </p>
                                            </div>
                                            <div class="testimonial-author-content">
                                                <h3>S. Lakshmi Narayanan</h3>
                                                <p>Homeowner</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial Slide End -->

                            </div>
                        </div>
                    </div>
                    <!-- Testimonial Slider End -->
                </div>

                <div class="col-lg-12">
                    <!-- Section Footer Text Start -->
                    <div class="section-footer-text section-satisfy-img wow fadeInUp" data-wow-delay="0.4s">
                        <div class="satisfy-client-images">
                            <div class="satisfy-client-image">
                            </div>
                            <div class="satisfy-client-image add-more">
                                <i><img src="{{asset('asset/frontend/images/icon-phone-white.svg')}}" alt=""></i>
                            </div>
                        </div>
                        <p>
                            Upgrade your home with premium uPVC & aluminium windows and doors –
                            <a href="{{ route('contact')}}">Contact Sherene Today</a>
                        </p>
                    </div>
                    <!-- Section Footer Text End -->
                </div>
            </div>
        </div>
    </div>

    <!-- Our Testimonials Section End -->

    <script>
        const modal = document.querySelector("#cert-popup");
        const openBtn = document.querySelector("#open-popup");
        const closeBtn = document.querySelector("#close-popup");

        // Open popup
        openBtn.addEventListener("click", () => {
            modal.showModal(); // Standard method for dialogs
        });

        // Close popup
        closeBtn.addEventListener("click", () => {
            modal.close();
        });

        // Close if clicking outside the image (on the backdrop)
        modal.addEventListener("click", (e) => {
            if (e.target === modal) modal.close();
        });
    </script>
@endsection