@include('frontend.layouts.header-link')

<!-- 1. Top Bar -->
@include('frontend.layouts.top_bar')

<!-- 2. Main Header (Sticky) -->
@include('frontend.layouts.main_header')

@include('frontend.layouts.navbar')

<!-- Main Content -->
<div class="bg-slate-50 min-h-screen pb-16 pt-6">
    <div class="max-w-7xl mx-auto px-4">

        <!-- Breadcrumbs -->
        <nav class="flex items-center text-[13px] text-gray-500 mb-6 font-medium flex-wrap">
            {{-- HOME --}}
            <a href="{{ url('/') }}" class="hover:text-primary transition-colors flex items-center gap-1">
                <i data-lucide="home" class="w-3.5 h-3.5"></i>
                Home
            </a>

            {{-- CATEGORY --}}
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 mx-2 text-gray-400"></i>
            <a href="{{ route('categoryproducts', $category->id) }}" class="hover:text-primary transition-colors whitespace-nowrap">
                {{ $category->category_name ?? '' }}
            </a>

            {{-- SUB CATEGORY --}}
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 mx-2 text-gray-400"></i>
            <a href="{{ route('subcategoryproducts', $subcategory->id) }}" class="hover:text-primary transition-colors whitespace-nowrap">
                {{ $subcategory->sub_category_name ?? '' }}
            </a>

            {{-- PRODUCT --}}
            <i data-lucide="chevron-right" class="w-3.5 h-3.5 mx-2 text-gray-400"></i>
            <span class="text-gray-900 truncate max-w-[200px] sm:max-w-none">
                {{ $product->product_name }}
            </span>
        </nav>

        <!-- Product Summary Section -->
        <div class="bg-white rounded-3xl p-5 lg:p-8 grid grid-cols-1 lg:grid-cols-12 gap-8 border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.03)] mb-8">
            
            <!-- Left Side: Images Gallery -->
            <div class="lg:col-span-5 xl:col-span-4 flex flex-col gap-4">
                <div class="w-full aspect-square rounded-2xl border border-gray-100 bg-white flex items-center justify-center p-6 relative group overflow-hidden">
                    <img id="main-product-img" src="{{ asset('uploads/products/' . $productImages[0]) }}" alt="{{ $product->product_name }}" class="max-w-full max-h-full object-contain mix-blend-multiply transition-all duration-300 group-hover:scale-105">
                    
                    <button class="absolute top-4 right-4 w-10 h-10 bg-white/90 backdrop-blur hover:bg-red-50 rounded-full flex items-center justify-center text-gray-400 hover:text-red-500 transition-colors shadow-sm border border-gray-100">
                        <i data-lucide="heart" class="w-4 h-4"></i>
                    </button>
                    
                    <button id="open-lightbox-btn" class="absolute bottom-4 right-4 w-10 h-10 bg-white/90 backdrop-blur border border-gray-200 rounded-full flex items-center justify-center text-gray-600 hover:text-primary transition-all shadow-sm">
                        <i data-lucide="maximize-2" class="w-4 h-4"></i>
                    </button>
                </div>

                <div class="grid grid-cols-4 gap-3">
                    @foreach ($productImages as $index => $image)
                        <div class="gallery-thumb aspect-square rounded-xl {{ $index == 0 ? 'border-2 border-primary' : 'border border-gray-100' }} bg-white p-2 cursor-pointer flex items-center justify-center transition-all hover:border-primary/50" data-img="{{ asset('uploads/products/' . $image) }}">
                            <img src="{{ asset('uploads/products/' . $image) }}" class="max-w-full max-h-full object-contain mix-blend-multiply">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Image Lightbox Modal -->
            <div id="image-lightbox" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/95 p-4 opacity-0 transition-opacity duration-300 backdrop-blur-sm">
                <button id="close-lightbox" class="absolute top-6 right-6 lg:top-10 lg:right-10 text-white/70 hover:text-white transition-colors cursor-pointer z-20 bg-white/10 p-2 rounded-full hover:bg-white/20">
                    <i data-lucide="x" class="w-7 h-7"></i>
                </button>
                <button id="lightbox-prev" class="absolute left-4 sm:left-10 top-1/2 -translate-y-1/2 text-white/70 hover:text-white transition-colors cursor-pointer z-20 bg-white/10 p-3 rounded-full hover:bg-white/20">
                    <i data-lucide="chevron-left" class="w-7 h-7"></i>
                </button>
                <button id="lightbox-next" class="absolute right-4 sm:right-10 top-1/2 -translate-y-1/2 text-white/70 hover:text-white transition-colors cursor-pointer z-20 bg-white/10 p-3 rounded-full hover:bg-white/20">
                    <i data-lucide="chevron-right" class="w-7 h-7"></i>
                </button>
                <img id="lightbox-img" src="" alt="Enlarged Product" class="max-w-full max-h-[85vh] object-contain scale-95 transition-all duration-300 z-10 relative">
            </div>

            <!-- Right Side: Content Details -->
            <div class="lg:col-span-7 xl:col-span-8 flex flex-col justify-between">
                <div>
                    <h1 class="text-xl md:text-2xl xl:text-3xl font-bold text-gray-900 leading-snug mb-3">
                        {{ $product->product_name }}
                    </h1>

                    <p class="text-sm text-gray-600 leading-relaxed mb-6 max-w-3xl">
                        {{ $product->short_description }}
                    </p>

                    <!-- Key Spec Matrix Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-6">
                        @foreach ($keyValues as $item)
                            <div class="flex items-center justify-between text-sm bg-slate-50 px-4 py-3 rounded-xl border border-slate-100/80">
                                <span class="text-gray-500 font-medium">{{ $item['key'] ?? '' }}</span>
                                <span class="font-semibold text-gray-900">{{ $item['value'] ?? '' }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="w-full h-px bg-gray-100 mb-6"></div>

                    <!-- Vendor Info Row -->
                    <div class="flex items-center justify-between mb-6 bg-white border border-gray-100 p-4 rounded-2xl shadow-sm">
                        <div class="flex items-center gap-3.5">
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center font-bold text-lg border border-blue-100 shrink-0">
                                {{ strtoupper(substr($vendor->company_name ?? 'V', 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-gray-900 flex items-center gap-1.5 hover:text-primary cursor-pointer transition-colors">
                                    {{ $vendor->company_name ?? '' }} 
                                    <i data-lucide="shield-check" class="w-4 h-4 text-emerald-500 fill-emerald-50"></i>
                                </h3>
                                <div class="flex items-center gap-2 text-xs text-gray-500 mt-1">
                                    <span><i data-lucide="map-pin" class="w-3 h-3 inline mr-0.5"></i> {{ $vendor->city ?? '' }}, {{ $vendor->state ?? '' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CTA Actions Platform -->
                <div class="flex flex-col sm:flex-row justify-center items-center gap-3 pt-4 w-full">
                    <a href="{{ route('enquiry', $product->id) }}" target="_blank" class="w-full sm:w-auto min-w-[260px] bg-primary text-white hover:bg-primaryHover py-2 px-6 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-2 shadow-lg shadow-primary/10">
                        <i data-lucide="mail" class="w-4 h-4"></i>
                        Send Enquiry
                    </a>
                    {{-- <button id="open-chat-btn" class="w-full sm:w-auto min-w-[160px] bg-white border border-gray-200 text-gray-800 hover:bg-slate-50 py-2 px-6 rounded-xl text-sm font-bold transition-all flex items-center justify-center gap-2 shadow-sm">
                        <i data-lucide="message-circle" class="w-4 h-4 text-primary"></i> 
                        Chat with Supplier
                    </button> --}}
                </div>
            </div>
        </div>

        <!-- Sticky Secondary Navigation Tabs -->
        <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.03)] overflow-hidden mb-12">
            <div class="flex overflow-x-auto border-b border-gray-100 hide-scrollbar bg-gray-50/50 px-4">
                <button class="tab-btn px-6 py-4 text-sm font-bold text-primary border-b-2 border-primary whitespace-nowrap bg-white" data-target="details">Product Details</button>
                <button class="tab-btn px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-900 border-b-2 border-transparent transition-colors whitespace-nowrap" data-target="specs">Specifications</button>
                <button class="tab-btn px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-900 border-b-2 border-transparent transition-colors whitespace-nowrap" data-target="company">Company Profile</button>
                <button class="tab-btn px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-900 border-b-2 border-transparent transition-colors whitespace-nowrap" data-target="delivery">Data Sheet</button>
            </div>

            <div class="p-6 lg:p-8 min-h-[250px]">
                <!-- Tab Panel: Details -->
                <div id="tab-details" class="tab-panel block space-y-6">
                    <div>
                        <h3 class="text-base font-bold text-gray-900 mb-3">Product Overview</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">
                            {{ $product->product_details }}
                        </p>
                    </div>

                    <div>
                        <h3 class="text-base font-bold text-gray-900 mb-3">Key Features</h3>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100/80">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                                <div class="flex items-center justify-between border-b border-gray-200/60 pb-2 md:border-none md:pb-0">
                                    <strong class="text-gray-500 font-medium">Brand</strong>
                                    <span class="text-gray-900 font-semibold">{{ $product->brand }}</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <strong class="text-gray-500 font-medium">Model</strong>
                                    <span class="text-gray-900 font-semibold">{{ $product->model_number }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab Panel: Specifications -->
                <div id="tab-specs" class="tab-panel hidden">
                    <h3 class="text-base font-bold text-gray-900 mb-4">Technical Specifications</h3>
                    <div class="overflow-x-auto rounded-xl border border-gray-100">
                        <table class="w-full text-sm text-left">
                            <tbody class="divide-y divide-gray-100">
                                @foreach ($specifications as $spec)
                                    <tr class="{{ $loop->even ? 'bg-gray-50/50' : '' }}">
                                        <th class="px-6 py-3.5 font-medium text-gray-500 w-1/3 sm:w-1/4">
                                            {{ $spec['name'] ?? '' }}
                                        </th>
                                        <td class="px-6 py-3.5 text-gray-900 font-medium">
                                            {{ $spec['value'] ?? '' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tab Panel: Company Profile -->
                <div id="tab-company" class="tab-panel hidden space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 border-b border-gray-100 pb-5">
                        <div class="w-20 h-20 rounded-xl border border-gray-200 bg-white shadow-sm overflow-hidden flex items-center justify-center shrink-0">
                            @if ($vendor->company_logo)
                                <img src="{{ asset('uploads/vendor_logo/' . $vendor->company_logo) }}" alt="{{ $vendor->company_name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-100 text-xl font-bold text-primary">
                                    {{ strtoupper(substr($vendor->company_name ?? 'V', 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div>
                            <div class="flex items-center gap-2 flex-wrap">
                                <h1 class="text-xl font-bold text-gray-900">{{ $vendor->company_name }}</h1>
                                @if ($vendor->status == 1)
                                    <i data-lucide="shield-check" class="w-5 h-5 text-emerald-500 fill-emerald-50"></i>
                                @endif
                            </div>
                            <p class="text-xs text-gray-400 mt-1">Trusted Supplier & Verified Business</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 bg-slate-50 border border-slate-100/80 rounded-xl p-5 text-sm">
                        <div>
                            <div class="text-gray-400 font-medium text-xs mb-0.5">Established</div>
                            <div class="font-semibold text-gray-900">{{ $vendor->year_established ?? 'N/A' }}</div>
                        </div>
                        <div>
                            <div class="text-gray-400 font-medium text-xs mb-0.5">Email</div>
                            <div class="font-semibold text-gray-900 break-all">{{ $vendor->email ?? 'N/A' }}</div>
                        </div>
                        <div>
                            <div class="text-gray-400 font-medium text-xs mb-0.5">Address</div>
                            <div class="font-semibold text-gray-900 leading-relaxed">{{ $vendor->address ?? 'N/A' }}</div>
                        </div>
                        <div>
                            <div class="text-gray-400 font-medium text-xs mb-0.5">Location</div>
                            <div class="font-semibold text-gray-900">
                                {{ collect([$vendor->city, $vendor->state, $vendor->country])->filter()->implode(', ') ?: 'N/A' }}
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-base font-bold text-gray-900 mb-3">About Company</h3>
                        <div class="text-sm text-gray-600 leading-relaxed bg-white border border-gray-100 p-5 rounded-xl">
                            {{ $vendor->about_us ?? 'No company details available.' }}
                        </div>
                    </div>

                    <div class="flex justify-center pt-2">
                        <a href="{{ route('vendor.details', $vendor->id) }}" class="px-5 py-2.5 rounded-xl bg-primary text-white font-semibold hover:bg-primaryHover transition-all shadow-md shadow-primary/10 text-sm">
                            Show More Details
                        </a>
                    </div>
                </div>

                <!-- Tab Panel: Data Sheet -->
                <div id="tab-delivery" class="tab-panel hidden space-y-4">
                    <div>
                        <h3 class="text-base font-bold text-gray-900 mb-1">Data Sheets & Documents</h3>
                        <p class="text-xs text-gray-500">Download technical specifications, user manuals, and compliance certificates.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        @foreach ($datasheets as $sheet)
                            <a href="{{ asset('uploads/datasheets/' . $sheet) }}" target="_blank" class="bg-white border border-gray-100 rounded-xl p-4 flex items-center gap-4 hover:border-primary/30 hover:shadow-sm transition-all group">
                                <div class="w-10 h-10 rounded-lg bg-red-50 text-red-500 flex items-center justify-center shrink-0">
                                    <i data-lucide="file-text" class="w-5 h-5"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-bold text-gray-900 truncate group-hover:text-primary transition-colors">
                                        {{ $sheet }}
                                    </h4>
                                </div>
                                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center text-gray-400 group-hover:bg-primary/5 group-hover:text-primary transition-colors">
                                    <i data-lucide="download" class="w-3.5 h-3.5"></i>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Supplier Chat Widget Platform -->
<div id="supplier-chat-widget" class="fixed bottom-0 right-4 sm:right-8 w-[calc(100%-2rem)] sm:w-[420px] bg-white rounded-t-2xl border border-gray-200 shadow-[0_-10px_40px_rgba(0,0,0,0.08)] z-50 transform translate-y-[120%] transition-transform duration-300 ease-out flex flex-col opacity-0">
    <!-- Chat Header -->
    <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between bg-white rounded-t-2xl">
        <div class="flex items-center gap-3">
            <div class="relative">
                <div class="w-9 h-9 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center font-bold text-sm border border-blue-100">
                    {{ strtoupper(substr($vendor->company_name ?? 'V', 0, 1)) }}
                </div>
                <div class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-emerald-500 border-2 border-white rounded-full"></div>
            </div>
            <div>
                <h4 class="text-sm font-bold text-gray-900 leading-none mb-1 truncate max-w-[200px]">{{ $vendor->company_name ?? 'Supplier' }}</h4>
                <span class="text-[11px] text-emerald-600 font-medium flex items-center gap-1">Online</span>
            </div>
        </div>
        <div class="flex items-center gap-1 text-gray-400">
            <button id="close-chat-btn" class="p-1.5 hover:bg-red-50 hover:text-red-500 rounded-md transition-colors">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
    </div>

    <!-- Chat Body -->
    <div class="p-4 bg-slate-50 h-[300px] overflow-y-auto flex flex-col gap-3">
        <div class="flex items-center justify-center">
            <span class="bg-emerald-50 text-emerald-700 border border-emerald-100 text-[10px] font-medium px-3 py-1.5 rounded-full flex items-center gap-1 text-center">
                <i data-lucide="shield-check" class="w-3.5 h-3.5 shrink-0"></i> Communicate securely inside the platform.
            </span>
        </div>

        <div class="bg-white border border-gray-200/80 rounded-xl p-3 flex gap-3 shadow-sm mt-1">
            <img src="{{ asset('uploads/products/' . $productImages[0]) }}" alt="Product" class="w-14 h-14 object-contain bg-slate-50 rounded-lg p-1 border border-gray-100 shrink-0">
            <div class="flex-1 flex flex-col justify-center">
                <h5 class="text-xs font-bold text-gray-900 line-clamp-2 leading-snug">{{ $product->product_name }}</h5>
                <p class="text-[11px] text-gray-500 mt-0.5">Ref: {{ $product->model_number ?? 'Inquiry' }}</p>
            </div>
        </div>
    </div>

    <!-- Chat Input Area -->
    <div class="p-3 bg-white border-t border-gray-100 flex items-center gap-2">
        <textarea rows="1" placeholder="Type a message..." class="flex-1 max-h-20 bg-slate-50 border border-gray-200 rounded-xl px-3 py-2 text-xs text-gray-700 focus:outline-none focus:border-primary focus:bg-white transition-all resize-none"></textarea>
        <button class="w-9 h-9 shrink-0 bg-primary text-white rounded-xl flex items-center justify-center hover:bg-primaryHover transition-colors shadow-sm">
            <i data-lucide="send" class="w-3.5 h-3.5 ml-0.5"></i>
        </button>
    </div>
</div>

<!-- Scripts Module Operations -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // =========================================
        // 1. CHAT WIDGET CONTROL LOGIC
        // =========================================
        const openChatBtn = document.getElementById('open-chat-btn');
        const closeChatBtn = document.getElementById('close-chat-btn');
        const chatWidget = document.getElementById('supplier-chat-widget');

        if(openChatBtn && chatWidget) {
            openChatBtn.addEventListener('click', (e) => {
                e.preventDefault();
                chatWidget.classList.remove('hidden', 'opacity-0', 'translate-y-[120%]');
                chatWidget.classList.add('opacity-100', 'translate-y-0');
            });
        }

        if(closeChatBtn && chatWidget) {
            closeChatBtn.addEventListener('click', () => {
                chatWidget.classList.remove('opacity-100', 'translate-y-0');
                chatWidget.classList.add('opacity-0', 'translate-y-[120%]');
            });
        }

        // =========================================
        // 2. IMAGE GALLERY & LIGHTBOX CONTROL
        // =========================================
        const mainImg = document.getElementById('main-product-img');
        const thumbnails = document.querySelectorAll('.gallery-thumb[data-img]');
        const openLightboxBtn = document.getElementById('open-lightbox-btn');
        const lightbox = document.getElementById('image-lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        const closeLightboxBtn = document.getElementById('close-lightbox');
        const lightboxPrev = document.getElementById('lightbox-prev');
        const lightboxNext = document.getElementById('lightbox-next');

        const imageArray = Array.from(thumbnails).map(thumb => thumb.getAttribute('data-img'));
        let currentIndex = 0;

        thumbnails.forEach((thumb, index) => {
            thumb.addEventListener('click', function() {
                currentIndex = index;
                const newSrc = this.getAttribute('data-img');

                if(mainImg) {
                    mainImg.style.opacity = '0';
                    setTimeout(() => {
                        mainImg.src = newSrc;
                        mainImg.style.opacity = '1';
                    }, 150);
                }

                thumbnails.forEach(t => t.classList.remove('border-primary', 'border-2'));
                thumbnails.forEach(t => t.classList.add('border-gray-100', 'border'));
                this.classList.remove('border-gray-100', 'border');
                this.classList.add('border-primary', 'border-2');
            });
        });

        if(openLightboxBtn && lightbox && lightboxImg) {
            openLightboxBtn.addEventListener('click', () => {
                if(imageArray.length > 0) {
                    lightboxImg.src = imageArray[currentIndex];
                    lightbox.classList.remove('hidden');
                    lightbox.classList.add('flex');
                    setTimeout(() => {
                        lightbox.classList.remove('opacity-0');
                        lightboxImg.classList.remove('scale-95');
                        lightboxImg.classList.add('scale-100');
                    }, 10);
                }
            });
        }

        const closeLightbox = () => {
            if(lightbox && lightboxImg) {
                lightbox.classList.add('opacity-0');
                lightboxImg.classList.remove('scale-100');
                lightboxImg.classList.add('scale-95');
                setTimeout(() => {
                    lightbox.classList.add('hidden');
                    lightbox.classList.remove('flex');
                }, 200);
            }
        };

        if(closeLightboxBtn) closeLightboxBtn.addEventListener('click', closeLightbox);
        if(lightbox) {
            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) closeLightbox();
            });
        }

        const updateLightboxImage = () => {
            if(lightboxImg) {
                lightboxImg.style.opacity = '0';
                setTimeout(() => {
                    lightboxImg.src = imageArray[currentIndex];
                    lightboxImg.style.opacity = '1';
                }, 150);
            }
        };

        if(lightboxPrev) {
            lightboxPrev.addEventListener('click', (e) => {
                e.stopPropagation();
                currentIndex = (currentIndex - 1 + imageArray.length) % imageArray.length;
                updateLightboxImage();
            });
        }

        if(lightboxNext) {
            lightboxNext.addEventListener('click', (e) => {
                e.stopPropagation();
                currentIndex = (currentIndex + 1) % imageArray.length;
                updateLightboxImage();
            });
        }

        document.addEventListener('keydown', (e) => {
            if (lightbox && !lightbox.classList.contains('hidden')) {
                if (e.key === 'Escape') closeLightbox();
                if (e.key === 'ArrowLeft' && lightboxPrev) lightboxPrev.click();
                if (e.key === 'ArrowRight' && lightboxNext) lightboxNext.click();
            }
        });

        // =========================================
        // 3. TAB CONTROLLER COMPONENT
        // =========================================
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabPanels = document.querySelectorAll('.tab-panel');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                tabBtns.forEach(b => {
                    b.className = "tab-btn px-6 py-4 text-sm font-medium text-gray-500 hover:text-gray-900 border-b-2 border-transparent transition-colors whitespace-nowrap";
                });
                btn.className = "tab-btn px-6 py-4 text-sm font-bold text-primary border-b-2 border-primary whitespace-nowrap bg-white";

                tabPanels.forEach(panel => {
                    panel.classList.remove('block');
                    panel.classList.add('hidden');
                });

                const targetPanel = document.getElementById('tab-' + btn.getAttribute('data-target'));
                if (targetPanel) {
                    targetPanel.classList.remove('hidden');
                    targetPanel.classList.add('block');
                }
            });
        });
    });
</script>

@include('frontend.layouts.footer')