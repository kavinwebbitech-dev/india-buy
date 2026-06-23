@include('frontend.layouts.header-link')


    <!-- 1. Top Bar -->
    @include('frontend.layouts.top_bar')


    <!-- 2. Main Header (Sticky) -->
    @include('frontend.layouts.main_header')



    @include('frontend.layouts.navbar')

    <div class="bg-slate-50 min-h-screen pb-16">

        {{-- COMPANY COVER --}}
        <section class="max-w-7xl mx-auto px-4 pt-6">

            <div class="bg-white rounded-3xl overflow-hidden shadow-sm">

                {{-- Cover Image --}}
                <div class="h-72 relative">
                    <img src="{{ asset('uploads/vendor/banner/' . ($vendor->banner ?? 'default-banner.jpg')) }}"
                        class="w-full h-full object-cover">

                    <div class="absolute inset-0 bg-black/30"></div>
                </div>

                {{-- Company Profile --}}
                <div class="relative px-8 pb-8">

                    <div
                        class="w-32 h-32 bg-white rounded-3xl shadow-lg absolute -top-16 left-8 overflow-hidden border-4 border-white">

                        <img src="{{ asset('uploads/vendor_logo/' . ($vendor->company_logo ?? 'default.png')) }}"
                            class="w-full h-full object-cover">

                    </div>

                    <div class="pt-20 flex justify-between flex-wrap gap-4">

                        <div>

                            <h1 class="text-3xl font-bold">
                                {{ $vendor->company_name }}
                            </h1>

                            <p class="text-gray-500 mt-2">
                                {{ $vendor->city }},
                                {{ $vendor->state }}
                            </p>

                        </div>

                        <div class="flex gap-3">

                            <button
                                class="px-6 py-3 rounded-xl border border-primary text-primary font-semibold hover:bg-primary/5">
                                Chat Now
                            </button>

                            <a href="{{ route('serviceenquiry', $service->id) }}"
                                class="px-6 py-3 rounded-xl bg-primary text-white font-semibold">
                                Send Enquiry
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </section>


        <section class="max-w-7xl mx-auto px-4 mt-8">

            <div class="bg-white rounded-3xl p-8">

                <div class="flex items-center justify-between mb-4"> 
                    <h2 class="text-3xl font-bold text-gray-900">
                    {{ $service->service_name }}
                    </h2>
                    <span class="px-4 py-2 bg-green-100 text-green-700 rounded-full text-sm font-semibold">
                        Active Service
                    </span>
                </div> 

                <p class="text-gray-500 mb-8">
                    {{ $service->short_description }}
                </p>  

                <div class="grid lg:grid-cols-2 gap-10">

                    {{-- IMAGE --}}
                    <div>
                        <img src="{{ asset('uploads/service/images/' . $service->service_img) }}"
                            class="w-full rounded-2xl border border-gray-200 shadow-sm">
                    </div>

                    {{-- DETAILS --}}
                    <div>

                        <div class="grid md:grid-cols-2 gap-4">

                            {{-- SERVICE NAME --}}
                            <div class="bg-slate-50 rounded-xl p-4">
                                <p class="text-xs text-gray-500 uppercase">
                                    Service Name
                                </p>
                                <p class="font-semibold text-gray-900 mt-1">
                                    {{ $service->service_name }}
                                </p>
                            </div>

                            {{-- PRICE TYPE --}}
                            <div class="bg-slate-50 rounded-xl p-4">
                                <p class="text-xs text-gray-500 uppercase">
                                    Price Type
                                </p>
                                <p class="font-semibold text-gray-900 mt-1">
                                    {{ ucfirst($service->price_type) }}
                                </p>
                            </div>

                            {{-- PRICE --}}
                            <div class="bg-slate-50 rounded-xl p-4">
                                <p class="text-xs text-gray-500 uppercase">
                                    Price
                                </p>
                                <p class="font-semibold text-green-600 mt-1">
                                    ₹ {{ number_format($service->price ?? 0) }}
                                </p>
                            </div>

                            {{-- BUSINESS TYPE --}}
                            <div class="bg-slate-50 rounded-xl p-4">
                                <p class="text-xs text-gray-500 uppercase">
                                    Business Type
                                </p>
                                <p class="font-semibold text-gray-900 mt-1">
                                    {{ $service->businessType->business_name ?? 'N/A' }}
                                </p>
                            </div>

                            {{-- CATEGORY --}}
                            <div class="bg-slate-50 rounded-xl p-4">
                                <p class="text-xs text-gray-500 uppercase">
                                    Category
                                </p>
                                <p class="font-semibold text-gray-900 mt-1">
                                    {{ $service->categoryData->category_name ?? 'N/A' }}
                                </p>
                            </div>

                            {{-- SUB CATEGORY --}}
                            <div class="bg-slate-50 rounded-xl p-4">
                                <p class="text-xs text-gray-500 uppercase">
                                    Sub Category
                                </p>
                                <p class="font-semibold text-gray-900 mt-1">
                                    {{ $service->subCategoryData->sub_category_name ?? 'N/A' }}
                                </p>
                            </div>

                            {{-- LOCATION --}}
                            <div class="bg-slate-50 rounded-xl p-4">
                                <p class="text-xs text-gray-500 uppercase">
                                    Location
                                </p>
                                <p class="font-semibold text-gray-900 mt-1">
                                    {{ $service->service_city }},
                                    {{ $service->service_state }}
                                </p>
                            </div>

                            {{-- AVAILABLE DAYS --}}
                            <div class="bg-slate-50 rounded-xl p-4">
                                <p class="text-xs text-gray-500 uppercase">
                                    Available Days
                                </p>
                                <p class="font-semibold text-gray-900 mt-1">

                                    @php
                                        $days = json_decode($service->available_days, true);
                                    @endphp

                                    @if (is_array($days))
                                        {{ implode(', ', $days) }}
                                    @else
                                        {{ $service->available_days }}
                                    @endif

                                </p>
                            </div>

                            {{-- WORKING HOURS --}}
                            <div class="bg-slate-50 rounded-xl p-4">
                                <p class="text-xs text-gray-500 uppercase">
                                    Working Hours
                                </p>
                                <p class="font-semibold text-gray-900 mt-1">

                                    @if ($service->opening_time && $service->closing_time)
                                        {{ \Carbon\Carbon::parse($service->opening_time)->format('h:i A') }}
                                        -
                                        {{ \Carbon\Carbon::parse($service->closing_time)->format('h:i A') }}
                                    @else
                                        N/A
                                    @endif

                                </p>
                            </div>

                            {{-- STATUS --}}
                            <div class="bg-slate-50 rounded-xl p-4">
                                <p class="text-xs text-gray-500 uppercase">
                                    Status
                                </p>
                                <p class="font-semibold mt-1">

                                    @if ($service->status == 1)
                                        <span class="text-green-600">Active</span>
                                    @else
                                        <span class="text-red-600">Inactive</span>
                                    @endif

                                </p>
                            </div>

                        </div>

                        {{-- DATASHEET --}}
                        @if ($service->datasheet)
                            <div class="mt-6">

                                <a href="{{ asset('uploads/service/datasheets/' . $service->datasheet) }}"
                                    target="_blank"
                                    class="inline-flex items-center gap-2 px-5 py-3 bg-primary text-white rounded-xl font-medium">

                                    <i data-lucide="file-text" class="w-4 h-4"></i>

                                    Download Datasheet

                                </a>

                            </div>
                        @endif

                    </div>

                </div>

                {{-- LONG DESCRIPTION --}}
                <div class="mt-10 border-t pt-8">

                    <h3 class="text-xl font-bold mb-4">
                        Service Description
                    </h3>

                    <div class="text-gray-600 leading-8">
                        {!! nl2br(e($service->long_description)) !!}
                    </div>

                </div>

                {{-- FEATURES --}}
                @if (!empty($features))
                    <div class="mt-10 border-t pt-8">

                        <h3 class="text-xl font-bold mb-6">
                            Service Features
                        </h3>

                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">

                            @foreach ($features as $feature)
                                <div class="border border-gray-200 rounded-xl p-4 hover:shadow-sm transition">

                                    <h4 class="font-semibold text-gray-900 mb-2">
                                        {{ $feature['key'] ?? '' }}
                                    </h4>

                                    <p class="text-gray-600 text-sm">
                                        {{ $feature['value'] ?? '' }}
                                    </p>

                                </div>
                            @endforeach

                        </div>

                    </div>
                @endif

            </div>
            <!-- Chat -->
            <div id="supplier-chat-widget"
                class="fixed bottom-0 right-4 sm:right-8 w-[calc(100%-2rem)] sm:w-[580px] bg-white rounded-t-2xl border border-gray-200 shadow-[0_-10px_40px_rgba(0,0,0,0.1)] z-50 transform translate-y-[120%] transition-transform duration-300 ease-out flex flex-col opacity-0">

                <div
                    class="px-4 py-3 border-b border-gray-100 flex items-center justify-between bg-white rounded-t-2xl cursor-pointer">
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
                            <h4 class="text-[14px] font-bold text-gray-900 leading-none mb-1">Mumbai Industrial Tech
                            </h4>
                            <span class="text-[11px] text-emerald-600 font-medium flex items-center gap-1">Online <span
                                    class="text-gray-400">• Local Time 16:03</span></span>
                        </div>
                    </div>
                    <div class="flex items-center gap-1 text-gray-400">
                        <button class="p-1.5 hover:bg-gray-50 hover:text-gray-600 rounded-md transition-colors"
                            title="Expand"><i data-lucide="maximize-2" class="w-4 h-4"></i></button>
                        <button id="close-chat-btn"
                            class="p-1.5 hover:bg-red-50 hover:text-red-500 rounded-md transition-colors"
                            title="Close"><i data-lucide="x" class="w-5 h-5"></i></button>
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
                            <h5 class="text-[12px] font-bold text-gray-900 line-clamp-2 leading-snug">Automatic
                                High-Speed
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
                document.addEventListener('DOMContentLoaded', function() {

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
        </section>

        {{-- GALLERY --}}
        <section class="max-w-7xl mx-auto px-4 mt-8">

            <div class="bg-white rounded-3xl p-8">

                <h2 class="text-2xl font-bold mb-6">
                    Service Gallery
                </h2>

                <div class="grid md:grid-cols-4 gap-4">

                    @foreach ($serviceImages as $image)
                        <div class="overflow-hidden rounded-2xl border">

                            <img src="{{ asset('uploads/service/images/' . $image) }}"
                                class="w-full h-56 object-cover hover:scale-105 transition duration-300">

                        </div>
                    @endforeach

                </div>

            </div>

        </section>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // =========================================
            // 1. IMAGE GALLERY FUNCTIONALITY
            // =========================================
            const mainImg = document.getElementById('main-product-img');
            const thumbnails = document.querySelectorAll('.gallery-thumb');

            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', function() {
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
                        b.className =
                            "tab-btn px-8 py-4 text-[15px] font-medium text-gray-500 hover:text-gray-900 border-b-2 border-transparent transition-colors whitespace-nowrap";
                    });

                    // 2. Apply active style to clicked button
                    btn.className =
                        "tab-btn px-8 py-4 text-[15px] font-bold text-primary border-b-2 border-primary whitespace-nowrap bg-white";

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
        document.addEventListener('DOMContentLoaded', function() {

            // =========================================
            // IMAGE GALLERY & LIGHTBOX FUNCTIONALITY
            // =========================================
            const mainImg = document.getElementById('main-product-img');
            const thumbnails = document.querySelectorAll(
                '.gallery-thumb[data-img]'); // Only target thumbs with images
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
                thumb.addEventListener('click', function() {
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
