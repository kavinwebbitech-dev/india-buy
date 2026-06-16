@extends('admin.layouts.app')
@section('page-title', 'Business Types  ' )

@section('content')
<style>
    #business-type-table {
        font-size: 13.5px;
    }

    #business-type-table th {
        padding: 10px 12px;
    }

    #business-type-table td {
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
            <li class="breadcrumb-item active">Business Types</li>
        </ol>
    </nav>

    <!-- Card -->
    <div class="card-custom">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Business Type List</h4>
            <a href="{{ route('admin.businesstype.create') }}" class="btn btn-success">
                Add Business Type
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="business-type-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Business Name</th>
                        <th>Vendor Type</th> <!-- NEW -->
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
    $('#business-type-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.businesstype.index') }}',
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'business_name' },
            { data: 'vendor_type' }, // IMPORTANT
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
        text: "This business type will be deleted!",
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
                        $('#business-type-table').DataTable().ajax.reload(null, false);
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