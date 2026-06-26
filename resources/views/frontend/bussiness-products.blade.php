@include('frontend.layouts.header-link')
@include('frontend.layouts.top_bar')
@include('frontend.layouts.main_header')
@include('frontend.layouts.navbar')

<div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 py-10 bg-[#f8fafc]">

    <nav class="flex items-center gap-2 text-[13px] text-slate-500 font-medium mb-8 px-1">
        <a href="#" class="hover:text-primary transition-colors flex items-center"><i data-lucide="home"
                class="w-4 h-4"></i></a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-300"></i>
        <a href="{{ route('home') }}" class="hover:text-primary transition-colors text-slate-600">All Categories</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-300"></i>
        <span class="text-slate-900 font-semibold">{{ $bussiness->business_name }}</span>
    </nav>

    <div class="flex flex-col lg:flex-row gap-8 items-start">

        <aside class="w-full lg:w-[300px] shrink-0 lg:sticky lg:top-28 z-10">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

                <div
                    class="py-4 px-5 bg-slate-50 border-b border-slate-200 font-bold text-slate-800 text-sm tracking-wide uppercase flex items-center gap-2">
                    <i data-lucide="menu" class="w-4 h-4 text-slate-500"></i> Browse Categories
                </div>

                <div class="divide-y divide-slate-100 font-medium text-[14px]">

                    <div class="bg-white">
                        <button type="button" onclick="filterCategory('all', null)" id="tab-all"
                            class="sidebar-root-btn w-full text-left px-5 py-3.5 flex items-center justify-between text-primary font-bold transition-all hover:bg-slate-50/80 active-tab-state">
                            <span class="truncate">All Categories</span>
                            <i data-lucide="chevron-right" class="w-4 h-4 transition-transform duration-200"></i>
                        </button>
                    </div>

                    @foreach ($categories as $category)
                        <div class="bg-white accordion-group" id="accordion-cat-{{ $category->id }}">

                            <button type="button" onclick="toggleAccordion('{{ $category->id }}')"
                                class="sidebar-root-btn w-full text-left px-5 py-3.5 flex items-center justify-between text-slate-700 hover:text-primary hover:bg-slate-50/50 transition-all">
                                <span class="truncate pr-2 font-semibold">{{ $category->category_name }}</span>
                                <i data-lucide="chevron-right"
                                    class="arrow-icon w-4 h-4 text-slate-400 transition-transform duration-200"></i>
                            </button>

                            <div
                                class="sub-drawer max-h-0 overflow-hidden bg-slate-50/50 transition-all duration-300 ease-in-out">
                                <div class="py-1 px-2 space-y-0.5 border-t border-slate-100">
                                    @foreach ($category->subcategories as $subcategory)
                                        <button type="button"
                                            onclick="filterCategory('cat-{{ $category->id }}', 'sub-{{ $subcategory->id }}')"
                                            id="sub-item-{{ $subcategory->id }}"
                                            class="sub-item-btn w-full text-left pl-8 pr-4 py-2 text-[13px] text-slate-600 hover:text-primary rounded-lg transition-all flex items-center justify-between group">
                                            <span class="truncate pr-1">{{ $subcategory->sub_category_name }}</span>
                                            <i data-lucide="chevron-right"
                                                class="w-3.5 h-3.5 text-primary opacity-0 group-hover:opacity-100 transform translate-x-[-4px] group-hover:translate-x-0 transition-all"></i>
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>
        </aside>

        <main class="flex-1 w-full space-y-8">

            @forelse($categories as $category)
                {{-- Entha category-ku subcategories iruko athu mattum dhaan thonum --}}
                @if ($category->subcategories->count() > 0)
                    <div class="category-section-block bg-white border border-slate-200 rounded-2xl p-6 shadow-[0_2px_8px_rgba(15,23,42,0.01)] transition-all duration-200"
                        id="block-cat-{{ $category->id }}">

                        <div class="flex items-center gap-3 border-b border-slate-100 pb-4 mb-5">
                            <div class="w-1 h-5 bg-primary rounded-full"></div>
                            <h2 class="text-base font-extrabold text-slate-900 tracking-tight">
                                {{ $category->category_name }}
                            </h2>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4">
                            @foreach ($category->subcategories as $subcategory)
                                <a href="{{ route('subcategoryproducts', $subcategory->id) }}"
                                    id="card-sub-{{ $subcategory->id }}"
                                    class="subcategory-card group bg-white border border-slate-100 hover:border-primary/20 hover:shadow-md rounded-xl p-4 flex flex-col items-center text-center transition-all duration-200">

                                    <div
                                        class="w-full aspect-square bg-slate-50 group-hover:bg-primary/5 rounded-lg flex items-center justify-center p-3 mb-3 relative overflow-hidden transition-colors">
                                        @if ($subcategory->image)
                                            <img src="{{ asset('uploads/subcategories/' . $subcategory->image) }}"
                                                class="max-w-full max-h-full object-contain transform group-hover:scale-105 transition-transform duration-300">
                                        @else
                                            <img src="{{ asset('images/no-image.png') }}"
                                                class="w-12 h-12 object-contain opacity-40">
                                        @endif
                                    </div>

                                    <h3
                                        class="font-bold text-slate-700 text-[13px] group-hover:text-primary transition-colors line-clamp-2 px-0.5">
                                        {{ $subcategory->sub_category_name }}
                                    </h3>
                                </a>
                            @endforeach
                        </div>

                    </div>
                @endif
            @empty
                <div class="text-center py-16 bg-white rounded-3xl border border-slate-100 text-slate-400 font-medium">
                    <i data-lucide="folder-search" class="w-8 h-8 mx-auto mb-3 text-slate-300"></i> No Categories Found
                </div>
            @endforelse

        </main>
    </div>
</div>

@include('frontend.layouts.footer')

<style>
    /* Accordion open rotation helper state */
    .accordion-open .arrow-icon {
        transform: rotate(90deg) !important;
        color: var(--primary-color, #f97316) !important;
    }

    .accordion-open>.sidebar-root-btn {
        background-color: rgb(248 250 252 / 1);
        color: var(--primary-color, #f97316) !important;
        font-weight: 700;
    }

    /* Selected subcategory highlight styling state */
    .active-sub-highlight {
        background-color: rgb(241 245 249 / 1) !important;
        /* slate-100 */
        color: var(--primary-color, #f97316) !important;
        font-weight: 700;
    }

    .active-tab-state {
        background-color: rgb(248 250 252 / 1) !important;
    }
</style>

<script>
    // 1. Sidebar Category Click: Toggle Dynamic Drawer
    function toggleAccordion(categoryId) {
        const targetWrapper = document.getElementById('accordion-cat-' + categoryId);
        const drawer = targetWrapper.querySelector('.sub-drawer');
        const isOpen = targetWrapper.classList.contains('accordion-open');

        // Close all other drawers first
        document.querySelectorAll('.accordion-group').forEach(group => {
            if (group.id !== 'accordion-cat-' + categoryId) {
                group.classList.remove('accordion-open');
                group.querySelector('.sub-drawer').style.maxHeight = '0px';
            }
        });

        // Toggle state for current clicked element
        if (isOpen) {
            targetWrapper.classList.remove('accordion-open');
            drawer.style.maxHeight = '0px';
            filterCategory('all', null); // Fallback grid view to all
        } else {
            targetWrapper.classList.add('accordion-open');
            drawer.style.maxHeight = drawer.scrollHeight + "px";
            filterCategory('cat-' + categoryId, null); // Instantly filter main page parent block
        }
    }

    // 2. Main Processing Dynamic Filtering System
    function filterCategory(catTargetId, subTargetId) {
        // Reset subcategory active highlight classes
        document.querySelectorAll('.sub-item-btn').forEach(btn => btn.classList.remove('active-sub-highlight'));
        document.getElementById('tab-all').classList.remove('text-primary', 'font-bold', 'active-tab-state');

        const mainBlocks = document.querySelectorAll('.category-section-block');

        // CASE A: All Categories Selected
        if (catTargetId === 'all') {
            document.getElementById('tab-all').classList.add('text-primary', 'font-bold', 'active-tab-state');

            mainBlocks.forEach(block => {
                block.style.display = 'block';
                block.querySelectorAll('.subcategory-card').forEach(card => card.style.display = 'flex');
            });
            return;
        }

        // Apply visual sub-item selector if chosen directly
        if (subTargetId) {
            const subBtn = document.getElementById('sub-item-' + subTargetId.replace('sub-', ''));
            if (subBtn) subBtn.classList.add('active-sub-highlight');
        }

        // CASE B: Parent Category Selected or specific subcategory requested
        mainBlocks.forEach(block => {
            if (block.id === 'block-' + catTargetId) {
                block.style.display = 'block';

                const cards = block.querySelectorAll('.subcategory-card');
                cards.forEach(card => {
                    if (!subTargetId || card.id === 'card-' + subTargetId) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
            } else {
                block.style.display = 'none';
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>
