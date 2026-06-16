@include('frontend.layouts.header-link')
@include('frontend.layouts.top_bar')
@include('frontend.layouts.main_header')
@include('frontend.layouts.navbar')

<div class="max-w-full mx-auto px-2 py-8">
    
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-[13px] text-gray-500 font-medium mb-6 px-1">
        <a href="#" class="hover:text-primary transition-colors"><i data-lucide="home" class="w-4 h-4"></i></a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors">All Categories</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <span class="text-gray-900 font-bold"> {{ $category->category_name }}</span>
    </nav>

    <div class="flex flex-col lg:flex-row gap-8 items-start">

        <!-- Sidebar Subcategories Navigation -->
        <aside class="w-full lg:w-[280px] shrink-0 sticky top-32 z-10 space-y-6">
            <div class="hidden lg:flex bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex-shrink-0 flex-col">
                <div class="py-4 px-5 border-b border-gray-100 font-bold text-gray-800 flex items-center gap-2">
                    <i data-lucide="list" class="text-primary w-5 h-5"></i>
                    {{ $category->category_name }}
                </div>
                <ul class="py-2 flex-1 overflow-y-auto custom-scrollbar text-[13px] font-medium text-gray-600">
                    @foreach($category->subcategories as $subcategory)
                        <a href="{{ route('subcategoryproducts', $subcategory->id) }}"
                            class="px-5 py-2.5 hover:bg-gray-50 hover:text-primary transition flex items-center justify-between group">
                            <span>{{ $subcategory->sub_category_name }}</span>
                            <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-gray-300 group-hover:text-primary transition-colors"></i>
                        </a>
                    @endforeach
                </ul>
            </div>
        </aside>

        <!-- Main Content (Products Grid) -->
        <main class="flex-1">

            <div class="bg-white p-3 rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgb(0,0,0,0.02)] mb-6">
                <h1 class="text-[20px] font-bold text-gray-900 text-center"> {{ $category->category_name }}</h1>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                @forelse($products as $product)
                    @php
                        $images = json_decode($product->image, true) ?? [];
                    @endphp

                    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-[0_12px_40px_rgba(0,0,0,0.06)] hover:border-primary/20 hover:-translate-y-1 transition-all duration-300 group flex flex-col">
                        
                        <!-- Product Image Slider Wrapper -->
                        <div class="relative h-56 bg-white border-b border-gray-50">
                            <div class="swiper productSwiper w-full h-full">
                                <div class="swiper-wrapper">
                                    @forelse($images as $image)
                                        <div class="swiper-slide flex items-center justify-center p-6 bg-white">
                                            <img src="{{ asset('uploads/products/' . $image) }}"
                                                alt="{{ $product->name }}"
                                                class="max-h-full max-w-full object-contain mix-blend-multiply transition-transform duration-500 group-hover:scale-105">
                                        </div>
                                    @empty
                                        <div class="swiper-slide flex items-center justify-center p-6 bg-white">
                                            <img src="{{ asset('uploads/products/default.png') }}"
                                                alt="Placeholder"
                                                class="max-h-full max-w-full object-contain opacity-40">
                                        </div>
                                    @endforelse
                                </div>

                                <!-- Dynamic Navigation controls (Controlled by JS script below) -->
                                <button class="prod-prev absolute left-2 top-1/2 -translate-y-1/2 w-8 h-8 bg-white border border-gray-100 rounded-full flex items-center justify-center shadow-md text-gray-500 hover:text-primary transition-all z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible">
                                    <i data-lucide="chevron-left" class="w-4 h-4"></i>
                                </button>
                                <button class="prod-next absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 bg-white border border-gray-100 rounded-full flex items-center justify-center shadow-md text-gray-500 hover:text-primary transition-all z-10 opacity-0 invisible group-hover:opacity-100 group-hover:visible">
                                    <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                </button>

                                <div class="swiper-pagination !-bottom-1"></div>
                            </div>
                        </div>

                        <!-- Product Information Body -->
                        <div class="p-5 flex flex-col flex-1">
                            <a href="{{ route('productdetails', $product->id) }}"
                                class="text-[15px] font-bold text-gray-900 mb-1 hover:text-primary transition-colors line-clamp-1">
                                {{ $product->name }}
                            </a>

                            <p class="text-[13px] text-gray-500 mb-2 line-clamp-2 leading-relaxed">
                                {{ Str::limit(strip_tags($product->description), 120, '...') }}
                            </p>

                            <!-- Vendor Meta Details -->
                            <div class="mt-auto pt-2 border-t border-gray-50 flex flex-col gap-1.5">
                                <div class="flex items-center justify-between">
                                    <span class="text-[13px] font-bold text-gray-800 truncate">
                                        {{ $product->vendor->company_name ?? 'Independent Supplier' }}
                                    </span>
                                    @if(isset($product->vendor))
                                        <i data-lucide="shield-check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                                    @endif
                                </div>
                                <div class="flex items-center gap-1.5 text-[12px] text-gray-500 font-medium">
                                    <i data-lucide="map-pin" class="w-3.5 h-3.5"></i> 
                                    {{ $product->vendor->city ?? 'Location unavailable' }}
                                </div>
                            </div>

                            <!-- Interaction Actions -->
                            <div class="mt-5 flex gap-2.5">
                                <a href="{{ route('productdetails', $product->id) }}"
                                    class="flex-1 bg-white border border-primary text-primary hover:bg-primary hover:text-white py-2.5 rounded-xl text-[13px] font-bold transition-all flex items-center justify-center gap-1.5 shadow-sm text-center">
                                    <i data-lucide="message-circle" class="w-4 h-4"></i> Chat Now
                                </a>
                                <a href="#"
                                    class="flex-1 bg-primary border border-primary text-white hover:bg-primaryHover py-2.5 rounded-xl text-[13px] font-bold transition-all flex items-center justify-center gap-1.5 shadow-sm text-center">
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
</div>

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