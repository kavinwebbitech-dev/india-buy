@include('auth.Layout.header')

<body class="text-gray-800 antialiased font-sans">

    {{-- Top Bar --}}
    @include('auth.Layout.top_bar')

    {{-- Main Header --}}
    @include('auth.Layout.main_header')

    {{-- Main Section --}}
    <section
        class="bg-slate-50 min-h-screen flex items-center justify-center p-3 selection:bg-primary/20 selection:text-primary">

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
                        Verify Your Account
                    </h2>

                    <p class="text-slate-300 text-[14px] leading-relaxed max-w-sm">
                        We have sent a verification OTP to your registered email address.
                        Enter the code to activate your account.
                    </p>
                </div>
            </div>

            {{-- Right Side --}}
            <div
                class="w-full lg:w-1/2 p-8 sm:p-12 flex flex-col justify-center bg-white">

                <div class="lg:hidden flex items-center gap-2 font-black text-xl mb-8 text-primary">
                    <i data-lucide="globe" class="w-6 h-6"></i>
                    India Buy
                </div>

                <div class="w-full max-w-md mx-auto">

                    {{-- Heading --}}
                    <h2 class="text-[28px] font-bold text-gray-900 mb-2">
                        OTP Verification
                    </h2>

                    <p class="text-[13px] text-gray-500 mb-8">
                        Enter the 4-digit OTP sent to your email.
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

                    {{-- OTP Form --}}
                    <form action="{{ route('otp.verify') }}" method="POST" class="space-y-6">

                        @csrf

                        <input type="hidden" name="user_id" value="{{ $user->id }}">

                        {{-- OTP Boxes --}}
                        <div>
                            <label
                                class="block text-[13px] font-bold text-gray-700 mb-3">
                                Enter OTP
                            </label>

                            <div class="flex justify-between gap-3">

                                <input type="text"
                                    maxlength="1"
                                    class="otp-input w-14 h-14 text-center text-xl font-bold bg-slate-50 border border-gray-200 rounded-xl focus:border-primary focus:bg-white focus:outline-none transition-colors">

                                <input type="text"
                                    maxlength="1"
                                    class="otp-input w-14 h-14 text-center text-xl font-bold bg-slate-50 border border-gray-200 rounded-xl focus:border-primary focus:bg-white focus:outline-none transition-colors">

                                <input type="text"
                                    maxlength="1"
                                    class="otp-input w-14 h-14 text-center text-xl font-bold bg-slate-50 border border-gray-200 rounded-xl focus:border-primary focus:bg-white focus:outline-none transition-colors">

                                <input type="text"
                                    maxlength="1"
                                    class="otp-input w-14 h-14 text-center text-xl font-bold bg-slate-50 border border-gray-200 rounded-xl focus:border-primary focus:bg-white focus:outline-none transition-colors">
                            </div>

                            {{-- Hidden OTP --}}
                            <input type="hidden" name="otp" id="otp">
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                            class="w-full bg-primary text-white hover:bg-primaryHover h-11 rounded-xl text-[14px] font-bold transition-all shadow-md shadow-primary/20 cursor-pointer">
                            Verify OTP
                        </button>

                    </form>

                    {{-- Back Login --}}
                    <div class="mt-6 text-center text-[13px] text-gray-600">
                        Back to
                        <a href="{{ route('login') }}"
                            class="text-primary font-bold hover:underline">
                            Login
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    @include('auth.Layout.footer')

    {{-- OTP Script --}}
    <script>

        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

        const otpInputs = document.querySelectorAll('.otp-input');
        const otpHidden = document.getElementById('otp');

        otpInputs.forEach((input, index) => {

            input.addEventListener('input', function () {

                this.value = this.value.replace(/[^0-9]/g, '');

                if (this.value.length === 1 && index < otpInputs.length - 1) {
                    otpInputs[index + 1].focus();
                }

                updateOTP();
            });

            input.addEventListener('keydown', function (e) {

                if (e.key === 'Backspace' && this.value === '' && index > 0) {
                    otpInputs[index - 1].focus();
                }
            });
        });

        function updateOTP() {

            let otp = '';

            otpInputs.forEach(input => {
                otp += input.value;
            });

            otpHidden.value = otp;
        }

    </script>

</body>
</html>