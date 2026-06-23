@include('vendor.Layout.head')

<body class="text-gray-800 antialiased font-sans bg-slate-50">

    {{-- TOP BAR --}}
    {{-- @include('vendor.Layout.top_bar') --}}

    {{-- HEADER --}}
    @include('vendor.Layout.main_header')

    @php
        $vendor = Auth::guard('vendor')->user();
    @endphp

    <div class="bg-slate-50 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4">

            @include('vendor.Layout.menu_bar')

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

                    </div>
                </aside>

                <main class="flex-1">

                    <div id="panel-inbox"
                        class="dashboard-panel bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden flex flex-col h-full min-h-[600px]">

                        <div class="px-6 pt-6 border-b border-gray-100">
                            <h1 class="text-[20px] font-bold text-gray-900 mb-6">Inbox</h1>

                            <div class="flex overflow-x-auto hide-scrollbar gap-8 text-[14px] font-medium">
                                <button
                                    class="inbox-tab-btn pb-3 border-b-2 border-primary text-primary font-bold whitespace-nowrap"
                                    data-filter="all">All</button>

                            </div>
                        </div>

                        {{-- <div
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
                        </div> --}}

                        <div class="flex-1 overflow-x-auto hide-scrollbar">
                            <table class="w-full text-left border-collapse min-w-[800px]">
                                <thead>
                                    <tr
                                        class="bg-white border-b border-gray-100 text-[12px] uppercase tracking-wider text-gray-400 font-bold">
                                        <th class="px-6 py-4 w-12 text-center">#</th>
                                        <th class="px-6 py-4">Sender Info</th>
                                        <th class="px-6 py-4">Interested Product</th>
                                        <th class="px-6 py-4">Location</th>
                                        <th class="px-6 py-4 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($enquiries as $key => $enquiry)
                                        @php
                                            $hasUnread = \App\Models\Message::where('enquiry_id', $enquiry->id)
                                                ->where('receiver_id', Auth::guard('vendor')->id())
                                                ->where('is_read', 1)
                                                ->exists();
                                        @endphp

                                        <tr class="hover:bg-slate-50 inbox-row"
                                            data-status="{{ $hasUnread ? 'unread' : 'read' }}">

                                            {{-- S.NO --}}
                                            <td class="px-6 py-5 text-center">
                                                {{ $enquiries->firstItem() + $key }}
                                            </td>

                                            {{-- Sender --}}
                                            <td class="px-6 py-5">
                                                <div class="flex items-center gap-3">

                                                    <div
                                                        class="w-10 h-10 rounded-full bg-blue-50 border border-blue-100 text-blue-600 flex items-center justify-center font-bold">

                                                        {{ strtoupper(substr($enquiry->sender->name ?? 'U', 0, 1)) }}

                                                    </div>

                                                    <div>

                                                        <p class="font-bold flex items-center gap-2">

                                                            {{ $enquiry->sender->name ?? 'N/A' }}

                                                            @if ($hasUnread)
                                                                <span
                                                                    class="w-2.5 h-2.5 bg-red-500 rounded-full"></span>
                                                            @endif

                                                        </p>

                                                        <p class="text-xs text-gray-500">
                                                            {{ $enquiry->sender->email ?? '' }}
                                                        </p>

                                                    </div>

                                                </div>
                                            </td>

                                            {{-- Product --}}
                                            <td class="px-6 py-5">

                                                <div class="flex items-center gap-3">

                                                    <div
                                                        class="w-12 h-12 rounded-xl border border-gray-100 p-1 bg-white overflow-hidden">

                                                        @if ($enquiry->product)
                                                            @php
                                                                $images = json_decode($enquiry->product->image, true);
                                                            @endphp

                                                            <img src="{{ asset('uploads/products/' . ($images[0] ?? 'no-image.png')) }}"
                                                                class="w-full h-full object-contain">
                                                        @elseif($enquiry->service)
                                                            @php
                                                                $serviceImages = json_decode(
                                                                    $enquiry->service->service_img,
                                                                    true,
                                                                );
                                                                $serviceImage = !empty($serviceImages[0])
                                                                    ? $serviceImages[0]
                                                                    : 'no-image.png';
                                                            @endphp

                                                            <img src="{{ asset('uploads/service/images/' . $serviceImage) }}"
                                                                class="w-full h-full object-contain">
                                                        @endif

                                                    </div>

                                                    <div>

                                                        @if ($enquiry->product)
                                                            <p class="font-medium text-gray-900">
                                                                {{ $enquiry->product->product_name }}
                                                            </p>

                                                            <span
                                                                class="inline-flex mt-1 px-2 py-1 text-[10px] font-semibold rounded-full bg-blue-100 text-blue-700">
                                                                Product Enquiry
                                                            </span>
                                                        @elseif($enquiry->service)
                                                            <p class="font-medium text-gray-900">
                                                                {{ $enquiry->service->service_name }}
                                                            </p>

                                                            <span
                                                                class="inline-flex mt-1 px-2 py-1 text-[10px] font-semibold rounded-full bg-emerald-100 text-emerald-700">
                                                                Service Enquiry
                                                            </span>
                                                        @endif

                                                    </div>

                                                </div>

                                            </td>

                                            {{-- Location --}}
                                            <td class="px-6 py-5">

                                                {{ $enquiry->sender->city ?? '-' }}

                                                <div class="text-xs text-gray-400">
                                                    {{ $enquiry->created_at->diffForHumans() }}
                                                </div>

                                            </td>

                                            {{-- Action --}}
                                            <td class="px-6 py-5 text-center">

                                                <a href="#"
                                                    onclick="openChat(
                                                        {{ $enquiry->id }},
                                                        '{{ $enquiry->product?->product_name ?? ($enquiry->service?->service_name ?? 'Enquiry') }}',
                                                        '{{ $enquiry->receiver?->company_name ?? ($enquiry->receiver?->name ?? 'Supplier') }}',
                                                        '{{ $enquiry->product
                                                            ? asset('uploads/products/' . (json_decode($enquiry->product->image, true)[0] ?? ''))
                                                            : asset('uploads/service/images/' . ($enquiry->service->service_img ?? 'default.png')) }}'
                                                    )"
                                                    class="inline-flex items-center gap-2 bg-slate-100 hover:bg-slate-200 px-4 py-2.5 rounded-xl text-[13px] font-bold transition">

                                                    <i data-lucide="eye" class="w-4 h-4"></i>
                                                    View

                                                </a>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>
                                            <td colspan="5" class="text-center py-10 text-gray-500">
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
                                    {{ \App\Models\Enquiry::where('sender_id', Auth::guard('vendor')->id())->count() }}
                                </strong>
                            </span>
                        </div>

                        {{-- <div
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
                        </div> --}}

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

                                            // Product enquiry
                                            if ($enquiry->product) {
                                                $title = $enquiry->product->product_name;

                                                $images = json_decode($enquiry->product->image, true);

                                                $image =
                                                    !empty($images) && isset($images[0])
                                                        ? asset('uploads/products/' . $images[0])
                                                        : asset('assets/images/no-image.png');
                                            }

                                            // Service enquiry
                                            elseif ($enquiry->service) {
                                                $title = $enquiry->service->service_name;

                                                $image = $enquiry->service->service_img
                                                    ? asset('uploads/service/images/' . $enquiry->service->service_img)
                                                    : asset('assets/images/no-image.png');
                                            }

                                            // Fallback
                                            else {
                                                $title = 'Item Not Available';

                                                $image = asset('assets/images/no-image.png');
                                            }

                                        @endphp

                                        <tr class="hover:bg-slate-50/50 transition-colors bg-white group">

                                            {{-- SI NO --}}
                                            <td class="px-6 py-5 text-center text-gray-400 font-medium">
                                                {{ $index + 1 }}
                                            </td>

                                            {{-- Supplier --}}
                                            <td class="px-6 py-5">

                                                <div class="flex items-center gap-3">

                                                    <div
                                                        class="w-10 h-10 rounded-full bg-blue-50 border border-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg">

                                                        {{ strtoupper(substr($enquiry->receiver->name  ?? 'S', 0, 1)) }}

                                                    </div>

                                                    <div>

                                                        <p class="font-bold text-gray-900 leading-tight">
                                                           
                                                            {{ $enquiry->receiver->name ?? 'Unknown Supplier' }}

                                                        </p>

                                                        <div class="text-[12px] text-gray-500">

                                                            {{ $enquiry->receiver->city ?? '' }}

                                                            {{ $enquiry->receiver->state ?? '' }}

                                                        </div>

                                                    </div>

                                                </div>

                                            </td>

                                            {{-- Product / Service --}}
                                            <td class="px-6 py-5">

                                                <div class="flex items-center gap-3">

                                                    @foreach ($enquiries as $enquiry)
                                                        @if ($enquiry->service)
                                                            @php
                                                                $images =
                                                                    json_decode($enquiry->service->images, true) ?? [];
                                                            @endphp

                                                            @foreach ($images as $img)
                                                                <div
                                                                    class="w-12 h-12 rounded-xl border border-gray-100 p-1 bg-white shadow-sm">
                                                                    <img src="{{ asset('uploads/service/images/' . $img) }}"
                                                                        class="w-full h-full object-contain">
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    @endforeach

                                                    <div>

                                                        <p
                                                            class="font-medium text-gray-900 line-clamp-1 max-w-[220px] text-[13px]">

                                                            {{ $title }}

                                                        </p>

                                                        <span
                                                            class="text-[10px] px-2 py-0.5 rounded bg-emerald-50 text-emerald-600">

                                                            {{ $enquiry->product ? 'Product Enquiry' : 'Service Enquiry' }}

                                                        </span>

                                                    </div>

                                                </div>

                                            </td>

                                            {{-- Date --}}
                                            <td class="px-6 py-5">

                                                <div class="text-[13px] font-medium text-gray-900">

                                                    {{ $enquiry->created_at->format('M d, Y') }}

                                                </div>

                                                <div class="text-[11px] text-gray-400">

                                                    {{ $enquiry->created_at->format('h:i A') }}

                                                </div>

                                            </td>

                                            {{-- Action --}}
                                            <td class="px-6 py-5 text-center">

                                                <a href="#"
                                                    onclick="openChat(
                                                        {{ $enquiry->id }},
                                                        '{{ $enquiry->product?->product_name ?? ($enquiry->service?->service_name ?? 'Enquiry') }}',
                                                        '{{ $enquiry->receiver?->company_name ?? ($enquiry->receiver?->name ?? 'Supplier') }}',
                                                        '{{ $enquiry->product
                                                            ? asset('uploads/products/' . (json_decode($enquiry->product->image, true)[0] ?? ''))
                                                            : asset('uploads/service/images/' . ($enquiry->service->service_img ?? 'default.png')) }}'
                                                    )"
                                                    class="inline-flex items-center gap-2 bg-slate-100 px-4 py-2.5 rounded-xl text-[13px] font-bold">

                                                    <i data-lucide="eye" class="w-4 h-4"></i>

                                                    View

                                                </a>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="5" class="text-center py-10 text-gray-500">

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
                        class="dashboard-panel bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden hidden flex-col h-full ">

                        <div class="px-6 py-6 border-b border-gray-100">
                            <h1 class="text-[20px] font-bold text-gray-900 mb-1">Basic Info</h1>
                            <p class="text-[13px] text-gray-500 font-medium">Accurate and verified contacts will help
                                to
                                build trust with suppliers.</p>
                        </div>

                        <div class="p-6 lg:p-10 flex-1 overflow-y-auto hide-scrollbar">
                            <div class="max-w-3xl">

                                <div class="flex items-center mb-6">
                                    <div
                                        class="w-36 sm:w-48 shrink-0 text-right pr-6 text-[13px] text-gray-500 font-medium">
                                        Photo:</div>
                                    <div class="relative group cursor-pointer">
                                        <div
                                            class="w-20 h-20 bg-blue-50 border border-blue-100 rounded-full flex items-center justify-center text-blue-400 group-hover:bg-blue-100 transition-colors">
                                            <i data-lucide="user" class="w-8 h-8"></i>
                                        </div>
                                        <div
                                            class="absolute inset-0 bg-black/40 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                            <i data-lucide="camera" class="w-5 h-5 text-white"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center min-h-[44px] mb-2">
                                    <div
                                        class="w-36 sm:w-48 shrink-0 text-right pr-6 text-[13px] text-gray-500 font-medium">
                                        Full Name:</div>
                                    <div class="text-[14px] font-bold text-gray-900">Mr. Jeyaram</div>
                                </div>

                                <div class="flex flex-col sm:flex-row sm:items-center min-h-[44px] mb-2">
                                    <div
                                        class="w-36 sm:w-48 shrink-0 sm:text-right pr-6 text-[13px] text-gray-500 font-medium mb-1 sm:mb-0">
                                        Email Address:</div>
                                    <div class="flex flex-wrap items-center gap-3">
                                        <span
                                            class="text-[14px] font-bold text-gray-900">jeyaram.webbitech@gmail.com</span>

                                    </div>
                                </div>

                                <!-- <div class="flex items-center">
                                    <div class="w-36 sm:w-48 shrink-0 text-right pr-6"></div>
                                    <button
                                        class="bg-primary text-white hover:bg-primaryHover px-8 py-2.5 rounded-xl text-[14px] font-bold transition-all shadow-md shadow-primary/20 flex items-center gap-2">
                                        <i data-lucide="edit-2" class="w-4 h-4"></i> Edit Profile
                                    </button>
                                </div> -->

                            </div>
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


    {{-- FOOTER --}}
    @include('vendor.Layout.footer')

</body>

</html>
