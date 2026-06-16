@extends('admin.layouts.app')

@section('page-title', 'Create Sub Category')

@section('content')
    <div class="main">
        <div class="card-custom">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Create Sub Category</h4>

                <a href="{{ route('admin.subcategory.index') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>

            <form id="subCategoryForm" action="{{ route('admin.subcategory.store') }}" method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="row">

                    <!-- Business Type -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Business Type</label>

                        <select name="business_type_id" id="business_type_id" class="form-select">

                            <option value="">Select Business Type</option>

                            @foreach ($businessTypes as $business)
                                <option value="{{ $business->id }}">
                                    {{ $business->business_name }}
                                </option>
                            @endforeach

                        </select>
                    </div>


                    <!-- Category -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category</label>

                        <select name="category_id" id="category_id" class="form-select">

                            <option value="">Select Category</option>

                        </select>
                    </div>


                    <!-- Sub Category -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sub Category Name</label>

                        <input type="text" name="sub_category_name" class="form-control"
                            placeholder="Enter sub category name">
                    </div>

                    <!-- IMAGE -->
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Sub Category Image
                        </label>

                        <input type="file" name="image" class="form-control">

                    </div>


                    <!-- Status -->
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Status</label>

                        <select name="status" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save"></i> Save Sub Category
                    </button>
                </div>

            </form>

        </div>
    </div>
@endsection


@section('scripts')

    <script>
        $(document).ready(function() {

            // ✅ BUSINESS TYPE → CATEGORY AJAX
            $('#business_type_id').change(function() {

                let businessId = $(this).val();

                $('#category_id').html('<option>Loading...</option>');

                if (businessId) {

                    $.ajax({

                        url: "{{ route('admin.get.categories', ':id') }}"
                            .replace(':id', businessId),

                        type: "GET",

                        success: function(data) {

                            let options = '<option value="">Select Category</option>';

                            $.each(data, function(key, value) {

                                options += `
                            <option value="${value.id}">
                                ${value.category_name}
                            </option>
                        `;
                            });

                            $('#category_id').html(options);
                        }
                    });

                } else {

                    $('#category_id').html(
                        '<option value="">Select Category</option>'
                    );
                }

            });


            // ✅ VALIDATION
            $("#subCategoryForm").validate({

                rules: {
                    business_type_id: {
                        required: true
                    },
                    category_id: {
                        required: true
                    },
                    sub_category_name: {
                        required: true,
                        minlength: 2
                    }
                },

                messages: {
                    business_type_id: "Select business type",
                    category_id: "Select category",
                    sub_category_name: {
                        required: "Enter sub category name",
                        minlength: "Minimum 2 characters required"
                    }
                },

                errorElement: "span",
                errorClass: "text-danger",

                highlight: function(element) {
                    $(element).addClass("is-invalid");
                },

                unhighlight: function(element) {
                    $(element).removeClass("is-invalid");
                }

            });

        });
    </script>

@endsection
