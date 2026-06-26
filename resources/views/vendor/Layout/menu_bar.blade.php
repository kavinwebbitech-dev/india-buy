{{-- TOP MENU --}}
<div style=" background-color: antiquewhite;"
    class="bg-white rounded-2xl border border-gray-100 p-2 mb-8 flex items-center gap-1.5 overflow-x-auto shadow-sm backdrop-blur-md">
    @php
        $vendor = Auth::guard('vendor')->user();
        $vendorTypes = explode(',', $vendor->vendor_type_id);
    @endphp

    {{-- DASHBOARD --}}
    <a href="{{ route('manufacturer.dashboard') }}"
        class="px-5 py-2.5 rounded-xl text-[14px] font-semibold tracking-wide whitespace-nowrap transition-all duration-200
       {{ request()->routeIs('manufacturer.dashboard') ? 'bg-primary text-white shadow-md shadow-primary/15' : 'text-gray-500 hover:bg-slate-50 hover:text-gray-900' }}">
        Dashboard
    </a>

    @if (in_array(1, $vendorTypes) || in_array(4, $vendorTypes))
        @php
            $categoryId = in_array(1, $vendorTypes) ? 1 : 4;
        @endphp
        {{-- PRODUCTS --}}
        <a href="{{ route('manufacturer.product.list') }}" data-category_id="{{ $categoryId }}"
            class="px-5 py-2.5 rounded-xl text-[14px] font-semibold tracking-wide whitespace-nowrap transition-all duration-200
           {{ request()->routeIs('manufacturer.product.*') ? 'bg-primary text-white shadow-md shadow-primary/15' : 'text-gray-500 hover:bg-slate-50 hover:text-gray-900' }}">
            Products Management
        </a>
    @endif

    @if (in_array(3, $vendorTypes))
        {{-- REALESTATE --}}
        <a href="{{ route('relastate.product.list') }}" data-category_id="3"
            class="px-5 py-2.5 rounded-xl text-[14px] font-semibold tracking-wide whitespace-nowrap transition-all duration-200
           {{ request()->routeIs('relastate.product.*') ? 'bg-primary text-white shadow-md shadow-primary/15' : 'text-gray-500 hover:bg-slate-50 hover:text-gray-900' }}">
            Relastate Management
        </a>
    @endif

    @if (in_array(2, $vendorTypes))
        {{-- SERVICE --}}
        <a href="{{ route('service.product.list') }}" data-category_id="2"
            class="px-5 py-2.5 rounded-xl text-[14px] font-semibold tracking-wide whitespace-nowrap transition-all duration-200
           {{ request()->routeIs('service.product.*') ? 'bg-primary text-white shadow-md shadow-primary/15' : 'text-gray-500 hover:bg-slate-50 hover:text-gray-900' }}">
            Service Management
        </a>
    @endif

    {{-- BANNER --}}
    <a href="{{ route('manufacturer.product.list') }}"
        class="px-5 py-2.5 rounded-xl text-[14px] font-semibold tracking-wide whitespace-nowrap transition-all duration-200
       {{ request()->routeIs('manufacturer.product.*') ? 'bg-primary text-white shadow-md shadow-primary/15' : 'text-gray-500 hover:bg-slate-50 hover:text-gray-900' }}">
        Banner
    </a>

    {{-- PROFILE --}}
    <a href="{{ route('manufacturer.profile') }}"
        class="px-5 py-2.5 rounded-xl text-[14px] font-semibold tracking-wide whitespace-nowrap transition-all duration-200
       {{ request()->routeIs('manufacturer.profile') ? 'bg-primary text-white shadow-md shadow-primary/15' : 'text-gray-500 hover:bg-slate-50 hover:text-gray-900' }}">
        Profile Management
    </a>
</div>

{{-- SUCCESS ALERT --}}
@if (session('success'))
    <div
        class="mb-5 bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 px-4 py-3.5 rounded-r-xl shadow-sm flex items-center gap-2.5 text-[14px] font-medium transition-all">
        <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z">
            </path>
        </svg>
        <span class="text-emerald-900">{{ session('success') }}</span>
    </div>
@endif

{{-- ERROR ALERT --}}
@if (session('error'))
    <div
        class="mb-5 bg-rose-50 border-l-4 border-rose-500 text-rose-800 px-4 py-3.5 rounded-r-xl shadow-sm flex items-center gap-2.5 text-[14px] font-medium transition-all">
        <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="text-rose-900">{{ session('error') }}</span>
    </div>
@endif
