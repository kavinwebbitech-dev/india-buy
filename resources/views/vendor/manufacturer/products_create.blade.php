{{-- resources/views/vendor/manufacturer/add_product.blade.php --}}

@include('vendor.Layout.head')


@include('vendor.Layout.top_bar')
@include('vendor.Layout.main_header')

<div class="min-h-screen py-8">

    <div class="max-w-7xl mx-auto px-4">

        @include('vendor.Layout.menu_bar')

        <div class="flex items-center justify-between mb-6">

            <div>
                <h2 class="text-2xl font-bold">
                    Add Product
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Create Product
                </p>
            </div>

            <a href="{{ route('manufacturer.product.list') }}"
                class="px-5 py-2.5 rounded-xl border border-gray-200 bg-white">
                ← Back
            </a>

        </div>

        <form action="{{ route('manufacturer.product.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-8">

            @csrf

            <div class="max-w-6xl mx-auto space-y-8">

                {{-- HEADER --}}
                <div class="bg-gradient-to-r from-indigo-500 to-purple-600 text-white p-6 rounded-2xl shadow">
                    <h2 class="text-2xl font-bold">Create New Product</h2>
                    <p class="text-sm opacity-90">Add and manage product details professionally</p>
                </div>

                {{-- STEP 1 --}}
                <div class="bg-white rounded-2xl border shadow-sm p-6">
                    <h3 class="text-lg font-bold mb-6 border-b pb-3">1. Product Classification</h3>

                    <div class="grid md:grid-cols-2 gap-5">

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Business Type</label>
                            <select id="buisness_type" name="business_type"
                                class="w-full mt-2 h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400 outline-none">
                                <option>Select Business Type</option>
                                @foreach ($businessType as $business)
                                    <option value="{{ $business->id }}">{{ $business->business_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Category</label>
                            <select id="category_id" name="category"
                                class="w-full mt-2 h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400 outline-none">
                                <option>Select Category</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Sub Category</label>
                            <select id="sub_category_id" name="sub_category"
                                class="w-full mt-2 h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400 outline-none">
                                <option>Select Sub Category</option>
                            </select>
                        </div>

                        <div>
                            <label class="text-sm font-semibold text-gray-600">Product Name</label>
                            <input type="text" name="product_name"
                                class="w-full mt-2 h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400 outline-none"
                                placeholder="Enter product name">
                        </div>

                    </div>
                </div>

                {{-- STEP 2 --}}
                <div class="bg-white rounded-2xl border shadow-sm p-6">
                    <h3 class="text-lg font-bold mb-6 border-b pb-3">2. Basic Information</h3>

                    <div class="grid md:grid-cols-2 gap-5">

                        <input type="text" name="brand" placeholder="Brand"
                            class="h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400">

                        <input type="text" name="model_number" placeholder="Model Number"
                            class="h-11 border rounded-xl px-4 focus:ring-2 focus:ring-indigo-400">

                        <div class="md:col-span-2">
                            <textarea name="short_description" rows="4" placeholder="Short Description"
                                class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-indigo-400"></textarea>
                        </div>

                    </div>
                </div>

                {{-- STEP 3 --}}
                <div class="bg-white rounded-2xl border shadow-sm p-6">
                    <div class="flex justify-between items-center mb-5 border-b pb-3">
                        <h3 class="text-lg font-bold">3. Key Values</h3>

                        <button type="button" id="addKeyValue"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-sm hover:bg-indigo-700">
                            + Add
                        </button>
                    </div>

                    <div id="keyValueWrapper">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <input type="text" name="key_name[]" placeholder="Key"
                                class="h-11 border rounded-xl px-4">

                            <input type="text" name="key_value[]" placeholder="Value"
                                class="h-11 border rounded-xl px-4">
                        </div>
                    </div>
                </div>

                {{-- STEP 4 --}}
                <div class="bg-white rounded-2xl border shadow-sm p-6">
                    <div class="flex justify-between items-center mb-5 border-b pb-3">
                        <h3 class="text-lg font-bold">4. Specifications</h3>

                        <button type="button" id="addSpecification"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-sm hover:bg-indigo-700">
                            + Add
                        </button>
                    </div>

                    <div id="specificationWrapper">
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <input type="text" name="specification_name[]" placeholder="Specification"
                                class="h-11 border rounded-xl px-4">

                            <input type="text" name="specification_value[]" placeholder="Value"
                                class="h-11 border rounded-xl px-4">
                        </div>
                    </div>
                </div>

                {{-- STEP 5 --}}
                <div class="bg-white rounded-2xl border shadow-sm p-6">
                    <h3 class="text-lg font-bold mb-4">5. Product Details</h3>

                    <textarea name="product_details" rows="6" class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-indigo-400"
                        placeholder="Enter full product details"></textarea>
                </div>

                {{-- STEP 6 --}}
                <div class="bg-white rounded-2xl border shadow-sm p-6">
                    <h3 class="text-lg font-bold mb-4">6. Product Images</h3>

                    {{-- <input type="file" name="image[]" multiple class="w-full border rounded-xl px-4 py-3"> --}}
                    <input type="file" id="imageInput" name="image[]" multiple
                        class="w-full border rounded-xl px-4 py-3">
                    {{-- <div id="preview" class="grid grid-cols-5 gap-4 mt-5"></div> --}}
                    <div id="preview" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4 mt-5"></div>
                </div>

                {{-- STEP 7 --}}
                <div class="bg-white rounded-2xl border shadow-sm p-6">
                    <h3 class="text-lg font-bold mb-4">7. Data Sheet</h3>

                    <input type="file" name="data_sheet[]" multiple class="w-full border rounded-xl px-4 py-3">
                </div>

                {{-- SUBMIT --}}
                <div class="flex justify-end">
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-10 py-3 rounded-xl shadow">
                        Save Product
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

        // ADD KEY VALUE

        $('#addKeyValue').click(function() {

            $('#keyValueWrapper').append(`
             <div class="grid grid-cols-5 gap-4 mb-4 key-row">

            <input type="text"
                name="key_name[]"
                placeholder="Key"
                class="col-span-2 h-12 border rounded-xl px-4">

            <input type="text"
                name="key_value[]"
                placeholder="Value"
                class="col-span-2 h-12 border rounded-xl px-4">

            <button type="button"
                class="remove-row bg-red-500 text-white rounded-xl">
                Remove
            </button>

        </div>
    `);

        });




        // ADD SPECIFICATION

        $('#addSpecification').click(function() {

            $('#specificationWrapper').append(`
        <div class="grid grid-cols-5 gap-4 mb-4 spec-row">

            <input type="text"
                name="specification_name[]"
                placeholder="Specification"
                class="col-span-2 h-12 border rounded-xl px-4">

            <input type="text"
                name="specification_value[]"
                placeholder="Value"
                class="col-span-2 h-12 border rounded-xl px-4">

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
        // Business Type -> Category
        $('#buisness_type').on('change', function() {

            let buisness_type = $(this).val();

            $('#category_id').html(
                '<option value="">Loading...</option>'
            );

            $.ajax({

                url: "{{ route('get.categories') }}",

                type: "GET",

                data: {
                    business_id: buisness_type
                },

                success: function(response) {

                    $('#category_id').html(
                        '<option value="">Select Category</option>'
                    );

                    $.each(response, function(key, value) {

                        $('#category_id').append(
                            `<option value="${value.id}">
                    ${value.category_name}
                </option>`
                        );

                    });

                    $('#sub_category_id').html(
                        '<option value="">Select Sub Category</option>'
                    );

                }

            });

        });

        // CATEGORY AJAX

        $('#category_id').change(function() {

            let category_id = $(this).val();

            $.ajax({

                url: "{{ route('manufacturer.get.subcategories') }}",

                type: "GET",

                data: {
                    category_id: category_id
                },

                success: function(response) {

                    $('#sub_category_id').html(
                        '<option value="">Select Sub Category</option>'
                    );

                    $.each(response, function(key, value) {

                        $('#sub_category_id').append(

                            `<option value="${value.id}">
                            ${value.sub_category_name}
                        </option>`

                        );

                    });

                }

            });

        });


        // IMAGE PREVIEW

        $('#imageInput').on('change', function() {

            $('#preview').html('');

            let files = this.files;

            $.each(files, function(index, file) {

                let reader = new FileReader();

                reader.onload = function(e) {

                    $('#preview').append(`
                <div class="relative border rounded-xl overflow-hidden image-item">

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

        });

        $(document).on('click', '.remove-image', function() {
            $(this).closest('.image-item').remove();
        });

    });
</script>
