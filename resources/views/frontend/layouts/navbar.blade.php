 <!-- <nav class="bg-white border-b border-gray-200 hidden lg:block relative z-40">
        <div class="max-w-7xl mx-auto px-4 flex items-center justify-between h-[46px] gap-8 text-[14px] font-medium text-gray-700">

        <div class="flex items-center gap-8"> 
           {{-- ALL CATEGORIES MENU --}}
    <div class="relative group z-50">

        {{-- BUTTON --}}
        <button class="flex items-center gap-2 h-full font-bold hover:text-primary transition-colors">
            <i data-lucide="layout-grid" class="w-4 h-4"></i>
            All Categories
        </button>

        {{-- FULL WIDTH MEGA MENU DROPDOWN --}}
        <div class="absolute top-full left-0 hidden group-hover:block z-[9999] pt-2">
            
            {{-- FIX: Removed 'w-full' and used 'w-[1250px]' with a responsive 'max-w-[95vw]' --}}
            <div class="w-[1250px] max-w-[95vw] bg-white border border-gray-100 rounded-xl shadow-xl p-8">
                
                {{-- SCROLLABLE WRAPPER --}}
                <div class="max-h-[250px] md:max-h-[350px] lg:max-h-[450px] xl:max-h-[500px] overflow-y-auto pr-4 custom-scroll">
                    
                    {{-- Grid layout for all categories and their subcategories --}}
                    <div class="grid grid-cols-4 gap-x-8 gap-y-10">
                        
                        @php
                            $categories = \App\Models\Category::where('status', 1)->get(); 
                        @endphp

                        @forelse($categories as $category)
                            
                            {{-- CATEGORY COLUMN --}}
                            <div class="flex flex-col">
                                
                                {{-- MAIN CATEGORY NAME (Header) --}}
                                <a href="{{ route('categoryproducts', $category->id) }}" 
                                class="text-[15px] font-bold text-gray-900 mb-2 hover:text-primary transition-colors border-b border-gray-100 pb-2">
                                    {{ $category->category_name }}
                                </a>

                                {{-- SUB CATEGORIES LIST (Underneath Main Category) --}}
                                <div class="flex flex-col gap-1">
                                    
                                    <a href="#" class="text-[13px] text-gray-600 hover:text-primary transition-colors">Subcategory 1</a>
                                    <a href="#" class="text-[13px] text-gray-600 hover:text-primary transition-colors">Subcategory 2</a>
                                    <a href="#" class="text-[13px] text-gray-600 hover:text-primary transition-colors">Subcategory 3</a>
                                    <a href="#" class="text-[13px] text-gray-600 hover:text-primary transition-colors">Subcategory 4</a>
                                    
                                    {{-- View All Link --}}
                                    <a href="{{ route('categoryproducts', $category->id) }}" class="text-[12px] font-semibold text-primary mt-1 hover:underline">
                                        View All
                                    </a>
                                </div>
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
            <a href="{{ route('home') }}" class="hover:text-primary transition-colors h-full flex items-center">Home</a>
            <a href="{{ route('products') }}" class="hover:text-primary transition-colors h-full flex items-center">Products</a>
            <a href="{{ route('vendor.index') }}" class="hover:text-primary transition-colors h-full flex items-center">Sell on India Buy</a>
            <a href="{{ route('sevice_list') }}" class="hover:text-primary transition-colors h-full flex items-center">Services</a>
            <a href="{{ route('sevice_list') }}" class="hover:text-primary transition-colors h-full flex items-center">RFQ inbox</a>
  
        </div>

        <a href="#"
               class="hover:text-primary transition flex items-center gap-1.5 ">

                <i data-lucide="headset"
                   class="text-gray-400 w-4 h-4"></i>

                Help & Community
            </a>
            
        </div>  
        
    </nav> -->