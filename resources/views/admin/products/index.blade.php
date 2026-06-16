@extends('admin.layouts.app')

@section('page-title', 'Product List')

@section('content')

<style>
    #product-table th {
        padding: 10px 12px;
        white-space: nowrap;
    }

    #product-table td {
        padding: 8px 12px;
        vertical-align: middle;
    }
</style>

<div class="main">

    {{-- FILTER --}}
    <div class="card-custom mb-3">

        <div class="row g-2">

            {{-- PRODUCT NAME --}}
            <div class="col-md-4">
                <input type="text" id="product_name"
                       class="form-control"
                       placeholder="Search Product">
            </div>

            {{-- CATEGORY --}}
            <div class="col-md-3">
                <select id="category" class="form-control">

                    <option value="">All Category</option>

                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">
                            {{ $cat->category_name }}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- STATUS --}}
            <div class="col-md-3">
                <select id="status" class="form-control">

                    <option value="">All Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>

                </select>
            </div>

            {{-- BUTTON --}}
            <div class="col-md-2">
                <button id="filterBtn" class="btn btn-primary w-100">
                    Filter
                </button>
            </div>

        </div>

    </div>

    {{-- TABLE --}}
    <div class="card-custom">

        <table class="table table-bordered table-striped"
               id="product-table">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Sub Category</th>
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

    let table = $('#product-table').DataTable({

        processing: true,
        serverSide: true,

        ajax: {
            url: "{{ route('admin.products.index') }}",
            data: function (d) {
                d.product_name = $('#product_name').val();
                d.category = $('#category').val();
                d.status = $('#status').val();
            }
        },

        columns: [

            { data: 'DT_RowIndex', orderable: false, searchable: false },

            { data: 'product', name: 'product', orderable: false },

            { data: 'category', name: 'categoryData.category_name' },

            { data: 'sub_category', name: 'subCategoryData.sub_category_name' },

            { data: 'status', orderable: false, searchable: false },

            { data: 'action', orderable: false, searchable: false },

        ]

    });

    // FILTER BUTTON
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
        text: "This product will be deleted!",
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

                    Swal.fire('Deleted!', 'Product deleted successfully', 'success');

                    $('#product-table').DataTable().ajax.reload();

                }

            });

        }

    });

});

</script>

@endsection