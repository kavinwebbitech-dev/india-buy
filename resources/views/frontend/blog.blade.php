@extends('frontend.layouts.app')
@section('content')
    <!-- Page Header Section Start -->
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-3" data-cursor="-opaque">OUR Blogs</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Blogs</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header Section End -->

    <!-- Page Blog Start -->
    @if($blogs->isNotEmpty())
        <div class="page-blog">
            <div class="container">
                <div class="row">
                    @foreach ($blogs as $blog)
                        <div class="col-xl-4 col-md-6">
                            <!-- Post Item Start -->
                            <div class="post-item wow fadeInUp">
                                <!-- Post Featured Image Start-->
                                <div class="post-featured-image">
                                    <a href="{{ route('blog.detail', $blog->slug)}}" data-cursor-text="View">
                                        <figure class="image-anime">
                                            <img src="{{ asset($blog->thumbnail)}}" alt="{{ $blog->title }}">
                                        </figure>
                                    </a>
                                    <div class="post-item-tags">
                                        <a href="{{ route('blog.detail', $blog->slug)}}">uPVC Windows</a>
                                    </div>
                                </div>
                                <!-- Post Featured Image End -->

                                <!-- Post Item Body Start -->
                                <div class="post-item-body">
                                    <div class="post-item-content">
                                        <h2>
                                            <a href="{{ route('blog.detail', $blog->slug)}}">
                                                {{ $blog->title ?? '' }}
                                            </a>
                                        </h2>
                                    </div>

                                    <div class="post-item-btn">
                                        <a href="{{ route('blog.detail', $blog->slug)}}" class="readmore-btn">Read More</a>
                                    </div>
                                </div>
                                <!-- Post Item Body End -->
                            </div>
                            <!-- Post Item End -->
                        </div>
                    @endforeach

                    <div class="col-lg-12">
                        <!-- Page Pagination Start -->
                        {{-- <div class="page-pagination wow fadeInUp" data-wow-delay="1.2s">
                            <ul class="pagination">
                                <li><a href="#"><i class="fa-solid fa-angle-left"></i></a></li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#"><i class="fa-solid fa-angle-right"></i></a></li>
                            </ul>
                        </div> --}}
                        <!-- Page Pagination End -->
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection