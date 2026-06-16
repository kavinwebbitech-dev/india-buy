@extends('admin.layouts.app')

@section('page-title', 'Create Vendor Type')

@section('content')
<div class="main">
    <div class="card-custom">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Create Vendor Type</h4>
            <a href="{{ route('admin.vendortype.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <form id="vendorTypeForm" action="{{ route('admin.vendortype.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <!-- Vendor Type Name -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Vendor Type Name</label>
                    <input type="text" name="vendor_name" class="form-control" placeholder="Enter vendor type name">
                </div>

                <!-- Image Upload -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" class="form-control" id="imageInput" accept="image/*">
                </div>

                <!-- Image Preview -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Preview</label><br>
                    <img id="imagePreview" src="" style="display:none; width:100px; height:100px; object-fit:cover; border:1px solid #ddd; padding:5px;">
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
                    <i class="fa fa-save"></i> Save Vendor Type
                </button>
            </div>

        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {

    // Image Preview
    $('#imageInput').change(function (e) {
        let reader = new FileReader();

        reader.onload = function (e) {
            $('#imagePreview')
                .attr('src', e.target.result)
                .show();
        }

        reader.readAsDataURL(this.files[0]);
    });

    // Validation
    $("#vendorTypeForm").validate({
        rules: {
            vendor_type_name: {
                required: true,
                minlength: 2
            },
            image: {
                required: true
            }
        },
        messages: {
            vendor_type_name: {
                required: "Vendor type name is required",
                minlength: "Minimum 2 characters required"
            },
            image: {
                required: "Image is required"
            }
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