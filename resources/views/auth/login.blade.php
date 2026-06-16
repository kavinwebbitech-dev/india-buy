@include('auth.Layout.header')

<body class="text-gray-800 antialiased font-sans">

    {{-- @include('auth.Layout.top_bar') --}}

   
    <!--@include('auth.Layout.main_header')-->
    {{-- @include('frontend.layouts.main_header') --}}
    @include('frontend.layouts.main_header')

    {{-- @include('frontend.layouts.navbar') --}}

   
    <section
        class="bg-slate-50 text-gray-800 antialiased flex items-center justify-center p-2 sm:p-6 selection:bg-primary/20 selection:text-primary">

        <div
            class="bg-white w-full max-w-[1000px] min-h-[600px] rounded-3xl shadow-[0_8px_40px_rgb(0,0,0,0.06)] border border-gray-100 flex overflow-hidden relative">

            {{-- Left Side --}}
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
                        Welcome Back
                    </h2>

                    <p class="text-slate-300 text-[14px] leading-relaxed max-w-sm">
                        Login to access your account, manage your orders,
                        and connect with verified suppliers worldwide.
                    </p>
                </div>
            </div>

            {{-- Right Side --}}
            <div
                class="w-full lg:w-1/2 p-8 sm:p-12 flex flex-col justify-center relative overflow-hidden hide-scrollbar bg-white">

                <div class="lg:hidden flex items-center gap-2 font-black text-xl mb-8 text-primary">
                    <i data-lucide="globe" class="w-6 h-6"></i>
                    India Buy
                </div>

                <div class="relative w-full max-w-md mx-auto">

                    {{-- Login Section --}}
                    <div class="w-full">

                        <h2 class="text-[24px] font-bold text-gray-900 mb-2">
                            Sign In
                        </h2>

                        <p class="text-[13px] text-gray-500 mb-8">
                            Please enter your login details.
                        </p>

                        {{-- Success Message --}}
                        @if(session('success'))
                            <div
                                class="mb-4 rounded-xl border border-green-200 bg-green-50 text-green-700 px-4 py-3 text-sm">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Error Message --}}
                        @if(session('error'))
                            <div
                                class="mb-4 rounded-xl border border-red-200 bg-red-50 text-red-700 px-4 py-3 text-sm">
                                {{ session('error') }}
                            </div>
                        @endif

                        {{-- Validation Errors --}}
                        @if ($errors->any())
                            <div
                                class="mb-4 rounded-xl border border-red-200 bg-red-50 text-red-700 px-4 py-3 text-sm">
                                <ul class="list-disc pl-5 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Login Form --}}
                        <form action="{{ route('login.check') }}" method="POST" class="space-y-4">

                            @csrf

                            {{-- Email --}}
                            <div>
                                <label
                                    class="block text-[13px] font-bold text-gray-700 mb-1.5">
                                    Email Address
                                </label>

                                <div class="relative">
                                    <i data-lucide="mail"
                                        class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>

                                    <input type="email"
                                        name="email"
                                        placeholder="john@example.com"
                                        value="{{ old('email') }}"
                                        class="w-full h-11 pl-10 pr-4 bg-slate-50 border border-gray-200 rounded-xl text-[13px] focus:outline-none focus:border-primary focus:bg-white transition-colors">
                                </div>

                                @error('email')
                                    <span class="text-red-500 text-[12px]">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div>
                                <label
                                    class="block text-[13px] font-bold text-gray-700 mb-1.5">
                                    Password
                                </label>

                                <div class="relative">
                                    <i data-lucide="lock"
                                        class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>

                                    <input type="password"
                                        name="password"
                                        placeholder="••••••••"
                                        class="w-full h-11 pl-10 pr-4 bg-slate-50 border border-gray-200 rounded-xl text-[13px] focus:outline-none focus:border-primary focus:bg-white transition-colors">
                                </div>

                                @error('password')
                                    <span class="text-red-500 text-[12px]">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>

                            {{-- Forgot Password --}}
                            <div class="flex items-center justify-end">
                                <a href="{{ route('forgot.password') }}"
                                    class="text-primary text-[12px] font-bold hover:underline">
                                    Forgot Password?
                                </a>
                            </div>

                            {{-- Login Button --}}
                            <button type="submit"
                                class="w-full bg-primary text-white hover:bg-primaryHover h-11 rounded-xl text-[14px] font-bold transition-all shadow-md shadow-primary/20 mt-4 cursor-pointer">
                                Sign In
                            </button>

                        </form>

                        {{-- Register --}}
                        <div class="mt-8 text-center text-[13px] text-gray-600">
                            Don't have an account?

                            <a href="{{ route('register') }}"
                                class="text-primary font-bold hover:underline ml-1">
                                Sign Up
                            </a>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </section>

   
    @include('auth.Layout.footer')

    
    <script>
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>

</body>

</html>