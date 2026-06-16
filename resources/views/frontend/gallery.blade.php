@extends('frontend.layouts.app')
@section('content')
    <!-- Page Header Section Start -->
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-3" data-cursor="-opaque">Aluminium Door Gallery</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">home |</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('gallery')}}">Gallery |</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $gallery->title ?? '' }}</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header Section End -->

@if(isset($gallery))
    <div class="container my-5">
        <div class="gallery-wrapper">
            <div class="gallery-grid">
                @foreach ($gallery->details as $list)
                    <div class="gallery-item">
                        <img src="{{ asset('uploads/gallery_image/'.$list->image)}}"
                            data-full="{{ asset('uploads/gallery_image/'.$list->image)}}"
                            alt="Aluminium Sliding Door">
                        <div class="item-details">
                            <h3>{{ $list->name ?? '' }}</h3>
                            <p>{{ $gallery->category ?? '' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div id="doorLightbox" class="door-lightbox">
            <div class="door-lightbox-content">
                <span class="door-close">&times;</span>
                <button class="door-nav door-prev">&#10094;</button>
                <img id="activeImage" src="" alt="Full view">
                <button class="door-nav door-next">&#10095;</button>
                <div class="door-info">
                    <h2 id="activeTitle"></h2>
                    <p id="activeSub"></p>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
@push('scripts')
    <!-- Main Custom js file -->
    <script src="{{ asset('asset/frontend/js/function.js')}}"></script>
@endpush