@include('auth.Layout.header')

<body class="text-gray-800 antialiased font-sans">

    <!-- Top Bar -->
    @include('auth.Layout.top_bar')

    <!-- Main Header -->
    @include('auth.Layout.main_header')

    <!-- Main Content -->
    <section
        class="bg-slate-50 min-h-screen text-gray-800 antialiased flex items-center justify-center p-2 selection:bg-primary/20 selection:text-primary">

        <div
            class="bg-white w-full max-w-[1000px] min-h-[600px] rounded-3xl shadow-[0_8px_40px_rgb(0,0,0,0.06)] border border-gray-100 flex overflow-hidden relative">

            <!-- Left Side -->
            <div
                class="hidden lg:flex w-1/2 bg-slate-900 relative flex-col justify-between p-12 text-white overflow-hidden">

                <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                    alt="Auth Background"
                    class="absolute inset-0 w-full h-full object-cover ">

                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/60 to-transparent"></div>

                <div class="relative z-10 flex items-center gap-2 font-black text-2xl">
                    <i data-lucide="globe" class="w-8 h-8 text-primary"></i>
                    India Buy
                </div>

                <div class="relative z-10">
                    <div
                        class="inline-block px-3 py-1 bg-white/10 backdrop-blur-md rounded-lg border border-white/10 text-[12px] font-bold mb-4">
                        <i data-lucide="shield-check"
                            class="w-3.5 h-3.5 inline mr-1 text-emerald-400"></i>
                        Secure Platform
                    </div>

                    <h2 class="text-[32px] font-bold leading-tight mb-4">
                        Forgot Your Password?
                    </h2>

                    <p class="text-slate-300 text-[14px] leading-relaxed max-w-sm">
                        No worries. Enter your registered email address and we’ll send an OTP to reset your password securely.
                    </p>
                </div>
            </div>

            <!-- Right Side -->
            <div
                class="w-full lg:w-1/2 p-8 sm:p-12 flex flex-col justify-center relative overflow-hidden bg-white">

                <div class="lg:hidden flex items-center gap-2 font-black text-xl mb-8 text-primary">
                    <i data-lucide="globe" class="w-6 h-6"></i>
                    India Buy
                </div>

                <div class="relative w-full max-w-md mx-auto">

                    <!-- Success Message -->
                    @if(session('success'))
                        <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl text-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Error Message -->
                    @if(session('error'))
                        <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl text-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Forgot Password Form -->
                    <div class="w-full">

                        <a href="{{ route('login') }}"
                            class="w-8 h-8 flex items-center justify-center bg-slate-50 hover:bg-slate-100 rounded-lg text-gray-500 mb-6 transition-colors">
                            <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        </a>

                        <h2 class="text-[24px] font-bold text-gray-900 mb-2">
                            Reset Password
                        </h2>

                        <p class="text-[13px] text-gray-500 mb-8">
                            Enter your registered email and we'll send you an OTP to reset your password.
                        </p>

                        <form action="{{ route('forgot.password.send') }}" method="POST" class="space-y-5">
                            @csrf

                            <!-- Email -->
                            <div>
                                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">
                                    Email Address
                                </label>

                                <div class="relative">
                                    <i data-lucide="mail"
                                        class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>

                                    <input type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        placeholder="john@example.com"
                                        required
                                        class="w-full h-11 pl-10 pr-4 bg-slate-50 border border-gray-200 rounded-xl text-[13px] focus:outline-none focus:border-primary focus:bg-white transition-colors">

                                </div>

                                @error('email')
                                    <p class="text-red-500 text-[12px] mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Submit -->
                            <button type="submit"
                                class="w-full bg-primary text-white hover:bg-primaryHover h-11 rounded-xl text-[14px] font-bold transition-all shadow-md shadow-primary/20 cursor-pointer">

                                Send Reset OTP

                            </button>

                            <!-- Login Link -->
                            <div class="text-center text-[13px] text-gray-600 pt-2">
                                Remember your password?
                                <a href="{{ route('login') }}"
                                    class="text-primary font-bold hover:underline ml-1">
                                    Login
                                </a>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('auth.Layout.footer')

    <!-- Lucide Icons -->
    <script>
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>

</body>

</html>