@include('vendor.service.Layout.head')

<body class="text-gray-800 antialiased font-sans bg-slate-50">

    {{-- TOP BAR --}}
    @include('vendor.service.Layout.top_bar')

    {{-- HEADER --}}
    @include('vendor.service.Layout.main_header')

    @php
        $vendor = Auth::guard('vendor')->user();
    @endphp

    <div class="bg-slate-50 min-h-screen py-8">
        <div class="max-w-7xl mx-auto px-4">

            @include('vendor.service.Layout.service_menubar')

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
                                <button
                                    class="inbox-tab-btn pb-3 border-b-2 border-transparent text-gray-500 hover:text-gray-900 transition-colors whitespace-nowrap"
                                    data-filter="unread">
                                    Unread <span
                                        class="text-xs ml-1 bg-gray-100 px-1.5 py-0.5 rounded-md text-gray-600">1</span>
                                </button>
                                <button
                                    class="inbox-tab-btn pb-3 border-b-2 border-transparent text-gray-500 hover:text-gray-900 transition-colors whitespace-nowrap"
                                    data-filter="unreplied">Not yet replied</button>
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
                                <tbody id="inbox-table-body" class="divide-y divide-gray-50 text-[14px]">

                                    <tr class="inbox-row hover:bg-slate-50/50 transition-colors bg-white group"
                                        data-status="unread">
                                        <td class="px-6 py-5 text-center text-gray-400 font-medium">1</td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-blue-50 border border-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg shrink-0">
                                                    R</div>
                                                <div>
                                                    <p class="font-bold text-gray-900 leading-tight">Rahul Sharma</p>
                                                    <p class="text-[12px] text-gray-500 mt-0.5">TechVision Industries
                                                        Ltd.</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-12 h-12 rounded-xl border border-gray-100 p-1 bg-white shrink-0 shadow-sm">
                                                    <img src="https://pngimg.com/uploads/robot/robot_PNG98.png"
                                                        alt="Product"
                                                        class="w-full h-full object-contain mix-blend-multiply">
                                                </div>
                                                <p
                                                    class="font-medium text-gray-900 line-clamp-2 max-w-[220px] text-[13px] group-hover:text-primary transition-colors cursor-pointer">
                                                    Automatic High-Speed Industrial Packaging Machine X-200
                                                </p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div
                                                class="flex items-center gap-1.5 text-gray-600 text-[13px] font-medium">
                                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-gray-400"></i>
                                                Bangalore, IN
                                            </div>
                                            <div class="text-[11px] text-gray-400 mt-1 ml-5">Today, 10:45 AM</div>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            <button id="open-chat-btn"
                                                class="inline-flex items-center justify-center gap-2 bg-primary text-white hover:bg-primaryHover px-4 py-2.5 rounded-xl text-[13px] font-bold transition-all shadow-md shadow-primary/20 relative">
                                                <i data-lucide="message-circle" class="w-4 h-4"></i> Chat
                                                <span class="absolute -top-1 -right-1 flex h-3.5 w-3.5">
                                                    <span
                                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                                                    <span
                                                        class="relative inline-flex rounded-full h-3.5 w-3.5 bg-red-500 border-2 border-white"></span>
                                                </span>
                                            </button>
                                        </td>
                                    </tr>

                                    <tr class="inbox-row hover:bg-slate-50/50 transition-colors bg-white group"
                                        data-status="read">
                                        <td class="px-6 py-5 text-center text-gray-400 font-medium">2</td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-lg shrink-0">
                                                    A</div>
                                                <div>
                                                    <p class="font-bold text-gray-900 leading-tight">Anita Patel</p>
                                                    <p class="text-[12px] text-gray-500 mt-0.5">Green Energy Hub
                                                        Solutions</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-12 h-12 rounded-xl border border-gray-100 p-1 bg-white shrink-0 shadow-sm">
                                                    <img src="https://pngimg.com/uploads/robot/robot_PNG98.png"
                                                        alt="Product"
                                                        class="w-full h-full object-contain mix-blend-multiply">
                                                </div>
                                                <p
                                                    class="font-medium text-gray-900 line-clamp-2 max-w-[220px] text-[13px] group-hover:text-primary transition-colors cursor-pointer">
                                                    Precision CNC Lathe Machine - Heavy Duty
                                                </p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div
                                                class="flex items-center gap-1.5 text-gray-600 text-[13px] font-medium">
                                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-gray-400"></i>
                                                Ahmedabad, IN
                                            </div>
                                            <div class="text-[11px] text-gray-400 mt-1 ml-5">Yesterday, 14:20 PM</div>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            <button
                                                class="inline-flex items-center justify-center gap-2 bg-slate-100 text-gray-700 hover:bg-slate-200 hover:text-gray-900 px-4 py-2.5 rounded-xl text-[13px] font-bold transition-all">
                                                <i data-lucide="message-circle" class="w-4 h-4 text-gray-500"></i>
                                                Open
                                            </button>
                                        </td>
                                    </tr>

                                    <tr class="inbox-row hover:bg-slate-50/50 transition-colors bg-white group"
                                        data-status="unreplied">
                                        <td class="px-6 py-5 text-center text-gray-400 font-medium">3</td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-purple-50 border border-purple-100 text-purple-600 flex items-center justify-center font-bold text-lg shrink-0">
                                                    S</div>
                                                <div>
                                                    <p class="font-bold text-gray-900 leading-tight">Sarah Jenkins</p>
                                                    <p class="text-[12px] text-gray-500 mt-0.5">Global Exports LLC</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-12 h-12 rounded-xl border border-gray-100 p-1 bg-white shrink-0 shadow-sm">
                                                    <img src="https://pngimg.com/uploads/engine/engine_PNG31.png"
                                                        alt="Product"
                                                        class="w-full h-full object-contain mix-blend-multiply">
                                                </div>
                                                <p
                                                    class="font-medium text-gray-900 line-clamp-2 max-w-[220px] text-[13px] group-hover:text-primary transition-colors cursor-pointer">
                                                    Industrial Diesel Generator V8 - Commercial Grade
                                                </p>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div
                                                class="flex items-center gap-1.5 text-gray-600 text-[13px] font-medium">
                                                <i data-lucide="globe" class="w-3.5 h-3.5 text-gray-400"></i> London,
                                                UK
                                            </div>
                                            <div class="text-[11px] text-gray-400 mt-1 ml-5">Oct 12, 09:15 AM</div>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            <button
                                                class="inline-flex items-center justify-center gap-2 bg-slate-100 text-gray-700 hover:bg-slate-200 hover:text-gray-900 px-4 py-2.5 rounded-xl text-[13px] font-bold transition-all">
                                                <i data-lucide="message-circle" class="w-4 h-4 text-gray-500"></i>
                                                Open
                                            </button>
                                        </td>
                                    </tr>

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
                                    {{ \App\Models\Enquiry::where('sender_id', Auth::guard('vendor')->id())->count() }}
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

                                    <tr class="hover:bg-slate-50/50 transition-colors bg-white group">
                                        <td class="px-6 py-5 text-center text-gray-400 font-medium">1</td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-blue-50 border border-blue-100 text-blue-600 flex items-center justify-center font-bold text-lg shrink-0">
                                                    M</div>
                                                <div>
                                                    <p class="font-bold text-gray-900 leading-tight">Mumbai Industrial
                                                        Tech</p>
                                                    <div class="flex items-center gap-1 mt-0.5">
                                                        <i data-lucide="shield-check"
                                                            class="w-3.5 h-3.5 text-emerald-500"></i>
                                                        <span class="text-[12px] text-gray-500">Verified
                                                            Supplier</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-12 h-12 rounded-xl border border-gray-100 p-1 bg-white shrink-0 shadow-sm">
                                                    <img src="https://pngimg.com/uploads/robot/robot_PNG98.png"
                                                        alt="Product"
                                                        class="w-full h-full object-contain mix-blend-multiply">
                                                </div>
                                                <div>
                                                    <p
                                                        class="font-medium text-gray-900 line-clamp-1 max-w-[220px] text-[13px] group-hover:text-primary transition-colors cursor-pointer">
                                                        Request for Quotation: Packaging Machine
                                                    </p>
                                                    <span
                                                        class="inline-flex mt-1 items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-emerald-50 text-emerald-600 border border-emerald-100">
                                                        <i data-lucide="check-check" class="w-3 h-3"></i> Replied
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="text-[13px] font-medium text-gray-900">Today</div>
                                            <div class="text-[11px] text-gray-400 mt-0.5">10:45 AM</div>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            <button
                                                class="inline-flex items-center justify-center gap-2 bg-slate-100 text-gray-700 hover:bg-slate-200 hover:text-gray-900 px-4 py-2.5 rounded-xl text-[13px] font-bold transition-all shadow-sm">
                                                <i data-lucide="eye" class="w-4 h-4 text-gray-500"></i> View
                                            </button>
                                        </td>
                                    </tr>

                                    <tr class="hover:bg-slate-50/50 transition-colors bg-white group">
                                        <td class="px-6 py-5 text-center text-gray-400 font-medium">2</td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-amber-50 border border-amber-100 text-amber-600 flex items-center justify-center font-bold text-lg shrink-0">
                                                    P</div>
                                                <div>
                                                    <p class="font-bold text-gray-900 leading-tight">Punjab Agri
                                                        Machineries</p>
                                                    <div class="flex items-center gap-1 mt-0.5">
                                                        <i data-lucide="shield-check"
                                                            class="w-3.5 h-3.5 text-emerald-500"></i>
                                                        <span class="text-[12px] text-gray-500">Verified
                                                            Supplier</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-12 h-12 rounded-xl border border-gray-100 p-1 bg-white shrink-0 shadow-sm">
                                                    <img src="https://pngimg.com/uploads/robot/robot_PNG98.png"
                                                        alt="Product"
                                                        class="w-full h-full object-contain mix-blend-multiply">
                                                </div>
                                                <div>
                                                    <p
                                                        class="font-medium text-gray-900 line-clamp-1 max-w-[220px] text-[13px] group-hover:text-primary transition-colors cursor-pointer">
                                                        Inquiry about 4WD Tractor 50HP Specs
                                                    </p>
                                                    <span
                                                        class="inline-flex mt-1 items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-blue-50 text-blue-600 border border-blue-100">
                                                        <i data-lucide="check" class="w-3 h-3"></i> Read
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="text-[13px] font-medium text-gray-900">Yesterday</div>
                                            <div class="text-[11px] text-gray-400 mt-0.5">14:20 PM</div>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            <button
                                                class="inline-flex items-center justify-center gap-2 bg-slate-100 text-gray-700 hover:bg-slate-200 hover:text-gray-900 px-4 py-2.5 rounded-xl text-[13px] font-bold transition-all shadow-sm">
                                                <i data-lucide="eye" class="w-4 h-4 text-gray-500"></i> View
                                            </button>
                                        </td>
                                    </tr>

                                    <tr class="hover:bg-slate-50/50 transition-colors bg-white group">
                                        <td class="px-6 py-5 text-center text-gray-400 font-medium">3</td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 text-slate-600 flex items-center justify-center font-bold text-lg shrink-0">
                                                    G</div>
                                                <div>
                                                    <p class="font-bold text-gray-900 leading-tight">Gujarat Motors
                                                        Ltd.
                                                    </p>
                                                    <p class="text-[12px] text-gray-500 mt-0.5">Standard Supplier</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-12 h-12 rounded-xl border border-gray-100 p-1 bg-white shrink-0 shadow-sm">
                                                    <img src="https://pngimg.com/uploads/engine/engine_PNG31.png"
                                                        alt="Product"
                                                        class="w-full h-full object-contain mix-blend-multiply">
                                                </div>
                                                <div>
                                                    <p
                                                        class="font-medium text-gray-900 line-clamp-1 max-w-[220px] text-[13px] group-hover:text-primary transition-colors cursor-pointer">
                                                        Pricing for Commercial V8 Engines
                                                    </p>
                                                    <span
                                                        class="inline-flex mt-1 items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-500 border border-slate-200">
                                                        <i data-lucide="send" class="w-3 h-3"></i> Delivered
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <div class="text-[13px] font-medium text-gray-900">Oct 12, 2023</div>
                                            <div class="text-[11px] text-gray-400 mt-0.5">09:15 AM</div>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            <button
                                                class="inline-flex items-center justify-center gap-2 bg-slate-100 text-gray-700 hover:bg-slate-200 hover:text-gray-900 px-4 py-2.5 rounded-xl text-[13px] font-bold transition-all shadow-sm">
                                                <i data-lucide="eye" class="w-4 h-4 text-gray-500"></i> View
                                            </button>
                                        </td>
                                    </tr>

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
