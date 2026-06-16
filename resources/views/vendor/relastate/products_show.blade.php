@include('vendor.relastate.Layout.head')

@php

use Illuminate\Support\Facades\Auth;
use App\Models\VendorType;
use App\Models\BusinessType;

@endphp

<body class="text-gray-800 antialiased font-sans bg-slate-50">

@include('vendor.relastate.Layout.top_bar')

@include('vendor.relastate.Layout.main_header')

<div class="min-h-screen py-8">

    <div class="max-w-7xl mx-auto px-4">

        @include('vendor.relastate.Layout.service_menubar')

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">

            {{-- HEADER --}}
            <div class="flex items-center justify-between mb-8">

                <div>

                    <h2 class="text-2xl font-bold text-gray-900">
                        Property Listings
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Manage your created property pages
                    </p>

                </div>

                <a href="{{ route('relastate.product.create') }}"
                   class="bg-primary text-white px-5 py-3 rounded-xl text-sm font-bold hover:bg-primaryHover transition">

                    + Add Property

                </a>

            </div>

            {{-- PROPERTIES --}}
            @forelse($services as $property)

            @php

                $vendorType = VendorType::find($vendor->vendor_type_id);

                $business = BusinessType::find($vendor->business_id);

                /*
                |--------------------------------------------------------------------------
                | PROPERTY IMAGES
                |--------------------------------------------------------------------------
                */

                $images = json_decode($property->proerty_image ?? '[]', true);

                /*
                |--------------------------------------------------------------------------
                | FEATURES
                |--------------------------------------------------------------------------
                */

                $features = json_decode($property->features ?? '[]', true);

                /*
                |--------------------------------------------------------------------------
                | SPECIFICATIONS
                |--------------------------------------------------------------------------
                */

                $specifications = json_decode($property->specification ?? '[]', true);

                /*
                |--------------------------------------------------------------------------
                | DATASHEETS
                |--------------------------------------------------------------------------
                */

                $datasheets = json_decode($property->datasheet ?? '[]', true);

            @endphp

            <div class="mb-10 border border-slate-200 rounded-3xl overflow-hidden shadow-sm bg-white">

                {{-- COVER IMAGE --}}
                <div class="h-72 w-full bg-slate-200 overflow-hidden relative">

                    <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                             class="w-full h-full object-cover">

                    <div class="absolute inset-0 bg-black/30"></div>

                </div>

                {{-- COMPANY PROFILE --}}
                <div class="px-6 pb-8 relative flex flex-col items-center text-center -mt-16">

                    {{-- COMPANY LOGO --}}
                    <div class="w-32 h-32 rounded-3xl border-4 border-white bg-white shadow-lg overflow-hidden relative z-10 mb-4">

                        @if($vendor->company_logo)

                            <img src="{{ asset('uploads/vendor_logo/'.$vendor->company_logo) }}"
                                 class="w-full h-full object-cover">

                        @else

                            <img src="https://ui-avatars.com/api/?name={{ urlencode($vendor->company_name) }}"
                                 class="w-full h-full object-cover">

                        @endif

                    </div>

                    {{-- COMPANY NAME --}}
                    <div class="flex items-center gap-2 mb-2">

                        <h1 class="text-3xl font-bold text-gray-900">

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

                    {{-- TYPE + BUSINESS --}}
                    <p class="text-sm text-gray-500 mb-4">

                        {{ $vendorType->vendor_name ?? 'Vendor' }}

                        •

                        {{ $business->business_name ?? 'Business' }}

                    </p>

                    {{-- PROPERTY TITLE --}}
                    <div class="inline-flex items-center px-4 py-2 bg-primary/10 text-primary rounded-full text-sm font-semibold">

                        {{ $property->property_title }}

                    </div>

                </div>

                {{-- ABOUT COMPANY --}}
                <div class="px-6 pb-6">

                    <div class="bg-slate-50 rounded-2xl p-6">

                        <h3 class="text-lg font-bold text-gray-900 mb-4">

                            About Company

                        </h3>

                        <p class="text-sm leading-7 text-gray-600">

                            {{ $vendor->about_us ?? 'No company description available.' }}

                        </p>

                    </div>

                </div>

                {{-- COMPANY DETAILS --}}
                <div class="grid md:grid-cols-4 gap-5 px-6 pb-8">

                    <div class="border border-slate-200 rounded-2xl p-5">

                        <p class="text-xs text-gray-400 mb-2">
                            Company Email
                        </p>

                        <h4 class="font-bold text-gray-900 break-all">

                            {{ $vendor->email }}

                        </h4>

                    </div>

                    <div class="border border-slate-200 rounded-2xl p-5">

                        <p class="text-xs text-gray-400 mb-2">
                            Location
                        </p>

                        <h4 class="font-bold text-gray-900">

                            {{ $property->city }},
                            {{ $property->state }}

                        </h4>

                    </div>

                    <div class="border border-slate-200 rounded-2xl p-5">

                        <p class="text-xs text-gray-400 mb-2">
                            Property Type
                        </p>

                        <h4 class="font-bold text-gray-900">

                            {{ $property->property_type }}

                        </h4>

                    </div>

                    <div class="border border-slate-200 rounded-2xl p-5">

                        <p class="text-xs text-gray-400 mb-2">
                            Property For
                        </p>

                        <h4 class="font-bold text-gray-900">

                            {{ $property->property_for }}

                        </h4>

                    </div>

                </div>

                {{-- DESCRIPTION --}}
                <div class="px-6 pb-6">

                    <div class="border border-slate-200 rounded-2xl p-6">

                        <h3 class="text-lg font-bold text-gray-900 mb-4">

                            Property Description

                        </h3>

                        <p class="text-sm leading-7 text-gray-600">

                            {{ $property->descripction ?? 'No description available.' }}

                        </p>

                    </div>

                </div>

                {{-- SPECIFICATIONS --}}
                @if(!empty($specifications))

                <div class="px-6 pb-8">

                    <div class="border border-slate-200 rounded-2xl p-6">

                        <h3 class="text-lg font-bold text-gray-900 mb-5">

                            Specifications

                        </h3>

                        <div class="grid md:grid-cols-2 gap-4">

                            @foreach($specifications as $spec)

                                <div class="flex items-center justify-between border rounded-xl px-4 py-3">

                                    <span class="font-semibold text-gray-700">

                                        {{ $spec['key'] ?? '' }}

                                    </span>

                                    <span class="text-gray-600">

                                        {{ $spec['value'] ?? '' }}

                                    </span>

                                </div>

                            @endforeach

                        </div>

                    </div>

                </div>

                @endif

                {{-- FEATURES --}}
                @if(!empty($features))

                <div class="px-6 pb-8">

                    <div class="border border-slate-200 rounded-2xl p-6">

                        <h3 class="text-lg font-bold text-gray-900 mb-5">

                            Features

                        </h3>

                        <div class="grid md:grid-cols-2 gap-4">

                            @foreach($features as $feature)

                            <div class="flex items-center gap-3">

                                <div class="w-2 h-2 rounded-full bg-primary"></div>

                                <span class="text-sm text-gray-700">

                                    {{ $feature['key'] ?? '' }}
                                    :

                                    {{ $feature['value'] ?? '' }}

                                </span>

                            </div>

                            @endforeach

                        </div>

                    </div>

                </div>

                @endif

                {{-- ADDRESS --}}
                <div class="px-6 pb-8">

                    <div class="grid md:grid-cols-2 gap-5">

                        <div class="border border-slate-200 rounded-2xl p-5">

                            <p class="text-xs text-gray-400 mb-2">
                                Address
                            </p>

                            <h4 class="font-bold text-gray-900">

                                {{ $property->address }}

                            </h4>

                        </div>

                        <div class="border border-slate-200 rounded-2xl p-5">

                            <p class="text-xs text-gray-400 mb-2">
                                Landmark
                            </p>

                            <h4 class="font-bold text-gray-900">

                                {{ $property->landmark }}

                            </h4>

                        </div>

                    </div>

                </div>

                {{-- DATASHEETS --}}
                @if(!empty($datasheets))

                <div class="px-6 pb-8">

                    <div class="border border-slate-200 rounded-2xl p-6">

                        <h3 class="text-lg font-bold text-gray-900 mb-5">

                            Property Datasheets

                        </h3>

                        <div class="flex flex-wrap gap-4">

                            @foreach($datasheets as $file)

                                <a href="{{ asset('uploads/relastate/datasheet/'.$file) }}"
                                   target="_blank"
                                   class="inline-flex items-center gap-2 bg-primary text-white px-5 py-3 rounded-xl font-semibold hover:opacity-90 transition">

                                    📄 {{ $file }}

                                </a>

                            @endforeach

                        </div>

                    </div>

                </div>

                @endif

                {{-- GALLERY --}}
                @if(!empty($images))

                <div class="px-6 pb-8">

                    <div class="border border-slate-200 rounded-2xl p-6">

                        <h3 class="text-lg font-bold text-gray-900 mb-5">

                            Property Gallery

                        </h3>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">

                            @foreach($images as $image)

                            <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-sm">

                                <img src="{{ asset('uploads/realestate/images/'.$image) }}"
                                     class="w-full h-48 object-cover hover:scale-105 transition duration-300">

                            </div>

                            @endforeach

                        </div>

                    </div>

                </div>

                @endif

            </div>

            @empty

            <div class="text-center py-20">

                <h3 class="text-2xl font-bold text-gray-700 mb-3">

                    No Properties Found

                </h3>

                <p class="text-gray-500 mb-6">

                    Create your first property listing to display here.

                </p>

                <a href="{{ route('relastate.product.create') }}"
                   class="inline-flex items-center bg-primary text-white px-5 py-3 rounded-xl font-semibold">

                    + Create Property

                </a>

            </div>

            @endforelse

        </div>

    </div>

</div>

@include('vendor.Layout.footer')

</body>

</html>