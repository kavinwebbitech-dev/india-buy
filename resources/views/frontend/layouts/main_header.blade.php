{{-- MASTER HEADER COMPONENT --}}
<header class="bg-white sticky top-0 z-50 shadow-sm font-sans relative">

    {{-- ========================================== --}}
    {{-- 1. TOP BAR (Logo, Search, User Actions)    --}}
    {{-- ========================================== --}}
    <div class="max-w-full mx-auto px-4 py-3 md:py-4 flex items-center justify-between gap-4 lg:gap-8">

        <div class="flex items-center gap-4 shrink-0">
            <button id="mobileMenuToggle" class="lg:hidden text-gray-600 hover:text-primary transition-colors">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
            <a href="{{ route('home') }}"
                class="flex items-center gap-2 text-3xl md:text-3xl font-bold text-primary tracking-tight">
                <i data-lucide="globe" class="text-primary w-6 h-6 md:w-7 md:h-7"></i>
                <span>india-buy.com</span>
            </a>
        </div>

        <div
            class="flex-1 max-w-3xl hidden md:flex items-center border-2 border-primary rounded-full bg-white h-11 transition-shadow focus-within:shadow-md focus-within:shadow-primary/10">
            <div class="relative h-full flex items-center border-r border-gray-200 bg-gray-50 hover:bg-gray-100 rounded-l-full shrink-0">
                <select id="searchType"
                    class="h-full pl-4 pr-8 text-[14px] text-gray-700 bg-transparent appearance-none focus:outline-none cursor-pointer font-medium z-10">
                    <option value="products">Products</option>
                    <option value="services">Services</option>
                </select>
                <i data-lucide="chevron-down"
                    class="w-3.5 h-3.5 text-gray-500 absolute right-3 pointer-events-none z-0"></i>
            </div>
            <input type="text" id="searchKeyword" placeholder="Search products, suppliers, or categories..."
                class="flex-1 h-full px-4 focus:outline-none text-[14px] w-full bg-transparent placeholder-gray-400">
            <button type="button" id="searchBtn"
                class="h-full bg-primary hover:bg-red-600 text-white px-8 font-medium transition-colors flex items-center justify-center rounded-r-full shrink-0">
                Search
            </button>
        </div>

        <div class="flex items-center gap-4 lg:gap-8 shrink-0">

            <button id="mobileSearchToggle" class="md:hidden text-gray-600 hover:text-primary transition-colors">
                <i data-lucide="search" class="w-6 h-6"></i>
            </button>

            <div class="hidden lg:flex items-center space-x-6 xl:space-x-8 text-[13px] font-medium">
                <a href="{{ route('postrfq') }}"
                    class="flex flex-col items-center text-gray-600 hover:text-primary transition-colors gap-1 group">
                    <i data-lucide="megaphone"
                        class="w-5 h-5 text-gray-500 group-hover:text-primary transition-colors"></i>
                    <span class="whitespace-nowrap">Post RFQ</span>
                </a>
                {{-- <a href="{{ route('user.dashboard') }}"
                    class="flex flex-col items-center text-gray-600 hover:text-primary transition-colors gap-1 group">
                    <i data-lucide="message-square-text"
                        class="w-5 h-5 text-gray-500 group-hover:text-primary transition-colors"></i>
                    <span class="whitespace-nowrap">Messages</span>
                </a> --}}

                <a href="{{ route('user.dashboard') }}"
                    class="relative flex flex-col items-center text-gray-600 hover:text-primary transition-colors gap-1 group">

                    <i data-lucide="message-square-text"
                        class="w-5 h-5 text-gray-500 group-hover:text-primary transition-colors"></i>

                    <span class="whitespace-nowrap">Messages</span>

                    @if ($messageCount > 0)
                        <span
                            class="absolute -top-1 right-0 bg-red-500 text-white text-[10px] min-w-[18px] h-[18px] rounded-full flex items-center justify-center px-1">
                            {{ $messageCount }}
                        </span>
                    @endif

                </a>

                @php
                    $user = Auth::guard('web')->user();
                @endphp

                @if (!$user)
                    <a href="{{ route('register') }}"
                        class="ml-auto inline-flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-xl text-[13px] font-bold hover:bg-red-600 transition-all shadow-md shadow-primary/20">
                        <i data-lucide="user-plus" class="w-4 h-4"></i>
                        Register / Login
                    </a>
                @else
                    {{-- USER DROPDOWN --}}
                    <div class="relative group ml-auto shrink-0 z-50">
                        <button
                            class="flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-xl text-[13px] font-bold hover:bg-red-600 transition-all shadow-md shadow-primary/20">
                            <i data-lucide="user-circle" class="w-4 h-4"></i>
                            <span class="max-w-[100px] truncate">{{ $user->name }}</span>
                            <i data-lucide="chevron-down"
                                class="w-3.5 h-3.5 opacity-80 transition-transform group-hover:rotate-180"></i>
                        </button>

                        <div
                            class="absolute top-full right-0 p-2 mt-2 w-72 bg-white border border-gray-100 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 origin-top-right scale-95 group-hover:scale-100">

                            <div class="px-4 py-3 border-b border-gray-100">
                                <h4 class="text-[15px] font-bold text-gray-900 truncate">{{ $user->name }}</h4>
                                <p class="text-[13px] text-gray-500 mt-1 truncate">{{ $user->email }}</p>
                                <p class="text-[13px] text-gray-500 mt-1">
                                    <i data-lucide="map-pin" class="w-3 h-3 inline"></i>
                                    {{ $user->city ?? 'No City' }}
                                </p>
                            </div>

                            <a href="{{ route('user.dashboard') }}"
                                class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-gray-600 hover:bg-slate-50 hover:text-primary transition-colors text-[14px] font-medium mt-1">
                                <i data-lucide="shopping-bag" class="w-4 h-4"></i> Buyer
                            </a>

                            @php
                                $vendor = \App\Models\Vendor::where('user_id', $user->id)->where('status', 1)->first();
                                $vendorTypes =
                                    $vendor && !empty($vendor->vendor_type_id)
                                        ? explode(',', $vendor->vendor_type_id)
                                        : [];
                            @endphp

                            @if ($vendor && (in_array(1, $vendorTypes) || in_array(4, $vendorTypes)))
                                <a href="{{ route('manufacturer.dashboard') }}"
                                    class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-gray-600 hover:bg-slate-50 hover:text-primary transition-colors text-[14px] font-medium">
                                    <i data-lucide="store" class="w-4 h-4"></i> Supplier
                                </a>
                            @endif

                            @if ($vendor && in_array(2, $vendorTypes))
                                <a href="{{ route('service.dashboard') }}"
                                    class="flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-gray-600 hover:bg-slate-50 hover:text-primary transition-colors text-[14px] font-medium">
                                    <i data-lucide="handshake" class="w-4 h-4"></i> Services
                                </a>
                            @endif

                            <div class="h-px bg-gray-100 my-1.5"></div>

                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full text-start flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-red-500 hover:bg-red-50 transition-colors text-[14px] font-medium">
                                    <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- 2. MOBILE EXPANDABLE SEARCH BAR            --}}
    {{-- ========================================== --}}
    <div id="mobileSearchContainer" class="md:hidden px-4 pb-3">
        <div class="flex items-center border-2 border-primary rounded-full overflow-hidden bg-white h-11 focus-within:shadow-md focus-within:shadow-primary/10 transition-shadow">
            <div class="relative h-full flex items-center border-r border-gray-200 bg-gray-50 hover:bg-gray-100 rounded-l-full shrink-0">
                <select id="searchType"
                    class="h-full pl-4 pr-8 text-[14px] text-gray-700 bg-transparent appearance-none focus:outline-none cursor-pointer font-medium z-10">
                    <option value="products">Products</option>
                    <option value="services">Services</option>
                </select>
                <i data-lucide="chevron-down"
                    class="w-3.5 h-3.5 text-gray-500 absolute right-3 pointer-events-none z-0"></i>
            </div>
            <input type="text" id="mobileSearchKeyword" placeholder="Search..."
                class="flex-1 h-full px-1 sm:px-4 focus:outline-none text-[15px] bg-transparent">
            <button type="button" id="mobileSearchBtn"
                class="h-full bg-primary hover:bg-red-600 text-white sm:px-2 px-1 flex items-center justify-center transition-colors">
                <i data-lucide="search" class="w-5 h-5"></i>
            </button>
        </div>
    </div>

    {{-- ========================================== --}}
    {{-- 3. BOTTOM NAVBAR (Desktop Only)            --}}
    {{-- ========================================== --}}
    <nav class="border-t border-gray-100 hidden lg:block bg-white relative z-40">
        <div
            class="max-w-full mx-auto px-4 flex items-center justify-between h-[46px] gap-8 text-[14px] font-medium text-gray-700">
            <div class="flex items-center gap-8 h-full">

                {{-- ALL CATEGORIES MEGA MENU --}}
                <div class="relative group z-50">

                    {{-- BUTTON --}}
                    <button class="flex items-center gap-2 h-full font-bold hover:text-primary transition-colors">
                        <i data-lucide="layout-grid" class="w-4 h-4"></i>
                        All Categories
                    </button>

                    {{-- FULL WIDTH MEGA MENU DROPDOWN --}}
                    <div class="absolute top-full left-0 hidden group-hover:block z-[9999] pt-2">

                        <div class="w-[1350px] max-w-[100vw] bg-white border border-gray-100 rounded-xl shadow-xl p-8">

                            {{-- SCROLLABLE WRAPPER --}}
                            <div
                                class="max-h-[250px] md:max-h-[350px] lg:max-h-[450px] xl:max-h-[500px] overflow-y-auto pr-4 custom-scroll">

                                @php
                                    $categories = \App\Models\Category::where('status', 1)->get();
                                @endphp

                                {{-- Grid layout for all categories --}}
                                <div class="grid grid-cols-4 gap-x-4 gap-y-4 max-h-[250px]">
                                    @forelse($categories as $category)
                                        <div class="flex flex-col">
                                            <a href="{{ route('categoryproducts', $category->id) }}"
                                                class="text-[14px] text-gray-800 hover:text-primary transition-colors">
                                                {{ $category->category_name }}
                                            </a>
                                        </div>
                                    @empty
                                        <div class="col-span-4 text-center py-10 text-gray-500">
                                            No Categories Found
                                        </div>
                                    @endforelse
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                {{-- DESKTOP MAIN LINKS --}}
                <div class="flex items-center gap-10 h-full">
                    <a href="{{ route('home') }}"
                        class="hover:text-primary transition-colors h-full flex items-center relative after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-primary after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:origin-left">Home</a>
                    <a href="{{ route('products') }}"
                        class="hover:text-primary transition-colors h-full flex items-center relative after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-primary after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:origin-left">Products</a>
                    <a href="{{ route('sevice_list') }}"
                        class="hover:text-primary transition-colors h-full flex items-center relative after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-primary after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:origin-left">Services</a>
                    <a href="{{ route('supplier_list') }}"
                        class="hover:text-primary transition-colors h-full flex items-center relative after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-primary after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:origin-left">Supplier</a>
                    <a href="{{ route('rfq_list') }}"
                        class="hover:text-primary transition-colors h-full flex items-center relative after:absolute after:bottom-0 after:left-0 after:w-full after:h-0.5 after:bg-primary after:scale-x-0 hover:after:scale-x-100 after:transition-transform after:origin-left">RFQ
                        inbox</a>
                </div>
            </div>

            {{-- <a href="#" class="hover:text-primary transition-colors flex items-center gap-1.5 font-semibold">
                <i data-lucide="headset" class="text-gray-400 w-4 h-4"></i>
                Help & Community
            </a> --}}
        </div>
    </nav>

    {{-- ========================================== --}}
    {{-- 4. MOBILE SIDEBAR (Off-canvas Menu)        --}}
    {{-- ========================================== --}}

    <div id="mobileSidebarOverlay"
        class="fixed inset-0 bg-black/60 z-[9998] hidden opacity-0 transition-opacity duration-300"></div>

    <div id="mobileSidebar"
        class="fixed top-0 left-0 h-full w-[280px] bg-white z-[9999] transform -translate-x-full transition-transform duration-300 shadow-2xl flex flex-col overflow-y-auto">

        <div class="flex items-center justify-between p-4 border-b border-gray-100 bg-gray-50">
            <span class="font-bold text-gray-900 text-lg">Menu</span>
            <button id="closeSidebarBtn" class="text-gray-500 hover:text-red-500 transition-colors p-1">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <div class="flex flex-col py-2 px-4 gap-1">
            <a href="{{ route('home') }}"
                class="flex items-center gap-3 py-3 text-gray-700 hover:text-primary font-medium border-b border-gray-50">
                <i data-lucide="home" class="w-5 h-5 text-gray-400"></i> Home
            </a>
            <a href="{{ route('home') }}"
                class="flex items-center gap-3 py-3 text-gray-700 hover:text-primary font-medium border-b border-gray-50">
                <i data-lucide="package" class="w-5 h-5 text-gray-400"></i> Categories
            </a>
            <a href="{{ route('products') }}"
                class="flex items-center gap-3 py-3 text-gray-700 hover:text-primary font-medium border-b border-gray-50">
                <i data-lucide="package" class="w-5 h-5 text-gray-400"></i> Products
            </a>
            <a href="{{ route('sevice_list') }}"
                class="flex items-center gap-3 py-3 text-gray-700 hover:text-primary font-medium border-b border-gray-50">
                <i data-lucide="briefcase" class="w-5 h-5 text-gray-400"></i> Services
            </a>
            <a href="{{ route('sevice_list') }}"
                class="flex items-center gap-3 py-3 text-gray-700 hover:text-primary font-medium border-b border-gray-50">
                <i data-lucide="briefcase" class="w-5 h-5 text-gray-400"></i> Supplier
            </a>
            <a href="{{ route('postrfq') }}"
                class="flex items-center gap-3 py-3 text-gray-700 hover:text-primary font-medium border-b border-gray-50">
                <i data-lucide="megaphone" class="w-5 h-5 text-gray-400"></i> Post RFQ
            </a>

            <a href="{{ route('postrfq') }}"
                class="flex items-center gap-3 py-3 text-gray-700 hover:text-primary font-medium border-b border-gray-50">
                <i data-lucide="megaphone" class="w-5 h-5 text-gray-400"></i> RFQ Inbox
            </a>

            <div class="mt-4 mb-2 text-xs font-bold text-gray-400 uppercase tracking-wider">Account</div>

            @if (!$user)
                <a href="{{ route('register') }}"
                    class="flex items-center justify-center gap-2 bg-primary text-white py-3 rounded-xl font-bold mt-2 hover:bg-red-600 transition-colors">
                    <i data-lucide="user-plus" class="w-4 h-4"></i> Register / Login
                </a>
                </else>
                <a href="{{ route('user.dashboard') }}"
                    class="flex items-center gap-3 py-3 text-gray-700 hover:text-primary font-medium border-b border-gray-50">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 text-gray-400"></i> My Dashboard
                </a>
                <a href="{{ route('user.dashboard') }}"
                    class="flex items-center gap-3 py-3 text-gray-700 hover:text-primary font-medium border-b border-gray-50">
                    <i data-lucide="message-square-text" class="w-5 h-5 text-gray-400"></i> Messages
                </a>
                <form action="{{ route('logout') }}" method="POST" class="mt-2">
                    @csrf
                    <button type="submit"
                        class="flex w-full items-center justify-center gap-2 bg-red-50 text-red-600 py-3 rounded-xl font-bold hover:bg-red-100 transition-colors">
                        <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                    </button>
                </form>
            @endif
        </div>
    </div>
</header>

{{-- SCROLLBAR STYLES --}}
<style>
    .custom-scroll {
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 #f8fafc;
    }

    .custom-scroll::-webkit-scrollbar {
        width: 6px;
    }

    .custom-scroll::-webkit-scrollbar-track {
        background: #f8fafc;
        border-radius: 20px;
    }

    .custom-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 20px;
    }

    .custom-scroll::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

{{-- HEADER JAVASCRIPT --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // --- 1. SEARCH FUNCTIONALITY ---
        function executeSearch(keywordId, typeId = null) {
            let keyword = document.getElementById(keywordId).value.trim();
            let type = typeId ? document.getElementById(typeId).value : 'products';

            if (keyword === "") return;

            if (type === 'products') {
                window.location.href = "{{ route('products') }}" + "?search=" + encodeURIComponent(keyword);
            } else if (type === 'services') {
                window.location.href = "{{ route('sevice_list') }}" + "?search=" + encodeURIComponent(keyword);
            }
        }

        // Desktop Search
        document.getElementById('searchBtn')?.addEventListener('click', () => executeSearch('searchKeyword',
            'searchType'));
        document.getElementById('searchKeyword')?.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') executeSearch('searchKeyword', 'searchType');
        });

        // Mobile Search
        document.getElementById('mobileSearchBtn')?.addEventListener('click', () => executeSearch(
            'mobileSearchKeyword'));
        document.getElementById('mobileSearchKeyword')?.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') executeSearch('mobileSearchKeyword');
        });


        // --- 2. MOBILE TOGGLES ---

        // Search Toggle
        const mobileSearchToggle = document.getElementById('mobileSearchToggle');
        const mobileSearchContainer = document.getElementById('mobileSearchContainer');
        const mobileSearchInput = document.getElementById('mobileSearchKeyword');

        mobileSearchToggle?.addEventListener('click', () => {
            mobileSearchContainer.classList.toggle('hidden');
            if (!mobileSearchContainer.classList.contains('hidden')) {
                mobileSearchInput.focus();
            }
        });

        // Sidebar Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuToggle');
        const sidebar = document.getElementById('mobileSidebar');
        const overlay = document.getElementById('mobileSidebarOverlay');
        const closeBtn = document.getElementById('closeSidebarBtn');

        function openSidebar() {
            overlay.classList.remove('hidden');
            // Small timeout ensures the browser renders the display block before applying opacity transition
            setTimeout(() => overlay.classList.remove('opacity-0'), 10);
            sidebar.classList.remove('-translate-x-full');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeSidebar() {
            overlay.classList.add('opacity-0');
            sidebar.classList.add('-translate-x-full');
            document.body.style.overflow = '';
            setTimeout(() => overlay.classList.add('hidden'), 300); // Wait for transition to finish
        }

        mobileMenuBtn?.addEventListener('click', openSidebar);
        closeBtn?.addEventListener('click', closeSidebar);
        overlay?.addEventListener('click', closeSidebar);
    });
</script>
