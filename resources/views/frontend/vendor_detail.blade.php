{{-- resources/views/frontend/vendor_details.blade.php --}}

@include('frontend.layouts.header-link')

@include('frontend.layouts.top_bar')
@include('frontend.layouts.main_header')
@include('frontend.layouts.navbar')

<div class="max-w-7xl mx-auto px-4 py-8">

    {{-- COMPANY PROFILE --}}
    <section class="bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6 lg:p-8 mb-8">

        <div class="flex flex-col lg:flex-row gap-8">

            {{-- COMPANY IMAGE --}}
            <div class="w-full lg:w-[320px] shrink-0">

                <div class="rounded-2xl overflow-hidden border border-gray-100 bg-slate-50">

                    @if ($vendor->company_logo)
                        <img src="{{ asset('uploads/vendor_logo/' . $vendor->company_logo) }}"
                            alt="{{ $vendor->company_name }}" class="w-full h-[280px] object-cover">
                    @else
                        <img src="https://via.placeholder.com/400x300" alt="No Image"
                            class="w-full h-[280px] object-cover">
                    @endif

                </div>

            </div>

            {{-- COMPANY DETAILS --}}
            <div class="flex-1">

                <div class="flex items-center gap-3 mb-5">

                    <h1 class="text-[28px] font-bold text-gray-900">

                        {{ $vendor->company_name }}

                    </h1>

                    @if ($vendor->status == 1)
                        <div class="w-7 h-7 rounded-full bg-emerald-100 flex items-center justify-center">

                            <i data-lucide="badge-check" class="w-5 h-5 text-emerald-600"></i>

                        </div>
                    @endif

                </div>

                {{-- INFO GRID --}}
                <div
                    class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-5 bg-slate-50 border border-slate-100 rounded-2xl p-6">

                    {{-- Business Type --}}
                    <div>
                        <div class="text-gray-500 font-medium mb-1">
                            Business Type
                        </div>

                        <div class="font-semibold text-gray-900">
                            {{ $vendor->businessType->business_name ?? 'N/A' }}
                        </div>
                    </div>

                    {{-- Vendor Type --}}
                    <div>
                        <div class="text-gray-500 font-medium mb-1">
                            Vendor Type
                        </div>

                        <div class="font-semibold text-gray-900">
                            {{ $vendor->vendorType->vendor_name ?? 'N/A' }}
                        </div>
                    </div>

                    {{-- Established --}}
                    <div>
                        <div class="text-gray-500 font-medium mb-1">
                            Established
                        </div>

                        <div class="font-semibold text-gray-900">
                            {{ $vendor->year_established ?? 'N/A' }}
                        </div>
                    </div>

                    {{-- Email --}}
                    <div>
                        <div class="text-gray-500 font-medium mb-1">
                            Email
                        </div>

                        <div class="font-semibold text-gray-900 break-all">
                            {{ $vendor->email ?? 'N/A' }}
                        </div>
                    </div>

                    {{-- Category --}}
                    <div>
                        <div class="text-gray-500 font-medium mb-1">
                            Category
                        </div>

                        <div class="font-semibold text-gray-900">
                            {{ $vendor->category->category_name ?? 'N/A' }}
                        </div>
                    </div>

                    {{-- Sub Category --}}
                    <div>
                        <div class="text-gray-500 font-medium mb-1">
                            Sub Category
                        </div>

                        <div class="font-semibold text-gray-900">
                            {{ $vendor->subCategory->sub_category_name ?? 'N/A' }}
                        </div>
                    </div>

                    {{-- Address --}}
                    <div class="md:col-span-2">
                        <div class="text-gray-500 font-medium mb-1">
                            Address
                        </div>

                        <div class="text-gray-900 leading-relaxed">
                            {{ $vendor->address ?? 'N/A' }}
                        </div>
                    </div>

                    {{-- Location --}}
                    <div class="md:col-span-2">
                        <div class="text-gray-500 font-medium mb-1">
                            Location
                        </div>

                        <div class="text-gray-900 leading-relaxed">
                            {{ collect([$vendor->city, $vendor->state, $vendor->country])->filter()->implode(', ') ?:
                                'N/A' }}
                        </div>
                    </div>

                </div>

                {{-- ABOUT US --}}
                <div class="mt-8">

                    <h2 class="text-[20px] font-bold text-gray-900 mb-4">
                        About Company
                    </h2>

                    <div
                        class="bg-slate-50 border border-slate-100 rounded-2xl p-6 text-[15px] text-gray-700 leading-8">

                        {{ $vendor->about_us ?? 'No company details available.' }}

                    </div>

                </div>

            </div>

        </div>

    </section>

    {{-- ALL PRODUCTS --}}
    <section class="bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6 lg:p-8">

        <div class="flex items-center justify-between mb-8">

            <h2 class="text-[24px] font-bold text-gray-900">
                All Products
            </h2>

            <span class="text-[14px] text-gray-500 font-medium">
                {{ $products->count() }} Products
            </span>

        </div>

        @if ($products->count() > 0)

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

                @foreach ($products as $product)
                    @php
                        $images = json_decode($product->image, true);
                    @endphp

                    <a href="{{ route('productdetails', $product->id) }}"
                        class="bg-white rounded-2xl border border-slate-200 hover:border-primary/40 shadow-sm hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:-translate-y-1 transition-all duration-300 overflow-hidden group">

                        {{-- IMAGE --}}
                        <div class="h-52 bg-slate-50 flex items-center justify-center p-4 border-b border-slate-100">

                            @if (!empty($images) && isset($images[0]))
                                <img src="{{ asset('uploads/products/' . $images[0]) }}"
                                    alt="{{ $product->product_name }}"
                                    class="max-w-full max-h-full object-contain group-hover:scale-105 transition-transform duration-500">
                            @else
                                <img src="https://pngimg.com/uploads/engine/engine_PNG31.png" alt="No Image"
                                    class="max-w-full max-h-full object-contain">
                            @endif

                        </div>

                        {{-- CONTENT --}}
                        <div class="p-5">

                            <h3
                                class="text-[15px] font-bold text-gray-900 line-clamp-2 leading-6 mb-3 group-hover:text-primary transition-colors">

                                {{ $product->product_name }}

                            </h3>

                            <div class="space-y-2 text-[13px]">

                                <div class="flex justify-between gap-3">

                                    <span class="text-gray-500">
                                        Brand
                                    </span>

                                    <span class="font-semibold text-gray-900">
                                        {{ $product->brand ?? 'N/A' }}
                                    </span>

                                </div>

                                <div class="flex justify-between gap-3">

                                    <span class="text-gray-500">
                                        Model
                                    </span>

                                    <span class="font-semibold text-gray-900">
                                        {{ $product->model_number ?? 'N/A' }}
                                    </span>

                                </div>

                            </div>

                            <div class="mt-5 flex items-center justify-between text-primary font-bold text-[14px]">

                                View Product

                                <i data-lucide="arrow-up-right" class="w-4 h-4"></i>

                            </div>

                        </div>

                    </a>
                @endforeach

            </div>
        @else
            <div class="text-center py-20 bg-slate-50 rounded-2xl border border-dashed border-slate-200">

                <i data-lucide="package-search" class="w-16 h-16 text-slate-300 mx-auto mb-4"></i>

                <h3 class="text-[18px] font-bold text-gray-800 mb-2">
                    No Products Found
                </h3>

                <p class="text-gray-500">
                    This vendor has not added any products yet.
                </p>

            </div>

        @endif

    </section>
    @if ($services->count() > 0)
        <section class="bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6 lg:p-8">

            <div class="flex items-center justify-between mb-8">

                <h2 class="text-[24px] font-bold text-gray-900">
                    All Service
                </h2>

                <span class="text-[14px] text-gray-500 font-medium">
                    {{ $services->count() }} Service
                </span>

            </div>

            @if ($services->count() > 0)

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @forelse($services as $service)
                        @php
                            $features = json_decode($service->feature, true);
                        @endphp

                        <div
                            class="bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] transition-all duration-300 flex flex-col group">

                            {{-- IMAGE --}}
                            <div class="relative h-[200px] overflow-hidden">

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
                                        alt="{{ $service->service_name }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <img src="https://via.placeholder.com/600x400" class="w-full h-full object-cover">
                                @endif

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                                </div>

                                <h3
                                    class="absolute bottom-3 left-4 right-4 text-white font-bold text-[17px] leading-snug">

                                    {{ $service->service_name }}

                                </h3>

                            </div>

                            {{-- CONTENT --}}
                            <div class="p-5 flex flex-col flex-1">

                                <div class="flex items-center justify-between mb-4">

                                    <span class="bg-[#fff8e1] text-[#f57f17] px-2 py-1 rounded text-[11px] font-bold">

                                        {{ ucfirst($service->price_type) }}

                                    </span>

                                    <span class="text-emerald-600 text-[12px] font-medium">

                                        Active

                                    </span>

                                </div>

                                {{-- DESCRIPTION --}}
                                <p class="text-[13px] text-gray-600 leading-relaxed mb-4 line-clamp-3">

                                    {{ $service->short_description }}

                                </p>

                                {{-- FEATURES --}}
                                @if (!empty($features))
                                    <div class="mb-5">

                                        <span class="text-[13px] font-bold text-gray-800 block mb-2">

                                            Features

                                        </span>

                                        <ul class="text-[13px] text-gray-600 space-y-1 list-disc pl-5">

                                            @foreach (array_slice($features, 0, 3) as $feature)
                                                <li>

                                                    {{ $feature['value'] ?? '' }}

                                                </li>
                                            @endforeach

                                        </ul>

                                    </div>
                                @endif

                                {{-- BUTTONS --}}
                                <div class="mt-auto flex gap-3">

                                    <button
                                        class="flex-1 bg-primary text-white py-2 rounded-xl text-[13px] font-bold hover:bg-primaryHover transition-all">

                                        Send Enquiry

                                    </button>
                                    <a href="{{ route('service.details', $service->id) }}"
                                        class="flex-1 border border-primary text-primary py-2 rounded-xl text-[13px] font-bold hover:bg-primary/5 transition-all text-center inline-block">
                                        View Details
                                    </a>

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="col-span-3 text-center py-10 text-gray-500">

                            No Services Found

                        </div>
                    @endforelse

                </div>
            @else
                <div class="text-center py-20 bg-slate-50 rounded-2xl border border-dashed border-slate-200">

                    <i data-lucide="package-search" class="w-16 h-16 text-slate-300 mx-auto mb-4"></i>

                    <h3 class="text-[18px] font-bold text-gray-800 mb-2">
                        No Products Found
                    </h3>

                    <p class="text-gray-500">
                        This vendor has not added any products yet.
                    </p>

                </div>

            @endif

        </section>

    @endif
        @if ($properties->count() > 0)
        <section class="bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6 lg:p-8">
    
            <div class="flex items-center justify-between mb-8">
    
                <h2 class="text-[24px] font-bold text-gray-900">
                    All Property
                </h2>
    
                <span class="text-[14px] text-gray-500 font-medium">
                    {{ $properties->count() }} Products
                </span>
    
            </div>
    
            @if ($properties->count() > 0)
    
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5">

                @foreach ($properties as $estate)
                    @php
                        $images = json_decode($estate->proerty_image, true);
                    @endphp

                    <div
                        class="bg-white rounded-2xl overflow-hidden border border-gray-200 hover:shadow-xl transition-all duration-300 group">

                        {{-- IMAGE --}}
                        <div class="relative h-[200px] overflow-hidden">

                            @php
                                $images = [];

                                if ($estate->proerty_image) {
                                    $decoded = json_decode($estate->proerty_image, true);

                                    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                        $images = $decoded;
                                    } else {
                                        $images = [$estate->proerty_image];
                                    }
                                }
                            @endphp

                            @if (!empty($images) && !empty($images[0]))
                                <img src="{{ asset('uploads/relastate/images/' . $images[0]) }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" class="w-full h-full object-cover">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent">
                            </div>

                            <span
                                class="absolute top-3 left-3 bg-primary text-white text-[11px] px-3 py-1 rounded-full font-bold">

                                {{ $estate->property_for }}

                            </span>

                            <h3 class="absolute bottom-3 left-4 right-4 text-white font-bold text-[16px]">

                                {{ $estate->property_title }}

                            </h3>

                        </div>

                        {{-- CONTENT --}}
                        <div class="p-4">

                            <div class="text-[13px] text-gray-500 mb-2">

                                {{ $estate->city }},
                                {{ $estate->state }}

                            </div>

                            <div class="text-[13px] text-gray-600 line-clamp-2 mb-4">

                                {{ $estate->descripction }}

                            </div>

                            {{-- <button
                                class="w-full bg-primary text-white py-2 rounded-xl text-[13px] font-bold hover:bg-primaryHover transition-all">

                                View Details

                            </button> --}}
                            {{-- <a href="{{ route('properties.show', $estate->id) }}"
                                class="flex-1 border border-primary text-primary py-2 rounded-xl text-[13px] font-bold hover:bg-primary/5 transition-all text-center inline-block">
                                View Details
                            </a> --}}
                             <a href="{{ route('properties.show', $estate->id) }}"
                                        class="w-full bg-primary text-white py-2 rounded-xl text-[13px] font-bold hover:bg-primaryHover transition-all text-center inline-block">
                                        View Details
                                    </a>



                        </div>

                    </div>
                @endforeach

            </div>
            @else
                <div class="text-center py-20 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
    
                    <i data-lucide="package-search" class="w-16 h-16 text-slate-300 mx-auto mb-4"></i>
    
                    <h3 class="text-[18px] font-bold text-gray-800 mb-2">
                        No Products Found
                    </h3>
    
                    <p class="text-gray-500">
                        This vendor has not added any products yet.
                    </p>
    
                </div>
    
            @endif
    
        </section>
            
        @endif



</div>

<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>

@include('frontend.layouts.footer')
