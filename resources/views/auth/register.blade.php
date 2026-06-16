@include('auth.Layout.header')

<body class="text-gray-800 antialiased font-sans">


    @include('auth.Layout.top_bar')


    @include('auth.Layout.main_header')

    <style>
        .step-hidden {
            display: none;
        }

        .step-active {
            display: block;
        }

        .error-text {
            color: red;
            font-size: 12px;
            margin-top: 4px;
        }
    </style>


    <section class="bg-slate-50 min-h-screen text-gray-800 antialiased flex items-center justify-center p-2">

        <div
            class="bg-white w-full max-w-[1000px] min-h-[600px] rounded-3xl shadow-[0_8px_40px_rgb(0,0,0,0.06)] border border-gray-100 flex overflow-hidden relative">

            <!-- Left Side -->
            <div
                class="hidden lg:flex w-1/2 bg-slate-900 relative flex-col justify-between p-12 text-white overflow-hidden">

                <img src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                    alt="Auth Background" class="absolute inset-0 w-full h-full object-cover ">

                <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/60 to-transparent"></div>

                <div class="relative z-10 flex items-center gap-2 font-black text-2xl">
                    <i data-lucide="globe" class="w-8 h-8 text-primary"></i>
                    India Buy
                </div>

                <div class="relative z-10">
                    <div
                        class="inline-block px-3 py-1 bg-white/10 backdrop-blur-md rounded-lg border border-white/10 text-[12px] font-bold mb-4">
                        <i data-lucide="shield-check" class="w-3.5 h-3.5 inline mr-1 text-emerald-400"></i>
                        Secure Platform
                    </div>

                    <h2 class="text-[32px] font-bold leading-tight mb-4">
                        Empowering global B2B trade.
                    </h2>

                    <p class="text-slate-300 text-[14px] leading-relaxed max-w-sm">
                        Connect with verified suppliers, manage your sourcing,
                        and grow your business with our premium tools.
                    </p>
                </div>
            </div>

            <!-- Right Side -->
            <div class="w-full lg:w-1/2 p-8 sm:p-12 flex flex-col justify-center relative overflow-hidden bg-white">

                <div class="lg:hidden flex items-center gap-2 font-black text-xl mb-8 text-primary">
                    <i data-lucide="globe" class="w-6 h-6"></i>
                    India Buy
                </div>

                <div class="relative w-full max-w-md mx-auto">

                    {{-- STEP 1 --}}
                    <div id="step-register-basic" class="auth-step step-active w-full">

                        <h2 class="text-[24px] font-bold text-gray-900 mb-2">
                            Create an Account
                        </h2>

                        <p class="text-[13px] text-gray-500 mb-8">
                            Enter your details to get started.
                        </p>

                        {{-- Success Message --}}
                        @if (session('success'))
                            <div class="mb-4 bg-green-100 text-green-700 p-3 rounded-lg text-sm">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form id="basicForm">

                            <!-- Name -->
                            <div class="mb-4">
                                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">
                                    Full Name
                                </label>

                                <div class="relative">
                                    <i data-lucide="user"
                                        class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>

                                    <input type="text" id="name" placeholder="John Doe"
                                        value="{{ old('name') }}"
                                        class="w-full h-11 pl-10 pr-4 bg-slate-50 border border-gray-200 rounded-xl text-[13px] focus:outline-none focus:border-primary">
                                </div>

                                @error('name')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">
                                    Email Address
                                </label>

                                <div class="relative">
                                    <i data-lucide="mail"
                                        class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>

                                    <input type="email" id="email" placeholder="john@example.com"
                                        value="{{ old('email') }}"
                                        class="w-full h-11 pl-10 pr-4 bg-slate-50 border border-gray-200 rounded-xl text-[13px] focus:outline-none focus:border-primary">
                                </div>

                                @error('email')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone -->
                            <div class="mb-4">
                                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">
                                    Phone
                                </label>

                                <div class="relative">
                                    <i data-lucide="phone"
                                        class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>

                                    <input type="text" id="phone" placeholder="9876543210"
                                        value="{{ old('phone') }}"
                                        class="w-full h-11 pl-10 pr-4 bg-slate-50 border border-gray-200 rounded-xl text-[13px] focus:outline-none focus:border-primary">
                                </div>

                                @error('phone')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="button" onclick="goToNextStep()"
                                class="w-full bg-primary text-white hover:bg-primaryHover h-11 rounded-xl text-[14px] font-bold transition-all mt-4 cursor-pointer">

                                Continue
                            </button>
                        </form>

                        <div class="mt-6 text-center text-[13px] text-gray-600">
                            Already have an account?

                            <a href="{{ route('login') }}" class="text-primary font-bold hover:underline ml-1">
                                Sign In
                            </a>
                        </div>
                    </div>

                    {{-- STEP 2 --}}
                    <div id="step-register-details" class="auth-step step-hidden w-full">

                        <button type="button" onclick="switchStep('step-register-basic')"
                            class="w-8 h-8 flex items-center justify-center bg-slate-50 hover:bg-slate-100 rounded-lg text-gray-500 mb-4">

                            <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        </button>

                        <h2 class="text-[20px] font-bold text-gray-900 mb-1">
                            Complete Registration
                        </h2>

                        <p class="text-[12px] text-gray-500 mb-6">
                            Fill remaining details and create account.
                        </p>

                        <form action="{{ route('register.store') }}" method="POST">

                            @csrf

                            {{-- Hidden Fields --}}
                            <input type="hidden" name="name" id="final_name">
                            <input type="hidden" name="email" id="final_email">
                            <input type="hidden" name="phone" id="final_phone">

                            <!-- City -->
                            <div class="mb-4">
                                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">
                                    City
                                </label>

                                <div class="relative">
                                    <i data-lucide="building"
                                        class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>

                                    <input type="text" name="city" placeholder="Mumbai"
                                        value="{{ old('city') }}"
                                        class="w-full h-11 pl-9 pr-3 bg-slate-50 border border-gray-200 rounded-xl text-[13px] focus:outline-none focus:border-primary">
                                </div>

                                @error('city')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- State -->
                            <div class="mb-4">
                                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">
                                    State
                                </label>

                                <div class="relative">
                                    <i data-lucide="map-pin"
                                        class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>

                                    <input type="text" name="state" placeholder="Tamil Nadu"
                                        value="{{ old('state') }}"
                                        class="w-full h-11 pl-9 pr-3 bg-slate-50 border border-gray-200 rounded-xl text-[13px] focus:outline-none focus:border-primary">
                                </div>

                                @error('state')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">
                                    Password
                                </label>

                                <div class="relative">
                                    <i data-lucide="lock"
                                        class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>

                                    <input type="password" name="password" placeholder="••••••••"
                                        class="w-full h-11 pl-10 pr-4 bg-slate-50 border border-gray-200 rounded-xl text-[13px] focus:outline-none focus:border-primary">
                                </div>

                                @error('password')
                                    <div class="error-text">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <!-- Password -->
                            <div class="mb-4">
                                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">
                                    Password
                                </label>

                                <div class="relative">
                                    <i data-lucide="lock-keyhole"
                                        class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>

                                    <input type="password" id="password" name="password" placeholder="••••••••"
                                        class="w-full h-11 pl-10 pr-10 bg-slate-50 border border-gray-200 rounded-xl text-[13px] focus:outline-none focus:border-primary">

                                    <button type="button" onclick="togglePassword('password','passwordIcon')"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                                        <i id="passwordIcon" data-lucide="eye" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">
                                    Confirm Password
                                </label>

                                <div class="relative">
                                    <i data-lucide="lock-keyhole"
                                        class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>

                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        placeholder="••••••••"
                                        class="w-full h-11 pl-10 pr-10 bg-slate-50 border border-gray-200 rounded-xl text-[13px] focus:outline-none focus:border-primary">

                                    <button type="button"
                                        onclick="togglePassword('password_confirmation','confirmPasswordIcon')"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400">
                                        <i id="confirmPasswordIcon" data-lucide="eye" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </div>

                            <button type="submit"
                                class="w-full bg-primary text-white hover:bg-primaryHover h-11 rounded-xl text-[14px] font-bold transition-all mt-4 cursor-pointer">

                                Complete Registration
                            </button>

                        </form>
                    </div>

                </div>
            </div>

        </div>
    </section>


    @include('auth.Layout.footer')

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {
                input.type = 'text';
                icon.setAttribute('data-lucide', 'eye-off');
            } else {
                input.type = 'password';
                icon.setAttribute('data-lucide', 'eye');
            }

            lucide.createIcons();
        }
    </script>
    <script>
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }


        function switchStep(targetId) {
            document.querySelectorAll('.auth-step').forEach(step => {
                step.classList.remove('step-active');
                step.classList.add('step-hidden');
            });

            document.getElementById(targetId).classList.remove('step-hidden');
            document.getElementById(targetId).classList.add('step-active');
        }


        function goToNextStep() {
            let name = document.getElementById('name').value;
            let email = document.getElementById('email').value;
            let phone = document.getElementById('phone').value;

            if (name == '' || email == '' || phone == '') {
                alert('Please fill all fields');
                return;
            }

            // Set Hidden Fields
            document.getElementById('final_name').value = name;
            document.getElementById('final_email').value = email;
            document.getElementById('final_phone').value = phone;

            switchStep('step-register-details');
        }
    </script>

</body>

</html>
