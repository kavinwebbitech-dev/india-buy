@extends('admin.layouts.app')

@section('title', 'Create Blog')

@section('content')
<div class="container mt-4">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Create Blog</h5>
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-secondary btn-sm">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <div class="card-body">
            <form id="blogForm" action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <!-- Title -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title"
                            value="{{ old('title') }}"
                            class="form-control @error('title') is-invalid @enderror">

                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category <span class="text-danger">*</span></label>
                        <input type="text" name="category"
                            value="{{ old('category') }}"
                            class="form-control @error('category') is-invalid @enderror">

                        @error('category')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Date -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" name="date"
                            value="{{ old('date') }}"
                            class="form-control @error('date') is-invalid @enderror">

                        @error('date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Thumbnail -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Thumbnail <span class="text-danger">*</span></label>
                        <input type="file" name="thumbnail"
                            class="form-control @error('thumbnail') is-invalid @enderror"
                            accept="image/*">

                        @error('thumbnail')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Banner Image -->
                    {{-- <div class="col-md-4 mb-3">
                        <label class="form-label">Banner Image <span class="text-danger">*</span></label>
                        <input type="file" name="banner_image"
                            class="form-control @error('banner_image') is-invalid @enderror"
                            accept="image/*">

                        @error('banner_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    <!-- Blog Image -->
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Blog Image <span class="text-danger">*</span></label>
                        <input type="file" name="blog_image"
                            class="form-control @error('blog_image') is-invalid @enderror"
                            accept="image/*">

                        @error('blog_image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Page Content <span class="text-danger">*</span></label>
                        <textarea name="page_content" id="page_content"
                            class="form-control @error('page_content') is-invalid @enderror"
                            rows="6">{{ old('page_content') }}</textarea>

                        @error('page_content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Status</label>
                        <select name="status"
                                class="form-select @error('status') is-invalid @enderror">
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>

                        @error('status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Save Blog
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        $(document).ready(function () {
            ClassicEditor
            .create(document.querySelector('#page_content'), {
                toolbar: [
                    'heading',
                    '|',
                    'bold', 'italic', 'underline', 'strikethrough',
                    '|',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor',
                    '|',
                    'alignment',
                    '|',
                    'bulletedList', 'numberedList',
                    '|',
                    'outdent', 'indent',
                    '|',
                    'link', 'blockQuote', 'insertTable', 'imageUpload',
                    '|',
                    'undo', 'redo'
                ]
            })
            .then(editor => {
                editor.editing.view.change(writer => {
                    writer.setStyle(
                        'height',
                        '400px',
                        editor.editing.view.document.getRoot()
                    );
                });
            })
            .catch(error => {
                console.error(error);
            });

            $("#blogForm").validate({
                ignore: [],
                rules: {
                    title: {
                        required: true,
                        minlength: 3
                    },
                    category: {
                        required: true
                    },
                    date: {
                        required: true
                    },
                    thumbnail: {
                        required: true,
                        extension: "jpg|jpeg|png|webp"
                    },
                    page_content: {
                        required: true
                    },
                    blog_image: {
                        required: true,
                        extension: "jpg|jpeg|png|webp"
                    }
                },
                messages: {
                    title: {
                        required: "Title is required",
                        minlength: "Minimum 3 characters required"
                    },
                    thumbnail: {
                        extension: "Only JPG, PNG, WEBP allowed"
                    }
                },
                errorElement: 'span',
                errorClass: 'text-danger',
                highlight: function (element) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element) {
                    $(element).removeClass('is-invalid');
                }
            });

        });
    </script>
@endsection