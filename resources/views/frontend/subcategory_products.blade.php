@include('frontend.layouts.header-link')


    @include('frontend.layouts.top_bar')

    @include('frontend.layouts.main_header')

    @include('frontend.layouts.navbar')

    <div class="max-w-full mx-auto px-2 py-8">

        {{-- Breadcrumb --}}
        <nav class="flex items-center text-[13px] text-gray-500 mb-6 font-medium flex-wrap gap-y-2">

            <a href="{{ url('/') }}"
                class="hover:text-primary transition-colors flex items-center gap-1">

                <i data-lucide="home" class="w-3.5 h-3.5"></i>

                Home

            </a>

            <i data-lucide="chevron-right"
                class="w-3.5 h-3.5 mx-2 text-gray-400"></i>

            <a href="{{ route('category_product_list', $category->id) }}"
                class="hover:text-primary transition-colors whitespace-nowrap">

                {{ $category->category_name }}

            </a>

            <i data-lucide="chevron-right"
                class="w-3.5 h-3.5 mx-2 text-gray-400"></i>

            <span class="text-gray-900 font-semibold whitespace-nowrap">

                {{ $subcategory->sub_category_name }}

            </span>

        </nav>

        {{-- Page Header --}}
        <div
            class="bg-white p-5 rounded-3xl border border-gray-100 shadow-sm mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h1 class="text-[24px] font-bold text-gray-900">

                    {{ $subcategory->sub_category_name }}

                </h1>

                <p class="text-[14px] text-gray-500 mt-1">

                    Total Products :
                    <span class="font-semibold text-primary">

                        {{ $products->total() }}

                    </span>

                </p>
            </div>

        </div>

        {{-- Products Grid --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">

            @forelse($products as $product)

                <a href="{{ route('productdetails', $product->id) }}"
                    class="bg-white rounded-3xl p-4 border border-slate-200 hover:border-primary/40 shadow-sm hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:-translate-y-1 transition-all duration-300 group flex flex-col overflow-hidden">

                    {{-- Product Image --}}
                    <div
                        class="h-44 bg-slate-50 rounded-2xl flex items-center justify-center overflow-hidden mb-4">

                        @php
                            $images = json_decode($product->image, true);
                        @endphp

                        @if(!empty($images) && isset($images[0]))

                            <img src="{{ asset('uploads/products/' . $images[0]) }}"
                                alt="{{ $product->product_name }}"
                                class="max-w-full max-h-full object-contain group-hover:scale-110 transition-transform duration-500">

                        @else

                            <img src="https://pngimg.com/uploads/engine/engine_PNG31.png"
                                alt="No Image"
                                class="max-w-full max-h-full object-contain">

                        @endif

                    </div>

                    {{-- Product Content --}}
                    <div class="flex flex-col flex-1">

                        <h3
                            class="text-[15px] font-bold text-slate-800 group-hover:text-primary transition-colors line-clamp-2 min-h-[44px]">

                            {{ $product->product_name }}

                        </h3>

                        {{-- Brand --}}
                        @if(!empty($product->brand))

                            <p class="text-[13px] text-gray-500 mt-2">

                                Brand :
                                <span class="font-medium text-gray-700">

                                    {{ $product->brand }}

                                </span>

                            </p>

                        @endif

                        {{-- Price --}}
                        @if(!empty($product->selling_price))

                            <div class="mt-3">

                                <span class="text-[18px] font-bold text-primary">

                                    ₹{{ number_format($product->selling_price, 2) }}

                                </span>

                            </div>

                        @endif

                        {{-- Button --}}
                        <div class="mt-auto pt-4">

                            <div
                                class="w-full bg-primary/5 group-hover:bg-primary text-primary group-hover:text-white text-center py-2.5 rounded-xl text-[13px] font-semibold transition-all duration-300">

                                View Details

                            </div>

                        </div>

                    </div>

                </a>

            @empty

                <div class="col-span-full">

                    <div
                        class="bg-white rounded-3xl border border-dashed border-slate-300 py-16 text-center">

                        <div
                            class="w-20 h-20 mx-auto rounded-full bg-slate-100 flex items-center justify-center mb-4">

                            <i data-lucide="package-x"
                                class="w-10 h-10 text-slate-400"></i>

                        </div>

                        <h3 class="text-[18px] font-bold text-gray-800 mb-2">

                            No Products Found

                        </h3>

                        <p class="text-gray-500 text-[14px]">

                            Products are not available in this sub category.

                        </p>

                    </div>

                </div>

            @endforelse

        </div>

        {{-- Pagination --}}
        @if($products->hasPages())

            <div class="mt-10">

                {{ $products->links() }}

            </div>

        @endif

    </div>

    @include('frontend.layouts.footer')

    <script>
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>
