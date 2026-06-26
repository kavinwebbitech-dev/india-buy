@include('frontend.layouts.header-link')
@include('frontend.layouts.top_bar')
@include('frontend.layouts.main_header')
@include('frontend.layouts.navbar')

<div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 py-10 bg-[#f8fafc]">

    {{-- Breadcrumb Navigation --}}
    <nav class="flex items-center text-[13px] text-slate-500 mb-8 font-medium flex-wrap gap-y-2 px-1">
        <a href="{{ url('/') }}" class="hover:text-primary transition-colors flex items-center gap-1">
            <i data-lucide="home" class="w-3.5 h-3.5"></i> Home
        </a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5 mx-2 text-slate-300"></i>
        <a href="{{ route('bussiness_product_list', $category->business_type_id) }}" class="hover:text-primary transition-colors whitespace-nowrap text-slate-600">
            {{ $category->category_name }}
        </a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5 mx-2 text-slate-300"></i>
        <span class="text-slate-900 font-semibold whitespace-nowrap">
            {{ $subcategory->sub_category_name }}
        </span>
    </nav>

    {{-- Responsive Multi-Column Split Framework Layout --}}
    <div class="flex flex-col lg:flex-row gap-8 items-start">
        
        <aside class="w-full lg:w-[280px] shrink-0 lg:sticky lg:top-28 z-10">
            <div class="bg-white rounded-xl shadow-[0_2px_12px_rgba(15,23,42,0.02)] border border-slate-200/60 overflow-hidden">
                
                <div class="py-4 px-5 bg-slate-50 border-b border-slate-100 font-extrabold text-slate-800 text-sm tracking-wide uppercase flex items-center gap-2">
                    <i data-lucide="layers" class="w-4 h-4 text-slate-500"></i> {{ $category->category_name }}
                </div>

                <div class="p-2 space-y-1 bg-white max-h-[450px] overflow-y-auto custom-scrollbar">
                    @foreach ($subcategories as $siblingSub)
                        <a href="{{ route('subcategoryproducts', $siblingSub->id) }}" 
                           class="w-full flex items-center justify-between px-4 py-3 rounded-lg text-[13px] font-semibold tracking-tight transition-all group
                                  {{ $siblingSub->id == $subcategory->id 
                                     ? 'bg-primary/5 text-primary border-l-4 border-primary pl-3' 
                                     : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                            
                            <span class="truncate pr-2">{{ $siblingSub->sub_category_name }}</span>
                            
                            <i data-lucide="chevron-right" 
                               class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-all transform translate-x-[-4px] group-hover:translate-x-0
                                      {{ $siblingSub->id == $subcategory->id ? 'opacity-100 text-primary' : 'text-slate-400' }}">
                            </i>
                        </a>
                    @endforeach
                </div>

            </div>
        </aside>

        <main class="flex-1 w-full space-y-6">

            {{-- Grid Dynamic Result Header Panel Bar --}}
            <div class="bg-white p-5 rounded-2xl border border-slate-200/60 shadow-[0_2px_8px_rgba(0,0,0,0.01)] flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h1 class="text-lg font-extrabold text-slate-900 tracking-tight flex items-center gap-2">
                        {{ $subcategory->sub_category_name }}
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-600 border border-slate-200/40">
                            {{ $products->total() }} Products
                        </span>
                    </h1>
                </div>
            </div>

            {{-- Products Grid Matrix Layer --}}
            <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
                @forelse($products as $product)
                    <a href="{{ route('productdetails', $product->id) }}"
                       class="bg-white rounded-2xl p-4 border border-slate-200/70 hover:border-primary/20 shadow-[0_2px_8px_rgba(0,0,0,0.01)] hover:shadow-md hover:-translate-y-1 transition-all duration-300 group flex flex-col overflow-hidden">

                        {{-- Product Frame Thumbnail Box --}}
                        <div class="h-44 bg-slate-50/60 rounded-xl flex items-center justify-center overflow-hidden mb-4 relative p-2 border border-slate-100">
                            @php
                                $images = json_decode($product->image, true);
                            @endphp

                            @if(!empty($images) && isset($images[0]))
                                <img src="{{ asset('uploads/products/' . $images[0]) }}"
                                     alt="{{ $product->product_name }}"
                                     class="max-w-full max-h-full object-contain transform group-hover:scale-105 transition-transform duration-500">
                            @else
                                <img src="https://pngimg.com/uploads/engine/engine_PNG31.png"
                                     alt="No Image"
                                     class="max-w-full max-h-full object-contain opacity-40">
                            @endif
                        </div>

                        {{-- Product Meta Data Info --}}
                        <div class="flex flex-col flex-1">
                            <h3 class="text-[13.5px] font-bold text-slate-800 group-hover:text-primary transition-colors line-clamp-2 min-h-[38px] leading-snug">
                                {{ $product->product_name }}
                            </h3>

                            {{-- Optional Brand Label Info --}}
                            @if(!empty($product->brand))
                                <p class="text-[11.5px] text-slate-400 font-medium mt-1.5 truncate">
                                    Brand: <span class="text-slate-600 font-semibold">{{ $product->brand }}</span>
                                </p>
                            @endif

                            {{-- Price View Integration Row --}}
                            @if(!empty($product->selling_price))
                                <div class="mt-2.5 mb-3">
                                    <span class="text-[16px] font-extrabold text-primary tracking-tight">
                                        ₹{{ number_format($product->selling_price, 2) }}
                                    </span>
                                </div>
                            @else
                                <div class="mt-2.5 mb-3 h-[24px]"></div>
                            @endif

                            {{-- Interactive Action CTA Trigger --}}
                            <div class="mt-auto">
                                <div class="w-full bg-slate-50 group-hover:bg-primary text-slate-700 group-hover:text-white text-center py-2 rounded-xl text-[12px] font-bold transition-all duration-300 border border-slate-100 group-hover:border-primary">
                                    View Details
                                </div>
                            </div>
                        </div>

                    </a>
                @empty
                    <div class="col-span-full">
                        <div class="bg-white rounded-2xl border border-dashed border-slate-300 py-16 text-center">
                            <div class="w-16 h-16 mx-auto rounded-full bg-slate-50 flex items-center justify-center mb-4 border border-slate-100">
                                <i data-lucide="package-x" class="w-8 h-8 text-slate-400"></i>
                            </div>
                            <h3 class="text-base font-bold text-slate-800 mb-1">No Products Found</h3>
                            <p class="text-slate-400 text-xs">Products are not available in this segment yet.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Custom Tailored Pagination Panel Block --}}
            @if($products->hasPages())
                <div class="mt-10 bg-white border border-slate-200/60 rounded-xl p-4 shadow-sm">
                    {{ $products->links() }}
                </div>
            @endif

        </main>
    </div>
</div>

@include('frontend.layouts.footer')

<style>
    /* Sleek Native Thin Scrollbar Architecture */
    .custom-scrollbar::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>