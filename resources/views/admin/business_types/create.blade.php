@extends('admin.layouts.app')

@section('page-title', 'Create Business Type')

@section('content')
<div class="main">
    <div class="card-custom">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Create Business Type</h4>
            <a href="{{ route('admin.businesstype.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <form id="businessTypeForm" action="{{ route('admin.businesstype.store') }}" method="POST">
            @csrf

            <div class="row">

                <!-- Business Name -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Business Name</label>
                    <input type="text" name="business_name" class="form-control" placeholder="Enter business name">
                </div>

                <!-- Vendor Type Dropdown -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Vendor Type</label>
                    <select name="vendor_type_id" class="form-select">
                        <option value="">Select Vendor Type</option>
                        @foreach($vendorTypes as $vendor)
                            <option value="{{ $vendor->id }}">{{ $vendor->vendor_name }}</option>
                        @endforeach
                    </select>
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
                    <i class="fa fa-save"></i> Save Business Type
                </button>
            </div>

        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {

    $("#businessTypeForm").validate({
        rules: {
            business_name: {
                required: true,
                minlength: 2
            },
            vendor_type_id: {
                required: true
            }
        },
        messages: {
            business_name: {
                required: "Business name is required",
                minlength: "Minimum 2 characters required"
            },
            vendor_type_id: {
                required: "Please select vendor type"
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