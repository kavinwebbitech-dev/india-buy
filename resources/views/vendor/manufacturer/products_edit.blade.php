{{-- resources/views/vendor/manufacturer/edit_product.blade.php --}}

@include('vendor.Layout.head')

@include('vendor.Layout.top_bar')
@include('vendor.Layout.main_header')

@php
    $keyValues = json_decode($product->key_value, true) ?? [];
    $specifications = json_decode($product->specification, true) ?? [];
    $images = json_decode($product->image, true) ?? [];
@endphp

<div class="min-h-screen py-8">

    <div class="max-w-7xl mx-auto px-4">

        @include('vendor.Layout.menu_bar')

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold">Edit Product</h2>
                <p class="text-sm text-gray-500 mt-1">Update Product</p>
            </div>

            <a href="{{ route('manufacturer.product.list') }}"
                class="px-5 py-2.5 rounded-xl border border-gray-200 bg-white shadow-sm hover:bg-gray-50 transition-colors">
                ← Back
            </a>
        </div>

        <form action="{{ route('manufacturer.product.update', $product->id) }}" method="POST"
            enctype="multipart/form-data" class="space-y-8">

            @csrf
            @method('PUT')

            <div class="max-w-6xl mx-auto space-y-8">

                {{-- HEADER BANNER --}}
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white p-6 rounded-2xl shadow">
                    <h2 class="text-2xl font-bold">Edit Product Details</h2>
                    <p class="text-sm opacity-90">Modify and update product information cleanly and professionally</p>
                </div>

                {{-- STEP 1 --}}
                <div class="bg-white rounded-2xl border shadow-sm p-6">
                    <h3 class="text-lg font-bold mb-6 border-b pb-3">1. Product Classification</h3>

                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="text-sm font-semibold text-gray-600">Business Type</label>
                            <select id="buisness_type" name="business_type"
                                class="w-full mt-2 h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400 outline-none">
                                <option value="">Select Business Type</option>
                                @foreach ($businessType as $business)
                                    <option value="{{ $business->id }}"
                                        {{ $product->business_type_id == $business->id ? 'selected' : '' }}>
                                        {{ $business->business_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Category</label>
                            <select id="category_id" name="category"
                                class="w-full mt-2 h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400 outline-none">
                                <option value="">Select Category</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Sub Category</label>
                            <select id="sub_category_id" name="sub_category"
                                class="w-full mt-2 h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400 outline-none">
                                <option value="">Select Sub Category</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Product Name</label>
                            <input type="text" name="product_name" value="{{ $product->product_name }}"
                                class="w-full mt-2 h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400 outline-none"
                                placeholder="Enter product name">
                        </div>
                    </div>
                </div>

                {{-- STEP 2 --}}
                <div class="bg-white rounded-2xl border shadow-sm p-6">
                    <h3 class="text-lg font-bold mb-6 border-b pb-3">2. Basic Information</h3>

                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="text-sm font-semibold text-gray-600">Brand</label>
                            <input type="text" name="brand" value="{{ $product->brand }}" placeholder="Brand"
                                class="w-full mt-2 h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400 outline-none">
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Model Number</label>
                            <input type="text" name="model_number" value="{{ $product->model_number }}"
                                placeholder="Model Number"
                                class="w-full mt-2 h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400 outline-none">
                        </div>

                        <div class="md:col-span-2">
                            <label class="text-sm font-semibold text-gray-600">Short Description</label>
                            <textarea name="short_description" rows="4" placeholder="Short Description"
                                class="w-full mt-2 border rounded-xl p-4 focus:ring-2 focus:ring-indigo-400 outline-none">{{ $product->short_description }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- STEP 3 --}}
                <div class="bg-white rounded-2xl border shadow-sm p-6">
                    <div class="flex justify-between items-center mb-5 border-b pb-3">
                        <h3 class="text-lg font-bold">3. Key Values</h3>
                        <button type="button" id="addKeyValue"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-sm hover:bg-indigo-700 transition-colors">
                            + Add
                        </button>
                    </div>

                    <div id="keyValueWrapper">
                        @if (count($keyValues) > 0)
                            @foreach ($keyValues as $kv)
                                {{-- <div class="grid grid-cols-2 gap-4 mb-4">
                                    <input type="text" name="key_name[]" value="{{ $kv['key'] ?? '' }}" placeholder="Key"
                                        class="h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400 outline-none">
                                    <input type="text" name="key_value[]" value="{{ $kv['value'] ?? '' }}" placeholder="Value"
                                        class="h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400 outline-none">
                                </div> --}}

                                <div class="grid grid-cols-5 gap-4 mb-4 key-row">
                                    <input type="text" name="key_name[]" value="{{ $kv['key'] ?? '' }}"
                                        placeholder="Key" class="col-span-2 h-11 border rounded-xl px-4">

                                    <input type="text" name="key_value[]" value="{{ $kv['value'] ?? '' }}"
                                        placeholder="Value" class="col-span-2 h-11 border rounded-xl px-4">

                                    <button type="button" class="remove-row bg-red-500 text-white rounded-xl">
                                        Remove
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="grid grid-cols-5 gap-4 mb-4 key-row">
                                <input type="text" name="key_name[]" value="{{ $kv['key'] ?? '' }}"
                                    placeholder="Key" class="col-span-2 h-11 border rounded-xl px-4">

                                <input type="text" name="key_value[]" value="{{ $kv['value'] ?? '' }}"
                                    placeholder="Value" class="col-span-2 h-11 border rounded-xl px-4">

                                <button type="button" class="remove-row bg-red-500 text-white rounded-xl">
                                    Remove
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- STEP 4 --}}
                <div class="bg-white rounded-2xl border shadow-sm p-6">
                    <div class="flex justify-between items-center mb-5 border-b pb-3">
                        <h3 class="text-lg font-bold">4. Specifications</h3>
                        <button type="button" id="addSpecification"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-sm hover:bg-indigo-700 transition-colors">
                            + Add
                        </button>
                    </div>

                    <div id="specificationWrapper">
                        @if (count($specifications) > 0)
                            @foreach ($specifications as $sp)
                                {{-- <div class="grid grid-cols-2 gap-4 mb-4">
                                    <input type="text" name="specification_name[]" value="{{ $sp['name'] ?? '' }}"
                                        placeholder="Specification"
                                        class="h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400 outline-none">
                                    <input type="text" name="specification_value[]"
                                        value="{{ $sp['value'] ?? '' }}" placeholder="Value"
                                        class="h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400 outline-none">
                                </div> --}}

                                <div class="grid grid-cols-5 gap-4 mb-4 spec-row">
                                    <input type="text" name="specification_name[]"
                                        value="{{ $sp['name'] ?? '' }}" placeholder="Specification"
                                        class="col-span-2 h-11 border rounded-xl px-4">

                                    <input type="text" name="specification_value[]"
                                        value="{{ $sp['value'] ?? '' }}" placeholder="Value"
                                        class="col-span-2 h-11 border rounded-xl px-4">

                                    <button type="button" class="remove-row bg-red-500 text-white rounded-xl">
                                        Remove
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="grid grid-cols-5 gap-4 mb-4 spec-row">
                                <input type="text" name="specification_name[]" value="{{ $sp['name'] ?? '' }}"
                                    placeholder="Specification" class="col-span-2 h-11 border rounded-xl px-4">

                                <input type="text" name="specification_value[]" value="{{ $sp['value'] ?? '' }}"
                                    placeholder="Value" class="col-span-2 h-11 border rounded-xl px-4">

                                <button type="button" class="remove-row bg-red-500 text-white rounded-xl">
                                    Remove
                                </button>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- STEP 5 --}}
                <div class="bg-white rounded-2xl border shadow-sm p-6">
                    <h3 class="text-lg font-bold mb-4">5. Product Details</h3>
                    <textarea name="product_details" rows="6"
                        class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-indigo-400 outline-none"
                        placeholder="Enter full product details">{{ $product->product_details }}</textarea>
                </div>

                {{-- STEP 6 --}}
                <div class="bg-white rounded-2xl border shadow-sm p-6">
                    <h3 class="text-lg font-bold mb-4">6. Product Images</h3>

                    @if (count($images) > 0)
                        <div class="mb-5 bg-gray-50 p-4 rounded-xl border">
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Current Active
                                Images</p>
                            <div class="flex gap-3 flex-wrap">

                                @foreach ($images as $img)
                                    <div class="relative existing-image">

                                        <img src="{{ asset('uploads/products/' . $img) }}"
                                            class="w-20 h-20 object-cover rounded-xl border shadow-sm">

                                        <button type="button"
                                            class="remove-existing-image absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-6 h-6"
                                            data-image="{{ $img }}">
                                            ×
                                        </button>

                                        <input type="hidden" name="old_images[]" value="{{ $img }}">

                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endif


                    <label class="block text-sm font-semibold text-gray-600 mb-2">Upload and replace / add
                        images</label>
                    <input type="file" id="imageInput" name="image[]" multiple
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-400 outline-none">

                    <div id="preview" class="grid grid-cols-5 gap-4 mt-5"></div>
                </div>

                {{-- STEP 7 --}}
                {{-- <div class="bg-white rounded-2xl border shadow-sm p-6">
                    <h3 class="text-lg font-bold mb-4">7. Data Sheet</h3>

                   @if ($product->data_sheet)
                        <div class="mb-4">
                            <a href="{{ asset('uploads/datasheets/' . $product->data_sheet) }}"
                                target="_blank"
                                class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800 hover:underline">
                                📎 View Current Data Sheet Document
                            </a>
                        </div>
                    @endif
                    <input type="file" name="data_sheet" multiple
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-400 outline-none">
                </div> --}}

                <div class="bg-white rounded-2xl border shadow-sm p-6">

                    <h3 class="text-lg font-bold mb-4">7. Data Sheets</h3>

                    @php
                        $datasheets = json_decode($product->data_sheet, true) ?? [];
                    @endphp

                    <div class="mb-5">

                        <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">
                            Current Documents
                        </p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            @foreach ($datasheets as $sheet)
                                <div class="relative border rounded-xl p-3 bg-gray-50 existing-doc">

                                    <div class="flex items-center gap-3">

                                        <div class="text-red-500 text-xl">📄</div>

                                        <div class="flex-1">

                                            <div class="text-sm font-medium truncate">
                                                {{ $sheet }}
                                            </div>

                                            <a href="{{ asset('uploads/datasheets/' . $sheet) }}" target="_blank"
                                                class="text-xs text-indigo-600 hover:underline">
                                                View File
                                            </a>

                                        </div>

                                        <button type="button"
                                            class="remove-existing-doc bg-red-600 text-white w-6 h-6 rounded-full">
                                            ×
                                        </button>

                                    </div>

                                    <input type="hidden" name="old_datasheets[]" value="{{ $sheet }}">

                                </div>
                            @endforeach

                        </div>

                    </div>

                    <input type="file" name="data_sheet[]" multiple accept=".pdf,.doc,.docx,.xls,.xlsx"
                        class="w-full border rounded-xl px-4 py-3">

                </div>

                {{-- SUBMIT --}}
                <div class="flex justify-end">
                    <button
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-10 py-3 rounded-xl shadow transition-colors font-medium">
                        Update Product
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

@include('vendor.Layout.footer')

{{-- JQUERY --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function() {

        // 1. ADD KEY VALUE
        // $('#addKeyValue').click(function() {
        //     $('#keyValueWrapper').append(`
        //         <div class="grid grid-cols-2 gap-4 mb-4">
        //             <input type="text" name="key_name[]" placeholder="Key" class="h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400 outline-none">
        //             <input type="text" name="key_value[]" placeholder="Value" class="h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400 outline-none">
        //         </div>
        //     `);
        // });


        $('#data_sheet').on('change', function() {

            $('#datasheet-live-preview').html('');

            Array.from(this.files).forEach(file => {

                $('#datasheet-live-preview').append(`
            <div class="flex items-center gap-3 p-3 border rounded-xl bg-blue-50">

                <div class="text-blue-500 text-xl">📄</div>

                <div class="overflow-hidden">
                    <div class="text-sm font-medium truncate">
                        ${file.name}
                    </div>
                </div>

            </div>
        `);

            });

        });

        $('#addKeyValue').click(function() {

            $('#keyValueWrapper').append(`
        <div class="grid grid-cols-5 gap-4 mb-4 key-row">

            <input type="text"
                name="key_name[]"
                placeholder="Key"
                class="col-span-2 h-11 border rounded-xl px-4">

            <input type="text"
                name="key_value[]"
                placeholder="Value"
                class="col-span-2 h-11 border rounded-xl px-4">

            <button type="button"
                class="remove-row bg-red-500 text-white rounded-xl">
                Remove
            </button>

        </div>
    `);

        });

        // 2. ADD SPECIFICATION
        // $('#addSpecification').click(function() {
        //     $('#specificationWrapper').append(`
        //         <div class="grid grid-cols-2 gap-4 mb-4">
        //             <input type="text" name="specification_name[]" placeholder="Specification Name" class="h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400 outline-none">
        //             <input type="text" name="specification_value[]" placeholder="Specification Value" class="h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400 outline-none">
        //         </div>
        //     `);
        // });

        $('#addSpecification').click(function() {

            $('#specificationWrapper').append(`
        <div class="grid grid-cols-5 gap-4 mb-4 spec-row">

            <input type="text"
                name="specification_name[]"
                placeholder="Specification"
                class="col-span-2 h-11 border rounded-xl px-4">

            <input type="text"
                name="specification_value[]"
                placeholder="Value"
                class="col-span-2 h-11 border rounded-xl px-4">

            <button type="button"
                class="remove-row bg-red-500 text-white rounded-xl">
                Remove
            </button>

        </div>
    `);

        });

        $(document).on('click', '.remove-row', function() {
            $(this).closest('.key-row, .spec-row').remove();
        });

        // 3. LIVE ASYNC IMAGE PREVIEW
        // $('#imageInput').on('change', function() {
        //     $('#preview').html('');
        //     let files = this.files;

        //     $.each(files, function(index, file) {
        //         let reader = new FileReader();
        //         reader.onload = function(e) {
        //             $('#preview').append(`
        //                 <div class="border rounded-xl overflow-hidden shadow-sm">
        //                     <img src="${e.target.result}" class="w-full h-32 object-cover">
        //                 </div>
        //             `);
        //         }
        //         reader.readAsDataURL(file);
        //     });
        // });

        let dt = new DataTransfer();

        $('#imageInput').on('change', function() {

            $('#preview').html('');
            dt = new DataTransfer();

            Array.from(this.files).forEach((file, index) => {

                dt.items.add(file);

                let reader = new FileReader();

                reader.onload = function(e) {

                    $('#preview').append(`
                <div class="relative image-item border rounded-xl overflow-hidden"
                     data-index="${index}">

                    <img src="${e.target.result}"
                         class="w-full h-32 object-cover">

                    <button type="button"
                        class="remove-image absolute top-2 right-2 bg-red-600 text-white rounded-full w-7 h-7 flex items-center justify-center">
                        ×
                    </button>

                </div>
            `);
                };

                reader.readAsDataURL(file);
            });

            $('#imageInput')[0].files = dt.files;
        });

        $(document).on('click', '.remove-image', function() {

            let removeIndex = $(this).closest('.image-item').data('index');

            let newDt = new DataTransfer();

            Array.from($('#imageInput')[0].files).forEach((file, index) => {

                if (index != removeIndex) {
                    newDt.items.add(file);
                }

            });

            $('#imageInput')[0].files = newDt.files;

            $(this).closest('.image-item').remove();

        });


        $(document).on('click', '.remove-existing-image', function() {

            $(this).siblings('input[name="old_images[]"]').remove();

            $(this).closest('.existing-image').remove();

        });

        // 4. DYNAMIC CASCADING DROPDOWN LOGIC
        const currentBusinessId = "{{ $product->business_type_id ?? '' }}";
        const currentCategoryId = "{{ $product->category_id ?? '' }}";
        const currentSubCategoryId = "{{ $product->sub_category_id ?? '' }}";

        // Business Type change handler
        $('#buisness_type').on('change', function() {
            let business_id = $(this).val();

            if (!business_id) {
                $('#category_id').html('<option value="">Select Category</option>');
                $('#sub_category_id').html('<option value="">Select Sub Category</option>');
                return;
            }

            $('#category_id').html('<option value="">Loading Categories...</option>');

            $.ajax({
                url: "{{ route('get.categories') }}",
                type: "GET",
                data: {
                    business_id: business_id
                },
                success: function(response) {
                    let options = '<option value="">Select Category</option>';
                    $.each(response, function(key, value) {
                        let selected = (value.id == currentCategoryId) ?
                            'selected' : '';
                        options +=
                            `<option value="${value.id}" ${selected}>${value.category_name}</option>`;
                    });
                    $('#category_id').html(options);

                    // Category லோட் ஆனவுடன் உடனே Sub-Category-ஐ இயக்கும்
                    $('#category_id').trigger('change');
                },
                error: function() {
                    $('#category_id').html(
                        '<option value="">Error loading categories</option>');
                }
            });
        });


        $(document).on('click', '.remove-existing-doc', function() {

            $(this)
                .closest('.existing-doc')
                .find('input[name="old_datasheets[]"]')
                .remove();

            $(this)
                .closest('.existing-doc')
                .remove();
        });

        // Category change handler
        $('#category_id').on('change', function() {
            let category_id = $(this).val();

            if (!category_id) {
                $('#sub_category_id').html('<option value="">Select Sub Category</option>');
                return;
            }

            $('#sub_category_id').html('<option value="">Loading Sub Categories...</option>');

            $.ajax({
                url: "{{ route('manufacturer.get.subcategories') }}",
                type: "GET",
                data: {
                    category_id: category_id
                },
                success: function(response) {
                    let options = '<option value="">Select Sub Category</option>';
                    $.each(response, function(key, value) {
                        let selected = (value.id == currentSubCategoryId) ?
                            'selected' : '';
                        options +=
                            `<option value="${value.id}" ${selected}>${value.sub_category_name}</option>`;
                    });
                    $('#sub_category_id').html(options);
                },
                error: function() {
                    $('#sub_category_id').html(
                        '<option value="">Error loading sub categories</option>');
                }
            });
        });

        // பக்கத்தை ஏற்றும்போது தானாகவே முதல் AJAX-ஐ இயக்கும் (Trigger Initial Load)
        if (currentBusinessId) {
            $('#buisness_type').val(currentBusinessId).trigger('change');
        }
    });
</script>
