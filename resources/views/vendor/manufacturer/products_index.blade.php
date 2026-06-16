{{-- resources/views/vendor/products/index.blade.php --}}

@include('vendor.Layout.head')

<body class="text-gray-800 antialiased font-sans bg-slate-50">

    {{-- TOP BAR --}}
    @include('vendor.Layout.top_bar')

    {{-- HEADER --}}
    @include('vendor.Layout.main_header')

    <div class="bg-slate-50 min-h-screen py-8">

        <div class="max-w-7xl mx-auto px-4">

            {{-- MENU --}}
            @include('vendor.Layout.menu_bar')

     

            <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">

                {{-- HEADER --}}
                <div
                    class="px-6 py-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">

                    <div>

                        <h2 class="text-[22px] font-bold text-gray-900">
                            Product List
                        </h2>

                        <p class="text-[13px] text-gray-500 mt-1">
                            Manage your products and inventory
                        </p>

                    </div>

                    {{-- ADD PRODUCT --}}
                    <a href="{{ route('manufacturer.product.create') }}"
                        class="bg-primary text-white hover:bg-primaryHover px-5 py-3 rounded-xl text-[14px] font-semibold transition-all flex items-center gap-2 shadow-md shadow-primary/20">

                        <i data-lucide="plus" class="w-4 h-4"></i>

                        Add New Product

                    </a>

                </div>

                {{-- FILTER --}}
                <div
                    class="p-4 bg-slate-50 border-b border-gray-100 flex flex-col md:flex-row gap-3 items-center">

                   <form method="GET" action="{{ route('manufacturer.product.list') }}"
    class="p-4 bg-slate-50 border-b border-gray-100 flex flex-col md:flex-row gap-3 items-center">

    {{-- CATEGORY --}}
    <div class="relative w-full md:w-52">

        <select name="category" id="category_id"
            class="w-full h-11 pl-4 pr-10 bg-white border border-gray-200 rounded-xl text-[13px]">

            <option value="">All Categories</option>

            @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                    {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->category_name }}
                </option>
            @endforeach

        </select>

    </div>

    {{-- SUB CATEGORY --}}
    <!-- <div class="relative w-full md:w-52">

        <select name="sub_category" id="sub_category_id"
            class="w-full h-11 pl-4 pr-10 bg-white border border-gray-200 rounded-xl text-[13px]">

            <option value="">All Sub Categories</option>

        </select>

    </div> -->

    {{-- STATUS --}}
    <div class="relative w-full md:w-44">

        <select name="status"
            class="w-full h-11 pl-4 pr-10 bg-white border border-gray-200 rounded-xl text-[13px]">

            <option value="">All Status</option>
            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active</option>
            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive</option>

        </select>

    </div>

    {{-- SEARCH --}}
    <div class="relative flex-1 w-full">

        <input type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search products..."
            class="w-full h-11 px-4 bg-white border border-gray-200 rounded-xl text-[13px]">

    </div>

    {{-- BUTTON --}}
    <button type="submit"
        class="px-5 py-2 bg-primary text-white rounded-xl">

        Filter

    </button>

</form>

                </div>

                {{-- TABLE --}}
                <div class="overflow-x-auto">

                    <table class="w-full min-w-[1000px]">

                        <thead class="bg-slate-50 border-b border-gray-100">

                            <tr class="text-left text-[12px] uppercase tracking-wider text-gray-500">

                                <th class="px-6 py-4">
                                    #
                                </th>

                                <th class="px-6 py-4">
                                    Product
                                </th>

                                <th class="px-6 py-4">
                                    Category
                                </th>

                                <th class="px-6 py-4">
                                    Sub Category
                                </th>

                                <th class="px-6 py-4">
                                    Status
                                </th>

                                <th class="px-6 py-4 text-center">
                                    Action
                                </th>

                            </tr>

                        </thead>

                      <tbody class="divide-y divide-gray-100">

    @forelse($products as $key => $product)

        @php

            $images = json_decode($product->image, true);

        @endphp

        <tr class="hover:bg-slate-50 transition-all">

            {{-- ID --}}
            <td class="px-6 py-4 text-sm text-gray-500">

                {{ $key + 1 }}

            </td>

            {{-- PRODUCT --}}
            <td class="px-6 py-4">

                <div class="flex items-center gap-4">

                    <div class="w-16 h-16 rounded-2xl border border-gray-100 overflow-hidden bg-white">

                        @if(!empty($images) && isset($images[0]))

                            <img src="{{ asset('uploads/products/'.$images[0]) }}"
                                class="w-full h-full object-cover">

                        @else

                            <img src="https://via.placeholder.com/150"
                                class="w-full h-full object-cover">

                        @endif

                    </div>

                    <div>

                        <h4 class="text-[14px] font-bold text-gray-900">

                            {{ $product->product_name }}

                        </h4>

                        <p class="text-[12px] text-gray-500 mt-1">

                            Model:
                            {{ $product->model_number ?? '-' }}

                        </p>

                        <p class="text-[12px] text-gray-500 mt-1">

                            Brand:
                            {{ $product->brand ?? '-' }}

                        </p>

                    </div>

                </div>

            </td>

            {{-- CATEGORY --}}
            <td class="px-6 py-4 text-[13px] text-gray-600">

                {{ $product->categoryData->category_name ?? '-' }}

            </td>

            {{-- PRICE --}}
            <td class="px-6 py-4 text-[13px] font-semibold text-gray-900">

               {{ $product->subCategoryData->sub_category_name ?? '-' }}

            </td>

            {{-- STATUS --}}
            <td class="px-6 py-4">

                @if($product->status == 1)

                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-[11px] font-bold bg-green-100 text-green-700">

                        Active

                    </span>

                @else

                    <span class="inline-flex items-center px-3 py-1 rounded-lg text-[11px] font-bold bg-red-100 text-red-700">

                        Inactive

                    </span>

                @endif

            </td>

            {{-- ACTION --}}
            <td class="px-6 py-4">

                <div class="flex items-center justify-center gap-2">

                    {{-- VIEW --}}
                    <a href="{{ route('manufacturer.product.show', $product->id) }}"
                        class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-primary hover:text-white flex items-center justify-center transition-all">

                        <i data-lucide="eye" class="w-4 h-4"></i>

                    </a>

                    {{-- EDIT --}}
                    <a href="{{ route('manufacturer.product.edit', $product->id) }}"
                        class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-blue-500 hover:text-white flex items-center justify-center transition-all">

                        <i data-lucide="edit-2" class="w-4 h-4"></i>

                    </a>

                    {{-- DELETE --}}
                    <form action="{{ route('manufacturer.product.delete', $product->id) }}"
                        method="POST"
                        onsubmit="return confirm('Delete this product?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                            class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-red-500 hover:text-white flex items-center justify-center transition-all">

                            <i data-lucide="trash-2" class="w-4 h-4"></i>

                        </button>

                    </form>

                </div>

            </td>

        </tr>

    @empty

        <tr>

            <td colspan="6"
                class="text-center py-10 text-gray-500">

                No Products Found

            </td>

        </tr>

    @endforelse

</tbody>

                    </table>

                </div>

                {{-- FOOTER --}}
                <div
                    class="px-6 py-4 border-t border-gray-100 flex items-center justify-between text-[13px] text-gray-500">

                    <p>
                        Showing 1 to 1 entries
                    </p>

                    <div class="flex items-center gap-2">

                        <button
                            class="px-4 py-2 border border-gray-200 rounded-xl hover:bg-slate-50 transition-all">

                            Prev

                        </button>

                        <button
                            class="px-4 py-2 bg-primary text-white rounded-xl">

                            1

                        </button>

                        <button
                            class="px-4 py-2 border border-gray-200 rounded-xl hover:bg-slate-50 transition-all">

                            Next

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- FOOTER --}}
    @include('vendor.Layout.footer')

</body>

</html>