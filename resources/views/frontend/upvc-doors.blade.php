@extends('frontend.layouts.app')
@section('content')
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header-box">
                        <h1 class="text-anime-style-3" data-cursor="-opaque">uPVC Doors</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">home |</a></li>
                                <li class="breadcrumb-item"><a href="{{route('gallery')}}">Doors |</a></li>
                                <li class="breadcrumb-item active" aria-current="page">uPVC Doors</li>
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
                                <img src="{{ asset('asset/frontend/new/up-dor.webp')}}" alt="Sherene uPVC Doors">
                            </figure>
                        </div>

                        <div class="project-entry">
                            <p class="wow fadeInUp">
                                Sherene uPVC Doors are trusted across Tamil Nadu for their durability, security, and elegance. With over 2,00,000 installations, our doors are designed to enhance modern homes and commercial spaces while providing superior performance.
                            </p>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">
                                Our uPVC doors offer smooth operation, energy efficiency, noise reduction, and are maintenance-free, making them ideal for residential and commercial projects.
                            </p>

                            <div class="project-overview-box">
                                <h2 class="text-anime-style-3">uPVC Doors Overview</h2>
                                <p class="wow fadeInUp">
                                    Sherene provides premium uPVC doors engineered for security, thermal insulation, soundproofing, and long-lasting durability. Each door system combines modern design with high functionality.
                                </p>

                                <div class="project-overview-body">
                                    <div class="project-overview-image">
                                        <figure class="image-anime reveal">
                                            <img src="{{ asset('asset/frontend/new/up-doorr.webp')}}" alt="Premium uPVC Doors">
                                        </figure>
                                    </div>

                                    <div class="project-overview-item-box wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="project-overview-item">
                                            <div class="icon-box">
                                                <img src="{{ asset('asset/frontend/images/icon-project-overview-1.svg')}}" alt="">
                                            </div>
                                            <div class="project-overview-item-content">
                                                <h3>Precision Door Systems</h3>
                                                <p>
                                                    Designed for smooth operation, safety, and long-term performance, our doors ensure peace of mind.
                                                </p>
                                            </div>
                                        </div>

                                        <div class="project-overview-list-contact-box">
                                            <div class="project-overview-list">
                                                <ul>
                                                    <li>Two-panel Sliding Doors</li>
                                                    <li>Three-panel Sliding Doors</li>
                                                    <li>Four-panel Sliding Doors</li>
                                                    <li>Sliding Doors with Bug Mesh</li>
                                                    <li>Casement Doors</li>
                                                    <li>Bi-Fold Doors</li>
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
                                    Every uPVC door is installed with precision to ensure maximum security, weather resistance, noise insulation, and maintenance-free performance.
                                </p>
                            </div>

                            <div class="row">
                                <div class="col-xl-4 col-md-6 my-4">
                                    <div class="project-item wow fadeInUp">
                                        <div class="project-item-image">
                                            <a href="javascript:void(0)" data-cursor-text="view">
                                                <figure class="image-anime">
                                                    <img src="{{ asset('asset/frontend/new/up-2s-dor.webp')}}" alt="Two-panel Sliding Door">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="project-item-content">
                                            <h3><a class="text-white" href="javascript:void(0)">Two-panel Sliding Door</a></h3>
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
                                                    <img src="{{ asset('asset/frontend/new/upvc-3-slidedr.webp')}}" alt="Three-panel Sliding Door">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="project-item-content">
                                            <h3><a class="text-white" href="javascript:void(0)">Three-panel Sliding Door</a></h3>
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
                                                    <img src="{{ asset('asset/frontend/new/up-door-3.webp')}}" alt="Four-panel Sliding Door">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="project-item-content">
                                            <h3><a class="text-white" href="javascript:void(0)">Four-panel Sliding Door</a></h3>
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
                                                    <img src="{{ asset('asset/frontend/new/up-door-4.webp')}}" alt="Sliding Door with Bug Mesh">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="project-item-content">
                                            <h3><a class="text-white" href="javascript:void(0)">Sliding Door with Bug Mesh</a></h3>
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
                                                    <img src="{{ asset('asset/frontend/new/up-door-5.webp')}}" alt="Casement Door">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="project-item-content">
                                            <h3><a class="text-white" href="javascript:void(0)">Casement Door</a></h3>
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
                                                    <img src="{{ asset('asset/frontend/new/up-bf-dor.webp')}}" alt="Bi-Fold Door">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="project-item-content">
                                            <h3><a class="text-white" href="javascript:void(0)">Bi-Fold Door</a></h3>
                                            <ul>
                                                <li>Premium Residences</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="section-footer-text wow fadeInUp" data-wow-delay="0.4s">
                                        <p>
                                            Explore Sherene’s Premium uPVC Door Range –
                                            <a href="{{ route('contact')}}">Built for Strength, Security & Style</a>
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <div class="project-solution-box">
                                <h2 class="text-anime-style-3">Solutions Provided</h2>
                                <p class="wow fadeInUp">
                                    We provide complete uPVC door solutions, focusing on energy efficiency, safety, smooth operation, and durability.
                                </p>

                                <div class="project-solution-item-list">
                                    <div class="project-solution-item wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="icon-box">
                                            <img src="{{ asset('asset/frontend/images/icon-project-solution-item-1.svg')}}" alt="">
                                        </div>
                                        <div class="project-solution-item-content">
                                            <h3>Energy Efficiency</h3>
                                            <p>High UV resistance, thermal insulation, and eco-friendly performance.</p>
                                        </div>
                                    </div>

                                    <div class="project-solution-item wow fadeInUp" data-wow-delay="0.4s">
                                        <div class="icon-box">
                                            <img src="{{ asset('asset/frontend/images/icon-project-solution-item-2.svg')}}" alt="">
                                        </div>
                                        <div class="project-solution-item-content">
                                            <h3>Low Maintenance</h3>
                                            <p>Zero painting, termite-proof, and corrosion-free finish for hassle-free use.</p>
                                        </div>
                                    </div>

                                    <div class="project-solution-item wow fadeInUp" data-wow-delay="0.6s">
                                        <div class="icon-box">
                                            <img src="{{ asset('asset/frontend/images/icon-project-solution-item-3.svg')}}" alt="">
                                        </div>
                                        <div class="project-solution-item-content">
                                            <h3>Safety & Sound Insulation</h3>
                                            <p>Enhanced locking systems and superior noise reduction for peace of mind.</p>
                                        </div>
                                    </div>
                                </div>

                                <p class="wow fadeInUp">
                                    Every door installation is tailored to site requirements, ensuring modern design, long-lasting durability, and complete customer satisfaction.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection