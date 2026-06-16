@extends('admin.layouts.app')

@section('page-title', 'Property List')

@section('content')

<style>

    #property-table th{
        padding:10px 12px;
        white-space:nowrap;
    }

    #property-table td{
        padding:8px 12px;
        vertical-align:middle;
    }

</style>

<div class="main">

    {{-- FILTER --}}
    <div class="card-custom mb-3">

        <div class="row g-2">

            {{-- PROPERTY TITLE --}}
            <div class="col-md-5">

                <input type="text"
                       id="property_title"
                       class="form-control"
                       placeholder="Search Property">

            </div>

            {{-- STATUS --}}
            <div class="col-md-5">

                <select id="status" class="form-control">

                    <option value="">
                        All Status
                    </option>

                    <option value="1">
                        Active
                    </option>

                    <option value="0">
                        Inactive
                    </option>

                </select>

            </div>

            {{-- BUTTON --}}
            <div class="col-md-2">

                <button id="filterBtn"
                        class="btn btn-primary w-100">

                    Filter

                </button>

            </div>

        </div>

    </div>


    {{-- TABLE --}}
    <div class="card-custom">

        <table class="table table-bordered table-striped"
               id="property-table">

            <thead>

                <tr>

                    <th>ID</th>
                    <th>Property</th>
                    <th>Vendor</th>
                    <th>Type</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>

            </thead>

            <tbody></tbody>

        </table>

    </div>

</div>

@endsection


@section('scripts')

<script>

$(function () {

    let table = $('#property-table').DataTable({

        processing: true,

        serverSide: true,

        ajax: {

            url: "{{ route('admin.properties.index') }}",

            data: function (d) {

                d.property_title = $('#property_title').val();

                d.status = $('#status').val();

            }

        },

        columns: [

            {
                data: 'DT_RowIndex',
                orderable: false,
                searchable: false
            },

            {
                data: 'property',
                name: 'property',
                orderable: false
            },

            {
                data: 'vendor',
                name: 'vendor.company_name'
            },

            {
                data: 'property_type',
                name: 'property_type'
            },

            {
                data: 'location',
                name: 'location',
                orderable: false
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
            }

        ]

    });


    /*
    |--------------------------------------------------------------------------
    | FILTER
    |--------------------------------------------------------------------------
    */

    $('#filterBtn').click(function () {

        table.draw();

    });

});

</script>


{{-- DELETE --}}
<script>

$(document).on('click', '.delete', function () {

    let url = $(this).data('route');

    Swal.fire({

        title: 'Are you sure?',

        text: "This property will be deleted!",

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

                    'X-CSRF-TOKEN':
                    $('meta[name="csrf-token"]').attr('content')

                },

                success: function (response) {

                    Swal.fire(
                        'Deleted!',
                        'Property deleted successfully',
                        'success'
                    );

                    $('#property-table')
                        .DataTable()
                        .ajax.reload();

                }

            });

        }

    });

});

</script>

@endsection