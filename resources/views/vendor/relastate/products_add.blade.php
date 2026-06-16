@include('vendor.Layout.head')

@include('vendor.Layout.top_bar')
@include('vendor.Layout.main_header')

<div class="min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-4">
        @include('vendor.Layout.menu_bar')

        <form action="{{ route('relastate.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
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

            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-700 p-4 rounded-xl mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-300 text-red-700 p-4 rounded-xl mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white rounded-3xl border shadow-sm overflow-hidden">
                {{-- HEADER --}}
                <div class="p-6 border-b bg-gradient-to-r from-slate-800 to-slate-900 text-white">
                    <h2 class="text-2xl font-bold">Add Real Estate / Construction Listing</h2>
                    <p class="text-sm opacity-80">Complete property or project details</p>
                </div>

                <div class="p-6 space-y-8">
                    {{-- 1. BUSINESS CLASSIFICATION --}}
                    <div class="border rounded-2xl p-5">
                        <h3 class="font-bold text-lg mb-4">1. Business Classification</h3>
                        <div class="grid md:grid-cols-3 gap-5">
                            <div>
                                <label class="text-sm font-semibold">Business Type</label>
                                <select name="business_type" id="buisness_type_id" class="w-full mt-2 border rounded-xl h-11 px-4">
                                    <option value="">Select Type</option>
                                    @foreach ($businessType as $type)
                                        <option value="{{ $type->id }}" {{ old('business_type') == $type->id ? 'selected' : '' }}>{{ $type->business_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="text-sm font-semibold">Category</label>
                                <select name="category" id="category_id" class="w-full mt-2 border rounded-xl h-11 px-4">
                                    <option value="">Select Category</option>
                                </select>
                            </div>

                            <div>
                                <label class="text-sm font-semibold">Sub Category</label>
                                <select name="subcategory" id="subcategory_id" class="w-full mt-2 border rounded-xl h-11 px-4">
                                    <option value="">Select Sub Category</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- 2. PROPERTY DETAILS --}}
                    <div class="border rounded-2xl p-5">
                        <h3 class="font-bold text-lg mb-4">2. Property / Project Details</h3>
                        <div class="grid md:grid-cols-2 gap-5">
                            <input type="text" name="property_title" value="{{ old('property_title') }}" placeholder="Property / Project Name" class="h-11 border rounded-xl px-4">

                            <select name="listing_type" class="h-11 border rounded-xl px-4">
                                <option value="">Listing Type</option>
                                <option value="Sale" {{ old('listing_type') == 'Sale' ? 'selected' : '' }}>Sale</option>
                                <option value="Rent" {{ old('listing_type') == 'Rent' ? 'selected' : '' }}>Rent</option>
                                <option value="Lease" {{ old('listing_type') == 'Lease' ? 'selected' : '' }}>Lease</option>
                                <option value="Project" {{ old('listing_type') == 'Project' ? 'selected' : '' }}>Project</option>
                            </select>

                            <select name="property_type" class="h-11 border rounded-xl px-4">
                                <option value="">Property Type</option>
                                <option value="Apartment" {{ old('property_type') == 'Apartment' ? 'selected' : '' }}>Apartment</option>
                                <option value="Villa" {{ old('property_type') == 'Villa' ? 'selected' : '' }}>Villa</option>
                                <option value="House" {{ old('property_type') == 'House' ? 'selected' : '' }}>House</option>
                                <option value="Plot / Land" {{ old('property_type') == 'Plot / Land' ? 'selected' : '' }}>Plot / Land</option>
                                <option value="Commercial" {{ old('property_type') == 'Commercial' ? 'selected' : '' }}>Commercial</option>
                                <option value="Industrial" {{ old('property_type') == 'Industrial' ? 'selected' : '' }}>Industrial</option>
                            </select>

                            <input type="text" name="price" value="{{ old('price') }}" placeholder="Price / Budget" class="h-11 border rounded-xl px-4">
                        </div>
                    </div>

                    {{-- 3. AREA DETAILS --}}
                    <div class="border rounded-2xl p-5">
                        <h3 class="font-bold text-lg mb-4">3. Area Details</h3>
                        <div class="grid md:grid-cols-3 gap-5">
                            <input type="text" name="total_area" value="{{ old('total_area') }}" placeholder="Total Area (Sqft / Acres)" class="h-11 border rounded-xl px-4">
                            <input type="text" name="built_up_area" value="{{ old('built_up_area') }}" placeholder="Built-up Area" class="h-11 border rounded-xl px-4">
                            <input type="text" name="carpet_area" value="{{ old('carpet_area') }}" placeholder="Carpet Area" class="h-11 border rounded-xl px-4">
                        </div>
                    </div>

                    {{-- 4. LOCATION --}}
                    <div class="border rounded-2xl p-5">
                        <h3 class="font-bold text-lg mb-4">4. Location Details</h3>
                        <div class="grid md:grid-cols-2 gap-5">
                            <input type="text" name="state" value="{{ old('state') }}" placeholder="State" class="h-11 border rounded-xl px-4">
                            <input type="text" name="city" value="{{ old('city') }}" placeholder="City" class="h-11 border rounded-xl px-4">
                            <textarea name="address" placeholder="Full Address" rows="3" class="md:col-span-2 border rounded-xl p-4">{{ old('address') }}</textarea>
                            <input type="text" name="landmark" value="{{ old('landmark') }}" placeholder="Nearby Landmark" class="h-11 border rounded-xl px-4">
                        </div>
                    </div>

                    {{-- 5. CONSTRUCTION DETAILS --}}
                    <div class="border rounded-2xl p-5">
                        <h3 class="font-bold text-lg mb-4">5. Construction / Engineering Details</h3>
                        <div class="grid md:grid-cols-2 gap-5">
                            <input type="text" name="project_status" value="{{ old('project_status') }}" placeholder="Project Status (Ongoing / Completed)" class="h-11 border rounded-xl px-4">
                            <input type="text" name="construction_type" value="{{ old('construction_type') }}" placeholder="Construction Type (Residential / Commercial)" class="h-11 border rounded-xl px-4">
                            <input type="text" name="floors" value="{{ old('floors') }}" placeholder="Number of Floors" class="h-11 border rounded-xl px-4">
                            <input type="text" name="units" value="{{ old('units') }}" placeholder="Total Units / Flats" class="h-11 border rounded-xl px-4">
                        </div>
                    </div>

                    {{-- 6. FEATURES --}}
                    <div class="border rounded-2xl p-5">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-lg">6. Features</h3>
                            <button type="button" id="addFeature" class="bg-green-600 text-white px-4 py-2 rounded-xl text-sm hover:bg-green-700 transition">
                                + Add Feature
                            </button>
                        </div>
                        <div id="featureContainer" class="space-y-3">
                            <div class="grid grid-cols-2 gap-4 feature-row relative">
                                <input type="text" name="feature_key[]" placeholder="Feature (e.g. Water Supply)" class="h-11 border rounded-xl px-4">
                                <input type="text" name="feature_value[]" placeholder="Value (e.g. 24/7 Borewell)" class="h-11 border rounded-xl px-4">
                            </div>
                        </div>
                    </div>

                    {{-- 7. SPECIFICATIONS --}}
                    <div class="border rounded-2xl p-5">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="font-bold text-lg">7. Specifications</h3>
                            <button type="button" id="addSpecification" class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm hover:bg-blue-700 transition">
                                + Add Specification
                            </button>
                        </div>
                        <div id="specificationContainer" class="space-y-3">
                            <div class="grid grid-cols-2 gap-4 spec-row relative">
                                <input type="text" name="specification_key[]" placeholder="Specification (e.g. Flooring)" class="border rounded-xl h-11 px-4">
                                <input type="text" name="specification_value[]" placeholder="Value (e.g. Vitrified Tiles)" class="border rounded-xl h-11 px-4">
                            </div>
                        </div>
                    </div>

                    {{-- 8. DESCRIPTION --}}
                    <div class="border rounded-2xl p-5">
                        <h3 class="font-bold text-lg mb-4">8. Description</h3>
                        <textarea name="description" rows="5" class="w-full border rounded-xl p-4">{{ old('description') }}</textarea>
                    </div>

                    {{-- 9. IMAGES --}}
                    <div class="border rounded-2xl p-5">
                        <h3 class="font-bold text-lg mb-4">9. Property Images</h3>
                        <input type="file" name="property_image[]" id="property_image" multiple class="w-full border rounded-xl p-3">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4" id="image-preview"></div>
                    </div>

                    {{-- 10. DOCUMENTS --}}
                    <div class="border rounded-2xl p-5">
                        <h3 class="font-bold text-lg mb-4">10. Documents (Optional)</h3>
                        <input type="file" name="documents[]" id="documents" multiple class="w-full border rounded-xl p-3">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4" id="datasheet-preview"></div>
                    </div>
                </div>

                {{-- FOOTER --}}
                <div class="p-6 border-t text-right bg-gray-50">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl font-medium transition">
                        Save Listing
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    $(document).ready(function() {
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

        // Dependent Dropdowns (Business Type -> Category)
        $('#buisness_type_id').on('change', function() {
            let business_id = $(this).val();
            let categoryDropdown = $('#category_id');
            let subcategoryDropdown = $('#subcategory_id');

            categoryDropdown.html('<option value="">Loading...</option>');
            subcategoryDropdown.html('<option value="">Select Sub Category</option>');

            if(!business_id) {
                categoryDropdown.html('<option value="">Select Category</option>');
                return;
            }

            $.ajax({
                url: "{{ route('get.categories') }}",
                type: "GET",
                data: { business_id: business_id },
                success: function(response) {
                    let html = '<option value="">Select Category</option>';
                    $.each(response, function(key, value) {
                        html += `<option value="${value.id}">${value.category_name}</option>`;
                    });
                    categoryDropdown.html(html);
                }
            });
        });

        // Dependent Dropdowns (Category -> Subcategory)
        $('#category_id').on('change', function() {
            let category_id = $(this).val();
            let subcategoryDropdown = $('#subcategory_id');

            subcategoryDropdown.html('<option value="">Loading...</option>');

            if(!category_id) {
                subcategoryDropdown.html('<option value="">Select Sub Category</option>');
                return;
            }

            $.ajax({
                url: "{{ route('get.subcategories') }}",
                type: "GET",
                data: { category_id: category_id },
                success: function(response) {
                    let html = '<option value="">Select Sub Category</option>';
                    $.each(response, function(key, value) {
                        html += `<option value="${value.id}">${value.sub_category_name}</option>`;
                    });
                    subcategoryDropdown.html(html);
                }
            });
        });

        // Native JS Multipurpose Image Files Upload Live Preview
        document.getElementById('property_image').addEventListener('change', function(event) {
            let preview = document.getElementById('image-preview');
            preview.innerHTML = '';
            let files = event.target.files;

            Array.from(files).forEach(file => {
                let reader = new FileReader();
                reader.onload = function(e) {
                    let div = document.createElement('div');
                    div.className = "border rounded-2xl overflow-hidden shadow-sm bg-white p-1";
                    div.innerHTML = `
                        <img src="${e.target.result}" class="w-full h-32 object-cover rounded-xl">
                        <div class="p-2 text-xs text-gray-600 truncate">${file.name}</div>
                    `;
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            });
        });

        // Native JS Document Files Upload Live Preview
        document.getElementById('documents').addEventListener('change', function(event) {
            let preview = document.getElementById('datasheet-preview');
            preview.innerHTML = '';
            let files = event.target.files;

            Array.from(files).forEach(file => {
                let div = document.createElement('div');
                div.className = "flex items-center gap-3 p-3 border rounded-xl bg-gray-50";
                div.innerHTML = `
                    <div class="text-red-500 text-xl">📄</div>
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