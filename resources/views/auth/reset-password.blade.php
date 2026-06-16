@include('auth.Layout.header')

<body class="text-gray-800 antialiased font-sans">

    <!-- Top Bar -->
    @include('auth.Layout.top_bar')

    <!-- Header -->
    @include('auth.Layout.main_header')

    <!-- Main Section -->
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
                        Reset Your Password Securely
                    </h2>

                    <p class="text-slate-300 text-[14px] leading-relaxed max-w-sm">
                        Enter the OTP sent to your email and create a new password
                        to regain access to your account.
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

                    <!-- Title -->
                    <h2 class="text-[24px] font-bold text-gray-900 mb-2">
                        Reset Password
                    </h2>

                    <p class="text-[13px] text-gray-500 mb-8">
                        Verify OTP and create a new password.
                    </p>

                    <!-- Error Message -->
                    @if(session('error'))
                        <div
                            class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-600">

                            {{ session('error') }}

                        </div>
                    @endif

                    <!-- Success Message -->
                    @if(session('success'))
                        <div
                            class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-600">

                            {{ session('success') }}

                        </div>
                    @endif

                    <!-- Form -->
                    <form id="resetPasswordForm"
                          action="{{ route('reset.password.update', $user->id) }}"
                          method="POST"
                          class="space-y-5">

                        @csrf

                        <!-- OTP -->
                        <div>
                            <label class="block text-[13px] font-bold text-gray-700 mb-1.5">
                                OTP
                            </label>

                            <div class="relative">

                                <i data-lucide="shield-check"
                                    class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>

                                <input type="text"
                                       name="otp"
                                       id="otp"
                                       value="{{ old('otp') }}"
                                       placeholder="Enter OTP"
                                       class="w-full h-11 pl-10 pr-4 bg-slate-50 border border-gray-200 rounded-xl text-[13px] focus:outline-none focus:border-primary focus:bg-white transition-colors">

                            </div>

                            <p id="otpError" class="text-red-500 text-xs mt-1"></p>

                            <p id="otpSuccess" class="text-emerald-500 text-xs mt-1"></p>

                            @error('otp')
                                <p class="text-red-500 text-xs mt-1">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Verify OTP Button -->
                        <button type="button"
                                id="verifyOtpBtn"
                                class="w-full bg-primary text-white hover:bg-primaryHover h-11 rounded-xl text-[14px] font-bold transition-all shadow-md shadow-primary/20 cursor-pointer">

                            Verify OTP

                        </button>

                        <!-- Password Section -->
                        <div id="passwordSection" class="hidden space-y-5">

                            <!-- Password -->
                            <div>
                                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">
                                    New Password
                                </label>

                                <div class="relative">

                                    <i data-lucide="lock"
                                        class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>

                                    <input type="password"
                                           name="password"
                                           placeholder="Enter New Password"
                                           class="w-full h-11 pl-10 pr-4 bg-slate-50 border border-gray-200 rounded-xl text-[13px] focus:outline-none focus:border-primary focus:bg-white transition-colors">

                                </div>

                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div>
                                <label class="block text-[13px] font-bold text-gray-700 mb-1.5">
                                    Confirm Password
                                </label>

                                <div class="relative">

                                    <i data-lucide="lock-keyhole"
                                        class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>

                                    <input type="password"
                                           name="password_confirmation"
                                           placeholder="Confirm Password"
                                           class="w-full h-11 pl-10 pr-4 bg-slate-50 border border-gray-200 rounded-xl text-[13px] focus:outline-none focus:border-primary focus:bg-white transition-colors">

                                </div>
                            </div>

                            <!-- Reset Password Button -->
                            <button type="submit"
                                class="w-full bg-emerald-500 text-white hover:bg-emerald-600 h-11 rounded-xl text-[14px] font-bold transition-all shadow-md shadow-emerald-500/20 cursor-pointer">

                                Reset Password

                            </button>

                        </div>

                        <!-- Back Login -->
                        <div class="text-center text-[13px] text-gray-600">
                            Back to
                            <a href="{{ route('login') }}"
                               class="text-primary font-bold hover:underline">

                                Login

                            </a>
                        </div>

                    </form>

                </div>

            </div>

        </div>

    </section>

    <!-- Footer -->
    @include('auth.Layout.footer')

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Lucide -->
    <script>
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>

    <!-- OTP Verify AJAX -->
    <script>

        $('#verifyOtpBtn').click(function () {

            let otp = $('#otp').val();

            $('#otpError').html('');
            $('#otpSuccess').html('');

            $.ajax({

                url: "{{ route('verify.reset.otp', $user->id) }}",

                type: "POST",

                data: {

                    _token: "{{ csrf_token() }}",

                    otp: otp
                },

                success: function (response) {

                    if (response.status == true) {

                        $('#otpSuccess').html(response.message);

                        $('#passwordSection').removeClass('hidden');

                        $('#verifyOtpBtn').hide();

                        $('#otp').attr('readonly', true);

                    } else {

                        $('#otpError').html(response.message);
                    }

                },

                error: function (xhr) {

                    if (xhr.responseJSON.errors?.otp) {

                        $('#otpError').html(xhr.responseJSON.errors.otp[0]);
                    }

                }

            });

        });

    </script>

</body>

</html>