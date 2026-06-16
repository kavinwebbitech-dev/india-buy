@include('vendor.Layout.head')

<body class="text-gray-800 antialiased font-sans bg-slate-50">

    {{-- TOP BAR --}}
    @include('vendor.Layout.top_bar')

    {{-- HEADER --}}
    @include('vendor.Layout.main_header')
    <div class="min-h-screen py-8">

        <div class="max-w-7xl mx-auto px-4">

            @include('vendor.Layout.menu_bar')

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">

                {{-- HEADER --}}
                <div class="flex items-center justify-between mb-6">

                    <div>

                        <h2 class="text-2xl font-bold text-gray-900">
                            Service Pages
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Manage your created service pages
                        </p>

                    </div>

                    <a href="{{ route('service.product.create') }}"
                        class="bg-primary text-white px-5 py-3 rounded-xl text-sm font-bold hover:bg-primaryHover transition">

                        + Add Service

                    </a>

                </div>



                {{-- FILTER --}}
                <form method="GET" action="{{ route('service.product.list') }}"
                    class="p-4 bg-slate-50 border border-gray-100 rounded-2xl flex flex-col md:flex-row gap-3 items-center mb-6">

                    {{-- CATEGORY --}}
                    <div class="w-full md:w-52">

                        <select name="category"
                            class="w-full h-11 px-4 bg-white border border-gray-200 rounded-xl text-[13px]">

                            <option value="">All Categories</option>

                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ request('category') == $cat->id ? 'selected' : '' }}>

                                    {{ $cat->category_name }}

                                </option>
                            @endforeach

                        </select>

                    </div>

                    {{-- STATUS --}}
                    <div class="w-full md:w-44">

                        <select name="status"
                            class="w-full h-11 px-4 bg-white border border-gray-200 rounded-xl text-[13px]">

                            <option value="">All Status</option>

                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                    </div>

                    {{-- SEARCH --}}
                    <div class="flex-1 w-full">

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search services..."
                            class="w-full h-11 px-4 bg-white border border-gray-200 rounded-xl text-[13px]">

                    </div>

                    {{-- BUTTON --}}
                    <button type="submit" class="px-5 py-3 bg-primary text-white rounded-xl text-sm font-bold">

                        Filter

                    </button>

                </form>

                {{-- TABLE --}}
                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead>

                            <tr class="border-b border-gray-100">

                                <th class="text-left py-4 text-sm font-bold text-gray-700">
                                    Image
                                </th>

                                <th class="text-left py-4 text-sm font-bold text-gray-700">
                                    Service Name
                                </th>

                                <th class="text-left py-4 text-sm font-bold text-gray-700">
                                    Category
                                </th>

                                <th class="text-left py-4 text-sm font-bold text-gray-700">
                                    Location
                                </th>

                                <th class="text-left py-4 text-sm font-bold text-gray-700">
                                    Status
                                </th>

                                <th class="text-center py-4 text-sm font-bold text-gray-700">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($services as $service)

                                <tr class="border-b border-gray-100 hover:bg-slate-50">

                                    {{-- IMAGE --}}
                                    <td class="py-4">
                                        @if (!empty($service->service_img))
                                            @php
                                            // JSON string ah php array va mathurom
                                            $images = json_decode($service->service_img, true);
                                            @endphp

                                            {{-- Array la muthal image mattum table preview ku edukirom --}}
                                            @if (is_array($images) && count($images) > 0)
                                                <img src="{{ asset('uploads/service/images/' . $images[0]) }}"
                                                    class="w-16 h-16 rounded-xl object-cover border"
                                                    alt="{{ $service->service_name }}">
                                            @else
                                                {{-- Incase column la data irundhu image file illa na generic placeholder --}}
                                                <img src="{{ asset('uploads/service/images/' . $service->service_img) }}"
                                                    class="w-16 h-16 rounded-xl object-cover border bg-gray-100"
                                                    alt="No Image">
                                            @endif
                                        @else
                                            {{-- Image column completely empty ah irundha --}}
                                            <img src="{{ asset('uploads/service/images/default-placeholder.png') }}"
                                                class="w-16 h-16 rounded-xl object-cover border bg-gray-100"
                                                alt="No Image">
                                        @endif
                                    </td>

                                    {{-- SERVICE NAME --}}
                                    <td class="py-4">

                                        <div class="font-bold text-gray-800">
                                            {{ $service->service_name }}
                                        </div>

                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ \Carbon\Carbon::parse($service->created_at)->format('d M Y') }}
                                        </div>

                                    </td>

                                    {{-- CATEGORY --}}
                                    <td class="py-4 text-sm text-gray-700">

                                        {{ $service->categoryData->category_name ?? '-' }}

                                    </td>

                                    {{-- LOCATION --}}
                                    <td class="py-4 text-sm text-gray-700">

                                        {{ $service->service_city }},
                                        {{ $service->service_state }}

                                    </td>

                                    {{-- STATUS --}}
                                    <td class="py-4">

                                        @if ($service->status == 1)
                                            <span
                                                class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                                Active
                                            </span>
                                        @else
                                            <span
                                                class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                                                Inactive
                                            </span>
                                        @endif

                                    </td>

                                    {{-- ACTION --}}
                                    <td class="py-4">

                                        <div class="flex items-center justify-center gap-2">

                                            {{-- VIEW --}}
                                            <a href="{{ route('service.product.show', $service->id) }}"
                                                class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-primary hover:text-white flex items-center justify-center transition-all">

                                                <i data-lucide="eye" class="w-4 h-4"></i>

                                            </a>

                                            {{-- EDIT --}}
                                            <a href="{{ route('service.product.edit', $service->id) }}"
                                                class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-blue-500 hover:text-white flex items-center justify-center transition-all">

                                                <i data-lucide="edit-2" class="w-4 h-4"></i>

                                            </a>

                                            {{-- DELETE --}}
                                            <form action="{{ route('service.product.delete', $service->id) }}"
                                                method="POST" onsubmit="return confirm('Delete this product?')">

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

                                    <td colspan="6" class="py-10 text-center text-gray-500">

                                        No Services Found

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- PAGINATION --}}
                <div class="mt-6">

                    {{ $services->links() }}

                </div>

            </div>

        </div>

    </div>

    @include('vendor.Layout.footer')

</body>

</html>
