@include('vendor.service.Layout.head')

<body class="text-gray-800 antialiased font-sans bg-slate-50">

    {{-- TOP BAR --}}
    @include('vendor.service.Layout.top_bar')

    {{-- HEADER --}}
    @include('vendor.service.Layout.main_header')

    @php
        $vendor = Auth::guard('vendor')->user();
    @endphp

    <div class="min-h-screen py-8">

        <div class="max-w-7xl mx-auto px-4">

            @include('vendor.service.Layout.service_menubar')

            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">

                {{-- HEADER --}}
                <div class="px-6 py-5 border-b border-gray-100">

                    <h2 class="text-2xl font-bold text-gray-900">
                        Vendor Profile
                    </h2>

                    <p class="text-sm text-gray-500 mt-1">
                        Update your company information
                    </p>

                </div>

                {{-- FORM --}}

                <form action="{{ route('service.profile.update') }}" method="POST" enctype="multipart/form-data"
                    class="p-6">

                    @csrf

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                        {{-- COMPANY LOGO --}}
                        <div class="lg:col-span-2 text-center">

                            @if ($vendor->company_logo)
                                <img src="{{ asset('uploads/vendor_logo/' . $vendor->company_logo) }}"
                                    class="w-32 h-32 rounded-full object-cover border mx-auto">
                            @else
                                <div
                                    class="w-32 h-32 rounded-full bg-slate-100 flex items-center justify-center mx-auto">

                                    <i data-lucide="building-2" class="w-12 h-12 text-gray-400"></i>

                                </div>
                            @endif

                            <div class="mt-4">

                                <input type="file" name="company_logo"
                                    class="border border-gray-200 rounded-xl px-4 py-2 text-sm">

                            </div>

                        </div>

                        {{-- COMPANY NAME --}}
                        <div>

                            <label class="block text-sm font-semibold mb-2">
                                Company Name
                            </label>

                            <input type="text" name="company_name"
                                value="{{ old('company_name', $vendor->company_name) }}"
                                class="w-full h-12 px-4 border border-gray-200 rounded-xl focus:outline-none focus:border-primary">

                            @error('company_name')
                                <p class="text-red-500 text-sm mt-1">

                                    {{ $message }}

                                </p>
                            @enderror

                        </div>

                        {{-- EMAIL --}}
                        <div>

                            <label class="block text-sm font-semibold mb-2">
                                Email
                            </label>

                            <input type="email" value="{{ $vendor->email }}" readonly
                                class="w-full h-12 px-4 bg-slate-100 border border-gray-200 rounded-xl">

                        </div>

                        {{-- PHONE --}}
                        <div>

                            <label class="block text-sm font-semibold mb-2">
                                Phone
                            </label>

                            <input type="text" name="phone" value="{{ old('phone', $vendor->phone) }}"
                                class="w-full h-12 px-4 border border-gray-200 rounded-xl focus:outline-none focus:border-primary">

                        </div>

                        {{-- GST --}}
                        <div>

                            <label class="block text-sm font-semibold mb-2">
                                GST Number
                            </label>

                            <input type="text" name="gst_no" value="{{ old('gst_no', $vendor->gst_no) }}"
                                class="w-full h-12 px-4 border border-gray-200 rounded-xl focus:outline-none focus:border-primary">

                        </div>

                        {{-- YEAR --}}
                        <div>

                            <label class="block text-sm font-semibold mb-2">
                                Year Established
                            </label>

                            <input type="text" name="year_established"
                                value="{{ old('year_established', $vendor->year_established) }}"
                                class="w-full h-12 px-4 border border-gray-200 rounded-xl focus:outline-none focus:border-primary">

                        </div>

                        {{-- COUNTRY --}}
                        <div>

                            <label class="block text-sm font-semibold mb-2">
                                Country
                            </label>

                            <input type="text" name="country" value="{{ old('country', $vendor->country) }}"
                                class="w-full h-12 px-4 border border-gray-200 rounded-xl focus:outline-none focus:border-primary">

                        </div>

                        {{-- STATE --}}
                        <div>

                            <label class="block text-sm font-semibold mb-2">
                                State
                            </label>

                            <input type="text" name="state" value="{{ old('state', $vendor->state) }}"
                                class="w-full h-12 px-4 border border-gray-200 rounded-xl focus:outline-none focus:border-primary">

                        </div>

                        {{-- CITY --}}
                        <div>

                            <label class="block text-sm font-semibold mb-2">
                                City
                            </label>

                            <input type="text" name="city" value="{{ old('city', $vendor->city) }}"
                                class="w-full h-12 px-4 border border-gray-200 rounded-xl focus:outline-none focus:border-primary">

                        </div>

                        {{-- ADDRESS --}}
                        <div class="lg:col-span-2">

                            <label class="block text-sm font-semibold mb-2">
                                Address
                            </label>

                            <textarea name="address" rows="4"
                                class="w-full p-4 border border-gray-200 rounded-xl focus:outline-none focus:border-primary">{{ old('address', $vendor->address) }}</textarea>

                        </div>

                        {{-- ABOUT --}}
                        <div class="lg:col-span-2">

                            <label class="block text-sm font-semibold mb-2">
                                About Us
                            </label>

                            <textarea name="about_us" rows="5"
                                class="w-full p-4 border border-gray-200 rounded-xl focus:outline-none focus:border-primary">{{ old('about_us', $vendor->about_us) }}</textarea>

                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                Vendor Type
                            </label>

                            <select name="vendor_type_id" id="vendor_type_id"
                                class="w-full h-12 px-4 border border-gray-200 rounded-xl">

                                <option value="">
                                    Select Vendor Type
                                </option>

                                @foreach ($vendorTypes as $type)
                                    <option value="{{ $type->id }}"
                                        {{ $vendor->vendor_type_id == $type->id ? 'selected' : '' }}>

                                        {{ $type->vendor_name }}

                                    </option>
                                @endforeach

                            </select>
                        </div>

                        {{-- BUSINESS TYPE --}}
                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                Business Type
                            </label>

                            <select name="business_id" id="business_id"
                                class="w-full h-12 px-4 border border-gray-200 rounded-xl">

                                <option value="">
                                    Select Business Type
                                </option>

                                @foreach ($businessTypes as $business)
                                    <option value="{{ $business->id }}"
                                        {{ $vendor->business_id == $business->id ? 'selected' : '' }}>

                                        {{ $business->business_name }}

                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                Category
                            </label>

                            <select name="category_id" id="category_id"
                                class="w-full h-12 px-4 border border-gray-200 rounded-xl">

                                <option value="">
                                    Select Category
                                </option>

                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $vendor->category_id == $category->id ? 'selected' : '' }}>

                                        {{ $category->category_name }}

                                    </option>
                                @endforeach

                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold mb-2">
                                Sub Category
                            </label>

                            <select name="sub_category_id" id="sub_category_id"
                                class="w-full h-12 px-4 border border-gray-200 rounded-xl">

                                <option value="">
                                    Select Sub Category
                                </option>

                                @foreach ($subCategories as $sub)
                                    <option value="{{ $sub->id }}"
                                        {{ $vendor->sub_category_id == $sub->id ? 'selected' : '' }}>

                                        {{ $sub->sub_category_name }}

                                    </option>
                                @endforeach

                            </select>
                        </div>

                    </div>

                    {{-- BUTTON --}}
                    <div class="mt-8">

                        <button type="submit"
                            class="bg-primary hover:bg-primaryHover text-white px-8 py-3 rounded-xl font-semibold transition-all">

                            Update Profile

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

    {{-- FOOTER --}}
    @include('vendor.Layout.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {

            // VENDOR TYPE CHANGE
            $('#vendor_type_id').on('change', function() {

                let vendor_type_id = $(this).val();

                $('#business_id').html(
                    '<option value="">Loading...</option>'
                );

                $.ajax({

                    url: "{{ route('get.business.types') }}",

                    type: "GET",

                    data: {
                        vendor_type_id: vendor_type_id
                    },

                    success: function(response) {

                        $('#business_id').html(
                            '<option value="">Select Business Type</option>'
                        );

                        $.each(response, function(key, value) {

                            $('#business_id').append(
                                `<option value="${value.id}">
                            ${value.business_name}
                        </option>`
                            );

                        });

                        // RESET
                        $('#category_id').html(
                            '<option value="">Select Category</option>'
                        );

                        $('#sub_category_id').html(
                            '<option value="">Select Sub Category</option>'
                        );

                    }

                });

            });



            // BUSINESS TYPE CHANGE
            $('#business_id').on('change', function() {

                let business_id = $(this).val();

                $('#category_id').html(
                    '<option value="">Loading...</option>'
                );

                $.ajax({

                    url: "{{ route('get.categories') }}",

                    type: "GET",

                    data: {
                        business_id: business_id
                    },

                    success: function(response) {

                        $('#category_id').html(
                            '<option value="">Select Category</option>'
                        );

                        $.each(response, function(key, value) {

                            $('#category_id').append(
                                `<option value="${value.id}">
                            ${value.category_name}
                        </option>`
                            );

                        });

                        $('#sub_category_id').html(
                            '<option value="">Select Sub Category</option>'
                        );

                    }

                });

            });



            // CATEGORY CHANGE
            $('#category_id').on('change', function() {

                let category_id = $(this).val();

                $('#sub_category_id').html(
                    '<option value="">Loading...</option>'
                );

                $.ajax({

                    url: "{{ route('get.subcategories') }}",

                    type: "GET",

                    data: {
                        category_id: category_id
                    },

                    success: function(response) {

                        $('#sub_category_id').html(
                            '<option value="">Select Sub Category</option>'
                        );

                        $.each(response, function(key, value) {

                            $('#sub_category_id').append(
                                `<option value="${value.id}">
                            ${value.sub_category_name}
                        </option>`
                            );

                        });

                    }

                });

            });

        });
    </script>

</body>

</html>
