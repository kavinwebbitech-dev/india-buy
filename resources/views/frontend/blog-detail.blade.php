@extends('frontend.layouts.app')
@section('content')
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-header-box">
                        <h1 class="text-anime-style-3" data-cursor="-opaque">{{ $blog->title ?? ''}}</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">home |</a></li>
                                <li class="breadcrumb-item"><a href="{{route('blog')}}">Blog |</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $blog->title ?? ''}}</li>
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
                <div class="col-lg-8">
                    <div class="page-single-post pt-0">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Post Featured Image Start -->
                                    <div class="post-image">
                                        <figure class="image-anime">
                                            <img src="{{ asset($blog->blog_image ?? '')}}" alt="{{ $blog->title ?? ''}}">
                                        </figure>
                                    </div>
                                    <!-- Post Featured Image End -->

                                    <!-- Post Single Content Start -->
                                    <div class="post-content">
                                        <!-- Post Entry Start -->
                                        <div class="post-entry">
                                            {!! $blog->page_content ?? '' !!}
                                        </div>
                                        <!-- Post Entry End -->

                                        <!-- Post Tag Links Start -->
                                        <div class="post-tag-links">
                                            <div class="row align-items-center">
                                                <div class="col-lg-8">
                                                    <!-- Post Tags Start -->
                                                    <div class="post-tags wow fadeInUp" data-wow-delay="0.5s">
                                                        @if ($tags->isNotEmpty())
                                                            <span class="tag-links">
                                                                Tags:
                                                                @foreach ($tags as $tag)
                                                                    <a href="{{ route('blog.detail', $tag->slug)}}">{{ $tag->category }}</a>
                                                                @endforeach
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <!-- Post Tags End -->
                                                </div>

                                                <div class="col-lg-4">
                                                    <!-- Post Social Links Start -->
                                                    <div class="post-social-sharing wow fadeInUp" data-wow-delay="0.5s">
                                                        <ul>
                                                            <li><a href="https://www.facebook.com/profile.php?id=61580956682232" target="blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                                            <li><a target="blank" href="https://www.instagram.com/sherene_windows?igsh=bjJ0OTB6eWsybjhp&utm_source=qr"><i class="fa-brands fa-instagram"></i></a></li>
                                                            <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                                            <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                                        </ul>
                                                    </div>
                                                    <!-- Post Social Links End -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Post Tag Links End -->
                                    </div>
                                    <!-- Post Single Content End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($latest_blogs->isNotEmpty())    
                    <div class="col-lg-4">
                        <div class="page-single-sidebar">
                            <div class="page-category-list wow fadeInUp">
                                <h3>Explore Our Services</h3>
                                <ul>
                                    @foreach ($latest_blogs as $blog)
                                        <li><a href="{{ route('blog.detail', $blog->slug)}}">{{ $blog->title ?? '' }}</a></li>
                                    @endforeach
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
                @endif
            </div>
        </div>
    </div>
@endsection