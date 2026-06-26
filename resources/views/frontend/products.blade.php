@include('frontend.layouts.header-link')

    <!-- 1. Top Bar -->
    @include('frontend.layouts.top_bar')

    <!-- 2. Main Header (Sticky) -->
    @include('frontend.layouts.main_header')

    @include('frontend.layouts.navbar')

    <!-- Main Content -->
    <div class="max-w-full mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-6">

            <aside class="w-full lg:w-[260px] shrink-0">
                <form method="GET" action="{{ route('products') }}">
                    <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.02)] sticky top-24 space-y-6">

                        <div class="flex items-center justify-between pb-3 border-b border-gray-100">
                            <h2 class="text-[15px] font-bold text-gray-900 flex items-center gap-2">
                                <i data-lucide="sliders-horizontal" class="w-4 h-4 text-primary"></i>
                                Filters
                            </h2>
                            <a href="{{ route('products') }}" class="text-[12px] text-gray-400 hover:text-primary font-medium">
                                Clear All
                            </a>
                        </div>

                        {{-- Product Search --}}
                        <div>
                            <h3 class="text-[13px] font-bold text-gray-900 mb-3">Product Name</h3>
                            <div class="relative">
                                <i data-lucide="search" class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name..."
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl pl-9 pr-3 py-2 text-[12px] text-gray-700 focus:outline-none focus:border-primary">
                            </div>
                        </div>

                        {{-- Category --}}
                        <div>
                            <h3 class="text-[13px] font-bold text-gray-900 mb-3">Category</h3>
                            <div class="max-h-52 overflow-y-auto space-y-2.5 custom-scrollbar">
                                @foreach($categories as $category)
                                    <label class="flex items-center gap-2.5 text-[12px] text-gray-600 cursor-pointer hover:text-primary">
                                        <input type="checkbox" name="category[]" value="{{ $category->id }}"
                                            {{ in_array($category->id, request('category', [])) ? 'checked' : '' }}
                                            class="w-3.5 h-3.5 rounded border-gray-300 text-primary focus:ring-0">
                                        {{ $category->category_name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Supplier Location --}}
                        <div>
                            <h3 class="text-[13px] font-bold text-gray-900 mb-3">Supplier Location</h3>
                            <div class="max-h-52 overflow-y-auto space-y-2.5 custom-scrollbar">
                                @forelse($cities as $city)
                                    <label class="flex items-center gap-2.5 text-[12px] text-gray-600 cursor-pointer hover:text-primary">
                                        <input type="checkbox" name="city[]" value="{{ $city }}"
                                            {{ in_array($city, request('city', [])) ? 'checked' : '' }}
                                            class="w-3.5 h-3.5 rounded border-gray-300 text-primary focus:ring-0">
                                        <span>{{ $city }}</span>
                                    </label>
                                @empty
                                    <p class="text-xs text-gray-400">No cities found</p>
                                @endforelse
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex gap-2 pt-2">
                            <button type="submit" class="flex-1 bg-primary text-white py-2 rounded-xl text-xs font-bold hover:bg-primaryHover transition-colors">
                                Apply
                            </button>
                            <a href="{{ route('products') }}" class="flex-1 border border-gray-200 py-2 rounded-xl text-center text-xs font-bold text-gray-600 hover:bg-gray-50 transition-colors">
                                Reset
                            </a>
                        </div>

                    </div>
                </form>
            </aside>

            <main class="flex-1">
                <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-[0_4px_20px_rgb(0,0,0,0.01)] mb-6">
                    <h1 class="text-[16px] font-bold text-gray-800">
                        All Products <span class="text-sm font-normal text-gray-400 ml-1">({{ $products->total() }} items)</span>
                    </h1>
                </div>

                <!-- Product Grid (Cards Optimized to max-w-[270px] on large screens for compact look) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 justify-items-center sm:justify-items-stretch">
                    @foreach ($products as $product)
                        <div class="w-full max-w-[270px] bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-[0_12px_30px_rgba(0,0,0,0.04)] hover:border-primary/10 hover:-translate-y-0.5 transition-all duration-300 flex flex-col h-full group">

                            {{-- Clickable Product Image Box Section --}}
                            <a href="{{ route('productdetails', $product->id) }}" class="relative h-48 bg-white border-b border-gray-50 flex items-center justify-center p-4 block overflow-hidden shrink-0">
                                @php
                                    $images = json_decode($product->image, true);
                                    $firstImage = $images[0] ?? null;
                                @endphp

                                @if ($firstImage)
                                    <img src="{{ asset('uploads/products/' . $firstImage) }}"
                                        alt="{{ $product->product_name }}" 
                                        class="max-h-full max-w-full object-contain mix-blend-multiply transition-transform duration-500 group-hover:scale-103">
                                @else
                                    <img src="{{ asset('images/no-image.png') }}" alt="No Image"
                                        class="max-h-full max-w-full object-contain opacity-40">
                                @endif
                            </a>

                            {{-- Product Details Layout --}}
                            <div class="p-4 flex flex-col flex-1">
                                <a href="{{ route('productdetails', $product->id) }}"
                                    class="text-[13.5px] font-bold text-gray-900 mb-1 hover:text-primary transition-colors line-clamp-2 leading-tight">
                                    {{ $product->product_name }}
                                </a>

                                <p class="text-[11.5px] text-gray-400 mb-0 line-clamp-2 leading-relaxed">
                                    {{ Str::limit(strip_tags($product->short_description), 90) }}
                                </p>

                                {{-- Vendor / Location details --}}
                                <div class="mt-auto pt-1 border-t border-gray-50">
                                    <div class="flex items-center justify-between gap-1">
                                        <span class="text-[12px] font-bold text-gray-700 truncate">
                                            {{ $product->vendor->company_name ?? 'Supplier' }}
                                        </span>
                                        <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-500 shrink-0"></i>
                                    </div>

                                    <div class="flex items-center gap-1 mt-0.5 text-[11px] text-gray-400">
                                        <i data-lucide="map-pin" class="w-3 h-3 text-gray-300 shrink-0"></i>
                                        <span class="truncate">{{ $product->vendor->city ?? 'India' }}</span>
                                    </div>
                                </div>
                                {{-- Compact Action Button Group --}}
                                <div class="mt-1 pt-1 flex gap-2 shrink-0">
                                    <a href="{{ route('enquiry', $product->id) }}"
                                        class="flex-1 bg-primary text-white hover:bg-primaryHover py-2 rounded-xl text-[12px] font-bold text-center shadow-sm shadow-primary/5 transition-colors">
                                        Send Enquiry
                                    </a>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $products->links() }}
                </div>
            </main>
        </div>
    </div>

    @include('frontend.layouts.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>