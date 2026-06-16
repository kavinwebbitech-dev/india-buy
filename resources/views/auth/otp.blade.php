@include('auth.Layout.header')

<body class="text-gray-800 antialiased font-sans bg-slate-50">

    {{-- Top Bar --}}
    @include('auth.Layout.top_bar')

    {{-- Main Header --}}
    @include('auth.Layout.main_header')

   {{-- OTP VERIFY SECTION --}}
<section class="min-h-screen flex items-center justify-center px-4 py-10 bg-slate-50">

    <div class="w-full max-w-md bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">

        {{-- Header --}}
        <div class="px-6 py-6 border-b border-gray-100 text-center">

            <h2 class="text-[26px] font-bold text-gray-900 mb-2">
                Verify OTP
            </h2>

            <p class="text-[14px] text-gray-500">
                Enter the 6 digit OTP sent to your email
            </p>

            @if(session('email'))
                <p class="text-primary font-semibold text-sm mt-2">
                    {{ session('email') }}
                </p>
            @endif

        </div>

        {{-- Body --}}
        <div class="p-6">

            {{-- SUCCESS MESSAGE --}}
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ERROR MESSAGE --}}
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl text-sm">
                    {{ session('error') }}
                </div>
            @endif

           <form action="{{ route('vendor.verify.otp', $vendor->id) }}" method="POST">

                @csrf

                {{-- OTP INPUTS --}}
                <div class="flex justify-center gap-3 mb-6">

                    <input type="text"
                        maxlength="1"
                        class="otp-input w-14 h-14 text-center text-xl font-bold bg-slate-50 border border-gray-300 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none">

                    <input type="text"
                        maxlength="1"
                        class="otp-input w-14 h-14 text-center text-xl font-bold bg-slate-50 border border-gray-300 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none">

                    <input type="text"
                        maxlength="1"
                        class="otp-input w-14 h-14 text-center text-xl font-bold bg-slate-50 border border-gray-300 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none">

                    <input type="text"
                        maxlength="1"
                        class="otp-input w-14 h-14 text-center text-xl font-bold bg-slate-50 border border-gray-300 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none">

                    <input type="text"
                        maxlength="1"
                        class="otp-input w-14 h-14 text-center text-xl font-bold bg-slate-50 border border-gray-300 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none">

                    <input type="text"
                        maxlength="1"
                        class="otp-input w-14 h-14 text-center text-xl font-bold bg-slate-50 border border-gray-300 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 focus:outline-none">

                </div>

                {{-- Hidden OTP --}}
                <input type="hidden" name="otp" id="otp">

                @error('otp')
                    <p class="text-red-500 text-sm text-center mb-4">
                        {{ $message }}
                    </p>
                @enderror

                {{-- SUBMIT BUTTON --}}
                <button type="submit"
                    class="w-full bg-primary hover:bg-primaryHover text-white py-3 rounded-xl font-bold text-[15px] transition-all shadow-lg shadow-primary/20">

                    Verify OTP

                </button>

            </form>

            {{-- RESEND --}}
            <div class="text-center mt-5">

                <a href="{{ route('vendor.resend.otp', $vendor->id) }}"
                    class="text-primary text-sm font-semibold hover:underline">

                    Resend OTP

                </a>

            </div>

        </div>

    </div>

</section>

{{-- JQUERY --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

$(document).ready(function () {

    $('.otp-input').on('input', function () {

        this.value = this.value.replace(/[^0-9]/g, '');

        if (this.value.length === 1) {

            $(this).next('.otp-input').focus();

        }

        updateOTP();

    });

    $('.otp-input').on('keydown', function (e) {

        if (e.key === 'Backspace' && this.value === '') {

            $(this).prev('.otp-input').focus();

        }

    });

    function updateOTP() {

        let otp = '';

        $('.otp-input').each(function () {

            otp += $(this).val();

        });

        $('#otp').val(otp);

    }

});

</script>

    {{-- Footer --}}
    @include('auth.Layout.footer')

    {{-- JQUERY --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    </script>

</body>

</html>