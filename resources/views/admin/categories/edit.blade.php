@extends('admin.layouts.app')

@section('page-title', 'Edit Category')

@section('content')
<div class="main">
    <div class="card-custom">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Edit Category</h4>
            <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <form id="categoryForm" action="{{ route('admin.category.update', $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">

                <!-- Vendor Type -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Vendor Type</label>
                    <select name="vendor_type_id" id="vendor_type_id" class="form-select">
                        <option value="">Select Vendor Type</option>
                        @foreach($vendorTypes as $vendor)
                            <option value="{{ $vendor->id }}" 
                                {{ $data->vendor_type_id == $vendor->id ? 'selected' : '' }}>
                                {{ $vendor->vendor_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Business Type -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Business Type</label>
                    <select name="business_type_id" id="business_type_id" class="form-select">
                        <option value="">Select Business Type</option>
                        @foreach($businessTypes as $business)
                            <option value="{{ $business->id }}" 
                                {{ $data->business_type_id == $business->id ? 'selected' : '' }}>
                                {{ $business->business_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Category Name -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" name="category_name" class="form-control"
                           value="{{ $data->category_name }}" placeholder="Enter category name">
                </div>

                <!-- Change Image -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Change Image</label>
                    <input type="file" name="image" id="imageInput" class="form-control" accept="image/*">
                </div>

                <!-- Current Image -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Current Image</label><br>
                    @if($data->image)
                        <img src="{{ asset('uploads/categories/'.$data->image) }}"
                             width="100" height="100"
                             style="object-fit:cover;border:1px solid #ddd;">
                    @else
                        <p>No Image</p>
                    @endif
                </div>

                <!-- New Preview -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">New Preview</label><br>
                    <img id="imagePreview" src=""
                         style="display:none;width:100px;height:100px;object-fit:cover;border:1px solid #ddd;">
                </div>

                <!-- Status -->
                <div class="col-md-3 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Update Category
                </button>
            </div>

        </form>
    </div>
</div>
@endsection


@section('scripts')
<script>
$(document).ready(function () {

    // ✅ Vendor → Business (AJAX)
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


    // ✅ Image Preview
    $('#imageInput').change(function () {
        let reader = new FileReader();

        reader.onload = function (e) {
            $('#imagePreview').attr('src', e.target.result).show();
        }

        if (this.files[0]) {
            reader.readAsDataURL(this.files[0]);
        }
    });


    // ✅ Validation
    $("#categoryForm").validate({
        rules: {
            vendor_type_id: { required: true },
            business_type_id: { required: true },
            category_name: { required: true, minlength: 2 }
        },
        messages: {
            vendor_type_id: "Select vendor type",
            business_type_id: "Select business type",
            category_name: "Enter category name"
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