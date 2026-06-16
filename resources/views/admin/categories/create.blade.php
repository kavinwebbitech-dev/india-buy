@extends('admin.layouts.app')

@section('page-title', 'Create Category')

@section('content')
<div class="main">
    <div class="card-custom">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Create Category</h4>
            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <form id="categoryForm" action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <!-- Vendor Type -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Vendor Type</label>
                    <select name="vendor_type_id" id="vendor_type_id" class="form-select">
                        <option value="">Select Vendor Type</option>
                        @foreach($vendorTypes as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->vendor_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Business Type -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Business Type</label>
                    <select name="business_type_id" id="business_type_id" class="form-select">
                        <option value="">Select Business Type</option>
                    </select>
                </div>

                <!-- Category Name -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="category_name" class="form-control" placeholder="Enter category name">
                </div>

                <!-- Image -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">
                </div>

                <!-- Image Preview -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Preview</label><br>
                    <img id="imagePreview" src="" 
                         style="display:none;width:100px;height:100px;object-fit:cover;border:1px solid #ddd;">
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
                    <i class="fa fa-save"></i> Save Category
                </button>
            </div>

        </form>
    </div>
</div>
@endsection


@section('scripts')

<script>
$(document).ready(function () {

    // ✅ DEPENDENT DROPDOWN (Vendor → Business)
    $('#vendor_type_id').change(function () {

        let vendorId = $(this).val();

        $('#business_type_id').html('<option>Loading...</option>');

        if (vendorId) {

            $.ajax({
                url: "{{ route('admin.get.business.types', ':id') }}".replace(':id', vendorId),
                type: 'GET',
                success: function (data) {

                    let options = '<option value="">Select Business Type</option>';

                    $.each(data, function (key, value) {
                        options += `<option value="${value.id}">${value.business_name}</option>`;
                    });

                    $('#business_type_id').html(options);
                }
            });

        } else {
            $('#business_type_id').html('<option value="">Select Business Type</option>');
        }
    });


    // ✅ IMAGE PREVIEW
    $('#imageInput').change(function () {
        let reader = new FileReader();

        reader.onload = function (e) {
            $('#imagePreview').attr('src', e.target.result).show();
        }

        if (this.files[0]) {
            reader.readAsDataURL(this.files[0]);
        }
    });


    // ✅ VALIDATION
    $("#categoryForm").validate({
        rules: {
            vendor_type_id: { required: true },
            business_type_id: { required: true },
            category_name: { required: true, minlength: 2 },
            image: { required: true }
        },
        messages: {
            vendor_type_id: "Select vendor type",
            business_type_id: "Select business type",
            category_name: "Enter category name",
            image: "Upload image"
        },
        errorElement: "span",
        errorClass: "text-danger",
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        }
    });

});
</script>

@endsection