@include('frontend.layouts.header-link')

    @include('frontend.layouts.top_bar')

    @include('frontend.layouts.main_header')

    @include('frontend.layouts.navbar')

    <div class="max-w-full mx-auto px-2 py-8">
        
        <nav class="flex items-center gap-2 text-[13px] text-gray-500 font-medium mb-6 px-1">
            <a href="#" class="hover:text-primary transition-colors"><i data-lucide="home" class="w-4 h-4"></i></a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors">All Categories</a>
            <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
            <span class="text-gray-900 font-bold">{{ $bussiness->business_name }}</span>
        </nav>

        <div class="flex flex-col lg:flex-row gap-8 items-start">

            <aside class="w-full lg:w-[280px] shrink-0 sticky top-32 z-10 space-y-6">
                 
            <div class="hidden lg:flex bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex-col">

                <div class="py-4 px-5 border-b border-gray-100 font-bold text-gray-800">
                    Categories
                </div>

                <ul class="py-2 text-[13px] font-medium text-gray-600">

                    @foreach($categories as $category)

                        <li class="border-b border-gray-100">

                            {{-- <div class="px-5 py-3 font-bold text-primary">
                                {{ $category->category_name }}
                            </div> --}}
                            <a href="{{ route('category_product_list', $category->id) }}"
                                class="block px-8 py-2 hover:bg-gray-50 hover:text-primary">

                                 {{ $category->category_name }}

                            </a>

                            {{-- @foreach($category->subcategories as $subcategory)

                                <a href="{{ route('subcategoryproducts', $subcategory->id) }}"
                                    class="block px-8 py-2 hover:bg-gray-50 hover:text-primary">

                                    {{ $subcategory->sub_category_name }}

                                </a>

                            @endforeach --}}

                        </li>

                    @endforeach

                </ul>

            </div>

            </aside>

             <main class="flex-1">

                <div
                    class="bg-white p-3 rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgb(0,0,0,0.02)] mb-6 gap-4">
                    <h1 class="text-[20px] font-bold text-gray-900 text-center"> {{ $category->category_name }}</h1>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

                    @forelse($products as $product)

                        @php
                            $images = json_decode($product->image, true) ?? [];
                        @endphp

                        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">

                            <div class="relative h-56 bg-white">

                                <div class="swiper productSwiper">

                                    <div class="swiper-wrapper">

                                        @forelse($images as $image)

                                            <div class="swiper-slide flex items-center justify-center p-6">

                                                <img src="{{ asset('uploads/products/'.$image) }}"
                                                    class="max-h-full max-w-full object-contain">

                                            </div>

                                        @empty

                                            <div class="swiper-slide flex items-center justify-center p-6">

                                                <img src="{{ asset('no-image.png') }}"
                                                    class="max-h-full max-w-full object-contain">

                                            </div>

                                        @endforelse

                                    </div>

                                    <div class="swiper-pagination"></div>

                                </div>

                            </div>

                            <div class="p-5">

                                <h3 class="font-bold">
                                    {{ $product->name }}
                                </h3>

                                <p class="text-sm text-gray-500">
                                    {{ $product->category->category_name ?? '' }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $product->subcategory->sub_category_name ?? '' }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $product->vendor->company_name ?? '' }}
                                </p>

                            </div>

                        </div>

                    @empty

                        <div class="col-span-3 text-center py-10">
                            No Products Found
                        </div>

                    @endforelse

                </div>

            </main>

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
                document.addEventListener('DOMContentLoaded', function () {
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
        </div>
    </div>
 
    @include('frontend.layouts.footer')

    <script>
        // Initialize Icons
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
