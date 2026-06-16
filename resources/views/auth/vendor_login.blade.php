@include('auth.Layout.header')

<body class="text-gray-800 antialiased font-sans bg-slate-50">

    {{-- TOP BAR --}}
    @include('auth.Layout.top_bar')

    {{-- HEADER --}}
    @include('auth.Layout.main_header')

    {{-- LOGIN SECTION --}}
    <section class="min-h-screen flex items-center justify-center px-4 py-10">

        <div class="w-full max-w-md bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">

            {{-- HEADER --}}
            <div class="px-6 py-6 border-b border-gray-100 text-center">

                <h2 class="text-[28px] font-bold text-gray-900 mb-2">
                    Vendor Login
                </h2>

                <p class="text-[14px] text-gray-500">
                    Login to access your vendor dashboard
                </p>

            </div>

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

                <form action="{{ route('vendor.login.submit') }}" method="POST">

                    @csrf

                    {{-- VENDOR TYPE --}}
                    


                    {{-- EMAIL --}}
                    <div class="mb-5">

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


                    {{-- PASSWORD --}}
                    <div class="mb-6">

                        <label class="block text-[13px] font-bold text-gray-700 mb-2">
                            Password
                            <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">

                            <input type="password"
                                id="password"
                                name="password"
                                placeholder="Enter Password"
                                class="w-full h-11 px-4 pr-12 bg-slate-50 border border-gray-200 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none">

                            <button type="button"
                                onclick="togglePassword()"
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


                    {{-- LOGIN BUTTON --}}
                    <button type="submit"
                        class="w-full bg-primary hover:bg-primaryHover text-white py-3 rounded-xl font-bold text-[15px] transition-all shadow-lg shadow-primary/20">

                        Login

                    </button>
                    {{-- FORGOT PASSWORD --}}
                    <div class="text-center mt-4 mb-5">

                        <a href="{{ route('vendor.forgot.password')}}"
                            class="text-sm text-primary font-semibold hover:underline">

                            Forgot Password?

                        </a>

                    </div>

                </form>


                {{-- REGISTER LINK --}}
                <div class="text-center mt-5">

                    <p class="text-sm text-gray-500">

                        Don't have a vendor account?

                        <a href="{{ route('vendor.register') }}"
                            class="text-primary font-semibold hover:underline">

                            Register Now

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

        function togglePassword() {

            let password = document.getElementById('password');
            let eye = document.getElementById('passwordEye');

            if (password.type === 'password') {

                password.type = 'text';

                eye.classList.remove('fa-eye-slash');
                eye.classList.add('fa-eye');

            } else {

                password.type = 'password';

                eye.classList.remove('fa-eye');
                eye.classList.add('fa-eye-slash');

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