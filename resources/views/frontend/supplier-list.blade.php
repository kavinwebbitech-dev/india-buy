@include('frontend.layouts.header-link')


    @include('frontend.layouts.top_bar')

    @include('frontend.layouts.main_header')

    @include('frontend.layouts.navbar')

    <div class="max-w-full mx-auto px-2 py-8">
        <div class="flex flex-col lg:flex-row gap-8 items-start">

            <form method="GET" action="{{ route('supplier_list') }}">

                <aside class="w-full lg:w-[280px] shrink-0 sticky top-32 z-10">
                    <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6">

                        <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-5">
                            <h3 class="text-[16px] font-bold text-gray-900 flex items-center gap-2">
                                <i data-lucide="sliders-horizontal" class="w-4 h-4 text-primary"></i>
                                Filters
                            </h3>

                            <a href="{{ route('supplier_list') }}"
                                class="text-[12px] font-bold text-gray-400 hover:text-primary transition-colors">
                                Clear All
                            </a>
                        </div>

                        {{-- Supplier Name --}}
                        <div class="mb-6">
                            <label class="block text-[13px] font-bold text-gray-700 mb-2">
                                Supplier Name
                            </label>

                            <div class="relative">
                                <i data-lucide="search"
                                    class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>

                                <input type="text"
                                    name="supplier_name"
                                    value="{{ request('supplier_name') }}"
                                    placeholder="Search by name..."
                                    class="w-full h-10 pl-9 pr-3 bg-slate-50 border border-gray-200 rounded-xl text-[13px] focus:outline-none focus:border-primary focus:bg-white transition-colors">
                            </div>
                        </div>

                        {{-- Supplier Location --}}
                        <div class="mb-6">
                            <label class="block text-[13px] font-bold text-gray-700 mb-3">
                                Supplier Location
                            </label>

                            <div class="space-y-3 max-h-48 overflow-y-auto pr-2">

                                @forelse($cities as $city)

                                    <label class="flex items-center gap-3 cursor-pointer group">

                                        <input type="checkbox"
                                            name="city[]"
                                            value="{{ $city }}"
                                            {{ in_array($city, request('city', [])) ? 'checked' : '' }}
                                            class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary accent-primary">

                                        <span
                                            class="text-[13px] text-gray-600 group-hover:text-gray-900 transition-colors">
                                            {{ $city }}
                                        </span>

                                    </label>

                                @empty

                                    <p class="text-sm text-gray-500">
                                        No locations found
                                    </p>

                                @endforelse

                            </div>
                        </div>

                        {{-- Buttons --}}
                        <div class="grid grid-cols-2 gap-3 pt-4 border-t border-gray-100">

                            <button type="submit"
                                class="bg-primary text-white hover:bg-primaryHover py-2.5 rounded-xl text-[13px] font-bold transition-all shadow-md shadow-primary/20">
                                Apply
                            </button>

                            <a href="{{ route('supplier_list') }}"
                                class="bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 py-2.5 rounded-xl text-[13px] font-bold transition-colors text-center">
                                Reset
                            </a>

                        </div>

                    </div>
                </aside>

            </form>

            <main class="flex-1 w-full min-w-0">

                <div
                    class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] p-4 md:p-5 mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <h1 class="text-[18px] font-bold text-gray-900">
                        Suppliers
                        <span class="text-gray-400 font-normal text-[15px] ml-1">
                            ({{ $vendors->count() }} Results)
                        </span>
                    </h1>
                </div>

                <div class="space-y-6">

                    @forelse($vendors as $vendor)

                        <div class="bg-white rounded-3xl border border-gray-100 p-6">

                            <div
                                class="flex flex-col md:flex-row justify-between items-start gap-5 border-b border-gray-50 pb-5 mb-5">

                                <div class="flex items-center gap-5">
                                    <a  href="{{ route('vendor.details', $vendor->id) }}">
                                    <div class="w-16 h-16 rounded-full overflow-hidden">
                                        <img src="{{ asset('uploads/vendor_logo/' . $vendor->company_logo) }}"
                                            class="w-full h-full object-cover">

                                    </div></a>

                                    <div>
                                        <a  href="{{ route('vendor.details', $vendor->id) }}">
                                        <h3 class="text-[18px] font-bold text-gray-900">
                                            {{ $vendor->company_name }}
                                        </h3></a>

                                        <div class="flex flex-wrap items-center gap-3 text-[13px] text-gray-500">
                                            <span>
                                                <i data-lucide="map-pin" class="w-3.5 h-3.5"></i> {{ $vendor->city }}
                                            </span>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div>

                                <h4 class="text-[13px] font-bold text-gray-900 mb-3">
                                    Featured Products
                                </h4>

                                <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-4">

                                    @foreach ($vendor->products->take(4) as $product)
                                        @php
                                            $images = json_decode($product->image, true);
                                        @endphp

                                        <a href="{{ route('productdetails', $product->id) }}"
                                            class="group relative rounded-xl border border-gray-100 overflow-hidden bg-white p-2">

                                            <div class="swiper productSwiper{{ $product->id }}">
                                                <div class="swiper-wrapper">

                                                    @if (!empty($images))
                                                        @foreach ($images as $img)
                                                            <div class="swiper-slide">
                                                                <img src="{{ asset('uploads/products/' . $img) }}"
                                                                    alt="{{ $product->name }}"
                                                                    class="h-40 w-full object-contain">
                                                            </div>
                                                        @endforeach
                                                    @endif

                                                </div>

                                                <div class="swiper-pagination"></div>
                                            </div>

                                            <div class="px-3 py-2 text-[12px] font-bold text-gray-900 truncate">
                                                {{ $product->name }}
                                            </div>

                                        </a>
                                    @endforeach

                                    <div
                                        class="rounded-xl border-2 border-dashed border-gray-200 bg-slate-50/50 flex flex-col items-center justify-center p-3">

                                        <span class="text-[12px] font-bold text-gray-500">
                                            +{{ max($vendor->products->count() - 4, 0) }} More Items
                                        </span>

                                        <a href="{{ route('vendor.details', $vendor->id) }}"
                                            class="w-full py-2 bg-red-50 text-primary rounded-lg text-[12px] font-bold text-center mt-2">
                                            View Profile
                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="text-center py-10">
                            No Suppliers Found
                        </div>

                    @endforelse

                </div>

            </main>
        </div>
    </div>

    @include('frontend.layouts.footer')

    <script>
        // Initialize Icons
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
