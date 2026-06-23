@include('frontend.layouts.header-link')


    <!-- 1. Top Bar -->
    @include('frontend.layouts.top_bar')

    <!-- 2. Main Header (Sticky) -->
    @include('frontend.layouts.main_header')

    @include('frontend.layouts.navbar')

    <!-- Main Content -->
    <div class="max-w-full mx-auto px-2 py-8">
        <div class="flex flex-col lg:flex-row gap-8">

            <aside class="w-full lg:w-[280px] shrink-0">

                <form method="GET" action="{{ route('products') }}">

                    <div
                        class="bg-white p-6 rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] sticky top-24 space-y-8">

                        <div class="flex items-center justify-between pb-4 border-b border-gray-100">
                            <h2 class="text-[16px] font-bold text-gray-900 flex items-center gap-2">
                                <i data-lucide="sliders-horizontal" class="w-4 h-4 text-primary"></i>
                                Filters
                            </h2>

                            <a href="{{ route('products') }}"
                                class="text-[12px] text-gray-400 hover:text-primary font-medium">
                                Clear All
                            </a>
                        </div>

                        {{-- Product Search --}}
                        <div>
                            <h3 class="text-[14px] font-bold text-gray-900 mb-4">
                                Product Name
                            </h3>

                            <div class="relative">
                                <i data-lucide="search"
                                    class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"></i>

                                <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Search by name..."
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-9 pr-3 py-2.5 text-[13px] text-gray-700 focus:outline-none focus:border-primary">
                            </div>
                        </div>

                        {{-- Supplier Location --}}
                        <div>

                            <h3 class="text-[14px] font-bold text-gray-900 mb-4">
                                Supplier Location
                            </h3>

                            <div class="max-h-64 overflow-y-auto space-y-3">

                                @forelse($cities as $city)
                                    <label
                                        class="flex items-center gap-2.5 text-[13px] font-medium text-gray-600 cursor-pointer">

                                        <input type="checkbox" name="city[]" value="{{ $city }}"
                                            {{ in_array($city, request('city', [])) ? 'checked' : '' }}
                                            class="w-4 h-4 rounded border-gray-300 text-primary">

                                        <span>{{ $city }}</span>

                                    </label>

                                @empty

                                    <p class="text-sm text-gray-400">
                                        No cities found
                                    </p>
                                @endforelse

                            </div>

                        </div>

                        {{-- Buttons --}}
                        <div class="flex gap-2">

                            <button type="submit"
                                class="flex-1 bg-primary text-white py-2.5 rounded-xl text-sm font-semibold hover:bg-primaryHover">

                                Apply

                            </button>

                            <a href="{{ route('products') }}"
                                class="flex-1 border border-gray-300 py-2.5 rounded-xl text-center text-sm font-semibold hover:bg-gray-50">

                                Reset

                            </a>

                        </div>

                    </div>

                </form>

            </aside>

            <main class="flex-1">

                <div
                    class="bg-white p-3 rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgb(0,0,0,0.02)] mb-6 gap-4">
                    <h1 class="text-[20px] font-bold text-gray-900 text-center">
                        Products ({{ $products->total() }})
                    </h1>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-5">

                    @foreach ($products as $product)
                        <div
                            class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-[0_12px_40px_rgba(0,0,0,0.06)] hover:border-primary/20 hover:-translate-y-1 transition-all duration-300 group flex flex-col">

                            {{-- Product Image --}}
                            <div class="relative h-56 bg-white border-b border-gray-50">

                                @php
                                    $images = json_decode($product->image, true);
                                    // dd($product->image );
                                    $firstImage = $images[0] ?? null;
                                @endphp

                                @if ($firstImage)
                                    <img src="{{ asset('uploads/products/' . $firstImage) }}"
                                        alt="{{ $product->product_name }}" class="w-full h-full object-contain p-5">
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" alt="No Image"
                                        class="w-full h-full object-contain p-5">
                                @endif

                                {{-- <button
                                    class="absolute top-4 right-4 w-8 h-8 bg-white border border-gray-100 rounded-full flex items-center justify-center text-gray-400 hover:text-red-500">

                                    <i data-lucide="heart" class="w-4 h-4"></i>

                                </button> --}}

                            </div>

                            {{-- Product Details --}}
                            <div class="p-5 flex flex-col flex-1">

                                <a href="{{ route('productdetails', $product->id) }}"
                                    class="text-[15px] font-bold text-gray-900 mb-2 hover:text-primary transition-colors">

                                    {{ $product->product_name }}

                                </a>

                                <p class="text-[13px] text-gray-500 mb-3 line-clamp-2">

                                    {{ Str::limit($product->short_description, 120) }}

                                </p>

                                {{-- Price --}}
                                {{-- <div class="mb-3">

                                    <span class="text-lg font-bold text-primary">
                                        ₹{{ $product->short_description  }}
                                    </span>

                                </div> --}}

                                {{-- Vendor --}}
                                <div class="mt-auto pt-3 border-t border-gray-100">

                                    <div class="flex items-center justify-between">

                                        <span class="text-[13px] font-bold text-gray-800">

                                            {{ $product->vendor->company_name ?? 'Supplier' }}

                                        </span>

                                        <i data-lucide="shield-check" class="w-4 h-4 text-emerald-500"></i>

                                    </div>

                                    <div class="flex items-center gap-1 mt-1 text-[12px] text-gray-500">

                                        <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>

                                        {{ $product->vendor->city ?? 'India' }}

                                    </div>

                                </div>

                                {{-- Buttons --}}
                                <div class="mt-5 flex gap-2">

                                    {{-- <button onclick="openChat({{ $product->id }})"
                                        class="flex-1 bg-white border border-primary text-primary hover:bg-primary hover:text-white py-2.5 rounded-xl text-[13px] font-bold transition-all">

                                        Chat Now

                                    </button> --}}

                                    <a href="{{ route('enquiry', $product->id) }}"
                                        class="flex-1 bg-primary text-white hover:bg-primaryHover py-2.5 rounded-xl text-[13px] font-bold text-center">

                                        Send Enquiry

                                    </a>

                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

                {{-- <div class="mt-12 mb-8 flex justify-center items-center gap-2 text-[14px]">
                    <button
                        class="w-10 h-10 rounded-xl border border-gray-200 bg-white flex items-center justify-center text-gray-400 hover:border-primary hover:text-primary transition-all shadow-sm">
                        <i data-lucide="chevron-left" class="w-5 h-5"></i>
                    </button>
                    <button
                        class="w-10 h-10 rounded-xl bg-primary text-white font-bold shadow-lg shadow-primary/20">1</button>
                    <button
                        class="w-10 h-10 rounded-xl border border-gray-200 bg-white flex items-center justify-center text-gray-600 hover:border-primary hover:text-primary transition-all shadow-sm">2</button>
                    <button
                        class="w-10 h-10 rounded-xl border border-gray-200 bg-white flex items-center justify-center text-gray-600 hover:border-primary hover:text-primary transition-all shadow-sm">3</button>
                    <div class="px-2 text-gray-400">...</div>
                    <button
                        class="w-10 h-10 rounded-xl border border-gray-200 bg-white flex items-center justify-center text-gray-600 hover:border-primary hover:text-primary transition-all shadow-sm">12</button>
                    <button
                        class="w-10 h-10 rounded-xl border border-gray-200 bg-white flex items-center justify-center text-gray-400 hover:border-primary hover:text-primary transition-all shadow-sm">
                        <i data-lucide="chevron-right" class="w-5 h-5"></i>
                    </button>
                </div> --}}
                <div class="mt-10">
                    {{ $products->links() }}
                </div>

            </main>
        </div>
    </div>

    <style>
        .productSwiper .swiper-pagination-bullet {
            width: 6px;
            height: 6px;
            background-color: #cbd5e1;
            opacity: 1;
        }

        .productSwiper .swiper-pagination-bullet-active {
            background-color: #e64545;
            width: 14px;
            border-radius: 4px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productSwipers = document.querySelectorAll('.productSwiper');

            productSwipers.forEach(function(swiperContainer) {
                new Swiper(swiperContainer, {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    simulateTouch: true,

                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },

                    navigation: {
                        nextEl: swiperContainer.parentElement.querySelector('.prod-next'),
                        prevEl: swiperContainer.parentElement.querySelector('.prod-prev'),
                    },

                    pagination: {
                        el: swiperContainer.querySelector('.swiper-pagination'),
                        clickable: true,
                    }
                });
            });

        });
    </script>

    @include('frontend.layouts.footer')
