@include('frontend.layouts.header-link')
@include('frontend.layouts.top_bar')
@include('frontend.layouts.main_header')
@include('frontend.layouts.navbar')

  <!-- Breadcrumb -->
    <nav class="flex flex-wrap items-center gap-2 text-[13px] text-gray-500 font-medium p-2">
        <a href="#" class="hover:text-primary transition-colors"><i data-lucide="home" class="w-4 h-4"></i></a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">All Categories</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <span class="text-gray-900 font-bold"> {{ $category->category_name }}</span>
    </nav>

<div class="flex flex-col lg:flex-row gap-2 lg:gap-4 items-start p-2">

    <aside class="w-full lg:w-[280px] shrink-0 sticky top-[115px] md:top-[75px] lg:top-32 z-40">
    
    <button id="mobile-cat-toggle" class="w-full lg:hidden flex items-center justify-between bg-white/95 backdrop-blur-md p-4 rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.06)] font-bold text-gray-900 transition-colors active:bg-gray-50 cursor-pointer">
        <span class="flex items-center gap-2">
            <i data-lucide="list" class="text-primary w-5 h-5"></i> Categories
        </span>
        <i data-lucide="chevron-down" id="mobile-cat-icon" class="w-5 h-5 text-gray-400 transition-transform duration-300"></i>
    </button>

    <div id="cat-list-container" class="hidden lg:flex lg:mt-0 bg-white rounded-2xl border border-gray-100 overflow-hidden flex-col shadow-sm transition-all">
        
        <div class="hidden lg:flex py-4 px-5 border-b border-gray-100 font-bold text-gray-800 items-center gap-2">
            <i data-lucide="list" class="text-primary w-5 h-5"></i>
            {{ $category->category_name }}
        </div>
        
        <ul class="py-2 flex-1 max-h-[50vh] lg:max-h-[calc(100vh-250px)] overflow-y-auto custom-scrollbar text-[13px] font-medium text-gray-600">
            @foreach($category->subcategories as $subcategory)
                <a href="{{ route('subcategoryproducts', $subcategory->id) }}"
                    class="px-5 py-3 lg:py-2.5 hover:bg-gray-50 hover:text-primary transition flex items-center justify-between group border-b border-gray-50 lg:border-none last:border-none">
                    <span>{{ $subcategory->sub_category_name }}</span>
                    <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-gray-300 group-hover:text-primary transition-colors"></i>
                </a>
            @endforeach
        </ul>
    </div>
</aside>

    <main class="flex-1 w-full min-w-0">

        <div class="bg-white p-3 rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgb(0,0,0,0.02)] mb-6">
            <h1 class="text-[18px] sm:text-[20px] font-bold text-gray-900 text-center truncate px-2"> 
                {{ $category->category_name }}
            </h1>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5">
            @forelse($products as $product)
                @php
                    $images = json_decode($product->image, true) ?? [];
                @endphp

                <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-[0_12px_40px_rgba(0,0,0,0.06)] hover:border-primary/20 hover:-translate-y-1 transition-all duration-300 group flex flex-col h-full">
                    
                    <div class="relative h-48 sm:h-56 bg-white border-b border-gray-50 shrink-0">
                        <div class="swiper productSwiper w-full h-full">
                            <div class="swiper-wrapper">
                                @forelse($images as $image)
                                    <div class="swiper-slide flex items-center justify-center p-4 sm:p-6 bg-white">
                                        <img src="{{ asset('uploads/products/' . $image) }}"
                                            alt="{{ $product->name }}"
                                            class="max-h-full max-w-full object-contain mix-blend-multiply transition-transform duration-500 group-hover:scale-105">
                                    </div>
                                @empty
                                    <div class="swiper-slide flex items-center justify-center p-4 sm:p-6 bg-white">
                                        <img src="{{ asset('uploads/products/default.png') }}"
                                            alt="Placeholder"
                                            class="max-h-full max-w-full object-contain opacity-40">
                                    </div>
                                @endforelse
                            </div>

                            <button class="prod-prev absolute left-2 top-1/2 -translate-y-1/2 w-8 h-8 bg-white border border-gray-100 rounded-full flex items-center justify-center shadow-md text-gray-500 hover:text-primary transition-all z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible cursor-pointer">
                                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                            </button>
                            <button class="prod-next absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 bg-white border border-gray-100 rounded-full flex items-center justify-center shadow-md text-gray-500 hover:text-primary transition-all z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible cursor-pointer">
                                <i data-lucide="chevron-right" class="w-4 h-4"></i>
                            </button>

                            <div class="swiper-pagination !-bottom-1"></div>
                        </div>
                    </div>

                    <div class="p-4 sm:p-5 flex flex-col flex-1">
                        
                        <a href="{{ route('productdetails', $product->id) }}"
                            class="text-[14px] sm:text-[15px] font-bold text-gray-900 mb-1 hover:text-primary transition-colors line-clamp-2 leading-snug">
                            {{ $product->name }}
                        </a>

                        <p class="text-[12px] sm:text-[13px] text-gray-500 mb-3 line-clamp-2 leading-relaxed">
                            {{ Str::limit(strip_tags($product->description), 120, '...') }}
                        </p>

                        <div class="mt-auto pt-3 border-t border-gray-50 flex flex-col gap-1.5 shrink-0">
                            <div class="flex items-center justify-between gap-2">
                                <span class="text-[12px] sm:text-[13px] font-bold text-gray-800 truncate">
                                    {{ $product->vendor->company_name ?? 'Independent Supplier' }}
                                </span>
                                @if(isset($product->vendor))
                                    <i data-lucide="shield-check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                                @endif
                            </div>
                            <div class="flex items-center gap-1.5 text-[11px] sm:text-[12px] text-gray-500 font-medium truncate">
                                <i data-lucide="map-pin" class="w-3 h-3 sm:w-3.5 sm:h-3.5 shrink-0"></i> 
                                <span class="truncate">{{ $product->vendor->city ?? 'Location unavailable' }}</span>
                            </div>
                        </div>

                        <div class="mt-4 flex flex-col sm:flex-row gap-2 sm:gap-2.5 shrink-0">
                            <a href="{{ route('productdetails', $product->id) }}"
                                class="flex-1 bg-white border border-primary text-primary hover:bg-primary hover:text-white py-2 sm:py-2.5 rounded-xl text-[12px] sm:text-[13px] font-bold transition-all flex items-center justify-center gap-1.5 shadow-sm text-center">
                                <i data-lucide="message-circle" class="w-4 h-4"></i> Chat Now
                            </a>
                            <a href="#"
                                class="flex-1 bg-primary border border-primary text-white hover:bg-primaryHover py-2 sm:py-2.5 rounded-xl text-[12px] sm:text-[13px] font-bold transition-all flex items-center justify-center gap-1.5 shadow-sm text-center">
                                <i data-lucide="mail" class="w-4 h-4"></i> Send Enquiry
                            </a>
                        </div>
                    </div>

                </div>
            @empty
                <div class="col-span-full text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm">
                    <i data-lucide="package-x" class="w-12 h-12 mx-auto text-gray-300 mb-3"></i>
                    <p class="text-gray-500 font-medium">No products available in this category.</p>
                </div>
            @endforelse
        </div>

    </main>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggleBtn = document.getElementById('mobile-cat-toggle');
        const catContainer = document.getElementById('cat-list-container');
        const catIcon = document.getElementById('mobile-cat-icon');

        if (toggleBtn && catContainer) {
            toggleBtn.addEventListener('click', function () {
                catContainer.classList.toggle('hidden');
                catContainer.classList.toggle('flex');
                
                if (catIcon) {
                    catIcon.classList.toggle('rotate-180');
                }
            });
        }
    });
</script>

@include('frontend.layouts.footer')

<!-- Component CSS Overrides -->
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

<!-- Scripts Initializers -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Swipers
        const productSwipers = document.querySelectorAll('.productSwiper');
        productSwipers.forEach(function (swiperContainer) {
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
                    nextEl: swiperContainer.querySelector('.prod-next'),
                    prevEl: swiperContainer.querySelector('.prod-prev'),
                },
                pagination: {
                    el: swiperContainer.querySelector('.swiper-pagination'),
                    clickable: true,
                }
            });
        });

        // Initialize Lucide Icons Safely
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>