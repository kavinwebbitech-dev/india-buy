@include('auth.Layout.header')

<body class="text-gray-800 antialiased font-sans bg-slate-50">

    {{-- TOP BAR --}}
    @include('auth.Layout.top_bar')

    {{-- HEADER --}}
    @include('auth.Layout.main_header')

    {{-- RESET PASSWORD SECTION --}}
    <section class="flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-md bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">

            {{-- HEADER --}}
            <div class="px-6 py-6 border-b border-gray-100 text-center">

                <h2 class="text-[28px] font-bold text-gray-900 mb-2">
                    Reset Password
                </h2>

                <p class="text-[14px] text-gray-500">
                    Enter OTP and create new password
                </p>

            </div>

            {{-- BODY --}}
            <div class="p-6">

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


                <form action="{{ route('vendor.reset.password.submit') }}"
                    method="POST">

                    @csrf

                    {{-- OTP --}}
                    <div class="mb-5">

                        <label class="block text-[13px] font-bold text-gray-700 mb-2">

                            OTP
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text"
                            name="otp"
                            value="{{ old('otp') }}"
                            maxlength="6"
                            placeholder="Enter 6 Digit OTP"
                            class="w-full h-11 px-4 bg-slate-50 border border-gray-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none">

                        @error('otp')

                            <p class="text-red-500 text-xs mt-1">

                                {{ $message }}

                            </p>

                        @enderror

                    </div>


                    {{-- NEW PASSWORD --}}
                    <div class="mb-5">

                        <label class="block text-[13px] font-bold text-gray-700 mb-2">

                            New Password
                            <span class="text-red-500">*</span>

                        </label>

                        <div class="relative">

                            <input type="password"
                                id="password"
                                name="password"
                                placeholder="Enter New Password"
                                class="w-full h-11 px-4 pr-12 bg-slate-50 border border-gray-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none">

                            <button type="button"
                                onclick="togglePassword('password','passwordEye')"
                                class="absolute top-3 right-4 text-gray-500">

                                <i id="passwordEye" class="fa fa-eye-slash"></i>

                            </button>

                        </div>

                        @error('password')

                            <p class="text-red-500 text-xs mt-1">

                                {{ $message }}

                            </p>

                        @enderror

                    </div>


                    {{-- CONFIRM PASSWORD --}}
                    <div class="mb-6">

                        <label class="block text-[13px] font-bold text-gray-700 mb-2">

                            Confirm Password
                            <span class="text-red-500">*</span>

                        </label>

                        <div class="relative">

                            <input type="password"
                                id="confirm_password"
                                name="password_confirmation"
                                placeholder="Confirm Password"
                                class="w-full h-11 px-4 pr-12 bg-slate-50 border border-gray-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none">

                            <button type="button"
                                onclick="togglePassword('confirm_password','confirmPasswordEye')"
                                class="absolute top-3 right-4 text-gray-500">

                                <i id="confirmPasswordEye" class="fa fa-eye-slash"></i>

                            </button>

                        </div>

                    </div>


                    {{-- SUBMIT BUTTON --}}
                    <button type="submit"
                        class="w-full bg-primary hover:bg-primaryHover text-white py-3 rounded-xl font-bold text-[15px] transition-all shadow-lg shadow-primary/20">

                        Reset Password

                    </button>

                </form>


                {{-- LOGIN LINK --}}
                <div class="text-center mt-5">

                    <p class="text-sm text-gray-500">

                        Back to

                        <a href="{{ route('vendor.login') }}"
                            class="text-primary font-semibold hover:underline">

                            Vendor Login

                        </a>

                    </p>

                </div>

            </div>

        </div>

    </section>

    {{-- FOOTER --}}
    @include('auth.Layout.footer')

    {{-- JQUERY --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>

        function togglePassword(inputId, eyeId) {

            let passwordInput = document.getElementById(inputId);
            let eyeIcon = document.getElementById(eyeId);

            if (passwordInput.type === 'password') {

                passwordInput.type = 'text';

                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');

            } else {

                passwordInput.type = 'password';

                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');

            }

        }

    </script>
<script>
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>
</body>

</html>