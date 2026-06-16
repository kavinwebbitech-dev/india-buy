@include('frontend.layouts.header-link')


    @include('frontend.layouts.top_bar')

    @include('frontend.layouts.main_header')

    @include('frontend.layouts.navbar')

    <div class="max-w-7xl mx-auto px-4 py-8">

        {{-- PAGE TITLE --}}
        <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm mb-8">

            <h1 class="text-[22px] font-bold text-center text-gray-900">
                All Services
            </h1>

        </div>

        {{-- ========================= --}}
        {{-- LATEST REAL ESTATE --}}
        {{-- ========================= --}}



        {{-- ========================= --}}
        {{-- ALL SERVICES --}}
        {{-- ========================= --}}

        <div id="all-services">

            <div class="mb-6">

                <h2 class="text-[22px] font-bold text-gray-900">
                    All Services
                </h2>

            </div>

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

                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent">
                            </div>

                            <h3 class="absolute bottom-3 left-4 right-4 text-white font-bold text-[17px] leading-snug">

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

            {{-- PAGINATION --}}
            <div class="mt-10">

                {{ $services->links() }}

            </div>

        </div>

        <div class="mb-12">

            <div class="flex items-center justify-between mb-5">

                <h2 class="text-[20px] font-bold text-gray-900">
                    Latest Real Estates
                </h2>

                {{-- <a href="#all-services"
                class="bg-primary text-white px-5 py-2 rounded-xl text-[13px] font-bold hover:bg-primaryHover transition-all">
                View All Services
            </a> --}}

            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5">

                @foreach ($latestRealEstates as $estate)
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
                            <a href="{{ route('properties.show', $estate->id) }}"
                                        class="w-full bg-primary text-white py-2 rounded-xl text-[13px] font-bold hover:bg-primaryHover transition-all text-center inline-block">
                                        View Details
                                    </a>
                             {{-- <a href="{{ route('service.details', $service->id) }}"
                                        class="w-full bg-primary text-white py-2 rounded-xl text-[13px] font-bold hover:bg-primaryHover transition-all text-center inline-block">
                                        View Details
                                    </a> --}}


                        </div>

                    </div>
                @endforeach

            </div>

        </div>

    </div>

    @include('frontend.layouts.footer')
