@include('auth.Layout.header')

<body class="text-gray-800 antialiased font-sans bg-slate-50">

    {{-- TOP BAR --}}
    @include('auth.Layout.top_bar')

    {{-- HEADER --}}
    @include('auth.Layout.main_header')

    {{-- FORGOT PASSWORD SECTION --}}
    <section class="flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-md bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">

            {{-- HEADER --}}
            <div class="px-6 py-6 border-b border-gray-100 text-center">

                <h2 class="text-[28px] font-bold text-gray-900 mb-2">
                    Forgot Password
                </h2>

                <p class="text-[14px] text-gray-500">
                    Enter your vendor details to receive OTP
                </p>

            </div>

            {{-- BODY --}}
            <div class="p-6">

                <form action="{{ route('vendor.send.forgot.otp') }}"
                    method="POST">

                    @csrf

                    {{-- SUCCESS MESSAGE --}}
                    @if(session('success'))

                        <div class="mb-4 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">

                            {{ session('success') }}

                        </div>

                    @endif


                    {{-- ERROR MESSAGE --}}
                    @if(session('error'))

                        <div class="mb-4 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl text-sm">

                            {{ session('error') }}

                        </div>

                    @endif


                    {{-- VENDOR TYPE --}}
                    {{-- <div class="mb-5">

                        <label class="block text-[13px] font-bold text-gray-700 mb-2">

                            Vendor Type
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="vendor_type_id"
                            class="w-full h-11 px-4 bg-slate-50 border border-gray-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none">

                            <option value="">
                                Select Vendor Type
                            </option>

                            @foreach($vendorTypes as $type)

                                <option value="{{ $type->id }}"
                                    {{ old('vendor_type_id') == $type->id ? 'selected' : '' }}>

                                    {{ $type->vendor_name }}

                                </option>

                            @endforeach

                        </select>

                        @error('vendor_type_id')

                            <p class="text-red-500 text-xs mt-1">

                                {{ $message }}

                            </p>

                        @enderror

                    </div> --}}


                    {{-- EMAIL --}}
                    <div class="mb-6">

                        <label class="block text-[13px] font-bold text-gray-700 mb-2">

                            Email Address
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter Email Address"
                            class="w-full h-11 px-4 bg-slate-50 border border-gray-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none">

                        @error('email')

                            <p class="text-red-500 text-xs mt-1">

                                {{ $message }}

                            </p>

                        @enderror

                    </div>


                    {{-- SUBMIT BUTTON --}}
                    <button type="submit"
                        class="w-full bg-primary hover:bg-primaryHover text-white py-3 rounded-xl font-bold text-[15px] transition-all shadow-lg shadow-primary/20">

                        Send OTP

                    </button>

                </form>


                {{-- LOGIN LINK --}}
                <div class="text-center mt-5">

                    <p class="text-sm text-gray-500">

                        Remember your password?

                        <a href="{{ route('vendor.login') }}"
                            class="text-primary font-semibold hover:underline">

                            Login Now

                        </a>

                    </p>

                </div>

            </div>

        </div>

    </section>

    {{-- FOOTER --}}
    @include('auth.Layout.footer')
<script>
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>
    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

</body>

</html>