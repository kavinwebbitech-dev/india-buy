@include('vendor.Layout.head')


    @include('vendor.Layout.top_bar')

    @include('vendor.Layout.main_header')

    <div class="min-h-screen py-8">

        <div class="max-w-7xl mx-auto px-4">

            @include('vendor.Layout.menu_bar')

            <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6">

                {{-- HEADER --}}
                <div class="flex items-center justify-between mb-6">

                    <div>

                        <h2 class="text-2xl font-bold text-gray-900">
                            Real Estate Properties
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Manage your property listings
                        </p>

                    </div>

                    <a href="{{ route('relastate.product.create') }}"
                        class="bg-primary text-white px-5 py-3 rounded-xl text-sm font-bold hover:bg-primaryHover transition">

                        + Add Property

                    </a>

                </div>



                {{-- FILTER --}}
                <form method="GET" action="{{ route('relastate.product.list') }}"
                    class="p-4 bg-slate-50 border border-gray-100 rounded-2xl flex flex-col md:flex-row gap-3 items-center mb-6">

                    {{-- CATEGORY --}}
                    <div class="w-full md:w-52">

                        <select name="category"
                            class="w-full h-11 px-4 bg-white border border-gray-200 rounded-xl text-[13px]">

                            <option value="">
                                All Categories
                            </option>

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

                            <option value="">
                                All Status
                            </option>

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
                            placeholder="Search property..."
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
                                    Property
                                </th>

                                <th class="text-left py-4 text-sm font-bold text-gray-700">
                                    Category
                                </th>

                                <th class="text-left py-4 text-sm font-bold text-gray-700">
                                    Location
                                </th>

                                <th class="text-left py-4 text-sm font-bold text-gray-700">
                                    Type
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

                            @forelse($properties as $property)
                                @php
                                    $images = json_decode($property->proerty_image, true);
                                    $images1 = json_decode($property->property_image, true);
                                @endphp

                                <tr class="border-b border-gray-100 hover:bg-slate-50">

                                    {{-- IMAGE --}}
                                    <td class="py-4">

                                        @if (!empty($images))
                                            <img src="{{ asset('uploads/relastate/images/' . $images[0]) }}"
                                                class="w-16 h-16 rounded-xl object-cover border">
                                        @elseif(!empty($images1))
                                            <img src="{{ asset('uploads/relastate/images/' . $images1[0]) }}"
                                                class="w-16 h-16 rounded-xl object-cover border">
                                        @else
                                            <img src="{{ asset('admin/no-image.png') }}"
                                                class="w-16 h-16 rounded-xl object-cover border">
                                        @endif

                                    </td>

                                    {{-- PROPERTY --}}
                                    <td class="py-4">

                                        <div class="font-bold text-gray-800">
                                            {{ $property->property_title }}
                                        </div>

                                        <div class="text-xs text-gray-500 mt-1">

                                            {{ \Carbon\Carbon::parse($property->created_at)->format('d M Y') }}

                                        </div>

                                    </td>

                                    {{-- CATEGORY --}}
                                    <td class="py-4 text-sm text-gray-700">

                                        {{ $property->categoryData->category_name ?? '-' }}

                                    </td>

                                    {{-- LOCATION --}}
                                    <td class="py-4 text-sm text-gray-700">

                                        {{ $property->city }},
                                        {{ $property->state }}

                                    </td>

                                    {{-- TYPE --}}
                                    <td class="py-4 text-sm text-gray-700">

                                        {{ $property->property_type }}

                                    </td>

                                    {{-- STATUS --}}
                                    <td class="py-4">

                                        @if ($property->status == 1)
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
                                            <a href="{{ route('relastate.product.show', $property->id) }}"
                                                class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-primary hover:text-white flex items-center justify-center transition-all">

                                                <i data-lucide="eye" class="w-4 h-4"></i>

                                            </a>

                                            {{-- EDIT --}}
                                            <a href="{{ route('relastate.product.edit', $property->id) }}"
                                                class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-blue-500 hover:text-white flex items-center justify-center transition-all">

                                                <i data-lucide="edit-2" class="w-4 h-4"></i>

                                            </a>

                                            {{-- DELETE --}}
                                            <form action="{{ route('relastate.product.delete', $property->id) }}"
                                                method="POST" class="delete-form">

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

                                    <td colspan="7" class="py-10 text-center text-gray-500">

                                        No Properties Found

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

                {{-- PAGINATION --}}
                <div class="mt-6">

                    {{ $properties->links() }}

                </div>

            </div>

        </div>

    </div>

    @include('vendor.Layout.footer')


