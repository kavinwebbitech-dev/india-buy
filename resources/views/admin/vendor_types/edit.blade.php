@extends('admin.layouts.app')

@section('page-title', 'Edit Vendor Type')

@section('content')
<div class="main">
    <div class="card-custom">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Edit Vendor Type</h4>
            <a href="{{ route('admin.vendortype.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <form id="vendorTypeForm" action="{{ route('admin.vendortype.update', $vendorType->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">

                <!-- Vendor Type Name -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Vendor Type Name</label>
                    <input type="text" name="vendor_name" class="form-control"
                           value="{{ $vendorType->vendor_name }}" placeholder="Enter vendor type name">
                </div>

                <!-- Image Upload -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Change Image</label>
                    <input type="file" name="image" class="form-control" id="imageInput" accept="image/*">
                </div>

                <!-- Current Image -->
                <div class="col-md-3 mb-3">
                    <label class="form-label">Current Image</label><br>
                    @if($vendorType->image)
                        <img src="{{ asset('uploads/vendor_types/'.$vendorType->image) }}"
                             width="100" height="100"
                             style="object-fit:cover; border:1px solid #ddd; padding:5px;">
                    @else
                        <p>No Image</p>
                    @endif
                </div>

                <!-- Preview New Image -->
                <div class="col-md-3 mb-3">
                    <label class="form-label">New Preview</label><br>
                    <img id="imagePreview" src="" 
                         style="display:none; width:100px; height:100px; object-fit:cover; border:1px solid #ddd; padding:5px;">
                </div>

                <!-- Status -->
                <div class="col-md-3 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $vendorType->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $vendorType->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Update Vendor Type
                </button>
            </div>

        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {

    // Live Image Preview
    $('#imageInput').change(function () {
        let reader = new FileReader();

        reader.onload = function (e) {
            $('#imagePreview')
                .attr('src', e.target.result)
                .show();
        }

        if (this.files[0]) {
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Validation
    $("#vendorTypeForm").validate({
        rules: {
            vendor_type_name: {
                required: true,
                minlength: 2
            }
        },
        messages: {
            vendor_type_name: {
                required: "Vendor type name is required",
                minlength: "Minimum 2 characters required"
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