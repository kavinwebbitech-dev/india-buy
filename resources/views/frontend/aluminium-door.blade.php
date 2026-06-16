@extends('frontend.layouts.app')
@section('content')
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header-box">
                        <h1 class="text-anime-style-3" data-cursor="-opaque">Aluminium Doors</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">home |</a></li>
                                <li class="breadcrumb-item"><a href="{{route('gallery')}}">Doors |</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Aluminium Doors</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="page-project-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="page-single-sidebar">
                        <div class="page-category-list wow fadeInUp">
                            <h3>Explore Our Services</h3>
                            <ul>
                                <li><a href="{{ route('upvc.window')}}">uPVC Windows</a></li>
                                <li><a href="{{ route('upvc.door')}}">uPVC Doors</a></li>
                                <li><a href="{{ route('aluminium.window')}}">Aluminium Windows</a></li>
                                <li><a href="{{ route('aluminium.door')}}">Aluminium Doors</a></li>
                            </ul>
                        </div>

                        <div class="sidebar-cta-box wow fadeInUp" data-wow-delay="0.25s">
                            <div class="icon-box">
                                <img src="{{ asset('asset/frontend/images/icon-phone-white.svg')}}" alt="">
                            </div>

                            <div class="sidebar-cta-content">
                                <h3>Contact Us Now!</h3>
                                <p>Have a project in mind or need expert advice on uPVC doors?</p>
                                <h4>Call At: <a href="tel:+91 98405 64600">+91 98405 64600</a></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="project-single-content">
                        <div class="page-single-image">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('asset/frontend/new/alu-dor.webp')}}" alt="Sherene uPVC Doors">
                            </figure>
                        </div>

                        <div class="project-entry">
                            <p class="wow fadeInUp">
                                Sherene Aluminium Doors are trusted across Tamil Nadu for their strength, security, and modern elegance. With over 2,00,000 installations, our doors are designed to enhance contemporary homes and commercial spaces while delivering superior structural performance.
                            </p>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">
                                Our aluminium doors offer smooth operation, high strength, weather resistance, and low maintenance, making them ideal for both residential and commercial projects.
                            </p>

                            <div class="project-overview-box">
                                <h2 class="text-anime-style-3">Aluminium Doors Overview</h2>
                                <p class="wow fadeInUp">
                                    Sherene provides premium aluminium doors engineered for structural strength, security, sound insulation, and long-lasting durability. Each door system combines sleek modern design with high-performance functionality.
                                </p>

                                <div class="project-overview-body">
                                    <div class="project-overview-image">
                                        <figure class="image-anime reveal">
                                            <img src="{{ asset('asset/frontend/new/alu-door.webp')}}" alt="Premium uPVC Doors">
                                        </figure>
                                    </div>

                                    <div class="project-overview-item-box wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="project-overview-item">
                                            <div class="icon-box">
                                                <img src="{{ asset('asset/frontend/images/icon-project-overview-1.svg')}}" alt="">
                                            </div>
                                            <div class="project-overview-item-content">
                                                <h3>Premium Aluminium Doors</h3>
                                                <p>
                                                    Precision Door Systems

                                                    Designed for smooth operation, enhanced safety, and long-term performance, our aluminium doors ensure peace of mind and architectural excellence.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="project-overview-list-contact-box">
                                            <div class="project-overview-list">
                                                <ul>
                                                    <li>Aluminium Sliding Doors</li>
                                                    <li>Aluminium Bi-Fold (Fold & Slide) Doors</li>
                                                    <li>Aluminium Casement (Swing) Doors</li>
                                                    <li>Aluminium Lift & Slide Doors</li>
                                                    <li>Aluminium Slim Frame Minimal Series</li>
                                                    <li>Aluminium Combination Doors</li>
                                                </ul>
                                            </div>

                                            <div class="contact-us-circle">
                                                <a href="{{ route('contact')}}">
                                                    <img src="{{ asset('asset/frontend/images/get-in-touch-circle-elite.svg')}}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <p class="wow fadeInUp" data-wow-delay="0.4s">
                                    Every aluminium door is installed with precision to ensure maximum strength, weather resistance, noise reduction, and effortless performance.
                                </p>
                            </div>

                            <div class="row">
                                <div class="col-xl-4 col-md-6 my-4">
                                    <div class="project-item wow fadeInUp">
                                        <div class="project-item-image">
                                            <a href="javascript:void(0)" data-cursor-text="view">
                                                <figure class="image-anime">
                                                    <img src="{{ asset('asset/frontend/new/alu-dor-slide.webp')}}" alt="Two-panel Sliding Door">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="project-item-content">
                                            <h3><a class="text-white" href="javascript:void(0)">Aluminium Sliding Door</a></h3>
                                            <ul>
                                                <li>Residential Installation</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 my-4">
                                    <div class="project-item wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="project-item-image">
                                            <a href="javascript:void(0)" data-cursor-text="view">
                                                <figure class="image-anime">
                                                    <img src="{{ asset('asset/frontend/new/alu-bf-dor.webp')}}" alt="Three-panel Sliding Door">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="project-item-content">
                                            <h3><a class="text-white" href="javascript:void(0)">Aluminium Fold & Slide (Bi-Fold) Doors</a></h3>
                                            <ul>
                                                <li>Homes & Apartments</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 my-4">
                                    <div class="project-item wow fadeInUp" data-wow-delay="0.4s">
                                        <div class="project-item-image">
                                            <a href="javascript:void(0)" data-cursor-text="view">
                                                <figure class="image-anime">
                                                    <img src="{{ asset('asset/frontend/new/cas-alu-dor.webp')}}" alt="Four-panel Sliding Door">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="project-item-content">
                                            <h3><a class="text-white" href="javascript:void(0)">Aluminium Casement (Swing) Doors</a></h3>
                                            <ul>
                                                <li>Premium Residences</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 my-4">
                                    <div class="project-item wow fadeInUp" data-wow-delay="0.6s">
                                        <div class="project-item-image">
                                            <a href="javascript:void(0)" data-cursor-text="view">
                                                <figure class="image-anime">
                                                    <img src="{{ asset('asset/frontend/new/alu-lif-dor.webp')}}" alt="Sliding Door with Bug Mesh">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="project-item-content">
                                            <h3><a class="text-white" href="javascript:void(0)">Aluminium Lift & Slide Doors</a></h3>
                                            <ul>
                                                <li>Ventilated Living Spaces</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 my-4">
                                    <div class="project-item wow fadeInUp" data-wow-delay="0.8s">
                                        <div class="project-item-image">
                                            <a href="javascript:void(0)" data-cursor-text="view">
                                                <figure class="image-anime">
                                                    <img src="{{ asset('asset/frontend/new/alu-slm-dr.webp')}}" alt="Casement Door">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="project-item-content">
                                            <h3><a class="text-white" href="javascript:void(0)">Aluminium Slim Frame Minimal Series</a></h3>
                                            <ul>
                                                <li>Residential & Commercial</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 my-4">
                                    <div class="project-item wow fadeInUp" data-wow-delay="1s">
                                        <div class="project-item-image">
                                            <a href="javascript:void(0)" data-cursor-text="view">
                                                <figure class="image-anime">
                                                    <img src="{{ asset('asset/frontend/new/alu-comb-dr.webp')}}" alt="Bi-Fold Door">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="project-item-content">
                                            <h3><a class="text-white" href="javascript:void(0)">Aluminium Combination Doors</a></h3>
                                            <ul>
                                                <li>Premium Residences</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="section-footer-text wow fadeInUp" data-wow-delay="0.4s">
                                        <p>
                                            Explore Sherene’s Premium Aluminium Door Range – 
                                            <a href="{{ route('contact')}}">Built for Strength, Performance & Modern Style</a>
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <div class="project-solution-box">
                                <h2 class="text-anime-style-3">Solutions Provided</h2>
                                <p class="wow fadeInUp">
                                   We provide complete aluminium door solutions, focusing on structural strength, safety, smooth operation, and long-term durability.
                                </p>

                                <div class="project-solution-item-list">
                                    <div class="project-solution-item wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="icon-box">
                                            <img src="{{ asset('asset/frontend/images/icon-project-solution-item-1.svg')}}" alt="">
                                        </div>
                                        <div class="project-solution-item-content">
                                            <h3>Structural Strength</h3>
                                            <p>High-grade aluminium profiles designed for large openings, heavy-duty usage, and long-lasting stability.</p>
                                        </div>
                                    </div>

                                    <div class="project-solution-item wow fadeInUp" data-wow-delay="0.4s">
                                        <div class="icon-box">
                                            <img src="{{ asset('asset/frontend/images/icon-project-solution-item-2.svg')}}" alt="">
                                        </div>
                                        <div class="project-solution-item-content">
                                            <h3>Low Maintenance</h3>
                                            <p>Rust-proof, corrosion-resistant, and no repainting required for hassle-free use.</p>
                                        </div>
                                    </div>

                                    <div class="project-solution-item wow fadeInUp" data-wow-delay="0.6s">
                                        <div class="icon-box">
                                            <img src="{{ asset('asset/frontend/images/icon-project-solution-item-3.svg')}}" alt="">
                                        </div>
                                        <div class="project-solution-item-content">
                                            <h3>Safety & Sound Insulation</h3>
                                            <p>Advanced locking systems and effective noise reduction for enhanced security and comfort.</p>
                                        </div>
                                    </div>
                                </div>

                                <p class="wow fadeInUp">
                                    Every aluminium door installation is customised to site requirements, ensuring modern design, long-lasting durability, and complete customer satisfaction.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection