@extends('admin.layouts.app')

@section('page-title', 'Sub Categories  ' )

@section('content')

<style>
    #subcategory-table {
        font-size: 13.5px;
    }

    #subcategory-table th {
        padding: 10px 12px;
    }

    #subcategory-table td {
        padding: 8px 12px;
    }
</style>

<div class="main">

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Sub Categories</li>
        </ol>
    </nav>

    <!-- Card -->
    <div class="card-custom">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Sub Category List</h4>

            <a href="{{ route('admin.subcategory.create') }}"
               class="btn btn-success">
                Add Sub Category
            </a>
        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-striped"
                   id="subcategory-table">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Business Type</th>
                        <th>Category</th>
                        <th>Sub Category Name</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody></tbody>

            </table>

        </div>
    </div>

</div>
@endsection


@section('scripts')

<script>
$(function () {

    $('#subcategory-table').DataTable({
        processing: true,
        serverSide: true,

        ajax: '{{ route('admin.subcategory.index') }}',

        columns: [

            {
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },

            {
                data: 'business_type',
                name: 'business_type'
            },

            {
                data: 'category',
                name: 'category'
            },

            {
                data: 'sub_category_name',
                name: 'sub_category_name'
            },
            {
                data: 'image',
                name: 'image'
            },

            {
                data: 'status',
                orderable: false,
                searchable: false
            },

            {
                data: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });

});
</script>


<!-- DELETE -->
<script>

$(document).on('click', '.delete', function () {

    let url = $(this).data('route');

    Swal.fire({
        title: 'Are you sure?',
        text: "This sub category will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    })

    .then((result) => {

        if (result.isConfirmed) {

            $.ajax({

                url: url,
                type: "DELETE",

                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function (response) {

                    if (response.status) {

                        Swal.fire(
                            'Deleted!',
                            response.message,
                            'success'
                        );

                        $('#subcategory-table')
                            .DataTable()
                            .ajax.reload(null, false);
                    }
                },

                error: function () {

                    Swal.fire(
                        'Error!',
                        'Something went wrong!',
                        'error'
                    );
                }

            });

        }

    });

});

</script>

@endsection