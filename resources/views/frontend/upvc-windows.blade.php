@extends('frontend.layouts.app')
@section('content')
    <!-- Page Header Section Start -->
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-3" data-cursor="-opaque">uPVC Windows</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">home |</a></li>
                                <li class="breadcrumb-item"><a href="{{route('gallery')}}">Windows |</a></li>
                                <li class="breadcrumb-item active" aria-current="page">uPVC Windows</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header Section End -->

   

    <!-- Page Project Single Start -->
    <div class="page-project-single">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <!-- Page Single Sidebar Start -->
                    <div class="page-single-sidebar">
                        <!-- Page Category List Start -->
                        <div class="page-category-list wow fadeInUp">
                            <h3>Explore Our Services</h3>
                            <ul>
                                <li><a href="{{ route('upvc.window')}}">uPVC Windows</a></li>
                                <li><a href="{{ route('upvc.door')}}">uPVC Doors</a></li>
                                <li><a href="{{ route('aluminium.window')}}">Aluminium Windows</a></li>
                                <li><a href="{{ route('aluminium.door')}}">Aluminium Doors</a></li>
                            </ul>
                        </div>
                        <!-- Page Category List End -->

                        <!-- Sidebar CTA Box Start -->
                        <div class="sidebar-cta-box wow fadeInUp" data-wow-delay="0.25s">
                            <!-- Icon Box Start -->
                            <div class="icon-box">
                                <img src="{{ asset('asset/frontend/images/icon-phone-white.svg')}}" alt="">
                            </div>
                            <!-- Icon Box End -->

                            <!-- Sidebar CTA Content Start -->
                            <div class="sidebar-cta-content">
                                <h3>Contact Us Now!</h3>
                                <p>Have a project in mind or need expert advice on uPVC & Aluminium windows and doors?</p>
                                <h4>Call At: <a href="tel:+91 98405 64600">+91 98405 64600</a></h4>
                            </div>
                            <!-- Sidebar CTA Content End -->
                        </div>
                        <!-- Sidebar CTA Box End -->
                    </div>
                    <!-- Page Single Sidebar End -->
                </div>

                <div class="col-lg-8">
                    <!-- Project Single Content Start -->
                    <div class="project-single-content">
                        <!-- Page Single image Start -->
                        <div class="page-single-image">
                            <figure class="image-anime reveal">
                                <img src="{{ asset('asset/frontend/new/up-win-1.webp')}}" alt="">
                            </figure>
                        </div>
                        <!-- Page Single image End -->

                        <!-- Project Entry Start -->
                        <div class="project-entry">
                            <p class="wow fadeInUp">
                                This project focuses on delivering high-performance uPVC and Aluminium windows and doors designed for durability, insulation, and modern aesthetics. Every installation balances strength, functionality, and elegant design.
                            </p>
                            <p class="wow fadeInUp" data-wow-delay="0.2s">
                                Sherene’s uPVC & Aluminium Solutions are crafted to enhance natural light, improve ventilation, reduce noise, and provide long-lasting performance for residential and commercial spaces.
                            </p>

                            <!-- Project Overview Box Start -->
                            <div class="project-overview-box">
                                <h2 class="text-anime-style-3">uPVC Windows Overview</h2>
                                <p class="wow fadeInUp">
                                    This project showcases the installation of premium uPVC and Aluminium windows and doors, engineered for weather resistance, energy efficiency, and smooth operation while maintaining a modern architectural look.
                                </p>

                                <!-- Project Overview Body Start -->
                                <div class="project-overview-body">
                                    <!-- Project Overview Image Start -->
                                    <div class="project-overview-image">
                                        <figure class="image-anime reveal">
                                            <img src="{{ asset('asset/frontend/new/up-win-2.webp')}}" alt="">
                                        </figure>
                                    </div>
                                    <!-- Project Overview Image End -->

                                    <!-- Project Overview Item Box Start -->
                                    <div class="project-overview-item-box wow fadeInUp" data-wow-delay="0.2s">
                                        <!-- Project Overview Item Start -->
                                        <div class="project-overview-item">
                                            <div class="icon-box">
                                                <img src="{{ asset('asset/frontend/images/icon-project-overview-1.svg')}}" alt="">
                                            </div>
                                            <div class="project-overview-item-content">
                                                <h3>Precision Window Systems</h3>
                                                <p>
                                                    Designed for smooth operation, thermal insulation, sound reduction, and long-term durability.
                                                </p>
                                            </div>
                                        </div>
                                        <!-- Project Overview Item End -->

                                        <!-- Project Overview List Contact Box Start -->
                                        <div class="project-overview-list-contact-box">
                                            <!-- Project Overview list Start -->
                                            <div class="project-overview-list">
                                                <ul>
                                                    <li>uPVC Casement Windows</li>
                                                    <li>uPVC Sliding Windows</li>
                                                    <li>Bay Windows</li>
                                                    <li>Tilt and Turn Windows</li>
                                                    <li>Sliding Windows with Bug Mesh</li>
                                                    <li>Fixed Windows</li>
                                                </ul>
                                            </div>
                                            <!-- Project Overview list End -->

                                            <!-- Contact Us Circle Start -->
                                            <div class="contact-us-circle">
                                                <a href="{{ route('contact')}}">
                                                    <img src="{{ asset('asset/frontend/images/get-in-touch-circle-elite.svg')}}" alt="">
                                                </a>
                                            </div>
                                            <!-- Contact Us Circle End -->
                                        </div>
                                        <!-- Project Overview List Contact Box End -->
                                    </div>
                                    <!-- Project Overview Item Box End -->
                                </div>
                                <!-- Project Overview Body End -->

                                <p class="wow fadeInUp" data-wow-delay="0.4s">
                                    Each window and door system is installed with precision to ensure maximum safety, weather resistance, sound insulation, and maintenance-free performance.
                                </p>
                            </div>
                            <!-- Project Overview Box End -->

                            <div class="row">
                                <div class="col-xl-4 col-md-6 my-4">
                                    <div class="project-item wow fadeInUp">
                                        <div class="project-item-image">
                                            <a href="javascript:void(0)" data-cursor-text="view">
                                                <figure class="image-anime">
                                                    <img src="{{ asset('asset/frontend/new/casement-up-win.webp')}}" alt="">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="project-item-content">
                                            <h3><a class="text-white" href="javascript:void(0)">uPVC Casement Windows</a></h3>
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
                                                    <img src="{{ asset('asset/frontend/new/up-window-3.webp')}}" alt="">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="project-item-content">
                                            <h3><a class="text-white" href="javascript:void(0)">uPVC Sliding Windows</a></h3>
                                            <ul>
                                                <li>Home & Apartment</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 my-4">
                                    <div class="project-item wow fadeInUp" data-wow-delay="0.4s">
                                        <div class="project-item-image">
                                            <a href="javascript:void(0)" data-cursor-text="view">
                                                <figure class="image-anime">
                                                    <img src="{{ asset('asset/frontend/new/up-window-4.webp')}}" alt="">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="project-item-content">
                                            <h3><a class="text-white" href="javascript:void(0)">uPVC Bay Windows</a></h3>
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
                                                    <img src="{{ asset('asset/frontend/new/up-window-51.webp')}}" alt="">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="project-item-content">
                                            <h3><a class="text-white" href="javascript:void(0)">uPVC Tilt & Turn Windows</a></h3>
                                            <ul>
                                                <li>Modern Homes</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 my-4">
                                    <div class="project-item wow fadeInUp" data-wow-delay="0.8s">
                                        <div class="project-item-image">
                                            <a href="javascript:void(0)" data-cursor-text="view">
                                                <figure class="image-anime">
                                                    <img src="{{ asset('asset/frontend/new/up-window-61.webp')}}" alt="">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="project-item-content">
                                            <h3><a class="text-white" href="javascript:void(0)">uPVC Sliding Windows with Bug Mesh</a></h3>
                                            <ul>
                                                <li>Ventilated Living Spaces</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-4 col-md-6 my-4">
                                    <div class="project-item wow fadeInUp" data-wow-delay="1s">
                                        <div class="project-item-image">
                                            <a href="javascript:void(0)" data-cursor-text="view">
                                                <figure class="image-anime">
                                                    <img src="{{ asset('asset/frontend/new/up-window-7.webp')}}" alt="">
                                                </figure>
                                            </a>
                                        </div>
                                        <div class="project-item-content">
                                            <h3><a class="text-white" href="javascript:void(0)">uPVC Fixed Windows</a></h3>
                                            <ul>
                                                <li>Commercial & Residential</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="section-footer-text wow fadeInUp" data-wow-delay="0.4s">
                                        <p>
                                            <span>Free</span> Explore Sherene’s Premium uPVC Window Range –
                                            <a href="{{ route('contact')}}">Built for Strength, Comfort & Style</a>
                                        </p>
                                    </div>
                                </div>
                            </div>


                            <!-- Project Solution Box Start -->
                            <div class="project-solution-box">
                                <h2 class="text-anime-style-3">Solutions Provided</h2>
                                <p class="wow fadeInUp">
                                    We provided complete uPVC and Aluminium window & door solutions focusing on insulation, security, smooth operation, and long-term durability.
                                </p>

                                <div class="project-solution-item-list">
                                    <div class="project-solution-item wow fadeInUp" data-wow-delay="0.2s">
                                        <div class="icon-box">
                                            <img src="{{ asset('asset/frontend/images/icon-project-solution-item-1.svg')}}" alt="">
                                        </div>
                                        <div class="project-solution-item-content">
                                            <h3>Energy Efficiency</h3>
                                            <p>High UV resistance and thermal insulation for comfort.</p>
                                        </div>
                                    </div>

                                    <div class="project-solution-item wow fadeInUp" data-wow-delay="0.4s">
                                        <div class="icon-box">
                                            <img src="{{ asset('asset/frontend/images/icon-project-solution-item-2.svg')}}" alt="">
                                        </div>
                                        <div class="project-solution-item-content">
                                            <h3>Low Maintenance</h3>
                                            <p>Zero painting, termite-proof, and corrosion-free finish.</p>
                                        </div>
                                    </div>

                                    <div class="project-solution-item wow fadeInUp" data-wow-delay="0.6s">
                                        <div class="icon-box">
                                            <img src="{{ asset('asset/frontend/images/icon-project-solution-item-3.svg')}}" alt="">
                                        </div>
                                        <div class="project-solution-item-content">
                                            <h3>Safety & Sound Insulation</h3>
                                            <p>Enhanced locking systems and superior soundproofing.</p>
                                        </div>
                                    </div>
                                </div>

                                <p class="wow fadeInUp">
                                    Every installation is tailored to site requirements, ensuring long-lasting performance, modern aesthetics, and complete customer satisfaction.
                                </p>
                            </div>
                            <!-- Project Solution Box End -->
                        </div>
                        <!-- Project Entry End -->
                    </div>
                    <!-- Project Single Content End -->
                </div>

            </div>
        </div>
    </div>
    <!-- Page Project Single End -->
@endsection