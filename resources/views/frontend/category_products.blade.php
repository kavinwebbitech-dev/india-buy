@include('frontend.layouts.header-link')


@include('frontend.layouts.top_bar')

@include('frontend.layouts.main_header')

@include('frontend.layouts.navbar')

<div class="max-w-full mx-auto px-2 py-8">

    {{-- TITLE --}}
    <div class="bg-white p-4 rounded-2xl border border-gray-100 shadow-sm mb-8">

        <h1 class="text-[22px] font-bold text-gray-900 text-center">

            {{ $category->category_name }}

        </h1>

    </div>

    {{-- SUB CATEGORIES --}}
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">

        @forelse($category->subcategories as $subcategory)

    <a href="{{ route('subcategoryproducts', $subcategory->id) }}"
        class="bg-white rounded-2xl border border-gray-200 p-5 hover:border-primary/30 hover:shadow-[0_8px_30px_rgb(0,0,0,0.06)] hover:-translate-y-1 transition-all duration-300 group">

        {{-- TOP --}}
        <div class="flex justify-between items-start mb-5">

            <div>

                <h3
                    class="text-[15px] font-bold text-gray-800 group-hover:text-primary transition-colors">

                    {{ $subcategory->sub_category_name }}

                </h3>

                <p class="text-[12px] text-gray-400 mt-1">

                    Browse Products

                </p>

            </div>

            <div
                class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center group-hover:bg-primary transition-all duration-300">

                <i data-lucide="arrow-up-right"
                    class="w-4 h-4 text-gray-500 group-hover:text-white"></i>

            </div>

        </div>

        {{-- IMAGE --}}
        <div class="flex items-center justify-center h-28">

            @if($subcategory->image)

                <img src="{{ asset('uploads/subcategories/' . $subcategory->image) }}"
                    alt="{{ $subcategory->sub_category_name }}"
                    class="h-24 w-24 object-contain group-hover:scale-110 transition-transform duration-300">

            @else

                <div
                    class="w-20 h-20 rounded-2xl bg-primary/10 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">

                    <i data-lucide="layers-3"
                        class="w-10 h-10 text-primary"></i>

                </div>

            @endif

        </div>

    </a>

@empty

    <div class="col-span-4 text-center py-10">

        <p class="text-gray-500">

            No Sub Categories Found

        </p>

    </div>

@endforelse

    </div>

</div>

@include('frontend.layouts.footer')