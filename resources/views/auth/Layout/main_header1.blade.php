 <header class="bg-white sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-4 flex items-center justify-between gap-4 lg:gap-8">
            <!-- Mobile Menu Toggle & Logo -->
            <div class="flex items-center gap-3">
                <button class="lg:hidden text-gray-600">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <a href="{{ route('home') }}"  class="flex items-center gap-2 text-2xl md:text-3xl font-bold text-primary tracking-tight">
                    <i data-lucide="globe" class="text-primary w-7 h-7"></i>
                    <span>India Buy</span>
                </a>
            </div>

            <!-- Search Bar -->
            <div
                class="flex-1 max-w-3xl hidden md:flex items-center border-2 border-primary rounded-full bg-white h-11">

                <div
                    class="relative h-full flex items-center border-r border-gray-200 bg-gray-50 hover:bg-gray-100 rounded-l-full">
                    <select
                        class="h-full pl-4 pr-8 text-sm text-gray-600 bg-transparent appearance-none focus:outline-none cursor-pointer font-medium z-10">
                        <option value="products">Products</option>
                        <option value="suppliers">Suppliers</option>
                        <option value="services">Services</option>
                    </select>
                    <i data-lucide="chevron-down"
                        class="w-3 h-3 text-gray-500 absolute right-3 pointer-events-none z-0"></i>
                </div>

                <input type="text" placeholder="Search products, suppliers, or categories..."
                    class="flex-1 h-full px-4 focus:outline-none text-sm w-full bg-transparent">

                <button
                    class="h-full bg-primary hover:bg-primaryHover text-white px-8 font-medium transition flex items-center justify-center rounded-r-full">
                    Search
                </button>
            </div>

            <!-- Mobile Search Icon -->
            <button class="md:hidden text-gray-600">
                <i data-lucide="search" class="w-6 h-6"></i>
            </button>

            <!-- Header Right Links (Desktop) -->
            <div class="hidden lg:flex items-center space-x-8 text-[13px] font-medium">
                <a href="post-rfq.html"
                    class="flex flex-col items-center text-gray-600 hover:text-primary transition gap-1 group">
                    <i data-lucide="megaphone" class="w-5 h-5 text-gray-500 group-hover:text-primary transition"></i>
                    <span class="whitespace-nowrap">Post RFQ</span>
                </a>
                <a href="message.html" class="flex flex-col items-center text-gray-600 hover:text-primary transition gap-1 group">
                    <i data-lucide="message-square-text"
                        class="w-5 h-5 text-gray-500 group-hover:text-primary transition"></i>
                    <span class="whitespace-nowrap">Messages</span>
                </a>
                <div class="relative group ml-auto shrink-0 z-80">
                    <button
                        class="flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-xl text-[13px] font-bold hover:bg-primaryHover transition-all shadow-md shadow-primary/20">
                        <i data-lucide="user-circle" class="w-4 h-4"></i> My Account
                        <i data-lucide="chevron-down"
                            class="w-3.5 h-3.5 opacity-80 transition-transform group-hover:rotate-180"></i>
                    </button>

                    <div
                        class="absolute top-full right-0 p-2 mt-2 w-48 bg-white border border-gray-100 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 origin-top-right scale-95 group-hover:scale-100">

                        {{-- BUYER --}}
                         <a href="{{ route('user.dashboard') }}"
                             class="sidebar-link flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-gray-600 hover:bg-slate-50 hover:text-primary transition-colors text-[14px] font-medium">

                             <i data-lucide="shopping-bag" class="w-4 h-4"></i>

                             Buyer

                         </a>
                        @php

                            $user = Auth::user();

                            $vendor = \App\Models\Vendor::where('user_id', $user->id)
                                ->where('email_verify', 1)
                                ->first();

                            $vendorTypes = [];

                            if ($vendor && !empty($vendor->vendor_type_id)) {

                                $vendorTypes = explode(',', $vendor->vendor_type_id);

                            }

                        @endphp


                         {{-- SUPPLIER --}}
                         @if($vendor && (in_array(1, $vendorTypes) || in_array(4, $vendorTypes)))

                         <a href="{{ route('manufacturer.dashboard') }}"
                             class="sidebar-link flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-gray-600 hover:bg-slate-50 hover:text-primary transition-colors text-[14px] font-medium">

                             <i data-lucide="store" class="w-4 h-4"></i>

                             Supplier

                         </a>
                         @endif


                         {{-- SERVICES --}}
                         @if($vendor && in_array(2, $vendorTypes))

                         <a href="{{ route('service.dashboard') }}"
                             class="sidebar-link flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-gray-600 hover:bg-slate-50 hover:text-primary transition-colors text-[14px] font-medium">

                             <i data-lucide="handshake" class="w-4 h-4"></i>

                             Services

                         </a>
                         @endif

                        <div class="h-px bg-gray-100 my-1.5"></div>


                        <a href="#"
                            class="sidebar-link flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-gray-600 hover:bg-slate-50 hover:text-primary transition-colors text-[14px] font-medium">
                            <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                        </a>

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