@include('vendor.Layout.head')

@include('vendor.Layout.top_bar')
@include('vendor.Layout.main_header')

@php
    $features   = json_decode($service->feature, true) ?? [];
    $images     = json_decode($service->service_img, true) ?? [];
@endphp

<div class="bg-slate-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4">
        @include('vendor.Layout.menu_bar')

        <form action="{{ route('service.product.update', $service->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="flex flex-col h-full bg-slate-50">
                {{-- HEADER --}}
                <div class="px-6 py-5 border border-gray-100 rounded-t-3xl flex items-center justify-between bg-white shadow-sm">
                    <div>
                        <h2 class="text-[20px] font-bold text-gray-900 mb-1">Edit Service</h2>
                        <p class="text-[13px] text-gray-500 font-medium">Update your service details</p>
                    </div>
                </div>

                {{-- BODY --}}
                <div class="border border-t-0 border-gray-100 rounded-b-3xl bg-white">
                    <div class="p-6 lg:p-8">

                        {{-- NOTIFICATIONS --}}
                        @if (session('success'))
                            <div class="mb-5 p-4 rounded-xl bg-green-100 text-green-700">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="mb-5 p-4 rounded-xl bg-red-100 text-red-700">{{ session('error') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="mb-5 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700">
                                <ul class="list-disc pl-4 space-y-1 text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="max-w-5xl mx-auto space-y-6">

                            {{-- 1. SERVICE DETAILS --}}
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                                <h3 class="text-[16px] font-bold text-gray-900 mb-5">1. Service Details</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                    {{-- BUSINESS TYPE --}}
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Business Type</label>
                                        <select name="business_type" id="business_type_id"
                                            class="w-full h-11 px-4 border rounded-xl text-[13px] border-gray-200">
                                            <option value="">Select Business Type</option>
                                            @foreach ($businessType as $type)
                                                <option value="{{ $type->id }}"
                                                    {{ old('business_type', $service->business_type_id) == $type->id ? 'selected' : '' }}>
                                                    {{ $type->business_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- CATEGORY --}}
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Category</label>
                                        <select name="category" id="category_id"
                                            class="w-full h-11 px-4 border rounded-xl text-[13px] border-gray-200">
                                            <option value="">Select Category</option>
                                        </select>
                                    </div>

                                    {{-- SUBCATEGORY --}}
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Sub Category</label>
                                        <select name="subcategory" id="subcategory_id"
                                            class="w-full h-11 px-4 border rounded-xl text-[13px] @error('subcategory') border-red-500 @else border-gray-200 @enderror">
                                            <option value="">Select Subcategory</option>
                                        </select>
                                        @error('subcategory')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- SERVICE NAME --}}
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Service Name</label>
                                        <input type="text" name="service_name"
                                            value="{{ old('service_name', $service->service_name) }}"
                                            class="w-full h-11 px-4 border rounded-xl text-[13px] @error('service_name') border-red-500 @else border-gray-200 @enderror">
                                        @error('service_name')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- SHORT DESCRIPTION --}}
                                    <div class="md:col-span-2">
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Short Description</label>
                                        <textarea rows="3" name="short_description"
                                            class="w-full p-4 border rounded-xl text-[13px] @error('short_description') border-red-500 @else border-gray-200 @enderror">{{ old('short_description', $service->short_description) }}</textarea>
                                        @error('short_description')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- LONG DESCRIPTION --}}
                                    <div class="md:col-span-2">
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Long Description</label>
                                        <textarea rows="6" name="long_description"
                                            class="w-full p-4 border rounded-xl text-[13px] @error('long_description') border-red-500 @else border-gray-200 @enderror">{{ old('long_description', $service->long_description) }}</textarea>
                                        @error('long_description')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            {{-- 2. PRICING DETAILS --}}
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                                <h3 class="text-[16px] font-bold text-gray-900 mb-5">2. Pricing Details</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Price Type</label>
                                        <select name="price_type"
                                            class="w-full h-11 px-4 border rounded-xl text-[13px] border-gray-200">
                                            <option value="">Select</option>
                                            <option value="fixed"      {{ old('price_type', $service->price_type) == 'fixed'      ? 'selected' : '' }}>Fixed</option>
                                            <option value="hourly"     {{ old('price_type', $service->price_type) == 'hourly'     ? 'selected' : '' }}>Hourly</option>
                                            <option value="negotiable" {{ old('price_type', $service->price_type) == 'negotiable' ? 'selected' : '' }}>Negotiable</option>
                                        </select>
                                        @error('price_type')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Price</label>
                                        <input type="number" step="0.01" name="price"
                                            value="{{ old('price', $service->price) }}" placeholder="0.00"
                                            class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                                        @error('price')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- 3. LOCATION DETAILS --}}
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                                <h3 class="text-[16px] font-bold text-gray-900 mb-5">3. Location Details</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">State</label>
                                        <input type="text" name="state"
                                            value="{{ old('state', $service->service_state) }}"
                                            class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                                        @error('state')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">City</label>
                                        <input type="text" name="city"
                                            value="{{ old('city', $service->service_city) }}"
                                            class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                                        @error('city')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- 4. AVAILABILITY --}}
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                                <h3 class="text-[16px] font-bold text-gray-900 mb-5">4. Availability</h3>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Available Days</label>
                                        <input type="text" name="available_days"
                                            value="{{ old('available_days', $service->available_days) }}"
                                            placeholder="Mon - Sat"
                                            class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                                        @error('available_days')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Opening Time</label>
                                        <input type="time" name="opening_time"
                                            value="{{ old('opening_time', $service->opening_time) }}"
                                            class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                                        @error('opening_time')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Closing Time</label>
                                        <input type="time" name="closing_time"
                                            value="{{ old('closing_time', $service->closing_time) }}"
                                            class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                                        @error('closing_time')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- 5. FEATURES --}}
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                                <h3 class="text-[16px] font-bold text-gray-900 mb-5">5. Features</h3>

                                <div id="feature-container" class="space-y-4 mb-4">
                                    @if (!empty($features))
                                        @foreach ($features as $index => $feat)
                                            <div class="flex items-center gap-4 feature-row">
                                                <div class="grid grid-cols-2 gap-4 flex-1">
                                                    <input type="text" name="feature_key[]"
                                                        value="{{ old('feature_key.' . $index, $feat['key'] ?? '') }}"
                                                        placeholder="Feature Key"
                                                        class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                                                    <input type="text" name="feature_value[]"
                                                        value="{{ old('feature_value.' . $index, $feat['value'] ?? '') }}"
                                                        placeholder="Feature Value"
                                                        class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                                                </div>
                                                <button type="button"
                                                    class="btn-remove-feature text-red-500 hover:text-red-700 font-bold px-2 text-[14px]">✕</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="flex items-center gap-4 feature-row">
                                            <div class="grid grid-cols-2 gap-4 flex-1">
                                                <input type="text" name="feature_key[]" placeholder="Feature Key"
                                                    class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                                                <input type="text" name="feature_value[]" placeholder="Feature Value"
                                                    class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                                            </div>
                                            <button type="button"
                                                class="btn-remove-feature text-red-500 hover:text-red-700 font-bold px-2 text-[14px] invisible">✕</button>
                                        </div>
                                    @endif
                                </div>

                                @error('feature_key')
                                    <p class="text-red-500 text-[12px] mt-1 mb-3">{{ $message }}</p>
                                @enderror

                                <button type="button" id="btn-add-feature"
                                    class="px-5 py-2 bg-primary text-white rounded-xl text-[13px] font-medium">
                                    Add Feature
                                </button>
                            </div>

                            {{-- 6. MEDIA FILES --}}
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                                <h3 class="text-[16px] font-bold text-gray-900 mb-5">6. Media Files</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                                    {{-- DATASHEET --}}
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-2">
                                            Datasheet
                                            <span class="text-gray-400 font-normal">(Leave blank to keep current)</span>
                                        </label>

                                        <input type="file" name="datasheet"
                                            class="w-full p-3 border border-gray-200 rounded-xl text-[13px]">

                                        {{-- Current Datasheet with Remove --}}
                                        @if (!empty($service->datasheet))
                                            <div class="mt-3 flex items-center gap-3 p-3 border rounded-xl bg-gray-50 existing-datasheet">
                                                <div class="text-red-500 text-xl">📄</div>
                                                <div class="flex-1 overflow-hidden">
                                                    <div class="text-sm font-medium text-gray-800 truncate">{{ $service->datasheet }}</div>
                                                    <a href="{{ asset('uploads/service/datasheet/' . $service->datasheet) }}"
                                                        target="_blank" class="text-xs text-indigo-600 hover:underline">
                                                        View File
                                                    </a>
                                                </div>
                                                <button type="button" id="remove-datasheet"
                                                    class="bg-red-600 text-white w-6 h-6 rounded-full text-xs flex items-center justify-center flex-shrink-0">
                                                    ×
                                                </button>
                                                {{-- Hidden flag: if present → keep existing datasheet --}}
                                                <input type="hidden" name="keep_datasheet" id="keep_datasheet" value="1">
                                            </div>
                                        @endif

                                        @error('datasheet')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- SERVICE IMAGES UPLOAD --}}
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-2">
                                            Add New Images
                                            <span class="text-gray-400 font-normal">(Appended to existing)</span>
                                        </label>

                                        <input type="file" name="service_img[]" id="service_img" multiple accept="image/*"
                                            class="w-full p-3 border border-gray-200 rounded-xl text-[13px] @error('service_img') border-red-500 @enderror">

                                        @error('service_img')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                        @error('service_img.*')
                                            <p class="text-red-500 text-[12px] mt-1">Invalid image selected</p>
                                        @enderror
                                    </div>

                                </div>

                                {{-- NEW IMAGE LIVE PREVIEW --}}
                                <div class="mt-5">
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">New Uploads Preview</p>
                                    <div id="image-live-preview" class="grid grid-cols-2 md:grid-cols-4 gap-4"></div>
                                </div>

                                {{-- EXISTING SAVED IMAGES WITH REMOVE --}}
                                <div class="mt-5">
                                    <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Currently Saved Images</p>

                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="saved-images-container">
                                        @if (!empty($images))
                                            @foreach ($images as $img)
                                                <div class="border rounded-xl overflow-hidden shadow-sm bg-white relative existing-image">
                                                    <img src="{{ asset('uploads/service/images/' . $img) }}"
                                                        class="w-full h-36 object-cover">
                                                    <div class="p-2 text-xs text-gray-600 truncate">{{ $img }}</div>
                                                    <button type="button"
                                                        class="remove-existing-image absolute top-2 right-2 bg-red-600 text-white rounded-full w-6 h-6 text-xs flex items-center justify-center shadow">
                                                        ×
                                                    </button>
                                                    {{-- Hidden input: present = keep this image --}}
                                                    <input type="hidden" name="old_images[]" value="{{ $img }}">
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-sm text-gray-400 italic col-span-full">No images saved yet.</p>
                                        @endif
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- FOOTER --}}
                    <div class="p-4 border-t border-gray-100 bg-white flex justify-end">
                        <button type="submit"
                            class="bg-primary text-white px-8 py-3 rounded-xl text-[13px] font-bold hover:bg-opacity-90 transition-all">
                            Update Service
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

@include('vendor.Layout.footer')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function () {

        /* ============================================================
         | CASCADING DROPDOWNS
         ============================================================ */
        const savedCategoryId    = "{{ old('category', $service->category) }}";
        const savedSubcategoryId = "{{ old('subcategory', $service->subcategory) }}";

        // Business Type → Category
        $('#business_type_id').on('change', function () {
            let business_id = $(this).val();

            $('#category_id').html('<option value="">Loading...</option>');
            $('#subcategory_id').html('<option value="">Select Subcategory</option>');

            if (!business_id) {
                $('#category_id').html('<option value="">Select Category</option>');
                return;
            }

            $.ajax({
                url: "{{ route('get.categories') }}",
                type: "GET",
                data: { business_id: business_id },
                success: function (response) {
                    let html = '<option value="">Select Category</option>';
                    $.each(response, function (key, value) {
                        let selected = (value.id == savedCategoryId) ? 'selected' : '';
                        html += `<option value="${value.id}" ${selected}>${value.category_name}</option>`;
                    });
                    $('#category_id').html(html);

                    // Auto-trigger subcategory load
                    if (savedCategoryId) {
                        $('#category_id').trigger('change');
                    }
                }
            });
        });

        // Category → Subcategory
        $('#category_id').on('change', function () {
            let category_id = $(this).val();

            $('#subcategory_id').html('<option value="">Loading...</option>');

            if (!category_id) {
                $('#subcategory_id').html('<option value="">Select Subcategory</option>');
                return;
            }

            $.ajax({
                url: "{{ route('service.get.subcategories') }}",
                type: "GET",
                data: { category_id: category_id },
                success: function (response) {
                    let html = '<option value="">Select Subcategory</option>';
                    $.each(response, function (key, value) {
                        let selected = (value.id == savedSubcategoryId) ? 'selected' : '';
                        html += `<option value="${value.id}" ${selected}>${value.sub_category_name}</option>`;
                    });
                    $('#subcategory_id').html(html);
                }
            });
        });

        // Trigger on page load
        if ($('#business_type_id').val()) {
            $('#business_type_id').trigger('change');
        }

        /* ============================================================
         | FEATURES — ADD / REMOVE
         ============================================================ */
        $('#btn-add-feature').click(function () {
            $('#feature-container').append(`
                <div class="flex items-center gap-4 feature-row">
                    <div class="grid grid-cols-2 gap-4 flex-1">
                        <input type="text" name="feature_key[]" placeholder="Feature Key"
                            class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                        <input type="text" name="feature_value[]" placeholder="Feature Value"
                            class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                    </div>
                    <button type="button"
                        class="btn-remove-feature text-red-500 hover:text-red-700 font-bold px-2 text-[14px]">✕</button>
                </div>
            `);
        });

        $(document).on('click', '.btn-remove-feature', function () {
            if ($('.feature-row').length > 1) {
                $(this).closest('.feature-row').remove();
            } else {
                alert('At least one feature row is required.');
            }
        });

        /* ============================================================
         | NEW IMAGE UPLOAD — LIVE PREVIEW
         ============================================================ */
        $('#service_img').on('change', function (e) {
            let preview = $('#image-live-preview');
            preview.html('');

            Array.from(e.target.files).forEach(file => {
                let reader = new FileReader();
                reader.onload = function (event) {
                    preview.append(`
                        <div class="border rounded-xl overflow-hidden shadow-sm">
                            <img src="${event.target.result}" class="w-full h-36 object-cover">
                            <div class="p-2 text-xs text-gray-600 truncate">${file.name}</div>
                        </div>
                    `);
                };
                reader.readAsDataURL(file);
            });
        });

        /* ============================================================
         | REMOVE EXISTING SAVED IMAGE
         | Removes hidden input → controller won't keep this file
         ============================================================ */
        $(document).on('click', '.remove-existing-image', function () {
            $(this).siblings('input[name="old_images[]"]').remove();
            $(this).closest('.existing-image').remove();
        });

        /* ============================================================
         | REMOVE EXISTING DATASHEET
         | Removes hidden keep_datasheet flag → controller will delete it
         ============================================================ */
        $('#remove-datasheet').on('click', function () {
            $('#keep_datasheet').remove();
            $(this).closest('.existing-datasheet').remove();
        });

    });
</script>