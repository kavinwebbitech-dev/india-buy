@include('auth.Layout.header')

<body class="text-gray-800 antialiased font-sans bg-slate-50">
 

      <!-- 2. Main Header (Sticky) -->
    @include('frontend.layouts.main_header')
 



    <section id="heroSection"
        class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-primary py-24 flex items-center">

        @if(session('success'))

            <div class="absolute top-5 right-5 z-50 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm">

                {{ session('success') }}

            </div>

        @endif


        <div class="relative max-w-5xl mx-auto px-6 text-center text-white">

            <span
                class="inline-flex items-center px-5 py-2 rounded-full bg-white/10 border border-white/20 text-sm font-semibold mb-8">

                Become a Vendor

            </span>


            <h1 class="text-5xl lg:text-6xl font-black leading-tight mb-8">

                Sell Your Products <br>
                Across The World

            </h1>


            <p class="max-w-3xl mx-auto text-lg text-white/80 leading-8 mb-14">

                Reach millions of active B2B buyers globally and grow your business.

            </p>


            <div class="flex flex-wrap items-center justify-center gap-5">

                {{-- REGISTER BUTTON --}}
                <a href="{{ route('vendor.register') }}"
                   class="bg-white text-primary px-10 py-4 rounded-2xl font-bold text-lg hover:bg-gray-100 transition-all inline-block">

                    Register as Vendor

                </a>


                {{-- LOGIN BUTTON --}}
                <a href="{{ route('vendor.login') }}"
                   class="border border-white/30 px-10 py-4 rounded-2xl font-bold text-lg hover:bg-white/10 transition-all inline-block">

                    Vendor Login

                </a>

            </div>

        </div>

    </section>


    {{-- Footer --}}
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