@extends('admin.layouts.app')

@section('page-title', 'Edit Sub Category')

@section('content')

<div class="main">

    <div class="card-custom">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h4>Edit Sub Category</h4>

            <a href="{{ route('admin.subcategory.index') }}"
               class="btn btn-secondary">

                <i class="fa fa-arrow-left"></i>

                Back

            </a>

        </div>

        <form id="subCategoryForm"
              action="{{ route('admin.subcategory.update', $data->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')

            <div class="row">

                {{-- BUSINESS TYPE --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Business Type
                    </label>

                    <select name="business_type_id"
                            id="business_type_id"
                            class="form-select">

                        <option value="">
                            Select Business Type
                        </option>

                        @foreach($businessTypes as $business)

                            <option value="{{ $business->id }}"
                                {{ $data->business_type_id == $business->id ? 'selected' : '' }}>

                                {{ $business->business_name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- CATEGORY --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Category
                    </label>

                    <select name="category_id"
                            id="category_id"
                            class="form-select">

                        <option value="">
                            Select Category
                        </option>

                        @foreach($categories as $cat)

                            <option value="{{ $cat->id }}"
                                {{ $data->category_id == $cat->id ? 'selected' : '' }}>

                                {{ $cat->category_name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                {{-- SUB CATEGORY NAME --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Sub Category Name
                    </label>

                    <input type="text"
                           name="sub_category_name"
                           class="form-control"
                           value="{{ old('sub_category_name', $data->sub_category_name) }}"
                           placeholder="Enter sub category name">

                </div>

                {{-- IMAGE --}}
                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Sub Category Image
                    </label>

                    <input type="file"
                           name="image"
                           class="form-control">

                    @if($data->image)

                        <div class="mt-3">

                            <img src="{{ asset('uploads/subcategories/'.$data->image) }}"
                                 width="100"
                                 class="rounded border p-1">

                        </div>

                    @endif

                </div>

                {{-- STATUS --}}
                <div class="col-md-3 mb-3">

                    <label class="form-label">
                        Status
                    </label>

                    <select name="status"
                            class="form-select">

                        <option value="1"
                            {{ $data->status == 1 ? 'selected' : '' }}>

                            Active

                        </option>

                        <option value="0"
                            {{ $data->status == 0 ? 'selected' : '' }}>

                            Inactive

                        </option>

                    </select>

                </div>

            </div>

            <div class="mt-4">

                <button type="submit"
                        class="btn btn-primary">

                    <i class="fa fa-save"></i>

                    Update Sub Category

                </button>

            </div>

        </form>

    </div>

</div>

@endsection


@section('scripts')

<script>

$(document).ready(function () {

    // BUSINESS TYPE -> CATEGORY
    $('#business_type_id').change(function () {

        let businessId = $(this).val();

        $('#category_id').html(
            '<option value="">Loading...</option>'
        );

        if (businessId) {

            $.ajax({

                url: "{{ route('admin.get.categories', ':id') }}"
                        .replace(':id', businessId),

                type: 'GET',

                success: function (data) {

                    let options =
                        '<option value="">Select Category</option>';

                    $.each(data, function (key, value) {

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


    // VALIDATION
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
            },

            image: {
                extension: "jpg|jpeg|png|webp"
            }

        },

        messages: {

            business_type_id: {
                required: "Select business type"
            },

            category_id: {
                required: "Select category"
            },

            sub_category_name: {
                required: "Enter sub category name",
                minlength: "Minimum 2 characters required"
            },

            image: {
                extension: "Only jpg, jpeg, png, webp allowed"
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