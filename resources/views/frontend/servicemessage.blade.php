@include('frontend.layouts.header-link')


@include('frontend.layouts.top_bar')

@include('frontend.layouts.main_header')

<section
    class="max-w-4xl mx-auto my-14 bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">

    {{-- TOP --}}
    <div class="bg-slate-50/80 border-b border-gray-100 px-6 py-4 flex items-center gap-2">

        <h3 class="text-[14px] font-bold text-gray-900 flex items-center gap-1.5">

            {{ $service->service_name }}

        </h3>

    </div>

    <form action="{{ route('service.enquiry.submit') }}" method="POST">

        @csrf

        <input type="hidden" name="service_id" value="{{ $service->id }}">

        {{-- SERVICE --}}
        <div
            class="p-6 border-b border-gray-100 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 bg-white">

            <div class="flex items-center gap-4 flex-1 min-w-0">

                <div
                    class="w-16 h-16 shrink-0 rounded-xl border border-gray-100 p-2 bg-white flex items-center justify-center">

                    @if ($service->service_img)
                        @php
                            $serviceImages = json_decode($service->service_img, true);
                            $serviceImage = !empty($serviceImages[0]) ? $serviceImages[0] : null;
                        @endphp

                        @if ($serviceImage)
                            <img src="{{ asset('uploads/service/images/' . $serviceImage) }}"
                                alt="{{ $service->service_name }}" class="max-w-full max-h-full object-contain">
                        @endif
                    @endif
                </div>

                <div>

                    <h4 class="text-[15px] font-bold text-primary leading-snug">

                        {{ $service->service_name }}

                    </h4>

                    <p class="text-xs text-gray-500 mt-1">

                        {{ $service->service_city }},
                        {{ $service->service_state }}

                    </p>

                </div>

            </div>

            {{-- Service Type --}}
            <div class="px-4 py-2 rounded-xl bg-slate-50 border border-slate-200 text-sm font-medium text-gray-700">

                {{ ucfirst($service->price_type ?? 'Negotiable') }}

            </div>

        </div>

        {{-- FORM --}}
        <div class="p-6 lg:p-8 space-y-6 bg-white">

            {{-- SUCCESS --}}
            @if (session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-3 rounded-xl">

                    {{ session('success') }}

                </div>
            @endif

            {{-- MESSAGE --}}
            <div>

                <label class="block text-[14px] font-bold text-gray-900 mb-2">

                    Message

                </label>

                <textarea rows="6" name="message" placeholder="Please describe your service requirement..."
                    class="w-full p-4 border border-gray-200 rounded-xl text-[14px]">{{ old('message') }}</textarea>

                @error('message')
                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- REQUIREMENT DETAILS --}}
            <div>

                <label class="block text-[14px] font-bold text-gray-900 mb-2">

                    Requirement Details

                </label>

                <input type="text" name="requirement" value="{{ old('requirement') }}"
                    placeholder="Example: Need website development service"
                    class="w-full p-4 border border-gray-200 rounded-xl text-[14px]">

            </div>

            {{-- EMAIL --}}
            <div>

                <label class="block text-[14px] font-bold text-gray-900 mb-2">

                    Email Address

                </label>

                <input type="email" disabled value="{{ auth()->user()->email ?? '' }}"
                    class="w-full sm:w-1/2 h-11 px-4 bg-slate-50 border border-gray-200 rounded-xl text-[14px]">

            </div>

            {{-- BUTTON --}}
            <div class="pt-4">

                <button type="submit"
                    class="bg-primary hover:bg-primaryHover text-white px-8 py-3 rounded-xl text-[14px] font-bold transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-2 w-full sm:w-auto">

                    <i data-lucide="send" class="w-4 h-4"></i>

                    Send Service Enquiry

                </button>

            </div>

        </div>

    </form>

</section>

@include('frontend.layouts.footer')
