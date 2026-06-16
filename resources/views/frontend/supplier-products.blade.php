@include('frontend.layouts.header-link')


    @include('frontend.layouts.top_bar')

    @include('frontend.layouts.main_header')

    @include('frontend.layouts.navbar')

    <div class="max-w-full mx-auto px-2 py-8">
        <div class="flex flex-col lg:flex-row gap-8 items-start">

            <aside class="w-full lg:w-[280px] shrink-0 sticky top-32 z-10">
                <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-6">
                    
                    <div class="flex items-center justify-between border-b border-gray-100 pb-4 mb-5">
                        <h3 class="text-[16px] font-bold text-gray-900 flex items-center gap-2">
                            <i data-lucide="sliders-horizontal" class="w-4 h-4 text-primary"></i> Filters
                        </h3>
                        <button class="text-[12px] font-bold text-gray-400 hover:text-primary transition-colors">Clear All</button>
                    </div>

                    <div class="mb-6">
                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Supplier Name</label>
                        <div class="relative">
                            <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                            <input type="text" placeholder="Search by name..." class="w-full h-10 pl-9 pr-3 bg-slate-50 border border-gray-200 rounded-xl text-[13px] focus:outline-none focus:border-primary focus:bg-white transition-colors">
                        </div>
                    </div>

                    <div class="mb-6">
                        <label class="block text-[13px] font-bold text-gray-700 mb-3">Supplier Location</label>
                        <div class="space-y-3 max-h-48 overflow-y-auto pr-2">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary accent-primary">
                                <span class="text-[13px] text-gray-600 group-hover:text-gray-900 transition-colors">Coimbatore</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary accent-primary">
                                <span class="text-[13px] text-gray-600 group-hover:text-gray-900 transition-colors">Theni</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary accent-primary">
                                <span class="text-[13px] text-gray-600 group-hover:text-gray-900 transition-colors">Chennai</span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-8">
                        <label class="block text-[13px] font-bold text-gray-700 mb-3">Business Type</label>
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary accent-primary">
                                <span class="text-[13px] text-gray-600 group-hover:text-gray-900 transition-colors">Manufacturer</span>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="checkbox" checked class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary accent-primary">
                                <span class="text-[13px] text-gray-600 group-hover:text-gray-900 transition-colors">Service Provider</span>
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 pt-4 border-t border-gray-100">
                        <button class="bg-primary text-white hover:bg-primaryHover py-2.5 rounded-xl text-[13px] font-bold transition-all shadow-md shadow-primary/20">Apply</button>
                        <button class="bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 py-2.5 rounded-xl text-[13px] font-bold transition-colors">Reset</button>
                    </div>

                </div>
            </aside>

            <main class="flex-1 w-full min-w-0">
                
                <div class="bg-white rounded-2xl border border-gray-100 shadow-[0_2px_10px_rgb(0,0,0,0.02)] p-4 md:p-5 mb-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <h1 class="text-[18px] font-bold text-gray-900">
                        Suppliers <span class="text-gray-400 font-normal text-[15px] ml-1">(5 Results)</span>
                    </h1> 
                </div>

                <div class="space-y-6">

                    <div class="bg-white rounded-3xl border border-gray-100 p-6 hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] transition-all duration-300">
                        
                        <div class="flex flex-col md:flex-row justify-between items-start gap-5 border-b border-gray-50 pb-5 mb-5">
                            <div class="flex items-center gap-5">
                                <div class="w-16 h-16 rounded-full border border-gray-100 bg-white shadow-sm overflow-hidden shrink-0">
                                    <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-4.0.3&auto=format&fit=crop&w=256&q=80" alt="Supplier" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h3 class="text-[18px] font-bold text-gray-900 mb-1 flex items-center gap-1.5 leading-tight">
                                        Apex Digital Solutions <i data-lucide="badge-check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                                    </h3>
                                    <div class="flex flex-wrap items-center gap-3 text-[13px] text-gray-500 mb-2.5">
                                        <span class="flex items-center gap-1"><i data-lucide="map-pin" class="w-3.5 h-3.5 text-gray-400"></i> Coimbatore, IN</span>
                                        <span class="flex items-center gap-1"><i data-lucide="clock" class="w-3.5 h-3.5 text-gray-400"></i> ≤ 2h Response</span>
                                    </div>
                                    <div class="flex flex-wrap gap-1.5">
                                        <span class="bg-amber-50 text-amber-600 px-2.5 py-1 rounded-md text-[11px] font-bold border border-amber-100">Service Provider</span>
                                        <span class="bg-blue-50 text-blue-600 px-2.5 py-1 rounded-md text-[11px] font-bold border border-blue-100">IT Solutions</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex md:flex-col gap-2.5 w-full md:w-auto shrink-0">
                                <button class="flex-1 md:w-40 py-2.5 bg-primary text-white hover:bg-primaryHover rounded-xl text-[13px] font-bold transition-colors shadow-sm shadow-primary/20 flex items-center justify-center gap-2">
                                    <i data-lucide="mail" class="w-4 h-4"></i> Send Enquiry
                                </button>
                                <button class="flex-1 md:w-40 py-2.5 bg-slate-50 border border-gray-200 text-gray-700 hover:text-primary hover:border-primary hover:bg-primary/5 rounded-xl text-[13px] font-bold transition-colors flex items-center justify-center gap-2">
                                    <i data-lucide="message-circle" class="w-4 h-4"></i> Chat Now
                                </button>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-[13px] font-bold text-gray-900 mb-3 flex items-center gap-2">
                                <i data-lucide="package" class="w-4 h-4 text-gray-400"></i> Featured Products
                            </h4>
                            
                            <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-4">
                                
                                <a href="#" class="group relative rounded-xl border border-gray-100 overflow-hidden bg-white p-2">
                                    <img src="https://pngimg.com/uploads/robot/robot_PNG98.png" alt="Product" class="max-h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-500">
                                    <div class="bottom-0 left-0 right-0 bg-white/95 backdrop-blur px-3 py-2 text-[12px] font-bold text-gray-900 truncate border-t border-gray-100">SEO Services</div>
                                </a>

                                 <a href="#" class="group relative rounded-xl border border-gray-100 overflow-hidden bg-white p-2">
                                    <img src="https://pngimg.com/uploads/robot/robot_PNG98.png" alt="Product" class="max-h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-500">
                                    <div class="bottom-0 left-0 right-0 bg-white/95 backdrop-blur px-3 py-2 text-[12px] font-bold text-gray-900 truncate border-t border-gray-100">SEO Services</div>
                                </a>

                                 <a href="#" class="group relative rounded-xl border border-gray-100 overflow-hidden bg-white p-2">
                                    <img src="https://pngimg.com/uploads/robot/robot_PNG98.png" alt="Product" class="max-h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-500">
                                    <div class="bottom-0 left-0 right-0 bg-white/95 backdrop-blur px-3 py-2 text-[12px] font-bold text-gray-900 truncate border-t border-gray-100">SEO Services</div>
                                </a>

                                 <a href="#" class="group relative rounded-xl border border-gray-100 overflow-hidden bg-white p-2">
                                    <img src="https://pngimg.com/uploads/robot/robot_PNG98.png" alt="Product" class="max-h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-500">
                                    <div class="bottom-0 left-0 right-0 bg-white/95 backdrop-blur px-3 py-2 text-[12px] font-bold text-gray-900 truncate border-t border-gray-100">SEO Services</div>
                                </a>

                                <div class="rounded-xl border-2 border-dashed border-gray-200 bg-slate-50/50 flex flex-col items-center justify-center p-3 sm:p-4 gap-2.5 text-center hover:border-primary transition-colors">
                                    <span class="text-[12px] font-bold text-gray-500 mb-1">+12 More Items</span>
                                    <a href="#" class="w-full py-2 bg-white border border-gray-200 hover:border-primary hover:text-primary rounded-lg text-[12px] font-bold text-gray-700 transition-colors flex items-center justify-center gap-1.5 shadow-sm">
                                        <i data-lucide="layout-grid" class="w-3.5 h-3.5"></i> All Products
                                    </a>
                                    <a href="#" class="w-full py-2 bg-red-50 text-primary hover:bg-primary hover:text-white rounded-lg text-[12px] font-bold transition-colors flex items-center justify-center gap-1.5">
                                        <i data-lucide="building-2" class="w-3.5 h-3.5"></i> View Profile
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl border border-gray-100 p-6 hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] transition-all duration-300">
                        
                        <div class="flex flex-col md:flex-row justify-between items-start gap-5 border-b border-gray-50 pb-5 mb-5">
                            <div class="flex items-center gap-5">
                                <div class="w-16 h-16 rounded-full border border-gray-100 bg-white shadow-sm overflow-hidden shrink-0">
                                    <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?ixlib=rb-4.0.3&auto=format&fit=crop&w=256&q=80" alt="Supplier" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <h3 class="text-[18px] font-bold text-gray-900 mb-1 flex items-center gap-1.5 leading-tight">
                                        Global Tech Inc. <i data-lucide="badge-check" class="w-4 h-4 text-emerald-500 shrink-0"></i>
                                    </h3>
                                    <div class="flex flex-wrap items-center gap-3 text-[13px] text-gray-500 mb-2.5">
                                        <span class="flex items-center gap-1"><i data-lucide="map-pin" class="w-3.5 h-3.5 text-gray-400"></i> Theni, IN</span>
                                        <span class="flex items-center gap-1"><i data-lucide="star" class="w-3.5 h-3.5 text-amber-400 fill-current"></i> 4.8 Rating</span>
                                    </div>
                                    <div class="flex flex-wrap gap-1.5">
                                        <span class="bg-emerald-50 text-emerald-600 px-2.5 py-1 rounded-md text-[11px] font-bold border border-emerald-100">Manufacturer</span>
                                        <span class="bg-slate-100 text-gray-600 px-2.5 py-1 rounded-md text-[11px] font-bold border border-gray-200">Machinery</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex md:flex-col gap-2.5 w-full md:w-auto shrink-0">
                                <button class="flex-1 md:w-40 py-2.5 bg-primary text-white hover:bg-primaryHover rounded-xl text-[13px] font-bold transition-colors shadow-sm shadow-primary/20 flex items-center justify-center gap-2">
                                    <i data-lucide="mail" class="w-4 h-4"></i> Send Enquiry
                                </button>
                                <button class="flex-1 md:w-40 py-2.5 bg-slate-50 border border-gray-200 text-gray-700 hover:text-primary hover:border-primary hover:bg-primary/5 rounded-xl text-[13px] font-bold transition-colors flex items-center justify-center gap-2">
                                    <i data-lucide="message-circle" class="w-4 h-4"></i> Chat Now
                                </button>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-[13px] font-bold text-gray-900 mb-3 flex items-center gap-2">
                                <i data-lucide="package" class="w-4 h-4 text-gray-400"></i> Featured Products
                            </h4>
                            <div class="grid grid-cols-2 sm:grid-cols-3 xl:grid-cols-5 gap-4">
                                <a href="#" class="group relative rounded-xl border border-gray-100 overflow-hidden bg-white p-2">
                                    <img src="https://pngimg.com/uploads/robot/robot_PNG98.png" alt="Product" class="max-h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-500">
                                    <div class="bottom-0 left-0 right-0 bg-white/95 backdrop-blur px-3 py-2 text-[12px] font-bold text-gray-900 truncate border-t border-gray-100">SEO Services</div>
                                </a>
                               <a href="#" class="group relative rounded-xl border border-gray-100 overflow-hidden bg-white p-2">
                                    <img src="https://pngimg.com/uploads/robot/robot_PNG98.png" alt="Product" class="max-h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-500">
                                    <div class="bottom-0 left-0 right-0 bg-white/95 backdrop-blur px-3 py-2 text-[12px] font-bold text-gray-900 truncate border-t border-gray-100">SEO Services</div>
                                </a>
                                 <a href="#" class="group relative rounded-xl border border-gray-100 overflow-hidden bg-white p-2">
                                    <img src="https://pngimg.com/uploads/robot/robot_PNG98.png" alt="Product" class="max-h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-500">
                                    <div class="bottom-0 left-0 right-0 bg-white/95 backdrop-blur px-3 py-2 text-[12px] font-bold text-gray-900 truncate border-t border-gray-100">SEO Services</div>
                                </a>
                                 <a href="#" class="group relative rounded-xl border border-gray-100 overflow-hidden bg-white p-2">
                                    <img src="https://pngimg.com/uploads/robot/robot_PNG98.png" alt="Product" class="max-h-full object-contain mix-blend-multiply group-hover:scale-105 transition-transform duration-500">
                                    <div class="bottom-0 left-0 right-0 bg-white/95 backdrop-blur px-3 py-2 text-[12px] font-bold text-gray-900 truncate border-t border-gray-100">SEO Services</div>
                                </a>

                                <div class="rounded-xl border-2 border-dashed border-gray-200 bg-slate-50/50 flex flex-col items-center justify-center p-3 sm:p-4 gap-2.5 text-center hover:border-primary transition-colors">
                                    <span class="text-[12px] font-bold text-gray-500 mb-1">+45 More Items</span>
                                    <a href="#" class="w-full py-2 bg-white border border-gray-200 hover:border-primary hover:text-primary rounded-lg text-[12px] font-bold text-gray-700 transition-colors flex items-center justify-center gap-1.5 shadow-sm">
                                        <i data-lucide="layout-grid" class="w-3.5 h-3.5"></i> All Products
                                    </a>
                                    <a href="#" class="w-full py-2 bg-red-50 text-primary hover:bg-primary hover:text-white rounded-lg text-[12px] font-bold transition-colors flex items-center justify-center gap-1.5">
                                        <i data-lucide="building-2" class="w-3.5 h-3.5"></i> View Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> 

            </main>
        </div>
    </div>
 
    @include('frontend.layouts.footer')

    <script>
        // Initialize Icons
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof lucide !== 'undefined') {
                lucide.createIcons();
            }
        });
    </script>
