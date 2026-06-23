@include('vendor.Layout.head')

@include('vendor.Layout.top_bar')
@include('vendor.Layout.main_header')

@php
    $features = json_decode($property->features ?? '[]', true);
    $specifications = json_decode($property->specification ?? '[]', true);
    $images = json_decode($property->proerty_image ?? '[]', true);
    $documents = json_decode($property->documents ?? '[]', true);
@endphp

<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4">
        @include('vendor.Layout.menu_bar')

        <form action="{{ route('relastate.product.update', $property->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if ($errors->any())
                <div class="bg-red-50 border border-red-300 text-red-700 p-4 rounded-xl mb-4">
                    <h4 class="font-semibold mb-2">Please fix the following errors:</h4>
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-100 border border-green-300 text-green-700 p-4 rounded-xl mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-xl mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">
                {{-- HEADER --}}
                <div class="p-6 border-b bg-gradient-to-r from-slate-800 to-slate-900 text-white">
                    <h2 class="text-2xl font-bold">Edit Real Estate / Construction Listing</h2>
                    <p class="text-sm opacity-80">Modify your current listing settings and structural properties</p>
                </div>

                <div class="p-6 space-y-8">
                    {{-- 1. BUSINESS CLASSIFICATION --}}
                    <div class="border rounded-2xl p-5">
                        <h3 class="font-bold text-lg mb-4">1. Business Classification</h3>
                        <div class="grid md:grid-cols-3 gap-5">
                            <div>
                                <label class="text-sm font-semibold">Business Type</label>
                                <select name="business_type" id="buisness_type_id"
                                    class="w-full mt-2 border rounded-xl h-11 px-4">
                                    <option value="">Select Type</option>
                                    @foreach ($businessType as $type)
                                        <option value="{{ $type->id }}"
                                            {{ old('business_type', $property->business_type_id) == $type->id ? 'selected' : '' }}>
                                            {{ $type->business_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="text-sm font-semibold">Category</label>
                                <select name="category" id="category_id"
                                    class="w-full mt-2 border rounded-xl h-11 px-4">
                                    <option value="">Select Category</option>
                                </select>
                            </div>

                            <div>
                                <label class="text-sm font-semibold">Sub Category</label>
                                <select name="subcategory" id="subcategory_id"
                                    class="w-full mt-2 border rounded-xl h-11 px-4">
                                    <option value="">Select Sub Category</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- 2. PROPERTY DETAILS --}}
                    <div class="border rounded-2xl p-5">
                        <h3 class="font-bold text-lg mb-4">2. Property / Project Details</h3>
                        <div class="grid md:grid-cols-2 gap-5">
                            <input type="text" name="property_title"
                                value="{{ old('property_title', $property->property_title) }}"
                                placeholder="Property / Project Name" class="h-11 border rounded-xl px-4">

                            <select name="listing_type" class="h-11 border rounded-xl px-4">
                                <option value="">Listing Type</option>
                                <option value="Sale"
                                    {{ old('listing_type', $property->property_for) == 'Sale' ? 'selected' : '' }}>Sale
                                </option>
                                <option value="Rent"
                                    {{ old('listing_type', $property->property_for) == 'Rent' ? 'selected' : '' }}>Rent
                                </option>
                                <option value="Lease"
                                    {{ old('listing_type', $property->property_for) == 'Lease' ? 'selected' : '' }}>
                                    Lease</option>
                                <option value="Project"
                                    {{ old('listing_type', $property->property_for) == 'Project' ? 'selected' : '' }}>
                                    Project</option>
                            </select>

                            <select name="property_type" class="h-11 border rounded-xl px-4">
                                <option value="">Property Type</option>
                                <option value="Apartment"
                                    {{ old('property_type', $property->property_type) == 'Apartment' ? 'selected' : '' }}>
                                    Apartment</option>
                                <option value="Villa"
                                    {{ old('property_type', $property->property_type) == 'Villa' ? 'selected' : '' }}>
                                    Villa</option>
                                <option value="House"
                                    {{ old('property_type', $property->property_type) == 'House' ? 'selected' : '' }}>
                                    House</option>
                                <option value="Plot / Land"
                                    {{ old('property_type', $property->property_type) == 'Plot / Land' ? 'selected' : '' }}>
                                    Plot / Land</option>
                                <option value="Commercial"
                                    {{ old('property_type', $property->property_type) == 'Commercial' ? 'selected' : '' }}>
                                    Commercial</option>
                                <option value="Industrial"
                                    {{ old('property_type', $property->property_type) == 'Industrial' ? 'selected' : '' }}>
                                    Industrial</option>
                            </select>

                            <input type="text" name="price" value="{{ old('price', $property->price) }}"
                                placeholder="Price / Budget" class="h-11 border rounded-xl px-4">
                        </div>
                    </div>

                    {{-- 3. AREA DETAILS --}}
                    <div class="border rounded-2xl p-5">
                        <h3 class="font-bold text-lg mb-4">3. Area Details</h3>
                        <div class="grid md:grid-cols-3 gap-5">
                            <input type="text" name="total_area"
                                value="{{ old('total_area', $property->total_area) }}"
                                placeholder="Total Area (Sqft / Acres)" class="h-11 border rounded-xl px-4">
                            <input type="text" name="built_up_area"
                                value="{{ old('built_up_area', $property->built_up_area) }}"
                                placeholder="Built-up Area" class="h-11 border rounded-xl px-4">
                            <input type="text" name="carpet_area"
                                value="{{ old('carpet_area', $property->carpet_area) }}" placeholder="Carpet Area"
                                class="h-11 border rounded-xl px-4">
                        </div>
                    </div>

                    {{-- 4. LOCATION --}}
                    <div class="border rounded-2xl p-5">
                        <h3 class="font-bold text-lg mb-4">4. Location Details</h3>
                        <div class="grid md:grid-cols-2 gap-5">
                            <input type="text" name="state" value="{{ old('state', $property->state) }}"
                                placeholder="State" class="h-11 border rounded-xl px-4">
                            <input type="text" name="city" value="{{ old('city', $property->city) }}"
                                placeholder="City" class="h-11 border rounded-xl px-4">
                            <textarea name="address" placeholder="Full Address" rows="3" class="md:col-span-2 border rounded-xl p-4">{{ old('address', $property->address) }}</textarea>
                            <input type="text" name="landmark" value="{{ old('landmark', $property->landmark) }}"
                                placeholder="Nearby Landmark" class="h-11 border rounded-xl px-4">
                        </div>
                    </div>

                    {{-- 5. CONSTRUCTION DETAILS --}}
                    <div class="border rounded-2xl p-5">
                        <h3 class="font-bold text-lg mb-4">5. Construction / Engineering Details</h3>
                        <div class="grid md:grid-cols-2 gap-5">
                            <input type="text" name="project_status"
                                value="{{ old('project_status', $property->project_status) }}"
                                placeholder="Project Status (Ongoing / Completed)"
                                class="h-11 border rounded-xl px-4">
                            <input type="text" name="construction_type"
                                value="{{ old('construction_type', $property->construction_type) }}"
                                placeholder="Construction Type (Residential / Commercial)"
                                class="h-11 border rounded-xl px-4">
                            <input type="text" name="floors" value="{{ old('floors', $property->floors) }}"
                                placeholder="Number of Floors" class="h-11 border rounded-xl px-4">
                            <input type="text" name="units" value="{{ old('units', $property->units) }}"
                                placeholder="Total Units / Flats" class="h-11 border rounded-xl px-4">
                        </div>
                    </div>

                    {{-- 6. FEATURES --}}
                    <div class="border rounded-2xl p-5">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-lg">6. Features</h3>
                            <button type="button" id="addFeature"
                                class="bg-green-600 text-white px-4 py-2 rounded-xl text-sm hover:bg-green-700 transition">
                                + Add Feature
                            </button>
                        </div>
                        <div id="featureContainer" class="space-y-3">
                            @if (!empty($features))
                                @foreach ($features as $index => $feat)
                                    <div
                                        class="grid grid-cols-2 gap-4 feature-row relative {{ $index > 0 ? 'pt-2' : '' }}">
                                        <input type="text" name="feature_key[]" value="{{ $feat['key'] ?? '' }}"
                                            placeholder="Feature (e.g. Water Supply)"
                                            class="h-11 border rounded-xl px-4">
                                        <input type="text" name="feature_value[]"
                                            value="{{ $feat['value'] ?? '' }}"
                                            placeholder="Value (e.g. 24/7 Borewell)"
                                            class="h-11 border rounded-xl px-4">
                                        @if ($index > 0)
                                            <button type="button"
                                                class="remove-feature absolute -right-2 top-4 bg-red-500 text-white w-6 h-6 rounded-full text-xs flex items-center justify-center shadow">×</button>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="grid grid-cols-2 gap-4 feature-row relative">
                                    <input type="text" name="feature_key[]"
                                        placeholder="Feature (e.g. Water Supply)" class="h-11 border rounded-xl px-4">
                                    <input type="text" name="feature_value[]"
                                        placeholder="Value (e.g. 24/7 Borewell)" class="h-11 border rounded-xl px-4">
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- 7. SPECIFICATIONS --}}
                    <div class="border rounded-2xl p-5">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-lg">7. Specifications</h3>
                            <button type="button" id="addSpecification"
                                class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm hover:bg-blue-700 transition">
                                + Add Specification
                            </button>
                        </div>
                        <div id="specificationContainer" class="space-y-3">
                            @if (!empty($specifications))
                                @foreach ($specifications as $index => $spec)
                                    <div
                                        class="grid grid-cols-2 gap-4 spec-row relative {{ $index > 0 ? 'pt-2' : '' }}">
                                        <input type="text" name="specification_key[]"
                                            value="{{ $spec['key'] ?? '' }}"
                                            placeholder="Specification (e.g. Flooring)"
                                            class="border rounded-xl h-11 px-4">
                                        <input type="text" name="specification_value[]"
                                            value="{{ $spec['value'] ?? '' }}"
                                            placeholder="Value (e.g. Vitrified Tiles)"
                                            class="border rounded-xl h-11 px-4">
                                        @if ($index > 0)
                                            <button type="button"
                                                class="remove-spec absolute -right-2 top-4 bg-red-500 text-white w-6 h-6 rounded-full text-xs flex items-center justify-center shadow">×</button>
                                        @endif
                                    </div>
                                @endforeach
                            @else
                                <div class="grid grid-cols-2 gap-4 spec-row relative">
                                    <input type="text" name="specification_key[]"
                                        placeholder="Specification (e.g. Flooring)"
                                        class="border rounded-xl h-11 px-4">
                                    <input type="text" name="specification_value[]"
                                        placeholder="Value (e.g. Vitrified Tiles)"
                                        class="border rounded-xl h-11 px-4">
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- 8. DESCRIPTION --}}
                    <div class="border rounded-2xl p-5">
                        <h3 class="font-bold text-lg mb-4">8. Description</h3>
                        <textarea name="description" rows="5" class="w-full border rounded-xl p-4">{{ old('description', $property->description) }}</textarea>
                    </div>

                    {{-- 9. IMAGES --}}
                    <div class="border rounded-2xl p-5">
                        <h3 class="font-bold text-lg mb-4">9. Property Images</h3>
                        <input type="file" name="property_image[]" id="property_image" multiple
                            class="w-full border rounded-xl p-3 mb-3" accept="image/*">

                        {{-- Live preview for new uploads --}}
                        <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">New Uploads
                            Preview</div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4" id="image-live-preview"></div>

                        {{-- Existing saved images with remove button --}}
                        <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Currently Saved
                            Images</div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="image-saved-preview">
                            @if (!empty($images))
                                @foreach ($images as $img)
                                    <div
                                        class="border rounded-2xl overflow-hidden shadow-sm bg-white p-1 relative existing-image">
                                        <img src="{{ asset('uploads/relastate/images/' . $img) }}"
                                            class="w-full h-32 object-cover rounded-xl">
                                        <div class="p-2 text-xs text-gray-600 truncate">{{ $img }}</div>
                                        <button type="button"
                                            class="remove-existing-image absolute top-2 right-2 bg-red-600 text-white rounded-full w-6 h-6 text-xs flex items-center justify-center shadow"
                                            data-image="{{ $img }}">×</button>
                                        <input type="hidden" name="old_images[]" value="{{ $img }}">
                                    </div>
                                @endforeach
                            @else
                                <p class="text-sm text-gray-400 italic col-span-full">No active images uploaded.</p>
                            @endif
                        </div>
                    </div>

                    {{-- 10. DOCUMENTS --}}
                    <div class="border rounded-2xl p-5">
                        <h3 class="font-bold text-lg mb-4">10. Documents (Optional)</h3>
                        <input type="file" name="documents[]" id="documents" multiple
                            class="w-full border rounded-xl p-3 mb-3" accept=".pdf,.doc,.docx,.xls,.xlsx">

                        {{-- Live preview for new uploads --}}
                        <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">New Uploads
                            Preview</div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4" id="document-live-preview"></div>

                        {{-- Existing saved documents with remove button --}}
                        <div class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Currently Saved
                            Documents</div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="document-saved-preview">
                            @if (!empty($documents))
                                @foreach ($documents as $doc)
                                    <div
                                        class="flex items-center gap-3 p-3 border rounded-xl bg-gray-50 relative existing-doc">
                                        <div class="text-red-500 text-xl">📄</div>
                                        <div class="overflow-hidden flex-1">
                                            <div class="text-sm font-medium text-gray-800 truncate">
                                                {{ $doc }}</div>
                                            <a href="{{ asset('uploads/relastate/documents/' . $doc) }}"
                                                target="_blank" class="text-xs text-indigo-600 hover:underline">View
                                                File</a>
                                        </div>
                                        <button type="button"
                                            class="remove-existing-doc bg-red-600 text-white w-6 h-6 rounded-full text-xs flex items-center justify-center flex-shrink-0">×</button>
                                        <input type="hidden" name="old_documents[]" value="{{ $doc }}">
                                    </div>
                                @endforeach
                            @else
                                <p class="text-sm text-gray-400 italic col-span-full">No documents associated.</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- FOOTER --}}
                <div class="p-6 border-t text-right bg-gray-50">
                    <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-medium transition">
                        Update Listing
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function() {
        let initialBusinessId = $('#buisness_type_id').val();
        let savedCategoryId = "{{ $property->category_id }}";
        let savedSubCategoryId = "{{ $property->sub_category_id }}";

        if (initialBusinessId) {
            loadCategories(initialBusinessId, savedCategoryId, function() {
                if (savedCategoryId) {
                    loadSubCategories(savedCategoryId, savedSubCategoryId);
                }
            });
        }


        // Remove existing saved image
        $(document).on('click', '.remove-existing-image', function() {
            $(this).siblings('input[name="old_images[]"]').remove();
            $(this).closest('.existing-image').remove();
        });

        // Remove existing saved document
        $(document).on('click', '.remove-existing-doc', function() {
            $(this).siblings('input[name="old_documents[]"]').remove();
            $(this).closest('.existing-doc').remove();
        });

        // Dynamic Specification Rows
        $('#addSpecification').click(function() {
            $('#specificationContainer').append(`
                <div class="grid grid-cols-2 gap-4 spec-row relative pt-2">
                    <input type="text" name="specification_key[]" placeholder="Specification" class="border rounded-xl h-11 px-4">
                    <input type="text" name="specification_value[]" placeholder="Value" class="border rounded-xl h-11 px-4">
                    <button type="button" class="remove-spec absolute -right-2 top-4 bg-red-500 text-white w-6 h-6 rounded-full text-xs flex items-center justify-center shadow">×</button>
                </div>
            `);
        });

        $(document).on('click', '.remove-spec', function() {
            $(this).closest('.spec-row').remove();
        });

        // Dynamic Feature Rows
        $('#addFeature').click(function() {
            $('#featureContainer').append(`
                <div class="grid grid-cols-2 gap-4 feature-row relative pt-2">
                    <input type="text" name="feature_key[]" placeholder="Feature" class="h-11 border rounded-xl px-4">
                    <input type="text" name="feature_value[]" placeholder="Value" class="h-11 border rounded-xl px-4">
                    <button type="button" class="remove-feature absolute -right-2 top-4 bg-red-500 text-white w-6 h-6 rounded-full text-xs flex items-center justify-center shadow">×</button>
                </div>
            `);
        });

        $(document).on('click', '.remove-feature', function() {
            $(this).closest('.feature-row').remove();
        });

        // Dependent Dropdowns
        $('#buisness_type_id').on('change', function() {
            loadCategories($(this).val(), null);
        });

        $('#category_id').on('change', function() {
            loadSubCategories($(this).val(), null);
        });

        function loadCategories(business_id, selectedId = null, callback = null) {
            let categoryDropdown = $('#category_id');
            let subcategoryDropdown = $('#subcategory_id');

            categoryDropdown.html('<option value="">Loading...</option>');
            subcategoryDropdown.html('<option value="">Select Sub Category</option>');

            if (!business_id) {
                categoryDropdown.html('<option value="">Select Category</option>');
                return;
            }

            $.ajax({
                url: "{{ route('get.categories') }}",
                type: "GET",
                data: {
                    business_id: business_id
                },
                success: function(response) {
                    let html = '<option value="">Select Category</option>';
                    $.each(response, function(key, value) {
                        let isSelected = (selectedId == value.id) ? 'selected' : '';
                        html +=
                            `<option value="${value.id}" ${isSelected}>${value.category_name}</option>`;
                    });
                    categoryDropdown.html(html);
                    if (callback) callback();
                }
            });
        }

        function loadSubCategories(category_id, selectedId = null) {
            let subcategoryDropdown = $('#subcategory_id');
            subcategoryDropdown.html('<option value="">Loading...</option>');

            if (!category_id) {
                subcategoryDropdown.html('<option value="">Select Sub Category</option>');
                return;
            }

            $.ajax({
                url: "{{ route('get.subcategories') }}",
                type: "GET",
                data: {
                    category_id: category_id
                },
                success: function(response) {
                    let html = '<option value="">Select Sub Category</option>';
                    $.each(response, function(key, value) {
                        let isSelected = (selectedId == value.id) ? 'selected' : '';
                        html +=
                            `<option value="${value.id}" ${isSelected}>${value.sub_category_name}</option>`;
                    });
                    subcategoryDropdown.html(html);
                }
            });
        }

        // Live Upload Image Previews
        document.getElementById('property_image').addEventListener('change', function(event) {
            let preview = document.getElementById('image-live-preview');
            preview.innerHTML = '';
            let files = event.target.files;

            Array.from(files).forEach(file => {
                if (file.type.match('image.*')) {
                    let reader = new FileReader();
                    reader.onload = function(e) {
                        let div = document.createElement('div');
                        div.className =
                            "border rounded-2xl overflow-hidden shadow-sm bg-white p-1 relative";
                        div.innerHTML = `
                            <img src="${e.target.result}" class="w-full h-32 object-cover rounded-xl">
                            <div class="p-2 text-xs text-gray-600 truncate font-medium">${file.name}</div>
                        `;
                        preview.appendChild(div);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });

        // Live Upload Document Previews
        document.getElementById('documents').addEventListener('change', function(event) {
            let preview = document.getElementById('document-live-preview');
            preview.innerHTML = '';
            let files = event.target.files;

            Array.from(files).forEach(file => {
                let div = document.createElement('div');
                div.className =
                    "flex items-center gap-3 p-3 border rounded-xl bg-blue-50/50 border-blue-200 shadow-inner";
                div.innerHTML = `
                    <div class="text-blue-500 text-xl">📄</div>
                    <div class="overflow-hidden">
                        <div class="text-sm font-medium text-gray-800 truncate">${file.name}</div>
                        <div class="text-xs text-gray-500">${(file.size / 1024).toFixed(2)} KB</div>
                    </div>
                `;
                preview.appendChild(div);
            });
        });
    });
</script>
