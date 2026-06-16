@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">Edit Gallery</h3>

    <form id="galleryForm" action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card p-4 mb-4">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $gallery->name }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Title</label>
                    <input type="text" name="title" class="form-control" value="{{ $gallery->title }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Category</label>
                    <input type="text" name="category" class="form-control" value="{{ $gallery->category }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control">
                    @if($gallery->thumbnail)
                        <div class="mt-2">
                            <img src="{{ asset('uploads/gallery_image/'.$gallery->thumbnail) }}" width="120" class="img-thumbnail">
                        </div>
                    @endif
                </div>

                {{-- <div class="col-md-6 mb-3">
                    <label>Banner Image</label>
                    <input type="file" name="banner_image" class="form-control">
                    @if($gallery->banner_image)
                        <div class="mt-2">
                            <img src="{{ asset('uploads/gallery_image/'.$gallery->banner_image) }}" width="120" class="img-thumbnail">
                        </div>
                    @endif
                </div> --}}
            </div>
        </div>

        <div class="card p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5>Gallery Images</h5>
                <button type="button" class="btn btn-success btn-sm" id="addRow">
                    + Add More
                </button>
            </div>

            <table class="table table-bordered" id="imageTable">
                <thead class="table-dark">
                    <tr>
                        <th width="25%">Image Name</th>
                        <th width="35%">Image</th>
                        <th width="25%">Preview</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>

                    {{-- Existing Images --}}
                    @foreach($gallery->details as $detail)
                    <tr id="old-row-{{ $detail->id }}">
                        <td>
                            <input type="text" class="form-control" value="{{ $detail->name }}" readonly>
                        </td>
                        <td>
                            <input type="file" name="images[]" class="form-control">
                            <input type="hidden" name="old_image_ids[]" value="{{ $detail->id }}">
                        </td>
                        <td>
                            <img src="{{ asset('uploads/gallery_image/'.$detail->image) }}" width="100" class="img-thumbnail">
                        </td>
                        <td>
                            <button type="button" 
                                class="btn btn-danger btn-sm remove-old" 
                                data-id="{{ $detail->id }}"
                                data-url="{{ route('admin.gallery.detail.delete', $detail->id) }}">
                                Delete
                            </button>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="text-end mt-4">
            <button type="submit" class="btn btn-primary px-4">
                Update Gallery
            </button>
        </div>
    </form>
</div>

{{-- jQuery Required --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    let rowCount = 0;

    // Add New Row
    $('#addRow').click(function () {
        rowCount++;

        let newRow = `
            <tr>
                <td>
                    <input type="text" name="image_names[]" class="form-control" placeholder="Enter Image Name">
                </td>
                <td>
                    <input type="file" name="images[]" class="form-control" required>
                </td>
                <td>
                    <span class="text-muted">New Image</span>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm removeRow">
                        Remove
                    </button>
                </td>
            </tr>
        `;

        $('#imageTable tbody').append(newRow);
    });

    // Remove New Row
    $(document).on('click', '.removeRow', function () {
        $(this).closest('tr').remove();
    });

    $(document).on('click', '.remove-old', function () {
        let button = $(this);
        let id = button.data('id');
        let url = button.data('url');
        let row = $('#old-row-' + id);

        Swal.fire({
            title: 'Are you sure?',
            text: "This image will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: "DELETE",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        if (response.status) {
                            row.fadeOut(300, function () {
                                $(this).remove();
                            });

                            Swal.fire('Deleted!', response.message, 'success');
                        }
                    },
                    error: function () {
                        Swal.fire('Error!', 'Something went wrong', 'error');
                    }
                });
            }
        });

    });
    $(document).ready(function () {
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
                // thumbnail: {
                //     required: true,
                //     extension: "jpg|jpeg|png|webp"
                // },
                // banner_image: {
                //     extension: "jpg|jpeg|png|webp"
                // },
                // 'images[]': {
                //     requireOneImage: true,
                //     extension: "jpg|jpeg|png|webp"
                // }
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
                // thumbnail: {
                //     required: "Thumbnail image is required",
                //     extension: "Only JPG, JPEG, PNG, WEBP files allowed"
                // },
                // 'images[]': {
                //     requireOneImage: "Please upload at least one gallery image",
                //     extension: "Only image files (JPG, PNG, WEBP) are allowed"
                // }
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