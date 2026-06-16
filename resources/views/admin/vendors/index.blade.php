@extends('admin.layouts.app')

@section('page-title', 'Vendor List')

@section('content')

<style>
    #vendor-table {
        font-size: 13.5px;
    }

    #vendor-table th {
        padding: 10px 12px;
        white-space: nowrap;
    }

    #vendor-table td {
        padding: 8px 12px;
        vertical-align: middle;
    }

    .vendor-logo {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        object-fit: cover;
        border: 1px solid #ddd;
    }
</style>

<div class="main">

    {{-- BREADCRUMB --}}
    <nav aria-label="breadcrumb" class="mb-4">

        <ol class="breadcrumb">

            <li class="breadcrumb-item">

                <a href="{{ route('admin.dashboard') }}">

                    Dashboard

                </a>

            </li>

            <li class="breadcrumb-item active">

                Vendors

            </li>

        </ol>

    </nav>

    {{-- CARD --}}
    <div class="card-custom">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h4>Vendor List</h4>

        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-striped"
                   id="vendor-table">

                <thead>

                    <tr>

                        <th>ID</th>

                        <th>Logo</th>

                        <th>Company</th>

                        <th>Vendor Type</th>

                        <th>Email</th>

                        <th>Phone</th>

                        <th>State</th>

                        <th>City</th>

                        <th>Status</th>

                        <th width="150">Action</th>

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

    $('#vendor-table').DataTable({

        processing: true,

        serverSide: true,

        ajax: '{{ route("admin.vendors.index") }}',

        columns: [

            {
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },

            {
                data: 'logo',
                orderable: false,
                searchable: false
            },

            {
                data: 'company_name',
                name: 'company_name'
            },

            {
                data: 'vendor_type',
                name: 'vendor_type'
            },

            {
                data: 'email',
                name: 'email'
            },

            {
                data: 'phone',
                name: 'phone'
            },

            {
                data: 'state',
                name: 'state'
            },

            {
                data: 'city',
                name: 'city'
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


{{-- DELETE VENDOR --}}

<script>

$(document).on('click', '.delete', function () {

    let url = $(this).data('route');

    Swal.fire({

        title: 'Are you sure?',

        text: "This vendor will be deleted!",

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

                        $('#vendor-table')
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