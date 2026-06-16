@include('frontend.layouts.header-link')


      <!-- 1. Top Bar -->
      @include('frontend.layouts.top_bar')


    <!-- 2. Main Header (Sticky) -->
   @include('frontend.layouts.main_header')

   

     @include('frontend.layouts.navbar')

    <!-- Main Content -->
    <div class="bg-slate-50 min-h-screen pb-16 pt-6">
        <div class="max-w-7xl mx-auto px-4">

           <nav class="flex items-center text-[13px] text-gray-500 mb-6 font-medium flex-wrap">

    {{-- HOME --}}
    <a href="{{ url('/') }}"
        class="hover:text-primary transition-colors flex items-center gap-1">

        <i data-lucide="home" class="w-3.5 h-3.5"></i>

        Home

    </a>

    {{-- CATEGORY --}}
    <i data-lucide="chevron-right"
        class="w-3.5 h-3.5 mx-2 text-gray-400"></i>

    <a href="{{ route('categoryproducts', $category->id) }}"
        class="hover:text-primary transition-colors whitespace-nowrap">

        {{ $category->category_name ?? '' }}

    </a>

    {{-- SUB CATEGORY --}}
    <i data-lucide="chevron-right"
        class="w-3.5 h-3.5 mx-2 text-gray-400"></i>

    <a href="{{ route('subcategoryproducts', $subcategory->id) }}"
        class="hover:text-primary transition-colors whitespace-nowrap">

        {{ $subcategory->sub_category_name ?? '' }}

    </a>

    {{-- PRODUCT --}}
    <i data-lucide="chevron-right"
        class="w-3.5 h-3.5 mx-2 text-gray-400"></i>

    <span class="text-gray-900 truncate max-w-[200px] sm:max-w-none">

        {{ $product->product_name }}

    </span>

</nav>

            <div
                class="bg-white rounded-3xl p-5 lg:p-6 flex flex-col lg:flex-row gap-6 lg:gap-8 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] mb-8">

                <div class="w-full lg:w-2/5 xl:w-1/3 shrink-0">
                    <div
                        class="w-full aspect-square rounded-2xl border border-gray-100 bg-white flex items-center justify-center p-4 relative group mb-3">
                        <img id="main-product-img"
                            src="{{ asset('uploads/products/' . $productImages[0]) }}"
                            alt="{{ $product->product_name }}"
                            class="max-w-full max-h-full object-contain mix-blend-multiply transition-opacity duration-300">
                        <button
                            class="absolute top-3 right-3 w-9 h-9 bg-gray-50 hover:bg-red-50 rounded-full flex items-center justify-center text-gray-400 hover:text-red-500 transition-colors shadow-sm">
                            <i data-lucide="heart" class="w-4 h-4"></i>
                        </button>
                        <button id="open-lightbox-btn"
                            class="absolute bottom-3 right-3 w-9 h-9 bg-white/80 backdrop-blur border border-gray-200 rounded-full flex items-center justify-center text-gray-600 hover:text-primary transition-all opacity-100">
                            <i data-lucide="maximize-2" class="w-4 h-4"></i>
                        </button>
                    </div>

                    <div class="grid grid-cols-4 gap-2">

    @foreach($productImages as $index => $image)

        <div class="gallery-thumb
            aspect-square
            rounded-xl
            {{ $index == 0 ? 'border-2 border-primary' : 'border border-gray-100' }}
            bg-white p-2 cursor-pointer flex items-center justify-center transition-all"
            data-img="{{ asset('uploads/products/' . $image) }}">

            <img src="{{ asset('uploads/products/' . $image) }}"
                class="max-w-full max-h-full object-contain mix-blend-multiply">

        </div>

    @endforeach

</div>
                </div>

                <div id="image-lightbox"
                    class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/95 p-4 opacity-0 transition-opacity duration-300 backdrop-blur-sm">

                    <button id="close-lightbox"
                        class="absolute top-6 right-6 lg:top-10 lg:right-10 text-white/70 hover:text-white transition-colors cursor-pointer z-20 bg-white/10 p-2 rounded-full hover:bg-white/20">
                        <i data-lucide="x" class="w-8 h-8"></i>
                    </button>

                    <button id="lightbox-prev"
                        class="absolute left-4 sm:left-10 top-1/2 -translate-y-1/2 text-white/70 hover:text-white transition-colors cursor-pointer z-20 bg-white/10 p-3 rounded-full hover:bg-white/20">
                        <i data-lucide="chevron-left" class="w-8 h-8"></i>
                    </button>

                    <button id="lightbox-next"
                        class="absolute right-4 sm:right-10 top-1/2 -translate-y-1/2 text-white/70 hover:text-white transition-colors cursor-pointer z-20 bg-white/10 p-3 rounded-full hover:bg-white/20">
                        <i data-lucide="chevron-right" class="w-8 h-8"></i>
                    </button>

                    <img id="lightbox-img" src="" alt="Enlarged Product"
                        class="max-w-full max-h-[90vh] object-contain scale-95 transition-all duration-300 z-10 relative">
                </div>

                <div class="flex-1 flex flex-col">

                    <h1 class="text-xl md:text-[24px] font-bold text-gray-900 leading-snug mb-3">
                       {{ $product->product_name }}
                    </h1>

                    <p class="text-[13px] md:text-[14px] text-gray-600 leading-relaxed mb-6">
                       {{ $product->short_description }}
                    </p>

                   <div
                        class="grid grid-cols-2 gap-y-3 text-[13px] text-gray-600 mb-6 bg-slate-50 p-4 rounded-xl border border-slate-100">

                        @foreach($keyValues as $item)

                            <div class="flex items-start gap-2">

                                <span class="text-gray-400 w-24">

                                    {{ $item['key'] ?? '' }} :

                                </span>

                                <span class="font-bold text-gray-900">

                                    {{ $item['value'] ?? '' }}

                                </span>

                            </div>

                        @endforeach

                    </div>

                    <div class="w-full h-px bg-gray-100 mb-5"></div>

                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center font-bold text-md border border-blue-100">
                                {{ strtoupper(substr($vendor->company_name ?? 'V',0,1)) }}</div>
                            <div>
                                <h3
                                    class="text-[14px] font-bold text-gray-900 flex items-center gap-1.5 hover:text-primary cursor-pointer transition-colors">
                                   {{ $vendor->company_name ?? '' }} <i data-lucide="shield-check"
                                        class="w-4 h-4 text-emerald-500"></i>
                                </h3>
                                <div class="flex items-center gap-2 text-[12px] text-gray-500 mt-0.5">
                                    <!-- <span class="flex items-center gap-1 text-[#f57f17] font-bold"><i data-lucide="gem"
                                            class="w-3 h-3 fill-current"></i> Diamond</span> -->
                                    <span><i data-lucide="map-pin" class="w-3 h-3 inline"></i> {{ $vendor->city ?? '' }},
                                                {{ $vendor->state ?? '' }}</span>
                                    <!-- <span class="text-emerald-600 font-medium">98% Response Rate</span> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-auto flex flex-col sm:flex-row gap-2.5">
                       <a href="{{ route('enquiry', $product->id) }}"
                            target="_blank"
                            class="flex-1 bg-primary text-white hover:bg-primaryHover py-3 rounded-xl text-[14px] font-bold transition-all flex items-center justify-center gap-2 shadow-md shadow-primary/20">

                                <i data-lucide="mail" class="w-4 h-4"></i>

                                Send Enquiry

                        </a>

                        {{-- <button id="open-chat-btn"
                            class="flex-1 bg-white border-2 border-primary text-primary hover:bg-primary/5 py-3 rounded-xl text-[14px] font-bold transition-all flex items-center justify-center gap-2">
                            <i data-lucide="message-circle" class="w-4 h-4"></i> Chat with Supplier
                        </button> --}}
                    </div>
                </div>
            </div>

            <div
                class="bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden mb-12">

                <div class="flex overflow-x-auto border-b border-gray-100 hide-scrollbar bg-gray-50/50 px-[12px]">
                    <button
                        class="tab-btn px-8 py-4 text-[15px] font-bold text-primary border-b-2 border-primary whitespace-nowrap bg-white"
                        data-target="details">Product Details</button>
                    <button
                        class="tab-btn px-8 py-4 text-[15px] font-medium text-gray-500 hover:text-gray-900 border-b-2 border-transparent transition-colors whitespace-nowrap"
                        data-target="specs">Specifications</button>
                    <button
                        class="tab-btn px-8 py-4 text-[15px] font-medium text-gray-500 hover:text-gray-900 border-b-2 border-transparent transition-colors whitespace-nowrap"
                        data-target="company">Company Profile</button>
                    <button
                        class="tab-btn px-8 py-4 text-[15px] font-medium text-gray-500 hover:text-gray-900 border-b-2 border-transparent transition-colors whitespace-nowrap"
                        data-target="delivery">Data Sheet</button>
                </div>

                <div class="p-6 lg:p-10 min-h-[300px]">

                    <div id="tab-details" class="tab-panel block">
                        <h3 class="text-[18px] font-bold text-gray-900 mb-4">Product Overview</h3>
                        <p class="text-[14px] text-gray-600 leading-relaxed mb-8">
                           {{ $product->product_details }}
                        </p>

                     <h3 class="text-[18px] font-bold text-gray-900 mb-4">
                        Key Features
                    </h3>

                    <ul class="space-y-4 mb-10">

                        <li
                            class="flex items-start gap-3 text-[14px] text-gray-600 bg-slate-50 p-4 rounded-xl border border-slate-100">

                            <i data-lucide="check-circle-2"
                                class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5"></i>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full">

                                <div>
                                    <strong class="text-gray-900 block mb-1">
                                        Brand
                                    </strong>

                                    {{ $product->brand }}
                                </div>

                                <div>
                                    <strong class="text-gray-900 block mb-1">
                                        Model
                                    </strong>

                                    {{ $product->model_number }}
                                </div>

                            </div>

                        </li>

                    </ul>
                    </div>

                    <div id="tab-specs" class="tab-panel hidden">
                        <h3 class="text-[18px] font-bold text-gray-900 mb-4">Technical Specifications</h3>
                        <div class="overflow-x-auto rounded-xl border border-gray-200">
                            <table class="w-full text-[14px] text-left">
                               <tbody class="divide-y divide-gray-200">

                                    @foreach($specifications as $spec)

                                        <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">

                                            <th class="px-6 py-4 font-medium text-gray-500 w-1/3 sm:w-1/4">

                                                {{ $spec['name'] ?? '' }}

                                            </th>

                                            <td class="px-6 py-4 text-gray-900 font-medium">

                                                {{ $spec['value'] ?? '' }}

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>

                   <div id="tab-company" class="tab-panel hidden">

    <div class="bg-white rounded-3xl border border-gray-100 p-6 md:p-8">

        {{-- Company Header --}}
        <div class="flex flex-col md:flex-row md:items-center gap-5 mb-8">

            {{-- Company Logo --}}
            <div
                class="w-24 h-24 rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden flex items-center justify-center shrink-0">

                @if($vendor->company_logo)

                    <img src="{{ asset('uploads/vendor_logo/' . $vendor->company_logo) }}"
                        alt="{{ $vendor->company_name }}"
                        class="w-full h-full object-cover">

                @else

                    <div
                        class="w-full h-full flex items-center justify-center bg-slate-100 text-2xl font-bold text-primary">

                        {{ strtoupper(substr($vendor->company_name ?? 'V',0,1)) }}

                    </div>

                @endif

            </div>

            {{-- Company Info --}}
            <div class="flex-1">

                <div class="flex items-center gap-2 flex-wrap">

                    <h1 class="text-[28px] font-bold text-gray-900">

                        {{ $vendor->company_name }}

                    </h1>

                    @if($vendor->status == 1)

                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="w-6 h-6 text-emerald-500">

                            <path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"></path>

                            <path d="m9 12 2 2 4-4"></path>

                        </svg>

                    @endif

                </div>

                <div class="mt-2 text-[14px] text-gray-500">

                    Trusted Supplier & Verified Business

                </div>

            </div>

        </div>

        {{-- Company Details --}}
     <div
    class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-5 bg-slate-50 border border-slate-100 rounded-2xl p-6">

    {{-- Established --}}
    <div>
        <div class="text-gray-500 font-medium mb-1">
            Established
        </div>

        <div class="font-semibold text-gray-900">
            {{ $vendor->year_established ?? 'N/A' }}
        </div>
    </div>

    {{-- Email --}}
    <div>
        <div class="text-gray-500 font-medium mb-1">
            Email
        </div>

        <div class="font-semibold text-gray-900 break-all">
            {{ $vendor->email ?? 'N/A' }}
        </div>
    </div>

    {{-- Address --}}
    <div>
        <div class="text-gray-500 font-medium mb-1">
            Address
        </div>

        <div class="text-gray-900 leading-relaxed">
            {{ $vendor->address ?? 'N/A' }}
        </div>
    </div>

    {{-- Location --}}
    <div>
        <div class="text-gray-500 font-medium mb-1">
            Location
        </div>

        <div class="text-gray-900 leading-relaxed">
            {{ collect([
                $vendor->city,
                $vendor->state,
                $vendor->country
            ])->filter()->implode(', ') ?: 'N/A' }}
        </div>
    </div>

</div>

        {{-- About Company --}}
        <div class="mt-8">

            <h3 class="text-[20px] font-bold text-gray-900 mb-4">

                About Company

            </h3>

            <div
                class="bg-white border border-gray-100 rounded-2xl p-6 text-[14px] text-gray-600 leading-8 shadow-sm">

                {{ $vendor->about_us ?? 'No company details available.' }}

            </div>

        </div>

        {{-- Show More Button --}}
<div class="mt-8 flex justify-center">

    <a href="{{ route('vendor.details', $vendor->id) }}"
        class="px-6 py-3 rounded-xl bg-primary text-white font-semibold hover:bg-primaryHover transition-all shadow-md shadow-primary/20">

        Show More Details

    </a>

</div>

       

    </div>

</div>



                    <div id="tab-delivery" class="tab-panel hidden">

                        <div class="mb-6">
                            <h3 class="text-[18px] font-bold text-gray-900 mb-1">Data Sheets & Documents</h3>
                            <p class="text-[14px] text-gray-500">Download technical specifications, user manuals, and
                                compliance certificates.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            @foreach($datasheets as $sheet)

                                <a href="{{ asset('uploads/datasheets/' . $sheet) }}"
                                    target="_blank"
                                    class="bg-white border border-gray-100 rounded-2xl p-4 flex items-center gap-4 hover:border-primary/30 hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] transition-all group">

                                    <div
                                        class="w-12 h-12 rounded-xl bg-red-50 text-red-500 flex items-center justify-center shrink-0">

                                        <i data-lucide="file-text" class="w-6 h-6"></i>

                                    </div>

                                    <div class="flex-1 min-w-0">

                                        <h4
                                            class="text-[14px] font-bold text-gray-900 truncate">

                                            {{ $sheet }}

                                        </h4>

                                    </div>

                                    <div
                                        class="w-9 h-9 rounded-full bg-slate-50 flex items-center justify-center text-gray-400">

                                        <i data-lucide="download" class="w-4 h-4"></i>

                                    </div>

                                </a>

                            @endforeach

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Chat -->
    <div id="supplier-chat-widget"
        class="fixed bottom-0 right-4 sm:right-8 w-[calc(100%-2rem)] sm:w-[580px] bg-white rounded-t-2xl border border-gray-200 shadow-[0_-10px_40px_rgba(0,0,0,0.1)] z-50 transform translate-y-[120%] transition-transform duration-300 ease-out flex flex-col opacity-0">

        <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between bg-white rounded-t-2xl cursor-pointer">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <div
                        class="w-9 h-9 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center font-bold text-sm border border-blue-100">
                        M</div>
                    <div
                        class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 border-2 border-white rounded-full">
                    </div>
                </div>
                <div>
                    <h4 class="text-[14px] font-bold text-gray-900 leading-none mb-1">Mumbai Industrial Tech</h4>
                    <span class="text-[11px] text-emerald-600 font-medium flex items-center gap-1">Online <span
                            class="text-gray-400">• Local Time 16:03</span></span>
                </div>
            </div>
            <div class="flex items-center gap-1 text-gray-400">
                <button class="p-1.5 hover:bg-gray-50 hover:text-gray-600 rounded-md transition-colors"
                    title="Expand"><i data-lucide="maximize-2" class="w-4 h-4"></i></button>
                <button id="close-chat-btn"
                    class="p-1.5 hover:bg-red-50 hover:text-red-500 rounded-md transition-colors" title="Close"><i
                        data-lucide="x" class="w-5 h-5"></i></button>
            </div>
        </div>

        <div class="p-4 bg-slate-50 h-[320px] overflow-y-auto flex flex-col gap-4">

            <div class="flex items-center justify-center mt-2">
                <span
                    class="bg-emerald-50 text-emerald-700 border border-emerald-100 text-[10px] font-medium px-3 py-1.5 rounded-full flex items-center gap-1.5 text-center">
                    <i data-lucide="shield-check" class="w-3.5 h-3.5"></i> To secure your transactions, please
                    communicate via the platform.
                </span>
            </div>

            <div
                class="bg-white border border-gray-200 rounded-xl p-3 flex gap-3 shadow-[0_2px_10px_rgb(0,0,0,0.02)] mt-2">
                <img src="https://pngimg.com/uploads/robot/robot_PNG98.png" alt="Product"
                    class="w-16 h-16 object-contain bg-gray-50 rounded-lg p-1 border border-gray-100 shrink-0">
                <div class="flex-1 flex flex-col justify-between">
                    <h5 class="text-[12px] font-bold text-gray-900 line-clamp-2 leading-snug">Automatic High-Speed
                        Industrial Packaging Machine</h5>
                    <div class="flex items-end justify-between mt-2">
                        <div>
                            <span class="text-[14px] font-extrabold text-gray-900">₹4,50,000</span>
                            <span class="text-[10px] text-gray-500 block">Min Order: 1 Unit</span>
                        </div>
                        <button
                            class="bg-gray-900 text-white text-[11px] font-bold px-4 py-1.5 rounded-lg hover:bg-primary transition-colors shadow-sm">Send</button>
                    </div>
                </div>
            </div>

        </div>

        <div class="p-3 bg-white border-t border-gray-100">
            <div class="flex items-center gap-1 mb-2 text-gray-400">
                <button class="p-1.5 hover:text-primary hover:bg-gray-50 rounded-md transition-colors"><i
                        data-lucide="smile" class="w-4 h-4"></i></button>
                <button class="p-1.5 hover:text-primary hover:bg-gray-50 rounded-md transition-colors"><i
                        data-lucide="folder" class="w-4 h-4"></i></button>
                <button class="p-1.5 hover:text-primary hover:bg-gray-50 rounded-md transition-colors"><i
                        data-lucide="image" class="w-4 h-4"></i></button>
                <button class="p-1.5 hover:text-primary hover:bg-gray-50 rounded-md transition-colors"><i
                        data-lucide="languages" class="w-4 h-4"></i></button>
            </div>
            <div class="flex items-end gap-2">
                <textarea rows="1" placeholder="Type a message..."
                    class="flex-1 max-h-24 bg-slate-50 border border-gray-200 rounded-xl px-3 py-2.5 text-[13px] text-gray-700 focus:outline-none focus:border-primary focus:bg-white transition-all resize-none"></textarea>
                <button
                    class="w-10 h-10 shrink-0 bg-primary text-white rounded-xl flex items-center justify-center hover:bg-primaryHover transition-colors shadow-sm">
                    <i data-lucide="send" class="w-4 h-4 ml-0.5"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const openChatBtn = document.getElementById('open-chat-btn');
            const closeChatBtn = document.getElementById('close-chat-btn');
            const chatWidget = document.getElementById('supplier-chat-widget');

            // Open Chat Function
            openChatBtn.addEventListener('click', (e) => {
                e.preventDefault(); // Prevent default link behavior if applicable

                // Make visible and slide up
                chatWidget.classList.remove('opacity-0', 'translate-y-[120%]');
                chatWidget.classList.add('opacity-100', 'translate-y-0');
            });

            // Close Chat Function
            closeChatBtn.addEventListener('click', () => {
                // Slide down and fade out
                chatWidget.classList.remove('opacity-100', 'translate-y-0');
                chatWidget.classList.add('opacity-0', 'translate-y-[120%]');
            });

        });
    </script>

    <!-- End Chat -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // =========================================
            // 1. IMAGE GALLERY FUNCTIONALITY
            // =========================================
            const mainImg = document.getElementById('main-product-img');
            const thumbnails = document.querySelectorAll('.gallery-thumb');

            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function () {
                    // Get the image source from the clicked thumbnail
                    const newSrc = this.getAttribute('data-img');

                    // Fade out the main image
                    mainImg.style.opacity = '0';

                    // Swap the image source and fade back in after a tiny delay
                    setTimeout(() => {
                        mainImg.src = newSrc;
                        mainImg.style.opacity = '1';
                    }, 200);

                    // Remove active classes (primary border) from all thumbnails
                    thumbnails.forEach(t => {
                        t.classList.remove('border-primary', 'border-2');
                        t.classList.add('border-gray-100', 'border');
                    });

                    // Add active classes to the clicked thumbnail
                    this.classList.remove('border-gray-100', 'border');
                    this.classList.add('border-primary', 'border-2');
                });
            });

            // =========================================
            // 2. TAB SWITCHING FUNCTIONALITY
            // =========================================
            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabPanels = document.querySelectorAll('.tab-panel');

            tabBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    // 1. Reset all buttons to default inactive style
                    tabBtns.forEach(b => {
                        b.className = "tab-btn px-8 py-4 text-[15px] font-medium text-gray-500 hover:text-gray-900 border-b-2 border-transparent transition-colors whitespace-nowrap";
                    });

                    // 2. Apply active style to clicked button
                    btn.className = "tab-btn px-8 py-4 text-[15px] font-bold text-primary border-b-2 border-primary whitespace-nowrap bg-white";

                    // 3. Hide all tab panels
                    tabPanels.forEach(panel => {
                        panel.classList.remove('block');
                        panel.classList.add('hidden');
                    });

                    // 4. Show the target panel
                    const targetId = 'tab-' + btn.getAttribute('data-target');
                    const targetPanel = document.getElementById(targetId);
                    if (targetPanel) {
                        targetPanel.classList.remove('hidden');
                        targetPanel.classList.add('block');
                    }
                });
            });

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // =========================================
            // IMAGE GALLERY & LIGHTBOX FUNCTIONALITY
            // =========================================
            const mainImg = document.getElementById('main-product-img');
            const thumbnails = document.querySelectorAll('.gallery-thumb[data-img]'); // Only target thumbs with images
            const openLightboxBtn = document.getElementById('open-lightbox-btn');

            const lightbox = document.getElementById('image-lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            const closeLightboxBtn = document.getElementById('close-lightbox');
            const lightboxPrev = document.getElementById('lightbox-prev');
            const lightboxNext = document.getElementById('lightbox-next');

            // Store all image sources in an array
            const imageArray = Array.from(thumbnails).map(thumb => thumb.getAttribute('data-img'));
            let currentIndex = 0; // Keep track of which image is active

            // 1. Thumbnail Click Logic
            thumbnails.forEach((thumb, index) => {
                thumb.addEventListener('click', function () {
                    currentIndex = index; // Update the global index
                    const newSrc = this.getAttribute('data-img');

                    // Fade out main image
                    mainImg.style.opacity = '0';

                    setTimeout(() => {
                        mainImg.src = newSrc;
                        mainImg.style.opacity = '1';
                    }, 200);

                    // Update active styling on thumbnails
                    document.querySelectorAll('.gallery-thumb').forEach(t => {
                        t.classList.remove('border-primary', 'border-2');
                        t.classList.add('border-gray-100', 'border');
                    });
                    this.classList.remove('border-gray-100', 'border');
                    this.classList.add('border-primary', 'border-2');
                });
            });

            // 2. Open Lightbox
            openLightboxBtn.addEventListener('click', () => {
                // Set lightbox image to current index
                lightboxImg.src = imageArray[currentIndex];

                lightbox.classList.remove('hidden');
                lightbox.classList.add('flex');

                setTimeout(() => {
                    lightbox.classList.remove('opacity-0');
                    lightboxImg.classList.remove('scale-95');
                    lightboxImg.classList.add('scale-100');
                }, 10);

                if (typeof lucide !== 'undefined') lucide.createIcons();
            });

            // 3. Close Lightbox
            const closeLightbox = () => {
                lightbox.classList.add('opacity-0');
                lightboxImg.classList.remove('scale-100');
                lightboxImg.classList.add('scale-95');

                setTimeout(() => {
                    lightbox.classList.add('hidden');
                    lightbox.classList.remove('flex');
                }, 300);
            };

            closeLightboxBtn.addEventListener('click', closeLightbox);

            // Close when clicking dark background
            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) closeLightbox();
            });

            // 4. Lightbox Navigation Logic
            const updateLightboxImage = () => {
                // Quick fade effect for sliding
                lightboxImg.style.opacity = '0';
                lightboxImg.style.transform = 'scale(0.98)';

                setTimeout(() => {
                    lightboxImg.src = imageArray[currentIndex];
                    lightboxImg.style.opacity = '1';
                    lightboxImg.style.transform = 'scale(1)';
                }, 200);
            };

            lightboxPrev.addEventListener('click', (e) => {
                e.stopPropagation(); // Stop click from hitting background and closing
                // Decrease index, wrap around to end if at 0
                currentIndex = (currentIndex - 1 + imageArray.length) % imageArray.length;
                updateLightboxImage();
            });

            lightboxNext.addEventListener('click', (e) => {
                e.stopPropagation();
                // Increase index, wrap around to 0 if at end
                currentIndex = (currentIndex + 1) % imageArray.length;
                updateLightboxImage();
            });

            // 5. Keyboard Navigation (Escape, Left, Right)
            document.addEventListener('keydown', (e) => {
                if (!lightbox.classList.contains('hidden')) {
                    if (e.key === 'Escape') closeLightbox();
                    if (e.key === 'ArrowLeft') lightboxPrev.click();
                    if (e.key === 'ArrowRight') lightboxNext.click();
                }
            });
        });
    </script>

    <!-- Footer -->
   @include('frontend.layouts.footer')