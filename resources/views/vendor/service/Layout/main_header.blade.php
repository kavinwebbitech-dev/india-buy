<header class="bg-white sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between gap-4 lg:gap-8">
            <!-- Mobile Menu Toggle & Logo -->
            <div class="flex items-center gap-3">
                <button class="lg:hidden text-gray-600">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <a href="#" class="flex items-center gap-2 text-2xl md:text-3xl font-bold text-primary tracking-tight">
                    <i data-lucide="globe" class="text-primary w-7 h-7"></i>
                    <span>India Buy</span>
                </a>
            </div>

            <!-- Mobile Search Icon -->
            <button class="md:hidden text-gray-600">
                <i data-lucide="search" class="w-6 h-6"></i>
            </button>

            <!-- Header Right Links (Desktop) -->
            <div class="hidden lg:flex items-center space-x-8 text-[13px] font-medium"> 
                <!-- <a href="#" class="flex flex-col items-center text-gray-600 hover:text-primary transition gap-1 group">
                    <i data-lucide="message-square-text"
                        class="w-5 h-5 text-gray-500 group-hover:text-primary transition"></i>
                    <span class="whitespace-nowrap">Messages</span>
                </a> -->
               @php

    use Illuminate\Support\Facades\Auth;

    $vendor = Auth::guard('vendor')->user();

@endphp


<div class="relative group ml-auto shrink-0 z-50">

    {{-- ACCOUNT BUTTON --}}
    <button
        class="flex items-center gap-3 bg-primary text-white px-4 py-2 rounded-xl hover:bg-primaryHover transition-all shadow-md shadow-primary/20">

        {{-- LOGO --}}
        @if($vendor && $vendor->company_logo)

            <img src="{{ asset('uploads/vendor_logo/' . $vendor->company_logo) }}"
                 class="w-9 h-9 rounded-full object-cover border border-white">

        @else

            <div class="w-9 h-9 rounded-full bg-white/20 flex items-center justify-center">

                <i data-lucide="building-2" class="w-5 h-5"></i>

            </div>

        @endif

        {{-- COMPANY DETAILS --}}
        <div class="text-left leading-tight hidden sm:block">

            <h6 class="text-[13px] font-bold">

                {{ $vendor->company_name ?? 'Vendor' }}

            </h6>

            <p class="text-[11px] text-white/80">

                {{ $vendor->vendorType->vendor_name ?? 'Vendor Account' }}

            </p>

        </div>

        <i data-lucide="chevron-down"
            class="w-4 h-4 transition-transform group-hover:rotate-180"></i>

    </button>


    {{-- DROPDOWN --}}
    <div
        class="absolute top-full right-0 mt-3 w-72 bg-white rounded-2xl border border-gray-100 shadow-[0_10px_40px_rgba(0,0,0,0.08)] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 overflow-hidden">

        {{-- TOP PROFILE --}}
        <div class="p-5 bg-slate-50 border-b border-gray-100">

            <div class="flex items-center gap-4">

                {{-- LOGO --}}
                @if($vendor && $vendor->company_logo)

                    <img src="{{ asset('uploads/vendor_logo/' . $vendor->company_logo) }}"
                         class="w-16 h-16 rounded-2xl object-cover border">

                @else

                    <div class="w-16 h-16 rounded-2xl bg-white border flex items-center justify-center">

                        <i data-lucide="building-2"
                           class="w-8 h-8 text-gray-400"></i>

                    </div>

                @endif

                {{-- DETAILS --}}
                <div class="flex-1 min-w-0">

                    <h4 class="text-[15px] font-bold text-gray-900 truncate">

                        {{ $vendor->company_name }}

                    </h4>

                    <p class="text-[12px] text-primary font-semibold mt-1">

                        {{ $vendor->vendorType->vendor_name ?? '' }}

                    </p>

                    <p class="text-[12px] text-gray-500 truncate mt-1">

                        {{ $vendor->email }}

                    </p>

                </div>

            </div>

        </div>


        {{-- MENU --}}
        <div class="p-2">

           

            <div class="h-px bg-gray-100 my-2"></div>

            {{-- LOGOUT --}}
            <form action="{{ route('service.vendor.logout') }}"
                  method="POST">

                @csrf

                <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-[14px] font-medium text-red-500 hover:bg-red-50 transition-all">

                    <i data-lucide="log-out" class="w-4 h-4"></i>

                    Logout

                </button>

            </form>

        </div>

    </div>

</div>
            </div>
        </div>

        <!-- Mobile Search Bar (Expandable) -->
        <div class="md:hidden px-4 pb-3">
            <div class="flex items-center border-2 border-primary rounded-full overflow-hidden bg-white h-10">
                <input type="text" placeholder="Search..." class="flex-1 h-full px-4 focus:outline-none text-sm">
                <button class="h-full bg-primary text-white px-5 flex items-center justify-center">
                    <i data-lucide="search" class="w-4 h-4"></i>
                </button>
            </div>
        </div>
    </header>