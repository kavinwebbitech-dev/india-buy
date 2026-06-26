@include('frontend.layouts.header-link')

@include('frontend.layouts.top_bar')

@include('frontend.layouts.main_header')

@include('frontend.layouts.navbar')

<div class="max-w-full mx-auto px-4 py-8">

    {{-- PAGE TITLE --}}
    <div
        class="bg-gradient-to-r from-gray-50 to-red-50 p-6 rounded-2xl border border-gray-100 shadow-sm mb-8 text-center">
        <h1 class="text-2xl font-black text-gray-950 tracking-tight">
            Explore All Services
        </h1>
        <p class="text-sm text-gray-600 mt-1">Find the best professional services tailored for you</p>
    </div>

    {{-- MAIN LAYOUT WITH SIDEBAR --}}
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-12">

        {{-- ========================================== --}}
        {{-- SIDEBAR FILTERS (MODERN BADGE STYLE) --}}
        {{-- ========================================== --}}
        <div class="lg:col-span-1">
            <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm sticky top-6">
                <div class="flex items-center justify-between mb-5 pb-3 border-b border-gray-100">
                    <h3 class="text-sm font-bold text-gray-900 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-red-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        Filter Options
                    </h3>
                    @if (request()->has('search') ||
                            request()->has('category_id') ||
                            request()->has('sub_category_id') ||
                            request()->has('price_type'))
                        <a href="{{ url()->current() }}" class="text-xs text-red-600 hover:underline font-bold">Clear
                            All</a>
                    @endif
                </div>

                <form action="{{ url()->current() }}" method="GET" id="filterForm" class="space-y-5">
                    {{-- Hidden inputs to preserve category selections --}}
                    <input type="hidden" name="category_id" id="category_id_input"
                        value="{{ request('category_id') }}">
                    <input type="hidden" name="sub_category_id" id="sub_category_id_input"
                        value="{{ request('sub_category_id') }}">

                    {{-- 1. Search Filter --}}
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Search
                            Service</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="What are you looking for?"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3.5 py-2 text-xs text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                    </div>

                    {{-- 2. Category & Sub Category Filter (NO RADIO BUTTONS) --}}
                    <div>
                        <label
                            class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Categories</label>
                        <div class="space-y-1.5 max-h-64 overflow-y-auto pr-1 scrollbar-thin">

                            {{-- All Categories Option --}}
                            <button type="button" onclick="filterBy('category', '')"
                                class="w-full text-left px-3 py-1.5 rounded-lg text-xs font-semibold transition-all flex items-center justify-between {{ !request('category_id') && !request('sub_category_id') ? 'bg-red-50 text-red-700 font-bold' : 'text-gray-700 hover:bg-gray-50' }}">
                                <span>All Categories</span>
                                @if (!request('category_id') && !request('sub_category_id'))
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                                @endif
                            </button>

                            @foreach ($categories as $category)
                                <div class="space-y-1">
                                    {{-- Main Category Item --}}
                                    <button type="button" onclick="filterBy('category', '{{ $category->id }}')"
                                        class="w-full text-left px-3 py-1.5 rounded-lg text-xs font-medium transition-all flex items-center justify-between {{ request('category_id') == $category->id ? 'bg-red-50 text-red-700 font-bold' : 'text-gray-800 hover:bg-gray-50' }}">
                                        <span class="truncate">{{ $category->category_name }}</span>
                                        @if (request('category_id') == $category->id)
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span>
                                        @endif
                                    </button>

                                    {{-- Sub Categories (Rendered as indented sub-badges) --}}
                                    @if ($category->subcategories->count() > 0)
                                        <div class="pl-4 border-l border-gray-100 ml-3 space-y-1 my-1">
                                            @foreach ($category->subcategories as $subCat)
                                                <button type="button"
                                                    onclick="filterBy('subcategory', '{{ $subCat->id }}')"
                                                    class="w-full text-left px-2.5 py-1 rounded-md text-[11px] transition-all flex items-center justify-between {{ request('sub_category_id') == $subCat->id ? 'bg-gray-900 text-white font-semibold' : 'text-gray-500 hover:text-red-600 hover:bg-gray-50' }}">
                                                    <span class="truncate">{{ $subCat->sub_category_name }}</span>
                                                </button>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- 3. Price Type Filter --}}
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Price
                            Type</label>
                        <select name="price_type" onchange="this.form.submit()"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-3 py-2 text-xs text-gray-900 focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all">
                            <option value="">All Types</option>
                            <option value="fixed" {{ request('price_type') == 'fixed' ? 'selected' : '' }}>Fixed
                            </option>
                            <option value="hourly" {{ request('price_type') == 'hourly' ? 'selected' : '' }}>Hourly
                            </option>
                        </select>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit"
                        class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-xl text-xs font-bold shadow-sm transition-all flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Apply Filters
                    </button>
                </form>
            </div>
        </div>

        {{-- ========================================== --}}
        {{-- SERVICE LIST CONTENT (4-Columns Compact Design) --}}
        {{-- ========================================== --}}
        <div class="lg:col-span-3" id="all-services">

            <div class="flex items-center justify-between mb-4">
                <h2 class="text-base font-bold text-gray-900">
                    Available Services ({{ $services->total() }})
                </h2>
            </div>

            {{-- Grid changed to 3 columns on lg layout to look cleaner with smaller sizes --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

                @forelse($services as $service)
                    @php
                        $features = json_decode($service->feature, true);
                    @endphp

                    {{-- Compact Card Layout --}}
                    <div
                        class="bg-white rounded-xl border border-gray-200 overflow-hidden hover:shadow-md transition-all duration-200 flex flex-col group">

                        {{-- IMAGE SECTION (Reduced Height) --}}
                        <div class="relative h-[140px] overflow-hidden bg-gray-50">
                            @php
                                $images = json_decode($service->service_img, true);
                                if (json_last_error() === JSON_ERROR_NONE && is_array($images)) {
                                    $image = $images[0] ?? null;
                                } else {
                                    $image = $service->service_img;
                                }
                            @endphp

                            @if ($image && file_exists(public_path('uploads/service/images/' . $image)))
                                <img src="{{ asset('uploads/service/images/' . $image) }}"
                                    alt="{{ $service->service_name }}"
                                    onerror="this.src='https://via.placeholder.com/600x400?text=Service'"
                                    class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-500">
                            @else
                                <img src="https://via.placeholder.com/600x400?text=No+Image"
                                    class="w-full h-full object-cover">
                            @endif

                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                            </div>

                            <h3
                                class="absolute bottom-2 left-3 right-3 text-white font-bold text-sm leading-snug line-clamp-2">
                                {{ $service->service_name }}
                            </h3>
                        </div>

                        {{-- CARD BODY (Compact Padding) --}}
                        <div class="p-3.5 flex flex-col flex-1">
                            <div class="flex items-center justify-between mb-2">
                                <span
                                    class="bg-gray-100 text-gray-800 px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider">
                                    {{ $service->price_type ?? 'Fixed' }}
                                </span>
                                <span class="flex items-center gap-1 text-emerald-600 text-[11px] font-medium">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Active
                                </span>
                            </div>

                            {{-- DESCRIPTION (Reduced text size & height) --}}
                            <p class="text-[12px] text-gray-500 leading-normal mb-3 line-clamp-2 h-[36px]">
                                {{ $service->short_description }}
                            </p>

                            {{-- HIGHLIGHTS --}}
                            @if (!empty($features))
                                <div class="mb-3 bg-gray-50 p-2 rounded-lg border border-gray-100/80">
                                    <ul class="text-[11px] text-gray-500 space-y-0.5 list-disc pl-3.5">
                                        @foreach (array_slice($features, 0, 1) as $feature)
                                            <li class="line-clamp-1">
                                                {{ $feature['value'] ?? '' }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <div class="mb-3 h-[26px]"></div>
                            @endif

                            {{-- COMPACT BUTTONS --}}
                            <div class="mt-auto flex gap-2 pt-1">
                                <button
                                    class="flex-1 bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg text-[11px] font-bold transition-all">
                                    Enquiry
                                </button>
                                <a href="{{ route('service.details', $service->id) }}"
                                    class="flex-1 border border-gray-200 text-gray-700 py-2 rounded-lg text-[11px] font-bold hover:bg-gray-50 transition-all text-center inline-block">
                                    Details
                                </a>
                            </div>
                        </div>
                    </div>

                @empty
                    <div
                        class="col-span-3 text-center py-12 bg-gray-50 rounded-xl border border-dashed border-gray-200">
                        <p class="text-gray-400 text-xs font-medium">No Services Found matching your criteria.</p>
                    </div>
                @endforelse

            </div>

            {{-- PAGINATION --}}
            <div class="mt-8">
                {{ $services->links() }}
            </div>

        </div>
    </div>

    {{-- ========================================== --}}
    {{-- LATEST REAL ESTATE SECTION --}}
    {{-- ========================================== --}}
    <div class="border-t border-gray-200 pt-10 mb-12">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-base font-bold text-gray-900">
                    Latest Real Estate Properties
                </h2>
                <p class="text-xs text-gray-400 mt-0.5">Recently added featured properties for sale & rent</p>
            </div>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @foreach ($latestRealEstates as $estate)
                <div
                    class="bg-white rounded-xl overflow-hidden border border-gray-200 hover:shadow-md transition-all duration-200 group flex flex-col">

                    <div class="relative h-[120px] overflow-hidden bg-gray-50">
                        @php
                            $estateImages = json_decode($estate->proerty_image, true);

                            if (!is_array($estateImages)) {
                                $estateImages = [$estate->proerty_image];
                            }

                            $image = !empty($estateImages[0])
                                ? asset('uploads/relastate/images/' . $estateImages[0])
                                : asset('images/no-image.png');
                                // dd($image);
                        @endphp

                        <img src="{{ $image }}" class="w-full h-full object-cover">

                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/10 to-transparent"></div>

                        <span
                            class="absolute top-1.5 left-1.5 bg-red-600 text-white text-[9px] px-2 py-0.5 rounded font-bold uppercase tracking-wider shadow-sm">
                            {{ $estate->property_for }}
                        </span>

                        <h3 class="absolute bottom-1.5 left-2 right-2 text-white font-bold text-xs line-clamp-1">
                            {{ $estate->property_title }}
                        </h3>
                    </div>

                    <div class="p-3 flex flex-col flex-1 bg-white">
                        <div class="text-[11px] text-gray-400 font-medium flex items-center gap-1 mb-1.5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-red-500 shrink-0"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                            <span class="truncate">{{ $estate->city }}</span>
                        </div>

                        <p class="text-[11px] text-gray-500 line-clamp-2 mb-3 flex-1 h-[32px] leading-snug">
                            {{ $estate->descripction }}
                        </p>

                        <a href="{{ route('properties.show', $estate->id) }}"
                            class="w-full bg-red-600 hover:bg-red-700 text-white py-1.5 rounded-lg text-[11px] font-bold text-center transition-all inline-block shadow-sm">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

{{-- Inline JavaScript logic to submit form on badge clicks --}}
<script>
    function filterBy(type, id) {
        if (type === 'category') {
            document.getElementById('category_id_input').value = id;
            document.getElementById('sub_category_id_input').value = ''; // Reset subcat if new category clicked
        } else if (type === 'subcategory') {
            document.getElementById('sub_category_id_input').value = id;
        }
        document.getElementById('filterForm').submit();
    }
</script>

@include('frontend.layouts.footer')
