@include('frontend.layouts.header-link')
@include('frontend.layouts.top_bar')
@include('frontend.layouts.main_header')
@include('frontend.layouts.navbar')

<div class="bg-slate-50 min-h-screen pb-16 pt-4">
    <div class="max-w-full mx-auto px-4">

        <nav class="flex flex-wrap items-center gap-2 text-[13px] text-gray-500 font-medium mb-6">
            <a href="{{ url('/') }}" class="hover:text-primary transition-colors flex items-center">
                <i data-lucide="home" class="w-4 h-4"></i>
            </a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-gray-300"></i>
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors">All Categories</a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-gray-300"></i>
            <span class="text-gray-900 font-bold">{{ $category->category_name }}</span>
        </nav>

        <div class="flex flex-col lg:flex-row gap-6 items-start">

            <aside class="w-full lg:w-[280px] shrink-0 lg:sticky lg:top-32 z-30">
                
                <button id="mobile-cat-toggle" class="w-full lg:hidden flex items-center justify-between bg-white p-4 rounded-2xl border border-gray-100 shadow-sm font-bold text-gray-900 transition-colors active:bg-gray-50 cursor-pointer">
                    <span class="flex items-center gap-2">
                        <i data-lucide="list" class="text-primary w-5 h-5"></i> Categories
                    </span>
                    <i data-lucide="chevron-down" id="mobile-cat-icon" class="w-5 h-5 text-gray-400 transition-transform duration-300"></i>
                </button>

                <div id="cat-list-container" class="hidden lg:flex flex-col mt-3 lg:mt-0 bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm transition-all w-full">
                    <div class="hidden lg:flex py-4 px-5 border-b border-gray-100 font-bold text-gray-800 items-center gap-2 bg-slate-50/50">
                        <i data-lucide="list" class="text-primary w-5 h-5"></i>
                        <span class="truncate">{{ $category->category_name }}</span>
                    </div>
                    
                    <ul class="py-2 flex-1 max-h-[50vh] lg:max-h-[calc(100vh-250px)] overflow-y-auto text-[13px] font-medium text-gray-600 divide-y divide-gray-50/60">
                        @foreach($category->subcategories as $subcategory)
                            <a href="{{ route('subcategoryproducts', $subcategory->id) }}"
                                class="px-5 py-3 lg:py-2.5 hover:bg-slate-50 hover:text-primary transition flex items-center justify-between group">
                                <span class="truncate pr-2">{{ $subcategory->sub_category_name }}</span>
                                <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-gray-300 group-hover:text-primary transition-colors shrink-0"></i>
                            </a>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <main class="flex-1 w-full min-w-0">

                <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm mb-6 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-lg md:text-xl font-bold text-gray-900 truncate"> 
                            {{ $category->category_name }}
                        </h1>
                        <p class="text-xs text-gray-400 mt-0.5" id="product-count-display">Showing products available</p>
                    </div>
                    
                    <div class="relative w-full md:w-72 shrink-0">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-gray-400">
                            <i data-lucide="search" class="w-4 h-4"></i>
                        </span>
                        <input type="text" id="product-search-input" placeholder="Search by product name..." 
                               class="w-full bg-slate-50 text-xs text-gray-800 pl-10 pr-4 py-2.5 rounded-xl border border-gray-200/80 focus:outline-none focus:border-primary focus:bg-white transition-all shadow-inner">
                    </div>
                </div>

                <div id="products-catalogue-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-5">
                    @forelse($products as $product)
                        @php
                            $images = json_decode($product->image, true) ?? [];
                        @endphp

                        <div class="product-card bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-[0_12px_30px_rgba(0,0,0,0.04)] hover:border-primary/20 hover:-translate-y-0.5 transition-all duration-300 flex flex-col h-full" 
                             data-name="{{ strtolower($product->name) }}">
                            
                            <div class="relative h-48 bg-white border-b border-gray-50 shrink-0 group">
                                <div class="swiper productSwiper w-full h-full">
                                    <div class="swiper-wrapper">
                                        @forelse($images as $image)
                                            <div class="swiper-slide flex items-center justify-center p-4 bg-white">
                                                <img src="{{ asset('uploads/products/' . $image) }}"
                                                     alt="{{ $product->name }}"
                                                     class="max-h-full max-w-full object-contain mix-blend-multiply transition-transform duration-500 group-hover:scale-102">
                                            </div>
                                        @empty
                                            <div class="swiper-slide flex items-center justify-center p-4 bg-white">
                                                <img src="{{ asset('uploads/products/default.png') }}"
                                                     alt="Placeholder"
                                                     class="max-h-full max-w-full object-contain opacity-30">
                                            </div>
                                        @endforelse
                                    </div>

                                    <button class="prod-prev absolute left-2 top-1/2 -translate-y-1/2 w-7 h-7 bg-white/90 backdrop-blur border border-gray-100 rounded-full flex items-center justify-center shadow-sm text-gray-500 hover:text-primary transition-all z-10 opacity-0 group-hover:opacity-100 cursor-pointer">
                                        <i data-lucide="chevron-left" class="w-3.5 h-3.5"></i>
                                    </button>
                                    <button class="prod-next absolute right-2 top-1/2 -translate-y-1/2 w-7 h-7 bg-white/90 backdrop-blur border border-gray-100 rounded-full flex items-center justify-center shadow-sm text-gray-500 hover:text-primary transition-all z-10 opacity-0 group-hover:opacity-100 cursor-pointer">
                                        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                                    </button>

                                    <div class="swiper-pagination !bottom-1"></div>
                                </div>
                            </div>

                            <div class="p-4 flex flex-col flex-1">
                                <a href="{{ route('productdetails', $product->id) }}"
                                   class="text-[14px] font-bold text-gray-900 mb-1 hover:text-primary transition-colors line-clamp-2 leading-snug">
                                    {{ $product->name }}
                                </a>

                                <p class="text-[12px] text-gray-500 mb-4 line-clamp-2 leading-relaxed">
                                    {{ Str::limit(strip_tags($product->description), 100, '...') }}
                                </p>
                                
                                <div class="mt-auto pt-3 border-t border-gray-50 flex flex-col gap-1 shrink-0">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="text-[12px] font-bold text-gray-700 truncate">
                                            {{ $product->vendor->company_name ?? 'Independent Supplier' }}
                                        </span>
                                        @if(isset($product->vendor))
                                            <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-500 shrink-0"></i>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-1 text-[11px] text-gray-400 font-medium truncate">
                                        <i data-lucide="map-pin" class="w-3 h-3 shrink-0"></i> 
                                        <span class="truncate">{{ $product->vendor->city ?? 'Location unavailable' }}</span>
                                    </div>
                                </div>

                                <div class="mt-4 flex gap-2 shrink-0">
                                    {{-- <a href="{{ route('productdetails', $product->id) }}"
                                       class="flex-1 bg-white border border-gray-200 text-gray-700 hover:border-primary hover:text-primary py-2 rounded-xl text-[12px] font-bold transition-all flex items-center justify-center gap-1 text-center shadow-sm">
                                        <i data-lucide="message-circle" class="w-3.5 h-3.5"></i> Chat
                                    </a> --}}
                                    <a href="{{ route('enquiry', $product->id) }}"
                                       class="flex-1 bg-primary text-white hover:bg-primaryHover py-2 rounded-xl text-[12px] font-bold transition-all flex items-center justify-center gap-1 text-center shadow-sm">
                                        <i data-lucide="mail" class="w-3.5 h-3.5"></i> Enquiry
                                    </a>
                                </div>
                            </div>

                        </div>
                    @empty
                        <div id="empty-state-card" class="col-span-full text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm">
                            <i data-lucide="package-x" class="w-12 h-12 mx-auto text-gray-300 mb-3"></i>
                            <p class="text-gray-500 font-medium">No products available in this category.</p>
                        </div>
                    @endforelse

                    <div id="no-search-results" class="hidden col-span-full text-center py-16 bg-white rounded-2xl border border-gray-100 shadow-sm">
                        <i data-lucide="search-x" class="w-11 h-11 mx-auto text-gray-300 mb-3"></i>
                        <p class="text-gray-500 font-medium text-sm">No products match your search keyword.</p>
                        <p class="text-gray-400 text-xs mt-1">Try checking for spelling or searching another item name.</p>
                    </div>
                </div>

            </main>
        </div>

    </div>
</div>

@include('frontend.layouts.footer')

<style>
    .productSwiper .swiper-pagination-bullet {
        width: 5px;
        height: 5px;
        background-color: #cbd5e1;
        opacity: 1;
        transition: all 0.2s ease;
    }
    .productSwiper .swiper-pagination-bullet-active {
        background-color: #e64545;
        width: 12px;
        border-radius: 4px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        // 1. Mobile Sidebar Visibility Toggle Control
        const toggleBtn = document.getElementById('mobile-cat-toggle');
        const catContainer = document.getElementById('cat-list-container');
        const catIcon = document.getElementById('mobile-cat-icon');

        if (toggleBtn && catContainer) {
            toggleBtn.addEventListener('click', function () {
                catContainer.classList.toggle('hidden');
                catContainer.classList.toggle('flex');
                if (catIcon) catIcon.classList.toggle('rotate-180');
            });
        }

        // 2. Swiper Module Elements Initialization Engine
        const productSwipers = document.querySelectorAll('.productSwiper');
        productSwipers.forEach(function (swiperContainer) {
            new Swiper(swiperContainer, {
                slidesPerView: 1,
                spaceBetween: 0,
                simulateTouch: true,
                autoplay: {
                    delay: 4500,
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

        // 3. Dynamic Live JavaScript-based Product Search Filter Logic
        const searchInput = document.getElementById('product-search-input');
        const productCards = document.querySelectorAll('.product-card');
        const noResultsWidget = document.getElementById('no-search-results');
        const initialEmptyState = document.getElementById('empty-state-card');
        const countDisplay = document.getElementById('product-count-display');

        function updateCounts(visibleCount) {
            if (countDisplay) {
                countDisplay.textContent = `Showing ${visibleCount} matching products`;
            }
        }

        if (searchInput) {
            // Set default display count
            updateCounts(productCards.length);

            searchInput.addEventListener('input', function (e) {
                const searchKeyword = e.target.value.toLowerCase().trim();
                let visibleCardsCounter = 0;

                productCards.forEach(function (card) {
                    const productName = card.getAttribute('data-name') || '';
                    if (productName.includes(searchKeyword)) {
                        card.style.display = 'flex';
                        visibleCardsCounter++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Handle conditions for fallback displays
                if (visibleCardsCounter === 0) {
                    if (initialEmptyState) initialEmptyState.style.display = 'none';
                    if (noResultsWidget) noResultsWidget.classList.remove('hidden');
                } else {
                    if (noResultsWidget) noResultsWidget.classList.add('hidden');
                }
                
                if(searchKeyword === '' && productCards.length === 0) {
                    if (initialEmptyState) initialEmptyState.style.display = 'block';
                }

                updateCounts(visibleCardsCounter);
            });
        }

        // 4. Lucide Vector Graphics Core Execution Rendering Engine
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>