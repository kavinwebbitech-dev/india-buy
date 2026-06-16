@include('auth.Layout.header')

<body class="text-gray-800 antialiased font-sans">

    @include('auth.Layout.top_bar')


    @include('auth.Layout.main_header')

    <div class="bg-slate-50 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4">

            <!-- <div
                class="bg-white rounded-2xl border border-gray-100 p-2 mb-8 flex items-center hide-scrollbar shadow-[0_2px_10px_rgb(0,0,0,0.02)] gap-1">
                <p class="px-5 py-2.5 rounded-xl text-[14px] font-medium text-gray-500 transition-colors whitespace-nowrap">Message</p=>
               
                <div class="relative group ml-auto shrink-0 z-50">

                    <button
                        class="flex items-center gap-2 bg-primary text-white px-5 py-2.5 rounded-xl text-[13px] font-bold hover:bg-primaryHover transition-all shadow-md shadow-primary/20">
                        <i data-lucide="user-circle" class="w-4 h-4"></i> My Account
                        <i data-lucide="chevron-down"
                            class="w-3.5 h-3.5 opacity-80 transition-transform group-hover:rotate-180"></i>
                    </button>

                    <div
                        class="absolute top-full right-0 p-2 mt-2 w-48 bg-white border border-gray-100 rounded-2xl shadow-[0_8px_30px_rgb(0,0,0,0.08)] py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 origin-top-right scale-95 group-hover:scale-100">

                        <a href="#" data-target="panel-profile"
                            class="sidebar-link flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-gray-600 hover:bg-slate-50 hover:text-primary transition-colors text-[14px] font-medium">
                            <i data-lucide="user" class="w-4 h-4"></i> Profile
                        </a>

                        <div class="h-px bg-gray-100 my-1.5"></div>


                        <a href="#"
                            class="sidebar-link flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-gray-600 hover:bg-slate-50 hover:text-primary transition-colors text-[14px] font-medium">
                            <i data-lucide="log-out" class="w-4 h-4"></i> Logout
                        </a>

                    </div>
                </div>
            </div> -->

            <div class="flex flex-col lg:flex-row gap-8">

                <aside class="w-full lg:w-[260px] shrink-0">
                    <div
                        class="bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-4 space-y-6 sticky top-24">

                        <div>
                            <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2 px-3">Inquiries
                            </h4>
                            <nav class="space-y-1">
                                <a href="#" data-target="panel-inbox"
                                    class="sidebar-link flex items-center gap-2.5  px-3 py-2.5 rounded-xl bg-primary/5 text-primary font-bold text-[14px] transition-colors">
                                    <i data-lucide="inbox" class="w-4 h-4"></i> Inbox
                                </a>
                                <a href="#" data-target="panel-sent"
                                    class="sidebar-link flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-gray-600 hover:bg-slate-50 hover:text-primary transition-colors text-[14px] font-medium">
                                    <i data-lucide="send" class="w-4 h-4"></i> Inquiries
                                </a>
                                {{-- <a href="#" data-target="panel-deleted"
                                    class="sidebar-link flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-gray-600 hover:bg-slate-50 hover:text-primary transition-colors text-[14px] font-medium">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i> Empty Inquiry
                                </a> --}}
                            </nav>
                        </div>

                        <div>
                            <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2 px-3">Sourcing
                            </h4>
                            <nav class="space-y-1">
                                <a href="#" data-target="panel-quotes"
                                    class="sidebar-link flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-gray-600 hover:bg-slate-50 hover:text-primary transition-colors text-[14px] font-medium">
                                    <i data-lucide="file-text" class="w-4 h-4"></i> Manage Quotations
                                </a>
                            </nav>
                        </div>


                        <div>
                            <h4 class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2 px-3">Account
                            </h4>
                            <nav class="space-y-1">
                                <a href="#" data-target="panel-profile"
                                    class="sidebar-link flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-gray-600 hover:bg-slate-50 hover:text-primary transition-colors text-[14px] font-medium">
                                    <i data-lucide="user" class="w-4 h-4"></i> Profile
                                </a>
                                <a href="#" data-target="panel-change-password"
                                    class="sidebar-link flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-gray-600 hover:bg-slate-50 hover:text-primary transition-colors text-[14px] font-medium">

                                    <i data-lucide="lock-keyhole" class="w-4 h-4"></i>
                                    Change Password
                                </a>


                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf

                                    <button type="submit"
                                        class="w-full flex items-center gap-2.5 px-3 py-2.5 rounded-xl text-gray-600 hover:bg-slate-50 hover:text-red-500 transition-colors text-[14px] font-medium">

                                        <i data-lucide="log-out" class="w-4 h-4"></i>
                                        Logout
                                    </button>
                                </form>
                            </nav>
                        </div>

                    </div>
                </aside>

                <main class="flex-1 ">

                    <div id="panel-inbox"
                        class="dashboard-panel bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden flex flex-col h-full min-h-[600px]">

                        <div class="px-6 pt-6 border-b border-gray-100">
                            <h1 class="text-[20px] font-bold text-gray-900 mb-6">Inbox</h1>

                            <div class="flex overflow-x-auto hide-scrollbar gap-8 text-[14px] font-medium">
                                <button
                                    class="inbox-tab-btn pb-3 border-b-2 border-primary text-primary font-bold whitespace-nowrap"
                                    data-filter="all">All</button>
                                {{-- <button
                                    class="inbox-tab-btn pb-3 border-b-2 border-transparent text-gray-500 hover:text-gray-900 transition-colors whitespace-nowrap"
                                    data-filter="unread">
                                    Unread <span
                                        class="text-xs ml-1 bg-gray-100 px-1.5 py-0.5 rounded-md text-gray-600">1</span>
                                </button>
                                <button
                                    class="inbox-tab-btn pb-3 border-b-2 border-transparent text-gray-500 hover:text-gray-900 transition-colors whitespace-nowrap"
                                    data-filter="unreplied">Not yet replied</button> --}}
                            </div>
                        </div>

                        <div
                            class="p-4 bg-slate-50/50 border-b border-gray-100 flex flex-col sm:flex-row flex-wrap gap-3 items-center">
                            <div class="relative w-full sm:w-auto">
                                <select
                                    class="w-full sm:w-40 h-10 pl-9 pr-8 bg-white border border-gray-200 rounded-xl text-[13px] font-medium text-gray-600 appearance-none focus:outline-none focus:border-primary">
                                    <option>Sent Time</option>
                                    <option>Last 7 Days</option>
                                </select>
                                <i data-lucide="calendar"
                                    class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                                <i data-lucide="chevron-down"
                                    class="w-3.5 h-3.5 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            </div>
                            <div class="relative flex-1 min-w-[200px] w-full">
                                <i data-lucide="search"
                                    class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                                <input type="text" placeholder="Subject/Name/Email"
                                    class="w-full h-10 pl-9 pr-3 bg-white border border-gray-200 rounded-xl text-[13px] font-medium text-gray-700 focus:outline-none focus:border-primary placeholder-gray-400">
                            </div>
                            <button
                                class="text-primary text-[13px] font-bold hover:text-primaryHover transition-colors px-2">Clear
                                All</button>
                        </div>

                        <div class="flex-1 overflow-x-auto hide-scrollbar">
                            <table class="w-full text-left border-collapse min-w-[800px]">
                                <thead>
                                    <tr
                                        class="bg-white border-b border-gray-100 text-[12px] uppercase tracking-wider text-gray-400 font-bold">
                                        <th class="px-6 py-4 w-12 text-center">#</th>
                                        <th class="px-6 py-4">Sender Info</th>
                                        <th class="px-6 py-4">Interested Product11</th>
                                        <th class="px-6 py-4">Location</th>
                                        <th class="px-6 py-4 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($enquiries as $key => $enquiry)
                                        {{-- @php

                                            if ($enquiry->product) {
                                                $title = $enquiry->product->product_name;

                                                $images = json_decode($enquiry->product->image, true);

                                                $image = !empty($images[0])
                                                    ? asset('uploads/products/' . $images[0])
                                                    : asset('assets/no-image.png');

                                                $type = 'Product';
                                            } elseif ($enquiry->service) {
                                                $title = $enquiry->service->service_name;

                                                $image = asset(
                                                    'uploads/service/images/' . $enquiry->service->service_img,
                                                );

                                                $type = 'Service';
                                            } else {
                                                $title = 'Item Deleted';

                                                $image = asset('assets/no-image.png');

                                                $type = '-';
                                            }

                                        @endphp --}}

                                        @php
                                            if ($enquiry->product) {
                                                $title = $enquiry->product->product_name;
                                                $images = json_decode($enquiry->product->image, true);
                                                $image = !empty($images[0])
                                                    ? asset('uploads/products/' . $images[0])
                                                    : asset('assets/no-image.png');
                                                $type = 'Product';
                                            } elseif ($enquiry->service) {
                                                $title = $enquiry->service->service_name;
                                                $serviceImages = json_decode($enquiry->service->service_img, true);
                                                $image = !empty($serviceImages[0])
                                                    ? asset('uploads/service/images/' . $serviceImages[0])
                                                    : asset('assets/no-image.png');
                                                $type = 'Service';
                                            } else {
                                                $title = 'Item Deleted';
                                                $image = asset('assets/no-image.png');
                                                $type = '-';
                                            }
                                        @endphp

                                        <tr class="hover:bg-slate-50">

                                            <td class="px-6 py-5 text-center">
                                                {{ $key + 1 }}
                                            </td>

                                            <td class="px-6 py-5">

                                                <div class="flex items-center gap-3">

                                                    <div
                                                        class="w-10 h-10 rounded-full bg-blue-50 border border-blue-100 text-blue-600 flex items-center justify-center font-bold">

                                                        {{ strtoupper(substr($enquiry->sender->name ?? 'U', 0, 1)) }}

                                                    </div>

                                                    <div>

                                                        <p class="font-bold">
                                                            {{ $enquiry->sender->name ?? '' }}
                                                        </p>

                                                        <p class="text-xs text-gray-500">
                                                            {{ $enquiry->sender->email ?? '' }}
                                                        </p>

                                                    </div>

                                                </div>

                                            </td>

                                            <td class="px-6 py-5">

                                                <div class="flex items-center gap-3">

                                                    <div
                                                        class="w-12 h-12 rounded-xl border border-gray-100 p-1 bg-white">

                                                        <img src="{{ $image }}"
                                                            class="w-full h-full object-contain">

                                                    </div>

                                                    <div>

                                                        <p class="font-medium">
                                                            {{ $title }}
                                                        </p>

                                                        <span class="text-xs text-primary">
                                                            {{ $type }}
                                                        </span>

                                                    </div>

                                                </div>

                                            </td>

                                            <td class="px-6 py-5">

                                                {{ $enquiry->sender->city ?? '-' }}

                                                <div class="text-xs text-gray-400">

                                                    {{ $enquiry->created_at->diffForHumans() }}

                                                </div>

                                            </td>

                                            <td class="px-6 py-5 text-center">

                                                <a href="#"
                                                    onclick="openChat(
        {{ $enquiry->id }},
        '{{ addslashes($title) }}',
        '{{ addslashes($enquiry->receiver?->company_name ?? ($enquiry->receiver?->name ?? 'Supplier')) }}',
        '{{ $image }}'
    )"
                                                    class="inline-flex items-center gap-2 bg-slate-100 px-4 py-2.5 rounded-xl text-[13px] font-bold">

                                                    <i data-lucide="eye" class="w-4 h-4"></i>

                                                    View

                                                </a>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="5" class="text-center py-10">
                                                No enquiries found
                                            </td>

                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>

                            <div id="no-results-state"
                                class="hidden flex-col items-center justify-center p-12 text-center bg-slate-50/30 min-h-[300px]">
                                <div
                                    class="w-20 h-20 bg-white shadow-sm border border-gray-100 rounded-full flex items-center justify-center mb-4">
                                    <i data-lucide="inbox" class="w-8 h-8 text-gray-300"></i>
                                </div>
                                <h3 class="text-[15px] font-bold text-gray-900 mb-1">No messages match this filter</h3>
                                <p class="text-[13px] text-gray-500 max-w-sm">Try selecting a different tab or clearing
                                    your search criteria.</p>
                            </div>
                        </div>

                        <div
                            class="border-t border-gray-100 p-4 bg-white flex items-center justify-between text-[13px] text-gray-500">
                            <span id="entries-count">Showing 3 entries</span>
                            <div class="flex gap-1">
                                <button
                                    class="px-3 py-1.5 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors disabled:opacity-50">Prev</button>
                                <button class="px-3 py-1.5 bg-primary text-white rounded-lg shadow-sm">1</button>
                                <button
                                    class="px-3 py-1.5 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors">Next</button>
                            </div>
                        </div>

                    </div>

                    <script>
                        // ==========================================
                        // INBOX TABS FILTERING FUNCTIONALITY
                        // ==========================================
                        const inboxTabs = document.querySelectorAll('.inbox-tab-btn');
                        const inboxRows = document.querySelectorAll('.inbox-row');
                        const noResultsState = document.getElementById('no-results-state');
                        const entriesCount = document.getElementById('entries-count');

                        inboxTabs.forEach(tab => {
                            tab.addEventListener('click', function() {

                                // 1. Reset all tabs to inactive state
                                inboxTabs.forEach(t => {
                                    t.classList.remove('border-primary', 'text-primary', 'font-bold');
                                    t.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-900');
                                });

                                // 2. Set clicked tab to active state
                                this.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-900');
                                this.classList.add('border-primary', 'text-primary', 'font-bold');

                                // 3. Filter the table rows
                                const filterValue = this.getAttribute('data-filter');
                                let visibleCount = 0;

                                inboxRows.forEach(row => {
                                    const rowStatus = row.getAttribute('data-status');

                                    // If filter is "all", or the row status matches the filter, show it
                                    if (filterValue === 'all' || rowStatus === filterValue) {
                                        row.style.display = ''; // Uses default table-row display
                                        visibleCount++;
                                    } else {
                                        row.style.display = 'none'; // Hide it
                                    }
                                });

                                // 4. Show "No Results" state if empty, update count text
                                if (visibleCount === 0) {
                                    noResultsState.classList.remove('hidden');
                                    noResultsState.classList.add('flex');
                                    entriesCount.textContent = 'Showing 0 entries';
                                } else {
                                    noResultsState.classList.add('hidden');
                                    noResultsState.classList.remove('flex');
                                    entriesCount.textContent = `Showing ${visibleCount} entries`;
                                }
                            });
                        });
                    </script>

                    <div id="panel-sent"
                        class="dashboard-panel bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden hidden flex-col h-full min-h-[600px]">

                        <div class="px-6 py-6 border-b border-gray-100 flex items-center justify-between">
                            <h1 class="text-[20px] font-bold text-gray-900">
                                Sent Inquiries
                            </h1>

                            <span class="text-[13px] text-gray-500 font-medium">
                                Total:
                                <strong class="text-gray-900">
                                    {{ \App\Models\Enquiry::where('sender_id', auth()->id())->count() }}
                                </strong>
                            </span>
                        </div>

                        <div
                            class="p-4 bg-slate-50/50 border-b border-gray-100 flex flex-col sm:flex-row flex-wrap gap-3 items-center">
                            <div class="relative w-full sm:w-auto">
                                <select
                                    class="w-full sm:w-40 h-10 pl-9 pr-8 bg-white border border-gray-200 rounded-xl text-[13px] font-medium text-gray-600 appearance-none focus:outline-none focus:border-primary">
                                    <option>Sent Time</option>
                                    <option>Last 7 Days</option>
                                    <option>Last 30 Days</option>
                                    <option>This Year</option>
                                </select>
                                <i data-lucide="calendar"
                                    class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                                <i data-lucide="chevron-down"
                                    class="w-3.5 h-3.5 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            </div>

                            <div class="relative w-full sm:w-auto">
                                <select
                                    class="w-full sm:w-40 h-10 pl-3 pr-8 bg-white border border-gray-200 rounded-xl text-[13px] font-medium text-gray-600 appearance-none focus:outline-none focus:border-primary">
                                    <option>Status</option>
                                    <option>Read by Supplier</option>
                                    <option>Unread</option>
                                    <option>Replied</option>
                                </select>
                                <i data-lucide="chevron-down"
                                    class="w-3.5 h-3.5 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                            </div>

                            <div class="relative flex-1 min-w-[200px] w-full">
                                <i data-lucide="search"
                                    class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                                <input type="text" placeholder="Search Supplier/Product..."
                                    class="w-full h-10 pl-9 pr-3 bg-white border border-gray-200 rounded-xl text-[13px] font-medium text-gray-700 focus:outline-none focus:border-primary placeholder-gray-400">
                            </div>

                            <button
                                class="text-primary text-[13px] font-bold hover:text-primaryHover transition-colors px-2">Clear
                                All</button>
                        </div>

                        <div class="flex-1 overflow-x-auto hide-scrollbar">
                            <table class="w-full text-left border-collapse min-w-[800px]">
                                <thead>
                                    <tr
                                        class="bg-white border-b border-gray-100 text-[12px] uppercase tracking-wider text-gray-400 font-bold">
                                        <th class="px-6 py-4 w-12 text-center">#</th>
                                        <th class="px-6 py-4">Sent To (Supplier)</th>
                                        <th class="px-6 py-4">Inquiry Subject / Product</th>
                                        <th class="px-6 py-4">Sent Date</th>
                                        <th class="px-6 py-4 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50 text-[14px]">

                                    @forelse ($sendenquiries as $index => $enquiry)
                                        @php

                                            if ($enquiry->product) {
                                                $title = $enquiry->product->product_name;

                                                $images = json_decode($enquiry->product->image, true);

                                                $image = !empty($images[0])
                                                    ? asset('uploads/products/' . $images[0])
                                                    : asset('assets/no-image.png');

                                                $type = 'Product Enquiry';
                                            } elseif ($enquiry->service) {
                                                $title = $enquiry->service->service_name;

                                                $image = asset(
                                                    'uploads/service/images/' . $enquiry->service->service_img,
                                                );

                                                $type = 'Service Enquiry';
                                            } else {
                                                $title = 'Item Deleted';

                                                $image = asset('assets/no-image.png');

                                                $type = '-';
                                            }

                                        @endphp

                                        <tr class="hover:bg-slate-50/50 transition-colors bg-white group">

                                            <td class="px-6 py-5 text-center text-gray-400 font-medium">
                                                {{ $index + 1 }}
                                            </td>

                                            <td class="px-6 py-5">

                                                <div class="flex items-center gap-3">

                                                    <div
                                                        class="w-10 h-10 rounded-full bg-blue-50 border border-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg">

                                                        {{ strtoupper(substr($enquiry->receiver->company_name ?? 'S', 0, 1)) }}

                                                    </div>

                                                    <div>

                                                        <p class="font-bold text-gray-900 leading-tight">

                                                            {{ $enquiry->receiver->company_name ?? 'Unknown Supplier' }}

                                                        </p>

                                                        <div class="text-[12px] text-gray-500">

                                                            {{ $enquiry->receiver->city ?? '' }}

                                                        </div>

                                                    </div>

                                                </div>

                                            </td>

                                            <td class="px-6 py-5">

                                                <div class="flex items-center gap-3">

                                                    <div
                                                        class="w-12 h-12 rounded-xl border border-gray-100 p-1 bg-white shadow-sm">

                                                        <img src="{{ $image }}"
                                                            class="w-full h-full object-contain">

                                                    </div>

                                                    <div>

                                                        <p class="font-medium text-gray-900">

                                                            {{ $title }}

                                                        </p>

                                                        <span
                                                            class="text-[10px] px-2 py-0.5 rounded bg-emerald-50 text-emerald-600">

                                                            {{ $type }}

                                                        </span>

                                                    </div>

                                                </div>

                                            </td>

                                            <td class="px-6 py-5">

                                                <div class="text-[13px] font-medium text-gray-900">

                                                    {{ $enquiry->created_at->format('M d, Y') }}

                                                </div>

                                                <div class="text-[11px] text-gray-400">

                                                    {{ $enquiry->created_at->format('h:i A') }}

                                                </div>

                                            </td>

                                            <td class="px-6 py-5 text-center">

                                                <a href="#"
                                                    onclick="openChat(
        {{ $enquiry->id }},
        '{{ addslashes($title) }}',
        '{{ addslashes($enquiry->receiver?->company_name ?? ($enquiry->receiver?->name ?? 'Supplier')) }}',
        '{{ $image }}'
    )"
                                                    class="inline-flex items-center gap-2 bg-slate-100 px-4 py-2.5 rounded-xl text-[13px] font-bold">

                                                    <i data-lucide="eye" class="w-4 h-4"></i>

                                                    View

                                                </a>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="5" class="text-center py-10">

                                                No enquiries found

                                            </td>

                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>

                        <div
                            class="border-t border-gray-100 p-4 bg-white flex items-center justify-between text-[13px] text-gray-500">

                            <span>
                                Showing {{ $enquiries->firstItem() ?? 0 }}
                                to {{ $enquiries->lastItem() ?? 0 }}
                                of {{ $enquiries->total() }} entries
                            </span>

                            <div>
                                {{ $enquiries->links() }}
                            </div>

                        </div>

                    </div>

                    <div id="panel-deleted"
                        class="dashboard-panel bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden hidden flex-col h-full min-h-[600px]">
                        <div class="flex-1 flex flex-col items-center justify-center p-12 text-center bg-slate-50/30">
                            <div
                                class="w-24 h-24 bg-white shadow-sm border border-gray-100 rounded-full flex items-center justify-center mb-5">
                                <i data-lucide="package-open" class="w-10 h-10 text-gray-300"></i>
                            </div>
                            <h3 class="text-[16px] font-bold text-gray-900 mb-1">No inquiries found</h3>
                            <p class="text-[13px] text-gray-500 max-w-sm">You haven't received any messages yet. When
                                buyers contact you, their inquiries will appear here.</p>
                        </div>
                    </div>

                    <div id="panel-profile"
                        class="dashboard-panel bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden hidden flex-col h-full">

                        <!-- Header -->
                        <div class="px-6 py-6 border-b border-gray-100 flex items-center justify-between">

                            <div>
                                <h1 class="text-[20px] font-bold text-gray-900 mb-1">
                                    My Profile
                                </h1>

                                <p class="text-[13px] text-gray-500 font-medium">
                                    Update your profile information
                                </p>
                            </div>

                            <button id="editProfileBtn" type="button"
                                class="bg-primary text-white hover:bg-primaryHover px-5 py-2.5 rounded-xl text-[13px] font-bold transition-all shadow-md shadow-primary/20 flex items-center gap-2">

                                <i data-lucide="square-pen" class="w-4 h-4"></i>
                                Edit Profile
                            </button>

                        </div>

                        <!-- Body -->
                        <div class="p-6 lg:p-10">

                            @if (session('success'))
                                <div
                                    class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('user.profile.update') }}" method="POST"
                                enctype="multipart/form-data" class="space-y-6">

                                @csrf

                                <!-- Profile Image -->
                                <div class="flex items-center gap-6">

                                    <div class="relative">

                                        @if (Auth::user()->profile_image)
                                            <img src="{{ asset('uploads/profile/' . Auth::user()->profile_image) }}"
                                                class="w-24 h-24 rounded-full object-cover border border-gray-200"
                                                alt="">
                                        @else
                                            <div
                                                class="w-24 h-24 rounded-full bg-slate-100 flex items-center justify-center border border-gray-200">
                                                <i data-lucide="user" class="w-10 h-10 text-gray-400"></i>
                                            </div>
                                        @endif

                                    </div>

                                    <div>

                                        <label
                                            class="cursor-pointer bg-slate-100 hover:bg-slate-200 text-gray-700 px-4 py-2 rounded-xl text-sm font-medium transition">

                                            Upload Photo

                                            <input type="file" name="image" class="hidden profile-input"
                                                disabled>

                                        </label>

                                        @error('image')
                                            <p class="text-red-500 text-xs mt-1">
                                                {{ $message }}
                                            </p>
                                        @enderror

                                    </div>

                                </div>

                                <!-- Full Name -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Full Name <span class="text-red-500">*</span>
                                    </label>

                                    <input type="text" name="name"
                                        value="{{ old('name', Auth::user()->name) }}"
                                        class="profile-input w-full h-12 px-4 border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:border-primary"
                                        disabled>

                                    @error('name')
                                        <p class="text-red-500 text-xs mt-1">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Email Address
                                    </label>

                                    <input type="email" name="email"
                                        value="{{ old('email', Auth::user()->email) }}" readonly
                                        class="w-full h-12 px-4 border border-gray-200 rounded-xl bg-gray-100 cursor-not-allowed focus:outline-none">
                                </div>

                                <!-- Phone -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Phone Number <span class="text-red-500">*</span>
                                    </label>

                                    <input type="text" name="mobile"
                                        value="{{ old('mobile', Auth::user()->phone) }}"
                                        class="profile-input w-full h-12 px-4 border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:border-primary"
                                        disabled>

                                    @error('mobile')
                                        <p class="text-red-500 text-xs mt-1">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Address -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Address <span class="text-red-500">*</span>
                                    </label>

                                    <textarea name="address" rows="3"
                                        class="profile-input w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:border-primary"
                                        disabled>{{ old('address', Auth::user()->address) }}</textarea>

                                    @error('address')
                                        <p class="text-red-500 text-xs mt-1">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- State & City -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                    <!-- State -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            State <span class="text-red-500">*</span>
                                        </label>

                                        <input type="text" name="state"
                                            value="{{ old('state', Auth::user()->state) }}"
                                            class="profile-input w-full h-12 px-4 border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:border-primary"
                                            disabled>

                                        @error('state')
                                            <p class="text-red-500 text-xs mt-1">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <!-- City -->
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                                            City <span class="text-red-500">*</span>
                                        </label>

                                        <input type="text" name="city"
                                            value="{{ old('city', Auth::user()->city) }}"
                                            class="profile-input w-full h-12 px-4 border border-gray-200 rounded-xl bg-gray-50 focus:outline-none focus:border-primary"
                                            disabled>

                                        @error('city')
                                            <p class="text-red-500 text-xs mt-1">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                </div>

                                <!-- Submit Button -->
                                <div class="hidden" id="saveProfileBtn">

                                    <button type="submit"
                                        class="bg-emerald-500 hover:bg-emerald-600 text-white px-8 py-3 rounded-xl text-sm font-bold shadow-lg shadow-emerald-500/20 transition-all">

                                        Update Profile
                                    </button>

                                </div>

                            </form>

                        </div>

                    </div>


                    <div id="panel-change-password"
                        class="dashboard-panel bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden hidden flex-col h-full">

                        <!-- Header -->
                        <div class="px-6 py-6 border-b border-gray-100">
                            <h1 class="text-[20px] font-bold text-gray-900 mb-1">
                                Change Password
                            </h1>

                            <p class="text-[13px] text-gray-500">
                                Update your account password securely
                            </p>
                        </div>

                        <!-- Form -->
                        <div class="p-6 lg:p-10">

                            @if (session('password_success'))
                                <div
                                    class="mb-5 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl text-sm">
                                    {{ session('password_success') }}
                                </div>
                            @endif

                            <form action="{{ route('user.password.update') }}" method="POST" class="space-y-5">

                                @csrf

                                <!-- Current Password -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Current Password
                                    </label>

                                    <input type="password" name="current_password"
                                        placeholder="Enter Current Password"
                                        class="w-full h-12 px-4 border border-gray-200 rounded-xl focus:outline-none focus:border-primary">

                                    @error('current_password')
                                        <p class="text-red-500 text-xs mt-1">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- New Password -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        New Password
                                    </label>

                                    <input type="password" name="password" placeholder="Enter New Password"
                                        class="w-full h-12 px-4 border border-gray-200 rounded-xl focus:outline-none focus:border-primary">

                                    @error('password')
                                        <p class="text-red-500 text-xs mt-1">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                                        Confirm Password
                                    </label>

                                    <input type="password" name="password_confirmation"
                                        placeholder="Confirm Password"
                                        class="w-full h-12 px-4 border border-gray-200 rounded-xl focus:outline-none focus:border-primary">
                                </div>

                                <!-- Submit -->
                                <div>
                                    <button type="submit"
                                        class="bg-primary hover:bg-primaryHover text-white px-8 py-3 rounded-xl text-sm font-bold transition-all shadow-lg shadow-primary/20">

                                        Update Password
                                    </button>
                                </div>

                            </form>

                        </div>

                    </div>



                    <div id="panel-quotes"
                        class="dashboard-panel bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden hidden flex-col h-full min-h-[600px]">
                        <div class="px-6 pt-6 border-b border-gray-100">
                            <h1 class="text-[20px] font-bold text-gray-900 mb-6">Manage Quotations</h1>
                        </div>
                        <div class="flex-1 flex flex-col items-center justify-center p-12 text-center bg-slate-50/30">
                            <div
                                class="w-24 h-24 bg-white shadow-sm border border-gray-100 rounded-full flex items-center justify-center mb-5">
                                <i data-lucide="file-text" class="w-10 h-10 text-gray-300"></i>
                            </div>
                            <h3 class="text-[16px] font-bold text-gray-900 mb-1">No active quotations</h3>
                            <p class="text-[13px] text-gray-500 max-w-sm">When you request or send a quote, you can
                                manage it here.</p>
                        </div>
                    </div>

                </main>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const sidebarLinks = document.querySelectorAll('.sidebar-link');
                    const dashboardPanels = document.querySelectorAll('.dashboard-panel');

                    const activeClasses = ['bg-primary/5', 'text-primary', 'font-bold'];
                    const inactiveClasses = ['text-gray-600', 'font-medium', 'hover:bg-slate-50', 'hover:text-primary'];

                    sidebarLinks.forEach(link => {
                        link.addEventListener('click', function(e) {
                            e.preventDefault(); // Stop page from scrolling to top

                            // 1. Reset all links to inactive state
                            sidebarLinks.forEach(l => {
                                l.classList.remove(...activeClasses);
                                l.classList.add(...inactiveClasses);

                                // Hide the Inbox icon wrapper if present (specific to your design)
                                const innerSpan = l.querySelector('span');
                                if (innerSpan) {
                                    l.innerHTML = innerSpan.innerHTML; // Unwrap the span styling
                                }
                            });

                            // 2. Set clicked link to active state
                            this.classList.remove(...inactiveClasses);
                            this.classList.add(...activeClasses);

                            // Re-wrap the inner HTML in a span with flex classes to maintain spacing
                            this.innerHTML =
                                `<span class="flex items-center gap-2.5">${this.innerHTML}</span>`;

                            // 3. Hide all right-side panels
                            dashboardPanels.forEach(panel => {
                                panel.classList.add('hidden');
                                panel.classList.remove('flex');
                            });

                            // 4. Show the target panel
                            const targetId = this.getAttribute('data-target');
                            const targetPanel = document.getElementById(targetId);
                            if (targetPanel) {
                                targetPanel.classList.remove('hidden');
                                targetPanel.classList.add(
                                    'flex'); // Apply flex to maintain your internal flexbox layout
                            }
                        });
                    });

                });
            </script>
        </div>
    </div>

    <!-- chat -->
    <div id="supplier-chat-widget"
        class="fixed bottom-0 right-4 sm:right-8 w-[calc(100%-2rem)] sm:w-[580px] bg-white rounded-t-2xl border border-gray-200 shadow-[0_-10px_40px_rgba(0,0,0,0.1)] z-50 transform translate-y-[120%] transition-transform duration-300 ease-out flex flex-col opacity-0">

        <!-- Header -->
        <div class="px-4 py-3 border-b border-gray-100 bg-white rounded-t-2xl">

            <!-- Enquiry Product / Service -->
            <div class="flex items-center gap-3">

                <div class="w-12 h-12 rounded-xl border border-gray-100 bg-white p-1 overflow-hidden">
                    <img id="chat-item-image" src="" class="w-full h-full object-contain">
                </div>

                <div class="flex-1 min-w-0">

                    <h4 id="chat-item-name" class="text-[14px] font-bold text-gray-900 truncate">
                        Loading...
                    </h4>

                    <div class="flex items-center gap-2 mt-1">

                        <span id="chat-supplier-name" class="text-[12px] text-gray-500">
                            Supplier
                        </span>

                        <span class="w-1 h-1 rounded-full bg-gray-300">
                        </span>

                        <span class="text-[11px] text-emerald-600 font-medium">
                            Online
                        </span>

                    </div>

                </div>

                <button id="close-chat-btn"
                    class="p-1.5 hover:bg-red-50 hover:text-red-500 rounded-md transition-colors">

                    <i data-lucide="x" class="w-5 h-5"></i>

                </button>

            </div>

        </div>

        <!-- Messages -->
        <div id="chat-messages" class="p-4 bg-slate-50 h-[350px] overflow-y-auto flex flex-col gap-3">

            <div class="flex justify-center">
                <span
                    class="bg-emerald-50 text-emerald-700 border border-emerald-100 text-[10px] font-medium px-3 py-1.5 rounded-full">
                    Chat Loading...
                </span>
            </div>

        </div>

        <!-- Footer -->
        <div class="p-3 bg-white border-t border-gray-100">

            <div class="flex items-end gap-2">

                <textarea id="chat-message" rows="1" placeholder="Type a message..."
                    class="flex-1 max-h-24 bg-slate-50 border border-gray-200 rounded-xl px-3 py-2.5 text-[13px] text-gray-700 focus:outline-none focus:border-primary resize-none"></textarea>

                <button onclick="sendMessage()"
                    class="w-10 h-10 shrink-0 bg-primary text-white rounded-xl flex items-center justify-center">
                    <i data-lucide="send" class="w-4 h-4"></i>
                </button>

            </div>

        </div>

    </div>

    @include('auth.Layout.footer')

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


    //profile edit
    <!-- Edit Enable Script -->
    <script>
        const editBtn = document.getElementById('editProfileBtn');
        const saveBtn = document.getElementById('saveProfileBtn');
        const profileInputs = document.querySelectorAll('.profile-input');

        editBtn.addEventListener('click', function() {

            profileInputs.forEach(input => {

                input.removeAttribute('disabled');

                input.classList.remove('bg-gray-50');

                input.classList.add('bg-white');

            });

            saveBtn.classList.remove('hidden');

            this.innerHTML = `
            <i data-lucide="check" class="w-4 h-4"></i>
            Editing Enabled
        `;

            this.disabled = true;

            lucide.createIcons();

        });
    </script>

    //same tab
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const sidebarLinks = document.querySelectorAll('.sidebar-link');
            const dashboardPanels = document.querySelectorAll('.dashboard-panel');

            const activeClasses = ['bg-primary/5', 'text-primary', 'font-bold'];
            const inactiveClasses = ['text-gray-600', 'font-medium', 'hover:bg-slate-50', 'hover:text-primary'];

            // =========================================
            // SIDEBAR PANEL SWITCHING
            // =========================================

            sidebarLinks.forEach(link => {

                link.addEventListener('click', function(e) {

                    e.preventDefault();

                    // Remove active from all
                    sidebarLinks.forEach(l => {
                        l.classList.remove(...activeClasses);
                        l.classList.add(...inactiveClasses);
                    });

                    // Active current
                    this.classList.remove(...inactiveClasses);
                    this.classList.add(...activeClasses);

                    // Hide all panels
                    dashboardPanels.forEach(panel => {
                        panel.classList.add('hidden');
                        panel.classList.remove('flex');
                    });

                    // Show target panel
                    const targetId = this.getAttribute('data-target');
                    const targetPanel = document.getElementById(targetId);

                    if (targetPanel) {
                        targetPanel.classList.remove('hidden');
                        targetPanel.classList.add('flex');
                    }

                });

            });

            // =========================================
            // PROFILE EDIT ENABLE
            // =========================================

            const editBtn = document.getElementById('editProfileBtn');
            const saveBtn = document.getElementById('saveProfileBtn');
            const profileInputs = document.querySelectorAll('.profile-input');

            if (editBtn) {

                editBtn.addEventListener('click', function() {

                    profileInputs.forEach(input => {

                        input.removeAttribute('disabled');

                        input.classList.remove('bg-gray-50');

                        input.classList.add('bg-white');
                    });

                    saveBtn.classList.remove('hidden');

                    this.innerHTML = `
                    <i data-lucide="check" class="w-4 h-4"></i>
                    Editing Enabled
                `;

                    this.disabled = true;

                    lucide.createIcons();
                });

            }

            // =========================================
            // KEEP CHANGE PASSWORD TAB ACTIVE
            // =========================================

            @if (session('password_success') || $errors->has('current_password') || $errors->has('password'))

                showPanel('panel-change-password');
            @endif


            // =========================================
            // KEEP PROFILE TAB ACTIVE
            // =========================================

            @if (session('success') ||
                    $errors->has('name') ||
                    $errors->has('mobile') ||
                    $errors->has('address') ||
                    $errors->has('state') ||
                    $errors->has('city') ||
                    $errors->has('image'))

                showPanel('panel-profile');

                // Enable editing automatically
                profileInputs.forEach(input => {

                    input.removeAttribute('disabled');

                    input.classList.remove('bg-gray-50');

                    input.classList.add('bg-white');
                });

                if (saveBtn) {
                    saveBtn.classList.remove('hidden');
                }
            @endif


            // =========================================
            // COMMON FUNCTION
            // =========================================

            function showPanel(panelId) {
                // Hide all panels
                dashboardPanels.forEach(panel => {
                    panel.classList.add('hidden');
                    panel.classList.remove('flex');
                });

                // Show selected panel
                const panel = document.getElementById(panelId);

                if (panel) {
                    panel.classList.remove('hidden');
                    panel.classList.add('flex');
                }

                // Remove active all sidebar
                sidebarLinks.forEach(link => {
                    link.classList.remove(...activeClasses);
                    link.classList.add(...inactiveClasses);
                });

                // Active current sidebar
                const activeLink = document.querySelector(`[data-target="${panelId}"]`);

                if (activeLink) {
                    activeLink.classList.remove(...inactiveClasses);
                    activeLink.classList.add(...activeClasses);
                }
            }

        });
    </script>

    <script>
        // Initialize Swiper after DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.trendingSwiper', {
                slidesPerView: 1,
                spaceBetween: 16,
                // Link custom buttons to Swiper's navigation
                navigation: {
                    nextEl: '.trending-next',
                    prevEl: '.trending-prev',
                },
                // Responsive breakpoints
                breakpoints: {
                    // when window width is >= 480px
                    480: {
                        slidesPerView: 2,
                    },
                    // when window width is >= 768px
                    768: {
                        slidesPerView: 3,
                    },
                    // when window width is >= 1024px
                    1024: {
                        slidesPerView: 4,
                    },
                    // when window width is >= 1280px
                    1280: {
                        slidesPerView: 5,
                    }
                }
            });

            // Re-initialize lucide icons if needed after swiper loads
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>

    <!-- Simple JavaScript for Carousel & Icons -->
    <script>
        // Initialize Lucide Icons
        lucide.createIcons();

        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.slider-dot');
        const totalSlides = slides.length;

        function updateSlider() {
            slides.forEach((slide, index) => {
                slide.style.opacity = index === currentSlide ? '1' : '0';
            });
            dots.forEach((dot, index) => {
                dot.style.opacity = index === currentSlide ? '1' : '0.5';
            });
        }

        function goToSlide(index) {
            currentSlide = index;
            updateSlider();
        }

        // Auto slide every 5 seconds
        setInterval(() => {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlider();
        }, 5000);
    </script>
    {{-- <script>
        let currentEnquiryId = null;
        const markReadUrl = "{{ route('chat.markRead', ':id') }}";

        function openChat(enquiryId, itemName, supplierName, imageUrl) {
            alert(2);

            currentEnquiryId = enquiryId;

            document.getElementById('chat-item-name').textContent = itemName;
            document.getElementById('chat-supplier-name').textContent = supplierName;
            document.getElementById('chat-item-image').src = imageUrl;

            const chat = document.getElementById('supplier-chat-widget');

            chat.classList.remove('translate-y-[120%]');
            chat.classList.remove('opacity-0');

            // Mark messages as read
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => {
                    console.log('STATUS', res.status);
                    return res.text();
                })
                .then(data => {
                    console.log('RESPONSE', data);
                })
                .catch(err => {
                    console.error(err);
                });

            loadMessages(enquiryId);
            document.querySelector(`#unread-${enquiryId}`)?.remove();
        }

        function loadMessages(enquiryId) {
            let url = "{{ route('enquiries.messages', ':id') }}";
            url = url.replace(':id', enquiryId);

            fetch(url)
                .then(response => response.json())
                .then(data => {

                    let html = '';

                    data.forEach(msg => {

                        let isMine = msg.sender_id == {{ auth()->id() }};

                        html += `
                    <div class="flex ${isMine ? 'justify-end' : 'justify-start'}">

                        <div class="${isMine
                            ? 'bg-blue-600 text-white'
                            : 'bg-white border border-gray-200 text-gray-800'}
                            px-4 py-2 rounded-2xl max-w-[75%]">

                            <div class="text-[13px]">
                                ${msg.message}
                            </div>

                            <div class="text-[10px] mt-1 opacity-70">
                                ${msg.sender.name}
                            </div>

                        </div>

                    </div>
                `;
                    });

                    document.getElementById('chat-messages').innerHTML = html;

                    let box = document.getElementById('chat-messages');
                    box.scrollTop = box.scrollHeight;
                });
        }

        function sendMessage() {
            let message = document.getElementById('chat-message').value;

            if (message.trim() === '') {
                return;
            }

            let url = "{{ route('enquiries.messages.store', ':id') }}";
            url = url.replace(':id', currentEnquiryId);

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        message: message
                    })
                })
                .then(response => response.json())
                .then(data => {

                    document.getElementById('chat-message').value = '';

                    loadMessages(currentEnquiryId);
                });
        }

        document.getElementById('close-chat-btn')
            .addEventListener('click', function() {

                const chat = document.getElementById('supplier-chat-widget');

                chat.classList.add('translate-y-[120%]');
                chat.classList.add('opacity-0');

            });

        setInterval(() => {

            if (currentEnquiryId) {
                loadMessages(currentEnquiryId);
            }

        }, 3000);
    </script> --}}
    <script>
        let currentEnquiryId = null;
        const markReadUrl = "{{ route('chat.markRead', ':id') }}";
            // alert(21);
        function openChat(enquiryId, itemName, supplierName, imageUrl) {

            currentEnquiryId = enquiryId;

            document.getElementById('chat-item-name').textContent = itemName;
            document.getElementById('chat-supplier-name').textContent = supplierName;
            document.getElementById('chat-item-image').src = imageUrl;

            const chat = document.getElementById('supplier-chat-widget');
            chat.classList.remove('translate-y-[120%]');
            chat.classList.remove('opacity-0');

            // ✅ Fixed: build markUrl correctly (was using undefined 'url')
            let markUrl = markReadUrl.replace(':id', enquiryId);

            fetch(markUrl, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(res => res.json())
                .then(data => {
                    console.log('Mark read:', data);
                })
                .catch(err => console.error('Mark read error:', err));

            loadMessages(enquiryId);
            document.querySelector(`#unread-${enquiryId}`)?.remove();
        }

        function loadMessages(enquiryId) {
            let url = "{{ route('enquiries.messages', ':id') }}";
            url = url.replace(':id', enquiryId);

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    let html = '';

                    data.forEach(msg => {
                        let isMine = msg.sender_id == {{ auth()->id() }};

                        html += `
                        <div class="flex ${isMine ? 'justify-end' : 'justify-start'}">
                            <div class="${isMine
                                ? 'bg-blue-600 text-white'
                                : 'bg-white border border-gray-200 text-gray-800'}
                                px-4 py-2 rounded-2xl max-w-[75%]">
                                <div class="text-[13px]">${msg.message}</div>
                                <div class="text-[10px] mt-1 opacity-70">${msg.sender.name}</div>
                            </div>
                        </div>
                    `;
                    });

                    document.getElementById('chat-messages').innerHTML = html;
                    let box = document.getElementById('chat-messages');
                    box.scrollTop = box.scrollHeight;
                });
        }

        function sendMessage() {
            let message = document.getElementById('chat-message').value;
            if (message.trim() === '') return;

            let url = "{{ route('enquiries.messages.store', ':id') }}";
            url = url.replace(':id', currentEnquiryId);

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        message: message
                    })
                })
                .then(response => response.json())
                .then(() => {
                    document.getElementById('chat-message').value = '';
                    loadMessages(currentEnquiryId);
                });
        }

        document.getElementById('close-chat-btn').addEventListener('click', function() {
            const chat = document.getElementById('supplier-chat-widget');
            chat.classList.add('translate-y-[120%]');
            chat.classList.add('opacity-0');
        });

        setInterval(() => {
            if (currentEnquiryId) {
                loadMessages(currentEnquiryId);
            }
        }, 3000);
    </script>
</body>

</html>
