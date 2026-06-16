@extends('admin.layouts.app')

@section('title', 'Create Gallery')

@section('content')
<div class="main">
    <div class="card-custom">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Create Gallery</h4>
            <a href="{{ route('admin.galleries.index') }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <form id="galleryForm" action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <!-- Name -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter name">
                </div>

                <!-- Title -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Enter title">
                </div>

                <!-- Category -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Category</label>
                    <input type="text" name="category" class="form-control" placeholder="Enter category">
                </div>

                <!-- Thumbnail -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Thumbnail Image</label>
                    <input type="file" name="thumbnail" class="form-control" accept="image/*">
                </div>

                <!-- Banner -->
                {{-- <div class="col-md-6 mb-3">
                    <label class="form-label">Banner Image</label>
                    <input type="file" name="banner_image" class="form-control" accept="image/*">
                </div> --}}

                <!-- Status -->
                <div class="col-md-3 mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
            </div>

            <hr>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5>Gallery Images</h5>
                <button type="button" class="btn btn-success btn-sm" id="addRow">
                    <i class="fa fa-plus"></i> Add More
                </button>
            </div>

            <!-- Dynamic Rows Table -->
            <div class="table-responsive">
                <table class="table table-bordered" id="imageTable">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">#</th>
                            <th width="35%">Image Name</th>
                            <th width="40%">Image</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="image-row">
                            <td class="row-index text-center">1</td>
                            <td>
                                <input type="text" name="image_names[]" class="form-control" placeholder="Image title">
                            </td>
                            <td>
                                <input type="file" name="images[]" class="form-control image-input" accept="image/*">
                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-danger btn-sm removeRow">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Save Gallery
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function () {

    // Add More Row
    $('#addRow').click(function () {
        let rowCount = $('#imageTable tbody tr').length + 1;

        let newRow = `
            <tr class="image-row">
                <td class="row-index text-center">${rowCount}</td>
                <td>
                    <input type="text" name="image_names[]" class="form-control" placeholder="Image title">
                </td>
                <td>
                    <input type="file" name="images[]" class="form-control image-input" accept="image/*">
                </td>
                <td class="text-center">
                    <button type="button" class="btn btn-danger btn-sm removeRow">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;

        $('#imageTable tbody').append(newRow);
    });

    // Remove Row
    $(document).on('click', '.removeRow', function () {
        if ($('#imageTable tbody tr').length > 1) {
            $(this).closest('tr').remove();
            updateRowIndex();
        } else {
            alert('At least one image row is required.');
        }
    });

    // Update Row Index after delete
    function updateRowIndex() {
        $('#imageTable tbody tr').each(function (index) {
            $(this).find('.row-index').text(index + 1);
        });
    }

    $.validator.addMethod("requireOneImage", function (value, element) {
        let valid = false;
        $('.image-input').each(function () {
            if ($(this).val()) {
                valid = true;
            }
        });
        return valid;
    }, "Please upload at least one image.");

    // Gallery Form Validation
    $("#galleryForm").validate({
        ignore: [],
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            title: {
                required: true,
                minlength: 3
            },
            category: {
                required: true
            },
            thumbnail: {
                required: true,
                // extension: "jpg|jpeg|png|webp"
            },
            // banner_image: {
            //     extension: "jpg|jpeg|png|webp"
            // },
            'images[]': {
                requireOneImage: true,
                // extension: "jpg|jpeg|png|webp"
            }
        },
        messages: {
            name: {
                required: "Name is required",
                minlength: "Name must be at least 2 characters"
            },
            title: {
                required: "Title is required",
                minlength: "Title must be at least 3 characters"
            },
            category: {
                required: "Category is required"
            },
            thumbnail: {
                required: "Thumbnail image is required",
                extension: "Only JPG, JPEG, PNG, WEBP files allowed"
            },
            'images[]': {
                requireOneImage: "Please upload at least one gallery image",
                extension: "Only image files (JPG, PNG, WEBP) are allowed"
            }
        },
        errorElement: "span",
        errorClass: "text-danger",
        highlight: function (element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
            $(element).removeClass("is-invalid");
        },
        errorPlacement: function (error, element) {
            if (element.hasClass('image-input')) {
                error.insertAfter($('#imageTable'));
            } else {
                error.insertAfter(element);
            }
        }
    });
});
</script>
@endsection