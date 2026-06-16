@include('vendor.Layout.head')

@include('vendor.Layout.top_bar')
@include('vendor.Layout.main_header')

<div class="bg-slate-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4">
        @include('vendor.Layout.menu_bar')

        <form action="{{ route('service.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="flex flex-col h-full bg-slate-50">
                {{-- HEADER --}}
                <div
                    class="px-6 py-5 border border-gray-100 rounded-t-3xl flex items-center justify-between bg-white shadow-sm">
                    <div>
                        <h2 class="text-[20px] font-bold text-gray-900 mb-1">Service Setup</h2>
                        <p class="text-[13px] text-gray-500 font-medium">Fill your service details</p>
                    </div>
                </div>

                {{-- BODY --}}
                <div class="border border-t-0 border-gray-100 rounded-b-3xl bg-white">
                    <div class="p-6 lg:p-8">

                        {{-- NOTIFICATIONS --}}
                        @if (session('success'))
                            <div class="mb-5 p-4 rounded-xl bg-green-100 text-green-700">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="mb-5 p-4 rounded-xl bg-red-100 text-red-700">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="max-w-5xl mx-auto space-y-6">

                            {{-- 1. SERVICE DETAILS (Business Type -> Category -> Sub Category -> Service Name) --}}
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                                <h3 class="text-[16px] font-bold text-gray-900 mb-5">1. Service Details</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    {{-- BUSINESS TYPE --}}
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Business
                                            Type</label>
                                        <select name="business_type" id="business_type_id"
                                            class="w-full h-11 px-4 border rounded-xl text-[13px] border-gray-200">
                                            <option value="">Select Business Type</option>
                                            @foreach ($businessType as $type)
                                                <option value="{{ $type->id }}"
                                                    {{ old('business_type') == $type->id ? 'selected' : '' }}>
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
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Sub
                                            Category</label>
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
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Service
                                            Name</label>
                                        <input type="text" name="service_name" value="{{ old('service_name') }}"
                                            class="w-full h-11 px-4 border rounded-xl text-[13px] @error('service_name') border-red-500 @else border-gray-200 @enderror">
                                        @error('service_name')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- SHORT DESCRIPTION --}}
                                    <div class="md:col-span-2">
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Short
                                            Description</label>
                                        <textarea rows="3" name="short_description"
                                            class="w-full p-4 border rounded-xl text-[13px] @error('short_description') border-red-500 @else border-gray-200 @enderror">{{ old('short_description') }}</textarea>
                                        @error('short_description')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- LONG DESCRIPTION --}}
                                    <div class="md:col-span-2">
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Long
                                            Description</label>
                                        <textarea rows="6" name="long_description"
                                            class="w-full p-4 border rounded-xl text-[13px] @error('long_description') border-red-500 @else border-gray-200 @enderror">{{ old('long_description') }}</textarea>
                                        @error('long_description')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- 2. PRICING & LOCATION (Location Fields -> Price Type -> Price) --}}
                            {{-- PRICING DETAILS --}}
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                                <h3 class="text-[16px] font-bold text-gray-900 mb-5">2. Pricing Details</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    {{-- PRICE TYPE --}}
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Price
                                            Type</label>
                                        <select name="price_type"
                                            class="w-full h-11 px-4 border rounded-xl text-[13px] border-gray-200">
                                            <option value="">Select</option>
                                            <option value="fixed"
                                                {{ old('price_type') == 'fixed' ? 'selected' : '' }}>Fixed</option>
                                            <option value="hourly"
                                                {{ old('price_type') == 'hourly' ? 'selected' : '' }}>Hourly</option>
                                            <option value="negotiable"
                                                {{ old('price_type') == 'negotiable' ? 'selected' : '' }}>Negotiable
                                            </option>
                                        </select>
                                        @error('price_type')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- PRICE --}}
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Price</label>
                                        <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                                            placeholder="0.00"
                                            class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                                        @error('price')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- LOCATION DETAILS --}}
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                                <h3 class="text-[16px] font-bold text-gray-900 mb-5">3. Location Details</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    {{-- STATE --}}
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">State</label>
                                        <input type="text" name="state" value="{{ old('state') }}"
                                            class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                                        @error('state')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    {{-- CITY --}}
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">City</label>
                                        <input type="text" name="city" value="{{ old('city') }}"
                                            class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                                        @error('city')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- 3. AVAILABILITY --}}
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                                <h3 class="text-[16px] font-bold text-gray-900 mb-5">4. Availability</h3>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Available
                                            Days</label>
                                        <input type="text" name="available_days" value="{{ old('available_days') }}"
                                            placeholder="Mon - Sat"
                                            class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                                        @error('available_days')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Opening
                                            Time</label>
                                        <input type="time" name="opening_time" value="{{ old('opening_time') }}"
                                            class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                                        @error('opening_time')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-1.5">Closing
                                            Time</label>
                                        <input type="time" name="closing_time" value="{{ old('closing_time') }}"
                                            class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                                        @error('closing_time')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- 4. FEATURES --}}
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                                <h3 class="text-[16px] font-bold text-gray-900 mb-5">5. Features</h3>

                                <div id="feature-container" class="space-y-4 mb-4">
                                    @if (old('feature_key'))
                                        @foreach (old('feature_key') as $index => $feature)
                                            <div class="flex items-center gap-4 feature-row">
                                                <div class="grid grid-cols-2 gap-4 flex-1">
                                                    <input type="text" name="feature_key[]"
                                                        value="{{ old('feature_key.' . $index) }}"
                                                        placeholder="Feature Key"
                                                        class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">

                                                    <input type="text" name="feature_value[]"
                                                        value="{{ old('feature_value.' . $index) }}"
                                                        placeholder="Feature Value"
                                                        class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                                                </div>
                                                <button type="button"
                                                    class="btn-remove-feature text-red-500 hover:text-red-700 font-bold px-2 text-[14px]">✕</button>
                                            </div>
                                        @endforeach
                                    @else
                                        {{-- Default single row on load --}}
                                        <div class="flex items-center gap-4 feature-row">
                                            <div class="grid grid-cols-2 gap-4 flex-1">
                                                <input type="text" name="feature_key[]" placeholder="Feature Key"
                                                    class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                                                <input type="text" name="feature_value[]"
                                                    placeholder="Feature Value"
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

                            {{-- 5. MEDIA FILES --}}
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                                <h3 class="text-[16px] font-bold text-gray-900 mb-5">6. Media Files</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Datasheet</label>
                                        <input type="file" name="datasheet"
                                            class="w-full p-3 border border-gray-200 rounded-xl text-[13px]">
                                        @error('datasheet')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="block text-[13px] font-bold text-gray-700 mb-2">Service Image</label>
                                        <input type="file" name="service_img[]" multiple
                                            class="w-full p-3 border border-gray-200 rounded-xl text-[13px] @error('service_img') border-red-500 @enderror">

                                        @error('service_img')
                                            <p class="text-red-500 text-[12px] mt-1">{{ $message }}</p>
                                        @enderror
                                        @error('service_img.*')
                                            <p class="text-red-500 text-[12px] mt-1">One or more files are invalid images.</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- FOOTER BUTTON --}}
                    <div class="p-4 border-t border-gray-100 bg-white flex justify-end">
                        <button type="submit"
                            class="bg-primary text-white px-8 py-3 rounded-xl text-[13px] font-bold">
                            Save Service
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
    $(document).ready(function() {

        // Dynamic Feature Row Adding
        $('#btn-add-feature').click(function() {
            let newRow = `
                <div class="flex items-center gap-4 feature-row">
                    <div class="grid grid-cols-2 gap-4 flex-1">
                        <input type="text" name="feature_key[]" placeholder="Feature Key" class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                        <input type="text" name="feature_value[]" placeholder="Feature Value" class="w-full h-11 px-4 border border-gray-200 rounded-xl text-[13px]">
                    </div>
                    <button type="button" class="btn-remove-feature text-red-500 hover:text-red-700 font-bold px-2 text-[14px]">✕</button>
                </div>`;
            $('#feature-container').append(newRow);
        });

        // Dynamic Feature Row Removing
        $(document).on('click', '.btn-remove-feature', function() {
            if ($('.feature-row').length > 1) {
                $(this).closest('.feature-row').remove();
            } else {
                alert('At least one feature row is required.');
            }
        });

        // Retention of selected IDs on Validation Fail
        let oldCategory = "{{ old('category') }}";
        let oldSubcategory = "{{ old('subcategory') }}";

        // Trigger dynamic fetch on page load if old business type exists
        if ($('#business_type_id').val()) {
            $('#business_type_id').trigger('change');
        }

        // BUSINESS TYPE -> CATEGORY
        $('#business_type_id').on('change', function() {
            let business_id = $(this).val();
            if (!business_id) {
                $('#category_id').html('<option value="">Select Category</option>');
                $('#subcategory_id').html('<option value="">Select Subcategory</option>');
                return;
            }

            $('#category_id').html('<option value="">Loading...</option>');

            $.ajax({
                url: "{{ route('get.categories') }}",
                type: "GET",
                data: {
                    business_id: business_id
                },
                success: function(response) {
                    let html = '<option value="">Select Category</option>';
                    $.each(response, function(key, value) {
                        let selected = (oldCategory == value.id) ? 'selected' : '';
                        html +=
                            `<option value="${value.id}" ${selected}>${value.category_name}</option>`;
                    });
                    $('#category_id').html(html);
                    $('#subcategory_id').html(
                        '<option value="">Select Subcategory</option>');

                    if (oldCategory) {
                        $('#category_id').trigger('change');
                        oldCategory = ""; // Clear after trigger
                    }
                }
            });
        });

        // CATEGORY -> SUBCATEGORY
        $('#category_id').on('change', function() {
            let category_id = $(this).val();
            if (!category_id) {
                $('#subcategory_id').html('<option value="">Select Subcategory</option>');
                return;
            }

            $('#subcategory_id').html('<option value="">Loading...</option>');

            $.ajax({
                url: "{{ route('get.subcategories') }}",
                type: "GET",
                data: {
                    category_id: category_id,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    let html = '<option value="">Select Subcategory</option>';
                    $.each(response, function(key, value) {
                        let selected = (oldSubcategory == value.id) ? 'selected' :
                            '';
                        html +=
                            `<option value="${value.id}" ${selected}>${value.sub_category_name}</option>`;
                    });
                    $('#subcategory_id').html(html);
                    oldSubcategory = ""; // Clear after load
                }
            });
        });
    });
</script>
