@include('frontend.layouts.header-link')

<body class="text-gray-800 antialiased font-sans">

    <!-- 1. Top Bar -->
    @include('frontend.layouts.top_bar')


    <!-- 2. Main Header (Sticky) -->
    @include('frontend.layouts.main_header')



    @include('frontend.layouts.navbar')

    <!-- Main Content -->
    <main class="max-w-full mx-auto px-2 py-4 md:py-4">

        <section class="flex flex-col lg:flex-row gap-5 h-[400px] lg:h-[460px] mb-4">

            <div
                class="hidden lg:flex w-64 bg-white rounded-xl shadow-sm border border-gray-100 overflow-visible flex-shrink-0 flex-col">

                {{-- HEADER --}}
                <div class="py-4 px-5 border-b border-gray-100 font-bold text-gray-800 flex items-center gap-2">

                    <i data-lucide="list" class="text-primary w-5 h-5"></i>

                    Top Categories

                </div>

                {{-- CATEGORY LIST --}}
                <div class="relative py-2">

                    @php
                        $categories1 = \App\Models\Category::with('subcategories')
                            ->where('status', 1)
                            ->latest()
                            ->take(9)
                            ->get();
                    @endphp

                    @forelse($categories1 as $category)

                        <div class="relative sidebar-category-group">

                            {{-- CATEGORY --}}
                            <a href="{{ route('categoryproducts', $category->id) }}"
                                class="px-5 py-3 hover:bg-gray-50 hover:text-primary transition flex items-center justify-between group text-[13px] font-medium text-gray-600">

                                <span class="flex items-center gap-3">

                                    <i data-lucide="folder" class="w-4 h-4 text-gray-400 group-hover:text-primary"></i>

                                    {{ $category->category_name }}

                                </span>

                                @if ($category->subcategories->count())
                                    <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-gray-300"></i>
                                @endif

                            </a>

                            {{-- SUB CATEGORY --}}
                            @if ($category->subcategories->count())
                                <div
                                    class="sidebar-submenu absolute left-full top-0 hidden w-64 bg-white border border-gray-100 rounded-xl shadow-xl z-[99999] py-2">

                                    @foreach ($category->subcategories as $subcategory)
                                        <a href="{{ route('subcategoryproducts', $subcategory->id) }}"
                                            class="block px-5 py-2.5 text-[13px] text-gray-600 hover:bg-gray-50 hover:text-primary transition">

                                            {{ $subcategory->sub_category_name }}

                                        </a>
                                    @endforeach

                                </div>
                            @endif

                        </div>

                    @empty

                        <div class="px-5 py-4 text-sm text-gray-500">

                            No Categories Found

                        </div>

                    @endforelse

                </div>

            </div>

            <style>
                /* SHOW SUBCATEGORY */
                .sidebar-category-group {
                    position: relative;
                }

                .sidebar-category-group:hover>.sidebar-submenu {
                    display: block;
                }
            </style>

            <div
                class="lg:flex-1 bg-white rounded-xl overflow-hidden relative shadow-sm h-[350px] md:h-[300px] lg:h-full">
                <div id="slider" class="w-full h-full relative">
                    <div class="slide absolute inset-0 bg-cover bg-center"
                        style="background-image: url('https://images.unsplash.com/photo-1565793298595-6a879b1d9492?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'); opacity: 1;">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center px-10 md:px-14 text-white text-left">
                            <h2 class="text-3xl md:text-5xl font-bold mb-4">Global Trade Solutions</h2>
                            <p class="mb-8 max-w-md text-gray-100 text-[15px] font-medium leading-relaxed">Secure
                                payments, reliable shipping, and comprehensive trade services.</p>
                            <div>
                                <button
                                    class="bg-primary hover:bg-primaryHover text-white px-8 py-2.5 rounded text-sm font-bold transition-colors">
                                    Learn More
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="slide absolute inset-0 bg-cover bg-center"
                        style="background-image: url('https://images.unsplash.com/photo-1565793298595-6a879b1d9492?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'); opacity: 0;">
                        <div
                            class="absolute inset-0 bg-black bg-opacity-40 flex flex-col justify-center px-10 md:px-14 text-white text-left">
                            <h2 class="text-3xl md:text-5xl font-bold mb-4">Premium Manufacturing</h2>
                            <p class="mb-8 max-w-md text-gray-100 text-[15px] font-medium leading-relaxed">Connect with
                                verified suppliers across India for high-quality goods.</p>
                            <div>
                                <button
                                    class="bg-primary hover:bg-primaryHover text-white px-8 py-2.5 rounded text-sm font-bold transition-colors">
                                    Source Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="absolute bottom-5 left-0 right-0 flex justify-center gap-2">
                    <button class="w-2 h-2 rounded-full bg-white opacity-100 slider-dot transition-opacity"
                        onclick="goToSlide(0)"></button>
                    <button
                        class="w-2 h-2 rounded-full bg-white opacity-50 hover:opacity-80 slider-dot transition-opacity"
                        onclick="goToSlide(1)"></button>
                </div>
            </div>

            <div class="w-full lg:w-72 flex flex-col gap-5 h-full">

                <div
                    class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex-1 flex flex-col items-center justify-center text-center">
                    <div
                        class="w-16 h-16 bg-red-50 border border-red-100 rounded-full flex items-center justify-center text-primary mb-4">
                        <i data-lucide="package" class="w-7 h-7"></i>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-1.5 text-[15px]">Sell Your Products</h3>
                    <p class="text-[13px] text-gray-500 mb-5">Reach millions of active B2B buyers globally and grow your
                        business.</p>
                    <div class="w-full flex gap-3">
                        <a href="{{ route('vendor.index') }}"
                            class="flex-1 bg-primary hover:bg-primaryHover text-white py-2 rounded text-[13px] font-bold transition-colors shadow-sm shadow-primary/20">
                            Start Selling
                        </a>
                        <a href="{{ route('products') }}"
                            class="flex-1 bg-white hover:bg-red-50 text-primary border border-primary py-2 rounded text-[13px] font-bold transition-colors">
                            View Products
                        </a>
                    </div>
                </div>

                <div
                    class="bg-[#fffbfa] p-6 rounded-xl shadow-sm border border-red-50 flex-1 flex flex-col justify-center relative overflow-hidden">
                    <h3 class="font-bold text-gray-900 mb-2 flex items-center gap-2 text-[15px]">
                        <i data-lucide="briefcase" class="text-primary w-5 h-5"></i> Provide Services
                    </h3>
                    <p class="text-[13px] text-gray-600 mb-5 leading-relaxed">Showcase your professional IT, marketing,
                        and digital services to top clients.</p>
                    <a href="{{ route('vendor.index') }}"
                        class="w-full bg-white hover:bg-red-50 text-center text-primary border border-primary py-2.5 rounded text-[13px] font-bold transition-colors shadow-sm">
                        List Services Now
                    </a>
                </div>

            </div>
        </section>

        @if (auth()->check() && count($rfqs))

            <section class="mb-6 bg-white p-4 rounded-2xl shadow-sm border border-gray-200">

                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold text-gray-900">
                        My RFQs
                    </h2>

                    <span class="text-xs text-gray-500">
                        {{ count($rfqs) }} Requirements
                    </span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">

                    @foreach ($rfqs as $rfq)
                        <div
                            class="border border-gray-200 rounded-xl p-3 hover:border-primary hover:shadow-md transition-all">

                            <div class="flex items-center justify-between mb-2">

                                <div class="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center">
                                    <i data-lucide="clipboard-list" class="w-4 h-4 text-primary"></i>
                                </div>

                                <span class="text-[10px] px-2 py-0.5 rounded-full bg-green-50 text-green-600">
                                    Active
                                </span>
                                <button type="button" onclick="deleteRfq({{ $rfq->id }})"
                                    class="text-red-500 hover:text-red-700">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>

                            </div>

                            <h3 class="text-sm font-semibold text-gray-900 mb-2 line-clamp-1">
                                {{ $rfq->product_name }}
                            </h3>

                            <div class="space-y-1 text-xs">

                                <div class="flex justify-between">
                                    <span class="text-gray-500">Category</span>
                                    <span class="font-medium text-gray-800 truncate ml-2">
                                        {{ $rfq->category }}
                                    </span>
                                </div>

                                <div class="flex justify-between">
                                    <span class="text-gray-500">Qty</span>
                                    <span class="font-medium text-gray-800">
                                        {{ $rfq->quantity }} {{ $rfq->unit }}
                                    </span>
                                </div>

                            </div>

                            <div class="mt-2 pt-2 border-t border-gray-100">

                                <p class="text-[11px] text-gray-500 line-clamp-2">
                                    {{ $rfq->details }}
                                </p>

                            </div>

                        </div>
                    @endforeach

                </div>

            </section>

        @endif

        {{-- Trending Categories Section --}}

        <section class="mt-8 mb-8 relative group bg-white p-5 rounded-2xl shadow-sm border border-gray-200">

            <div class="flex justify-between items-end mb-5 px-1">
                <div>
                    <h2 class="text-[22px] font-bold text-gray-900 tracking-tight mb-1">
                        Trending Services
                    </h2>
                </div>
                <a href="{{ route('sevice_list') }}"
                    class="text-[13px] font-bold text-primary hover:text-primaryHover flex items-center gap-1 transition-colors">
                    View All Service
                </a>
            </div>

            <div class="swiper trendingService !py-2 !px-1 -mx-1">
                <div class="swiper-wrapper">

                    @forelse($allServices as $service)
                        <div class="swiper-slide h-auto flex">
                            <div
                                class="w-full bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] transition-all duration-300 flex flex-col group">

                                {{-- IMAGE --}}
                                <a href="{{ route('service.details', $service->id) }}">
                                    <div class="relative h-[170px] w-full overflow-hidden shrink-0">
                                        @php
                                            $images = json_decode($service->service_img, true);

                                            if (json_last_error() === JSON_ERROR_NONE && is_array($images)) {
                                                $image = $images[0] ?? null;
                                            } else {
                                                $image = $service->service_img;
                                            }
                                        @endphp

                                        @if ($image)
                                            <img src="{{ asset('uploads/service/images/' . $image) }}"
                                                alt="{{ $service->service_name }}" class="w-full h-full object-cover">
                                        @endif
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                                        </div>
                                        <h3
                                            class="absolute bottom-3 left-4 right-4 text-white font-bold text-[17px] leading-snug">
                                            {{ $service->service_name }}
                                        </h3>
                                    </div>
                                </a>

                                {{-- CONTENT --}}
                                <div class="p-5 flex flex-col flex-1">
                                    <div class="flex items-center gap-3 mb-4 shrink-0">
                                        <span
                                            class="bg-[#fff8e1] text-[#f57f17] px-2 py-0.5 rounded text-[11px] font-bold">
                                            Service Provider
                                        </span>
                                        <span class="text-emerald-600 text-[12px] font-medium">
                                            Verified
                                        </span>
                                    </div>

                                    {{-- SHORT DESCRIPTION --}}
                                    <div class="flex-1 mb-5">
                                        <span class="text-[14px] text-gray-400 mb-2 block">
                                            Short Description:
                                        </span>
                                        <p class="text-[13px] text-gray-700 leading-relaxed">
                                            {{ Str::limit($service->short_description, 120) }}
                                        </p>
                                    </div>

                                    {{-- BUTTONS (Forced to bottom with mt-auto) --}}
                                    <div class="mt-auto flex flex-col sm:flex-row gap-2.5 shrink-0">
                                        <a href="{{ route('serviceenquiry', $service->id) }}"
                                            class="flex-1 bg-primary text-white hover:bg-primaryHover px-3.5 py-2 rounded text-[13px] font-bold transition-all flex items-center justify-center gap-2 text-center">
                                            Send Enquiry
                                        </a>
                                        <a href="{{ route('service.details', $service->id) }}"
                                            class="flex-1 bg-white border-2 border-primary text-primary hover:bg-primary/5 px-3.5 py-2 rounded text-[13px] font-bold transition-all flex items-center justify-center gap-2 text-center">
                                            View Full Details
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="w-full text-center py-10">
                            <p class="text-gray-500">
                                No Services Found
                            </p>
                        </div>
                    @endforelse

                </div>
            </div>

            <button
                class="services-prev absolute left-0 top-1/2 mt-3 w-11 h-11 bg-white border border-gray-200 rounded-full flex items-center justify-center shadow-lg text-gray-500 hover:text-primary hover:border-primary transition-all z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible disabled:!hidden cursor-pointer hover:scale-110">
                <i data-lucide="chevron-left" class="w-5 h-5"></i>
            </button>

            <button
                class="services-next absolute right-0 top-1/2 mt-3 w-11 h-11 bg-white border border-gray-200 rounded-full flex items-center justify-center shadow-lg text-gray-500 hover:text-primary hover:border-primary transition-all z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible disabled:!hidden cursor-pointer hover:scale-110">
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </button>

        </section>

        <section class="mt-8 mb-8 relative group bg-white p-5 rounded-2xl shadow-sm border border-gray-200">

            <div class="flex justify-between items-end mb-5 px-1">
                <h2 class="text-[22px] font-bold text-gray-900 tracking-tight">
                    Trending Products
                </h2>

                <a href="{{ route('products') }}"
                    class="text-[13px] font-bold text-primary hover:text-primaryHover flex items-center gap-1 transition-colors">
                    View All Products
                </a>
            </div>

            <div class="swiper trendingSwiper !py-2 !px-1 -mx-1">
                <div class="swiper-wrapper">

                    @foreach ($trendingProducts as $product)
                        <div class="swiper-slide h-auto">

                            <a href="{{ route('productdetails', $product->id) }}"
                                class="block bg-white rounded-2xl border border-gray-200 p-5 flex flex-col h-[250px] group/card hover:shadow-lg hover:border-primary/20 hover:-translate-y-1 transition-all duration-300">

                                {{-- PRODUCT NAME --}}
                                <div class="flex border-b border-gray-100 pb-3 justify-between items-start w-full">

                                    <h4 class="text-[14px] font-bold text-gray-800 group-hover/card:text-primary">

                                        {{ $product->product_name }}

                                    </h4>

                                    <div
                                        class="w-7 h-7 rounded-full bg-gray-50 flex items-center justify-center group-hover/card:bg-primary">
                                        <i data-lucide="arrow-up-right" class="w-3.5 h-3.5"></i>
                                    </div>

                                </div>

                                {{-- IMAGE --}}
                                @php
                                    $images = json_decode($product->image ?? '[]', true);
                                    $firstImage = $images[0] ?? null;
                                @endphp

                                <div class="flex-1 flex items-center justify-center mt-4">

                                    @if ($firstImage)
                                        <img src="{{ asset('uploads/products/' . $firstImage) }}"
                                            class="max-h-36 object-contain group-hover/card:scale-110 transition-transform duration-500">
                                    @else
                                        <img src="https://pngimg.com/uploads/engine/engine_PNG31.png"
                                            class="max-h-36 object-contain">
                                    @endif

                                </div>

                                {{-- CATEGORY --}}
                                <div class="text-[12px] text-gray-400 mt-2">
                                    {{ $category->category_name }}
                                </div>

                            </a>

                        </div>
                    @endforeach

                </div>
            </div>

            <button
                class="trending-prev absolute left-0 top-1/2 mt-3 w-11 h-11 bg-white border border-gray-200 rounded-full flex items-center justify-center shadow-lg text-gray-500 hover:text-primary hover:border-primary transition-all z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible disabled:!hidden cursor-pointer hover:scale-110">

                <i data-lucide="chevron-left" class="w-5 h-5"></i>

            </button>

            <button
                class="trending-next absolute right-0 top-1/2 mt-3 w-11 h-11 bg-white border border-gray-200 rounded-full flex items-center justify-center shadow-lg text-gray-500 hover:text-primary hover:border-primary transition-all z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible disabled:!hidden cursor-pointer hover:scale-110">

                <i data-lucide="chevron-right" class="w-5 h-5"></i>

            </button>

        </section>


        <section class="mt-8 mb-8 relative group bg-white p-5 rounded-2xl shadow-sm border border-gray-200">

            <div class="flex justify-between items-end mb-5 px-1">
                <div>
                    <h2 class="text-[22px] font-bold text-gray-900 tracking-tight mb-1">
                        Top Verified Suppliers
                    </h2>
                </div>
                <a href="{{ route('supplier_list') }}"
                    class="text-[13px] font-bold text-primary hover:text-primaryHover flex items-center gap-1 transition-colors">
                    View All Suppliers
                </a>
            </div>

            <div class="swiper supplierSwiper !py-2 !px-1 -mx-1">
                <div class="swiper-wrapper">

                    @foreach ($vendors as $vendor)
                        <div class="swiper-slide h-auto flex">

                            <div
                                class="w-full bg-white rounded-2xl border border-gray-200 p-6 flex flex-col items-center text-center hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:border-primary/30 hover:-translate-y-1 transition-all duration-300 group">

                                {{-- LOGO --}}
                                <div
                                    class="w-20 h-20 rounded-full border-4 border-slate-50 bg-white shadow-sm overflow-hidden mb-4 relative flex items-center justify-center">

                                    @if ($vendor->company_logo)
                                        <img src="{{ asset('uploads/vendor_logo/' . $vendor->company_logo) }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div
                                            class="bg-blue-50 text-blue-600 font-bold text-xl w-full h-full flex items-center justify-center">
                                            {{ strtoupper(substr($vendor->company_name, 0, 1)) }}
                                        </div>
                                    @endif

                                </div>

                                {{-- COMPANY NAME --}}
                                <h3
                                    class="text-[15px] font-bold text-gray-900 mb-1 flex items-center justify-center gap-1">

                                    {{ $vendor->company_name }}

                                    <i data-lucide="badge-check" class="w-4 h-4 text-emerald-500"></i>

                                </h3>

                                {{-- LOCATION --}}
                                <div class="text-[12px] text-gray-500 mb-5 flex items-center justify-center gap-1">

                                    <i data-lucide="map-pin" class="w-3 h-3 text-gray-400"></i>

                                    {{ $vendor->city ?? '' }}, {{ $vendor->country ?? '' }}

                                </div>

                                {{-- BUTTON --}}
                                <a href="{{ route('vendor.details', $vendor->id) }}"
                                    class="mt-auto w-full py-2.5 bg-slate-50 border border-gray-200 text-gray-700 hover:text-primary hover:border-primary hover:bg-primary/5 rounded-xl text-[13px] font-bold transition-colors">

                                    View Full Details

                                </a>

                            </div>

                        </div>
                    @endforeach

                </div>
            </div>

            <button
                class="supplier-prev absolute left-0 top-1/2 mt-3 w-11 h-11 bg-white border border-gray-200 rounded-full flex items-center justify-center shadow-lg text-gray-500 hover:text-primary hover:border-primary transition-all z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible disabled:!hidden cursor-pointer hover:scale-110">
                <i data-lucide="chevron-left" class="w-5 h-5"></i>
            </button>

            <button
                class="supplier-next absolute  right-0 top-1/2 mt-3 w-11 h-11 bg-white border border-gray-200 rounded-full flex items-center justify-center shadow-lg text-gray-500 hover:text-primary hover:border-primary transition-all z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible disabled:!hidden cursor-pointer hover:scale-110">
                <i data-lucide="chevron-right" class="w-5 h-5"></i>
            </button>

        </section>


        @foreach ($businessTypes as $businessType)
            <section class="mt-8 mb-6">

                <div class="flex flex-col lg:flex-row gap-2 bg-white p-0 rounded-2xl shadow-sm border border-gray-200">

                    {{-- LEFT BUSINESS TYPE BLOCK --}}
                    <div
                        class="lg:w-1/4 w-full p-6 pt-8 relative flex flex-col justify-start min-h-[320px] overflow-hidden group rounded-2xl">

                        {{-- background image (optional fallback) --}}
                        <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d"
                            class="absolute inset-0 w-full h-full object-cover">

                        <div class="absolute inset-0 bg-black/30"></div>

                        <div class="relative z-10 bg-white/90 p-4 rounded-2xl">

                            <h3 class="text-[20px] font-semibold text-[#1a1a1a] mb-4">
                                {{ $businessType->business_name }}
                            </h3>

                            <a href="{{ route('bussiness_product_list', $businessType->id) }}"
                                class="bg-[#e64545] hover:bg-[#cc3b3b] text-white text-[13px] font-medium py-1.5 px-4 rounded-sm">

                                Source Now

                            </a>

                        </div>

                    </div>

                    {{-- RIGHT CATEGORY BLOCK --}}
                    <div class="lg:w-3/4 w-full grid grid-cols-2 md:grid-cols-4 gap-2 p-4">

                        @foreach ($businessType->categories as $category)
                            <a href="{{ route('category_product_list', $category->id) }}"
                                class="bg-white rounded-2xl p-5 border border-slate-200 hover:border-primary/40 shadow-sm hover:shadow transition-all group flex flex-col h-[190px]">

                                {{-- CONTENT SWITCH --}}
                                @if ($category->products->count() > 0)
                                    {{-- 🟢 SHOW PRODUCT --}}
                                    @php
                                        $product = $category->products[0];
                                        $images = json_decode($product->image ?? '[]', true);
                                    @endphp

                                    <div class="flex justify-between items-start w-full relative z-10">

                                        <h4 class="text-[14px] font-bold text-slate-700 group-hover:text-primary">
                                            {{ $product->product_name }}
                                        </h4>

                                        <div
                                            class="w-7 h-7 rounded-full bg-slate-50 flex items-center justify-center group-hover:bg-primary">
                                            <i data-lucide="arrow-up-right"
                                                class="w-3.5 h-3.5 text-slate-400 group-hover:text-white"></i>
                                        </div>

                                    </div>

                                    <div class="mt-auto h-24 w-full flex items-end justify-center">

                                        @if (!empty($images[0]))
                                            <img src="{{ asset('uploads/products/' . $images[0]) }}"
                                                class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform">
                                        @endif

                                    </div>
                                @else
                                    {{-- 🔵 FALLBACK CATEGORY --}}
                                    <div class="flex justify-between items-start w-full relative z-10">

                                        <h4 class="text-[14px] font-bold text-slate-700 group-hover:text-primary">
                                            {{ $category->category_name }}
                                        </h4>

                                        <div
                                            class="w-7 h-7 rounded-full bg-slate-50 flex items-center justify-center group-hover:bg-primary">
                                            <i data-lucide="arrow-up-right"
                                                class="w-3.5 h-3.5 text-slate-400 group-hover:text-white"></i>
                                        </div>

                                    </div>

                                    <div class="mt-auto h-24 w-full flex items-end justify-center">

                                        <img src="{{ asset('uploads/categories/' . $category->image) }}"
                                            class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform">

                                    </div>
                                @endif

                            </a>
                        @endforeach

                    </div>

                </div>

            </section>
        @endforeach

        <style>
            .swiper-pagination-bullet-active {
                background-color: var(--color-primary, #e64545) !important;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize Cities Swiper
                const citiesSwiper = new Swiper('.citiesSwiper', {
                    slidesPerView: 1,
                    spaceBetween: 16,

                    autoplay: {
                        delay: 1500,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },

                    navigation: {
                        nextEl: '.cities-next',
                        prevEl: '.cities-prev',
                    },

                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                    },

                    breakpoints: {
                        480: {
                            slidesPerView: 1.5,
                        },
                        768: {
                            slidesPerView: 3,
                        },
                        1024: {
                            slidesPerView: 4,
                        }
                    }
                });
            });
        </script>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function deleteRfq(id) {
            Swal.fire({
                title: 'Delete RFQ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Delete'
            }).then((result) => {

                if (result.isConfirmed) {

                    let url = "{{ route('rfq.destroy', ':id') }}";
                    url = url.replace(':id', id);

                    fetch(url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {

                            if (data.status) {

                                Swal.fire({
                                    icon: 'success',
                                    title: data.message,
                                    timer: 1500,
                                    showConfirmButton: false
                                });

                                setTimeout(() => {
                                    location.reload();
                                }, 1500);
                            }

                        });

                }

            });
        }
    </script>

    @include('frontend.layouts.footer')
