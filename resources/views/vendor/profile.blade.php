@include('vendor.Layout.head')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>

.select2-container--default .select2-selection--multiple {

    border: 1px solid #e5e7eb !important;

    border-radius: 12px !important;

    min-height: 48px !important;

    padding: 6px !important;

}

.select2-container--default.select2-container--focus .select2-selection--multiple {

    border-color: #6366f1 !important;

    box-shadow: none !important;

}

.select2-container .select2-search--inline .select2-search__field {

    margin-top: 6px !important;

}

.select2-selection__choice {

    border-radius: 8px !important;

    padding: 4px 8px !important;

}

</style>
<body class="text-gray-800 antialiased font-sans bg-slate-50">

    {{-- TOP BAR --}}
    @include('vendor.Layout.top_bar')

    {{-- HEADER --}}
    @include('vendor.Layout.main_header')

    @php
        $vendor = Auth::guard('vendor')->user();
    @endphp

    <div class="min-h-screen py-8">

        <div class="max-w-7xl mx-auto px-4">

            @include('vendor.Layout.menu_bar')

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

                <form action="{{ route('manufacturer.profile.update') }}" method="POST" enctype="multipart/form-data"
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

                        {{-- VENDOR TYPES --}}
                        <div class="lg:col-span-2">

                            <label class="block text-sm font-semibold mb-2">
                                Vendor Types
                            </label>

                            @php

                                $selectedVendorTypes = [];

                                if ($vendor->vendor_type_id) {
                                    $selectedVendorTypes = explode(',', $vendor->vendor_type_id);
                                }

                            @endphp

                            <select name="vendor_type_id[]" id="vendor_type_id" multiple class="w-full">

                                @foreach ($vendorTypes as $type)
                                    <option value="{{ $type->id }}"
                                        {{ in_array($type->id, $selectedVendorTypes) ? 'selected' : '' }}>

                                        {{ $type->vendor_name }}

                                    </option>
                                @endforeach

                            </select>

                            <p class="text-xs text-gray-500 mt-2">
                                Hold CTRL (Windows) or CMD (Mac) to select multiple vendor types.
                            </p>

                        </div>
                        {{-- BUSINESS TYPE --}}

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
    <!-- JQUERY -->
    <!-- SELECT2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

        $('#vendor_type_id').select2({

            placeholder: "Select Vendor Types",

            allowClear: true,

            width: '100%'

        });

    </script>
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
