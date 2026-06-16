{{-- resources/views/vendor/manufacturer/products_show.blade.php --}}

@include('vendor.Layout.head')

@php

use App\Models\VendorType;
use App\Models\Category;
use App\Models\SubCategory;

$vendorType = VendorType::find($vendor->vendor_type_id);

$category = Category::find($product->category_id);

$subCategory = SubCategory::find($product->sub_category_id);

$images = json_decode($product->image, true);

$dataSheets = json_decode($product->data_sheet, true);

$keyValues = json_decode($product->key_value, true);

$specifications = json_decode($product->specification, true);

$productDetails = json_decode($product->product_details, true);

@endphp

<body class="bg-slate-50 text-gray-800 antialiased font-sans">

@include('vendor.Layout.top_bar')

    {{-- HEADER --}}
    @include('vendor.Layout.main_header')

<div class="min-h-screen py-8">

    <div class="max-w-7xl mx-auto px-4">

      @include('vendor.Layout.menu_bar')

        <main class="flex-1 space-y-8 w-full">

            {{-- COMPANY PROFILE --}}
            <section
                class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 lg:p-8">

              <div class="flex items-center justify-between border-b border-gray-100 pb-5 mb-6">

                    <h2 class="text-[20px] font-bold text-gray-900">
                        Company Profile
                    </h2>

                    {{-- BACK BUTTON --}}
                    <a href="{{ url()->previous() }}"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl border border-slate-200 bg-white text-sm font-semibold text-gray-700 hover:bg-slate-50 transition">

                        <i data-lucide="arrow-left" class="w-4 h-4"></i>

                        Back

                    </a>

                </div>

                {{-- COVER IMAGE --}}
                <div class="w-full h-72 rounded-2xl overflow-hidden bg-slate-100 mb-8">

                   

                        <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                             class="w-full h-full object-cover">

                   

                </div>

                <div class="grid lg:grid-cols-[280px_1fr] gap-8">

                    {{-- COMPANY LOGO --}}
                    <div>

                        <div class="w-52 h-52 rounded-3xl overflow-hidden border border-slate-200 shadow-sm mx-auto">

                            @if($vendor->company_logo)

                                <img src="{{ asset('uploads/vendor_logo/'.$vendor->company_logo) }}"
                                     class="w-full h-full object-cover">

                            @else

                                <img src="https://ui-avatars.com/api/?name={{ urlencode($vendor->company_name) }}"
                                     class="w-full h-full object-cover">

                            @endif

                        </div>

                    </div>

                    {{-- COMPANY DETAILS --}}
                    <div class="space-y-5">

                        <div class="flex items-center gap-2">

                            <h1 class="text-[28px] font-bold text-gray-900">

                                {{ $vendor->company_name }}

                            </h1>

                            @if($vendor->status == 1)

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="24"
                                 height="24"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2"
                                 stroke-linecap="round"
                                 stroke-linejoin="round"
                                 class="w-6 h-6 text-emerald-500">

                                <path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"></path>

                                <path d="m9 12 2 2 4-4"></path>

                            </svg>

                            @endif

                        </div>

                        <div class="grid grid-cols-[180px_1fr] gap-y-4 text-[14px]">

                            <div class="text-gray-500 font-medium">
                                Business Type:
                            </div>

                            <div class="font-semibold text-gray-900">

                                {{ $vendorType->vendor_name ?? 'N/A' }}

                            </div>


                            <div class="text-gray-500 font-medium">
                                 Product:
                            </div>

                            <div class="font-semibold text-gray-900">

                                {{ $product->product_name }}

                            </div>


                            <div class="text-gray-500 font-medium">
                                Brand:
                            </div>

                            <div class="font-semibold text-gray-900">

                                {{ $product->brand ?? 'N/A' }}

                            </div>


                     


                            <div class="text-gray-500 font-medium">
                                Established:
                            </div>

                            <div class="font-semibold text-gray-900">

                                {{ $vendor->year_established ?? 'N/A' }}

                            </div>


                            <div class="text-gray-500 font-medium">
                                Address:
                            </div>

                            <div class="text-gray-900 leading-relaxed">

                                {{ $vendor->address ?? 'N/A' }}

                            </div>

                                    <div class="text-gray-500 font-medium">
                                Location
                            </div>

                            <div class="text-gray-900 leading-relaxed">

                                {{ collect([
                                    $vendor->city,
                                    $vendor->state,
                                    $vendor->country
                                ])->filter()->implode(', ') ?: 'N/A' }}

                            </div>

                        </div>

                        <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200">

                            <div class="grid md:grid-cols-2 gap-4 text-sm">

                                <div>
                                    <span class="text-gray-500">
                                        Email:
                                    </span>

                                    <div class="font-semibold text-gray-900 mt-1">
                                        {{ $vendor->email }}
                                    </div>
                                </div>

                                <div>
                                    <span class="text-gray-500">
                                        Company GST:
                                    </span>

                                    <div class="font-semibold text-gray-900 mt-1">
                                        {{ $vendor->gst_no ?? 'N/A' }}
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- ABOUT --}}
                <div class="mt-8 text-[14px] text-gray-600 leading-8">

                    {{ $vendor->about_us ?? 'No company details available.' }}

                </div>

            </section>


            {{-- PRODUCT DETAILS --}}
            <section
                class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 lg:p-8">

                <div class="border-b border-gray-100 pb-5 mb-6">

                    <h2 class="text-[20px] font-bold text-gray-900">
                        Product Details
                    </h2>

                </div>

                <div class="grid md:grid-cols-2 gap-y-6 gap-x-10 text-[14px]">

                    <div class="grid grid-cols-[180px_1fr] items-center">

                        <span class="text-gray-500">
                            Product Name:
                        </span>

                        <span class="font-semibold text-gray-900">

                            {{ $product->product_name }}

                        </span>

                    </div>


                    <div class="grid grid-cols-[180px_1fr] items-center">

                        <span class="text-gray-500">
                            Category:
                        </span>

                        <span class="font-semibold text-gray-900">

                            {{ $category->category_name ?? 'N/A' }}

                        </span>

                    </div>


                    <div class="grid grid-cols-[180px_1fr] items-center">

                        <span class="text-gray-500">
                            Sub Category:
                        </span>

                        <span class="font-semibold text-gray-900">

                            {{ $subCategory->sub_category_name ?? 'N/A' }}

                        </span>

                    </div>


                    <div class="grid grid-cols-[180px_1fr] items-center">

                        <span class="text-gray-500">
                            Brand:
                        </span>

                        <span class="font-semibold text-gray-900">

                            {{ $product->brand ?? 'N/A' }}

                        </span>

                    </div>

                </div>

            </section>


            {{-- SHORT DESCRIPTION --}}
            <section
                class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 lg:p-8">

                <div class="border-b border-gray-100 pb-5 mb-6">

                    <h2 class="text-[20px] font-bold text-gray-900">
                        Product Description
                    </h2>

                </div>

                <div class="text-[14px] leading-8 text-gray-600">

                    {{ $product->short_description ?? 'No description available.' }}

                </div>

            </section>


            {{-- KEY VALUE --}}
            @if(is_array($keyValues) && count($keyValues) > 0)

            <section
                class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 lg:p-8">

                <div class="border-b border-gray-100 pb-5 mb-6">

                    <h2 class="text-[20px] font-bold text-gray-900">
                        Product Information
                    </h2>

                </div>

                <div class="grid md:grid-cols-2 gap-6">

                    @foreach($keyValues as $item)

                    <div class="flex justify-between border-b border-slate-100 pb-3">

                        <span class="text-gray-500">

                            {{ $item['key'] ?? '' }}

                        </span>

                        <span class="font-semibold text-gray-900">

                            {{ $item['value'] ?? '' }}

                        </span>

                    </div>

                    @endforeach

                </div>

            </section>

            @endif


            {{-- SPECIFICATIONS --}}
            @if(is_array($specifications) && count($specifications) > 0)

            <section
                class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 lg:p-8">

                <div class="border-b border-gray-100 pb-5 mb-6">

                    <h2 class="text-[20px] font-bold text-gray-900">
                        Specifications
                    </h2>

                </div>

                <div class="space-y-5">

                    @foreach($specifications as $spec)

                    <div class="flex justify-between border-b border-slate-100 pb-4">

                        <span class="text-gray-500">

                            {{ $spec['name'] ?? '' }}

                        </span>

                        <span class="font-semibold text-gray-900">

                            {{ $spec['value'] ?? '' }}

                        </span>

                    </div>

                    @endforeach

                </div>

            </section>

            @endif


            {{-- PRODUCT IMAGES --}}
            @if(is_array($images) && count($images) > 0)

            <section
                class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 lg:p-8">

                <div class="border-b border-gray-100 pb-5 mb-6">

                    <h2 class="text-[20px] font-bold text-gray-900">
                        Product Gallery
                    </h2>

                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-5">

                    @foreach($images as $image)

                    <div class="rounded-2xl overflow-hidden border border-slate-200">

                        <img src="{{ asset('uploads/products/'.$image) }}"
                             class="w-full h-52 object-cover hover:scale-105 transition duration-300">

                    </div>

                    @endforeach

                </div>

            </section>

            @endif


            {{-- DATASHEET --}}
            @if(is_array($dataSheets) && count($dataSheets) > 0)

            <section
                class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 lg:p-8">

                <div class="border-b border-gray-100 pb-5 mb-6">

                    <h2 class="text-[20px] font-bold text-gray-900">
                        Product Datasheets
                    </h2>

                </div>

                <div class="flex flex-wrap gap-4">

                    @foreach($dataSheets as $sheet)

                    <a href="{{ asset('uploads/datasheets/'.$sheet) }}"
                       target="_blank"
                       class="inline-flex items-center gap-2 bg-primary text-white px-5 py-3 rounded-xl font-semibold">

                        <i class="fas fa-file-pdf"></i>

                        View Datasheet

                    </a>

                    @endforeach

                </div>

            </section>

            @endif

        </main>

    </div>

</div>

@include('vendor.Layout.footer')

</body>

</html>