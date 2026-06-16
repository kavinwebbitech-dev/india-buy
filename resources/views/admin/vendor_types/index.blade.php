@extends('admin.layouts.app')
@section('page-title', 'Vendor Types  ' )

@section('content')
<style>
    #vendor-type-table {
        font-size: 13.5px;
    }

    #vendor-type-table th {
        padding: 10px 12px;
    }

    #vendor-type-table td {
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
            <li class="breadcrumb-item active">Vendor Types</li>
        </ol>
    </nav>

    <!-- Card -->
    <div class="card-custom">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Vendor Type List</h4>
            <a href="{{ route('admin.vendortype.create') }}" class="btn btn-success">
                Add Vendor Type
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="vendor-type-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
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
    $('#vendor-type-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.vendortype.index') }}',
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'vendor_name', name: 'vendor_type_name' },
            { data: 'image', name: 'image', orderable: false, searchable: false },
            { data: 'status', orderable: false, searchable: false },
            { data: 'action', orderable: false, searchable: false },
        ]
    });
});
</script>

<!-- DELETE SCRIPT -->
<script>
$(document).on('click', '.delete', function () {

    let url = $(this).data('route');

    Swal.fire({
        title: 'Are you sure?',
        text: "This vendor type will be deleted!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: url,
                type: "DELETE",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {

                    if (response.status) {
                        Swal.fire('Deleted!', response.message, 'success');
                        $('#vendor-type-table').DataTable().ajax.reload(null, false);
                    }
                },
                error: function () {
                    Swal.fire('Error!', 'Something went wrong!', 'error');
                }
            });

        }
    });
});
</script>

@endsection