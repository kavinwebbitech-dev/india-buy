@include('auth.Layout.header')

<body class="text-gray-800 antialiased font-sans bg-slate-50">

    {{-- TOP BAR --}}
    @include('auth.Layout.top_bar')

    {{-- HEADER --}}
    @include('auth.Layout.main_header')


    {{-- REGISTER SECTION --}}
    <section class="py-10 px-4 bg-slate-50 min-h-screen">

        <div class="w-full max-w-5xl mx-auto bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">

            {{-- HEADER --}}
            <div class="px-6 py-6 border-b border-gray-100 flex items-center justify-between bg-white">

                <div>
                    <h2 class="text-[24px] font-bold text-gray-900 mb-1">
                        Vendor Registration
                    </h2>

                    <p class="text-[13px] text-gray-500 font-medium">
                        Fill in the details below to complete your vendor profile.
                    </p>
                </div>

                <a href="{{ route('vendor.index') }}"
                    class="text-[13px] font-bold text-gray-500 hover:text-black px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition-all">

                    Cancel

                </a>

            </div>


            {{-- SUCCESS MESSAGE --}}
            @if (session('success'))
                <div class="mx-6 mt-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif


            @if (session('vendor_error'))
                <div class="mx-6 mt-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('vendor_error') }}
                </div>
            @endif


            <form id="vendorRegisterForm" action="{{ route('vendor.register.submit') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="p-6 lg:p-8">

                    <div class="max-w-4xl mx-auto space-y-10">

                        {{-- GENERAL INFO --}}
                        <div>

                            <h3 class="text-[18px] font-bold text-gray-900 mb-6 pb-2 border-b border-gray-100">
                                General Information
                            </h3>

                            <div class="space-y-5">

                                {{-- COMPANY LOGO --}}
                                <div class="flex flex-col items-center justify-center mb-10">

                                    <div class="relative">

                                        <img id="logoPreview" src="https://placehold.co/120x120?text=Logo"
                                            class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg bg-slate-100">

                                        <label
                                            class="absolute bottom-0 right-0 bg-primary text-white p-2 rounded-full cursor-pointer shadow-lg">

                                            <i class="fa fa-camera"></i>

                                            <input type="file" name="company_logo" id="companyLogoInput"
                                                accept="image/*" class="hidden">

                                        </label>

                                    </div>

                                    @error('company_logo')
                                        <p class="text-red-500 text-xs mt-2">
                                            {{ $message }}
                                        </p>
                                    @enderror

                                </div>


                                {{-- VENDOR TYPE --}}
                                


                                {{-- COMPANY NAME --}}
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                                    <label class="text-[13px] font-bold text-gray-700 sm:text-right">
                                        Company Name
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <div class="sm:col-span-2">

                                        <input type="text" name="company_name" value="{{ old('company_name') }}"
                                            placeholder="Enter Company Name"
                                            class="w-full h-11 px-4 bg-slate-50 border border-gray-200 rounded-xl">

                                        @error('company_name')
                                            <p class="text-red-500 text-xs mt-1">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>

                                </div>


                                {{-- ABOUT US --}}
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                                    <label class="text-[13px] font-bold text-gray-700 sm:text-right pt-3">
                                        About Us
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <div class="sm:col-span-2">

                                        <textarea rows="5" name="about_us" placeholder="About your company"
                                            class="w-full p-4 bg-slate-50 border border-gray-200 rounded-xl">{{ old('about_us') }}</textarea>

                                        @error('about_us')
                                            <p class="text-red-500 text-xs mt-1">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>

                                </div>


                                {{-- YEAR --}}
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                                    <label class="text-[13px] font-bold text-gray-700 sm:text-right">
                                        Year Established
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <div class="sm:col-span-2">

                                        <input type="text" name="year_established"
                                            value="{{ old('year_established') }}" maxlength="4" placeholder="2005"
                                            class="w-full sm:w-1/2 h-11 px-4 bg-slate-50 border border-gray-200 rounded-xl">

                                        @error('year_established')
                                            <p class="text-red-500 text-xs mt-1">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- LOCATION --}}
                        <div>

                            <h3 class="text-[18px] font-bold text-gray-900 mb-6 pb-2 border-b border-gray-100">
                                Location Information
                            </h3>

                            <div class="space-y-5">

                                @foreach (['country' => 'Country', 'state' => 'State', 'city' => 'City'] as $field => $label)
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                                        <label class="text-[13px] font-bold text-gray-700 sm:text-right">
                                            {{ $label }}
                                            <span class="text-red-500">*</span>
                                        </label>

                                        <div class="sm:col-span-2">

                                            <input type="text" name="{{ $field }}"
                                                value="{{ old($field) }}"
                                                class="w-full h-11 px-4 bg-slate-50 border border-gray-200 rounded-xl">

                                            @error($field)
                                                <p class="text-red-500 text-xs mt-1">
                                                    {{ $message }}
                                                </p>
                                            @enderror

                                        </div>

                                    </div>
                                @endforeach


                                {{-- ADDRESS --}}
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                                    <label class="text-[13px] font-bold text-gray-700 sm:text-right">
                                        Address
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <div class="sm:col-span-2">

                                        <textarea rows="4" name="address" class="w-full p-4 bg-slate-50 border border-gray-200 rounded-xl">{{ old('address') }}</textarea>

                                        @error('address')
                                            <p class="text-red-500 text-xs mt-1">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- CONTACT --}}
                        <div>

                            <h3 class="text-[18px] font-bold text-gray-900 mb-6 pb-2 border-b border-gray-100">
                                Contact Information
                            </h3>

                            <div class="space-y-5">

                                {{-- PHONE --}}
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                                    <label class="text-[13px] font-bold text-gray-700 sm:text-right">
                                        Phone
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <div class="sm:col-span-2">

                                        <input type="text" name="phone" value="{{ old('phone') }}"
                                            maxlength="10"
                                            class="w-full h-11 px-4 bg-slate-50 border border-gray-200 rounded-xl">

                                        @error('phone')
                                            <p class="text-red-500 text-xs mt-1">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>

                                </div>


                                {{-- EMAIL --}}
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                                    <label class="text-[13px] font-bold text-gray-700 sm:text-right">
                                        Email
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <div class="sm:col-span-2">

                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class="w-full h-11 px-4 bg-slate-50 border border-gray-200 rounded-xl">

                                        @error('email')
                                            <p class="text-red-500 text-xs mt-1">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>

                                </div>


                                {{-- GST --}}
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                                    <label class="text-[13px] font-bold text-gray-700 sm:text-right">
                                        GST Number
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <div class="sm:col-span-2">

                                        <input type="text" name="gst_no" value="{{ old('gst_no') }}"
                                            maxlength="15"
                                            class="w-full h-11 px-4 bg-slate-50 border border-gray-200 rounded-xl">

                                        @error('gst_no')
                                            <p class="text-red-500 text-xs mt-1">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>

                                </div>


                                {{-- PASSWORD --}}
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                                    <label class="text-[13px] font-bold text-gray-700 sm:text-right">
                                        Password
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <div class="sm:col-span-2 relative">

                                        <input type="password" id="password" name="password"
                                            class="w-full h-11 px-4 pr-12 bg-slate-50 border border-gray-200 rounded-xl">

                                        <button type="button" onclick="togglePassword('password','passwordEye')"
                                            class="absolute right-4 top-3 text-gray-500">

                                            <i id="passwordEye" class="fa fa-eye-slash"></i>

                                        </button>

                                        @error('password')
                                            <p class="text-red-500 text-xs mt-1">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>

                                </div>


                                {{-- CONFIRM PASSWORD --}}
                                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

                                    <label class="text-[13px] font-bold text-gray-700 sm:text-right">
                                        Confirm Password
                                        <span class="text-red-500">*</span>
                                    </label>

                                    <div class="sm:col-span-2 relative">

                                        <input type="password" id="confirm_password" name="password_confirmation"
                                            class="w-full h-11 px-4 pr-12 bg-slate-50 border border-gray-200 rounded-xl">

                                        <button type="button"
                                            onclick="togglePassword('confirm_password','confirmPasswordEye')"
                                            class="absolute right-4 top-3 text-gray-500">

                                            <i id="confirmPasswordEye" class="fa fa-eye-slash"></i>

                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>


                        {{-- BUTTON --}}
                        <div class="pt-6 border-t border-gray-100 flex justify-end">

                            <button type="submit"
                                class="bg-primary hover:bg-primaryHover text-white px-10 py-3 rounded-xl text-[14px] font-bold">

                                Register Vendor

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </section>


    {{-- FOOTER --}}
    @include('auth.Layout.footer')


    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


    <script>
        $('#vendorRegisterForm').submit(function(e) {

            e.preventDefault();

            let formData = new FormData(this);

            $('.text-red-500').html('');

            $.ajax({

                url: $(this).attr('action'),

                type: "POST",

                data: formData,

                processData: false,

                contentType: false,

                beforeSend: function() {

                    $('button[type="submit"]')
                        .prop('disabled', true)
                        .text('Processing...');

                },

                success: function(response) {

                    window.location.href = response.redirect;

                },

                error: function(xhr) {

                    $('button[type="submit"]')
                        .prop('disabled', false)
                        .text('Register Vendor');

                    if (xhr.status === 422) {

                        let errors = xhr.responseJSON.errors;

                        $.each(errors, function(key, value) {

                            $(`[name="${key}"]`)
                                .closest('div')
                                .find('.error-text')
                                .remove();

                            $(`[name="${key}"]`)
                                .after(`
                            <p class="error-text text-red-500 text-xs mt-1">
                                ${value[0]}
                            </p>
                        `);

                        });

                    }

                }

            });

        });
        // IMAGE PREVIEW
        $('#companyLogoInput').on('change', function(e) {

            let file = e.target.files[0];

            if (file) {

                let reader = new FileReader();

                reader.onload = function(event) {

                    $('#logoPreview').attr('src', event.target.result);

                }

                reader.readAsDataURL(file);

            }

        });


        // PASSWORD TOGGLE
        function togglePassword(inputId, eyeId) {

            let input = document.getElementById(inputId);
            let eye = document.getElementById(eyeId);

            if (input.type === "password") {

                input.type = "text";

                eye.classList.remove("fa-eye-slash");
                eye.classList.add("fa-eye");

            } else {

                input.type = "password";

                eye.classList.remove("fa-eye");
                eye.classList.add("fa-eye-slash");

            }

        }


        // VENDOR -> BUSINESS
        $('#vendor_type_id').change(function() {

            let vendor_type_id = $(this).val();

            $.ajax({

                url: "{{ route('get.business.types') }}",
                type: "GET",

                data: {
                    vendor_type_id: vendor_type_id
                },

                success: function(response) {

                    $('#business_id').html('<option value="">Select Business Type</option>');

                    $.each(response, function(key, row) {

                        $('#business_id').append(`
                            <option value="${row.id}">
                                ${row.business_name}
                            </option>
                        `);

                    });

                }

            });

        });


        // BUSINESS -> CATEGORY
        $('#business_id').change(function() {

            let business_id = $(this).val();

            $.ajax({

                url: "{{ route('get.categories') }}",
                type: "GET",

                data: {
                    business_id: business_id
                },

                success: function(response) {

                    $('#category_id').html('<option value="">Select Category</option>');

                    $.each(response, function(key, row) {

                        $('#category_id').append(`
                            <option value="${row.id}">
                                ${row.category_name}
                            </option>
                        `);

                    });

                }

            });

        });


        // CATEGORY -> SUBCATEGORY
        $('#category_id').change(function() {

            let category_id = $(this).val();

            $.ajax({

                url: "{{ route('get.subcategories') }}",
                type: "GET",

                data: {
                    category_id: category_id
                },

                success: function(response) {

                    $('#sub_category_id').html('<option value="">Select Sub Category</option>');

                    $.each(response, function(key, row) {

                        $('#sub_category_id').append(`
                            <option value="${row.id}">
                                ${row.sub_category_name}
                            </option>
                        `);

                    });

                }

            });

        });
    </script>
    <script>
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>
</body>

</html>
