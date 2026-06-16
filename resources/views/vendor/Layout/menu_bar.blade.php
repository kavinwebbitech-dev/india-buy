 {{-- TOP MENU --}}
 <div class="bg-white rounded-2xl border border-gray-100 p-2 mb-8 flex items-center gap-2 overflow-x-auto shadow-sm">
        @php

            $vendor = Auth::guard('vendor')->user();

            $vendorTypes = explode(',', $vendor->vendor_type_id);

        @endphp
     {{-- DASHBOARD --}}
     <a href="{{ route('manufacturer.dashboard') }}"
         class="px-5 py-2.5 rounded-xl text-[14px] font-medium whitespace-nowrap
        {{ request()->routeIs('manufacturer.dashboard') ? 'bg-primary text-white' : 'text-gray-500 hover:bg-slate-50' }}">

         Dashboard

     </a>
    @if(in_array(1, $vendorTypes) || in_array(4, $vendorTypes))
        @php
            $categoryId = in_array(1, $vendorTypes) ? 1 : 4;
        @endphp
     {{-- PRODUCTS --}}
     <a href="{{ route('manufacturer.product.list') }}" 
         class="px-5 py-2.5 rounded-xl text-[14px] font-medium whitespace-nowrap data-category_id="{{ $categoryId }}"
        {{ request()->routeIs('manufacturer.product.*') ? 'bg-primary text-white' : 'text-gray-500 hover:bg-slate-50' }}">

         Products Management

     </a>
    @endif
    @if(in_array(3, $vendorTypes))
     <a href="{{ route('relastate.product.list') }}" data-category_id="3"
         class="px-5 py-2.5 rounded-xl text-[14px] font-medium whitespace-nowrap
        {{ request()->routeIs('relastate.product.*') ? 'bg-primary text-white' : 'text-gray-500 hover:bg-slate-50' }}">

         Relastate Management

     </a>
    @endif
    @if(in_array(2, $vendorTypes))

     <a href="{{ route('service.product.list') }}" data-category_id="2"
         class="px-5 py-2.5 rounded-xl text-[14px] font-medium whitespace-nowrap
        {{ request()->routeIs('service.product.*') ? 'bg-primary text-white' : 'text-gray-500 hover:bg-slate-50' }}">

         Service Management
     </a>
    @endif


     {{-- PROFILE --}}
     <a href="{{ route('manufacturer.profile') }}"
         class="px-5 py-2.5 rounded-xl text-[14px] font-medium whitespace-nowrap
        {{ request()->routeIs('manufacturer.profile') ? 'bg-primary text-white' : 'text-gray-500 hover:bg-slate-50' }}">

         Profile Management

     </a>

 </div>

 {{-- SUCCESS --}}
 @if (session('success'))
     <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-xl">

         {{ session('success') }}

     </div>
 @endif

 {{-- ERROR --}}
 @if (session('error'))
     <div class="mb-4 bg-red-100 text-red-700 px-4 py-3 rounded-xl">

         {{ session('error') }}

     </div>
 @endif
