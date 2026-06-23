@include('vendor.Layout.head')

@php

use Illuminate\Support\Facades\Auth;
use App\Models\Service;
use App\Models\VendorType;
use App\Models\BusinessType;

$vendor = Auth::guard('vendor')->user();

$services = Service::where('vendor_id', $vendor->id)
                    ->latest()
                    ->get();

@endphp

<body class="text-gray-800 antialiased font-sans bg-slate-50">

@include('vendor.Layout.top_bar')

    @include('vendor.Layout.main_header')

<div class="min-h-screen py-8">

    <div class="max-w-7xl mx-auto px-4">

      @include('vendor.Layout.menu_bar')

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">

            {{-- HEADER --}}
            <div class="flex items-center justify-between mb-8">

                <div>

                    <h2 class="text-2xl font-bold text-gray-900">
                        Service Pages
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Manage your created service pages
                    </p>

                </div>

                <a href="{{ route('service.product.create') }}"
                   class="bg-primary text-white px-5 py-3 rounded-xl text-sm font-bold hover:bg-primaryHover transition">

                    + Add Service

                </a>

            </div>


            {{-- SERVICES --}}
            @forelse($services as $service)

            @php

                $vendorType = VendorType::find($vendor->vendor_type_id);

                $business = BusinessType::find($vendor->business_id);

                /*
                |--------------------------------------------------------------------------
                | SERVICE IMAGE HANDLE
                |--------------------------------------------------------------------------
                */

                $images = [];

                if($service->service_img){

                    $decodedImages = json_decode($service->service_img, true);

                    if(is_array($decodedImages)){

                        $images = $decodedImages;

                    }else{

                        $images[] = $service->service_img;

                    }

                }

                /*
                |--------------------------------------------------------------------------
                | FEATURES HANDLE
                |--------------------------------------------------------------------------
                */

                $features = [];

                if($service->feature){

                    $decodedFeatures = json_decode($service->feature, true);

                    if(is_array($decodedFeatures)){

                        $features = $decodedFeatures;

                    }else{

                        $features = explode(',', $service->feature);

                    }

                }

                /*
                |--------------------------------------------------------------------------
                | AVAILABLE DAYS
                |--------------------------------------------------------------------------
                */

                $availableDays = trim($service->available_days, '"');

                /*
                |--------------------------------------------------------------------------
                | DATASHEET PATH
                |--------------------------------------------------------------------------
                */

                $datasheetPath = public_path('uploads/datasheet/'.$service->datasheet);

            @endphp


            <div class="mb-10 border border-slate-200 rounded-3xl overflow-hidden shadow-sm bg-white">

                {{-- COVER IMAGE --}}


                {{-- COMPANY PROFILE --}}
                <div class="px-6 pb-8 relative flex flex-col items-center text-center mt-16">

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


                    {{-- SERVICE NAME --}}
                    <div class="inline-flex items-center px-4 py-2 bg-primary/10 text-primary rounded-full text-sm font-semibold">

                        {{ $service->service_name }}

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
                            Company Location
                        </p>

                        <h4 class="font-bold text-gray-900">

                            {{ $vendor->city ?? 'N/A' }},
                            {{ $vendor->state ?? 'N/A' }}

                        </h4>

                    </div>


                    <div class="border border-slate-200 rounded-2xl p-5">

                        <p class="text-xs text-gray-400 mb-2">
                            Company GST
                        </p>

                        <h4 class="font-bold text-gray-900">

                            {{ $vendor->gst_no ?? 'N/A' }}

                        </h4>

                    </div>


                    <div class="border border-slate-200 rounded-2xl p-5">

                        <p class="text-xs text-gray-400 mb-2">
                            Year Established
                        </p>

                        <h4 class="font-bold text-gray-900">

                            {{ $vendor->year_established ?? 'N/A' }}

                        </h4>

                    </div>

                </div>


                {{-- SERVICE DESCRIPTION --}}
                <div class="px-6 pb-6">

                    <div class="border border-slate-200 rounded-2xl p-6">

                        <h3 class="text-lg font-bold text-gray-900 mb-4">

                            Service Description

                        </h3>

                        <p class="text-sm leading-7 text-gray-600">

                            {{ $service->long_description ?? 'No service description available.' }}

                        </p>

                    </div>

                </div>


                {{-- FEATURES --}}
                @if(!empty($features))

                <div class="px-6 pb-8">

                    <div class="border border-slate-200 rounded-2xl p-6">

                        <h3 class="text-lg font-bold text-gray-900 mb-5">

                            Service Features

                        </h3>

                        <div class="grid md:grid-cols-2 gap-4">

                            @foreach($features as $feature)

                            <div class="flex items-center gap-3">

                                <div class="w-2 h-2 rounded-full bg-primary"></div>

                                <span class="text-sm text-gray-700">

                                    @if(is_array($feature))

                                        {{ implode(', ', $feature) }}

                                    @else

                                        {{ $feature }}

                                    @endif

                                </span>

                            </div>

                            @endforeach

                        </div>

                    </div>

                </div>

                @endif


                {{-- SERVICE DETAILS --}}
                <div class="grid md:grid-cols-4 gap-5 px-6 pb-8">

                    <div class="border border-slate-200 rounded-2xl p-5">

                        <p class="text-xs text-gray-400 mb-2">
                            Price Type
                        </p>

                        <h4 class="font-bold text-gray-900">

                            {{ $service->price_type ?? 'N/A' }}

                        </h4>

                    </div>


                    <div class="border border-slate-200 rounded-2xl p-5">

                        <p class="text-xs text-gray-400 mb-2">
                            Service Location
                        </p>

                        <h4 class="font-bold text-gray-900">

                            {{ $service->service_city ?? 'N/A' }},
                            {{ $service->service_state ?? 'N/A' }}

                        </h4>

                    </div>


                    <div class="border border-slate-200 rounded-2xl p-5">

                        <p class="text-xs text-gray-400 mb-2">
                            Available Days
                        </p>

                        <h4 class="font-bold text-gray-900">

                            {{ ucfirst($availableDays) }}

                        </h4>

                    </div>


                    <div class="border border-slate-200 rounded-2xl p-5">

                        <p class="text-xs text-gray-400 mb-2">
                            Service Time
                        </p>

                        <h4 class="font-bold text-gray-900">

                            {{ \Carbon\Carbon::parse($service->opening_time)->format('h:i A') }}

                            -

                            {{ \Carbon\Carbon::parse($service->closing_time)->format('h:i A') }}

                        </h4>

                    </div>

                </div>


                {{-- DATASHEET --}}
                @if($service->datasheet )

                <div class="px-6 pb-8">

                    <div class="border border-slate-200 rounded-2xl p-6">

                        <h3 class="text-lg font-bold text-gray-900 mb-5">

                            Service Datasheet

                        </h3>

                        <a href="{{ asset('uploads/service/datasheet/'.$service->datasheet) }}"
                           target="_blank"
                           class="inline-flex items-center gap-2 bg-primary text-white px-5 py-3 rounded-xl font-semibold hover:opacity-90 transition">

                            <i class="fas fa-file-pdf"></i>

                            View Datasheet

                        </a>

                    </div>

                </div>

                @endif


                {{-- SERVICE GALLERY --}}
                @if(!empty($images))

                <div class="px-6 pb-8">

                    <div class="border border-slate-200 rounded-2xl p-6">

                        <h3 class="text-lg font-bold text-gray-900 mb-5">

                            Service Gallery

                        </h3>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-5">

                            @foreach($images as $image)

                            <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-sm">

                                <img src="{{ asset('uploads/service/images/'.$image) }}"
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

                    No Services Found

                </h3>

                <p class="text-gray-500 mb-6">

                    Create your first service page to display here.

                </p>

                <a href="{{ route('service.product.create') }}"
                   class="inline-flex items-center bg-primary text-white px-5 py-3 rounded-xl font-semibold">

                    + Create Service

                </a>

            </div>

            @endforelse

        </div>

    </div>

</div>

@include('vendor.Layout.footer')

</body>

</html>