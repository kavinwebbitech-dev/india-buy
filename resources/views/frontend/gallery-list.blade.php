@extends('frontend.layouts.app')
@section('content')
    <!-- Page Header Section Start -->
    <div class="page-header parallaxie">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Page Header Box Start -->
                    <div class="page-header-box">
                        <h1 class="text-anime-style-3" data-cursor="-opaque">Gallery</h1>
                        <nav class="wow fadeInUp">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">home |</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('gallery')}}">Gallery </a></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Page Header Box End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header Section End -->

    @if($galleries->isNotEmpty())
        <div class="container my-5">
            <div class="row">
                @foreach ($galleries as $gallery)
                    <div class="col-xl-3 col-md-6">
                        <div class="project-item wow fadeInUp">
                            <div class="project-item-image">
                                <a href="{{ route('gallery.list', $gallery->slug ?? '#')}}" data-cursor-text="view">
                                    <figure class="image-anime">
                                        <img src="{{ asset('uploads/gallery_image/'.$gallery->thumbnail) }}" alt="">
                                    </figure>
                                </a>
                            </div>
                            <div class="project-item-content">
                                <h2><a href="{{ route('gallery.list', $gallery->slug ?? '#')}}">{{ $gallery->name ?? '' }}</a></h2>
                                <ul>
                                    <li>{{ $gallery->category ?? '' }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>           
                @endforeach
            </div>
        </div>
    @endif
@endsection