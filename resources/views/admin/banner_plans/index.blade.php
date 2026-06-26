@extends('admin.layouts.app')
@section('page-title', 'Banner Plans')

@section('content')
<style>
    #banner-plan-table {
        font-size: 13.5px;
    }

    #banner-plan-table th {
        padding: 10px 12px;
    }

    #banner-plan-table td {
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
            <li class="breadcrumb-item active">Banner Plans</li>
        </ol>
    </nav>

    <!-- Card -->
    <div class="card-custom">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Banner Plan List</h4>
            <a href="{{ route('admin.bannerplans.create') }}" class="btn btn-success">
                Add Banner Plan
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="banner-plan-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Plan Name</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Max Banners</th>
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
    $('#banner-plan-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('admin.bannerplans.index') }}',
        columns: [
            { data: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'plan_name' },
            { data: 'price' },
            { data: 'duration' },
            { data: 'max_banners' },
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
        text: "This banner plan will be deleted!",
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
                        $('#banner-plan-table').DataTable().ajax.reload(null, false);
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