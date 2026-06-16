@extends('admin.layouts.app')
@section('title', 'Gallery | ' . config('app.name'))
@section('content')
    <style>
        #pages-table {
            font-size: 13.5px;
        }

        #pages-table th {
            padding: 10px 12px;
        }

        #pages-table td {
            padding: 8px 12px;
        }

        dialog {
            border: none;
            padding: 0;
            width: 350px;
            border-radius: .5rem;
            opacity: 0;
            transform: scale(0.8);
            transition: all .25s ease;
        }

        dialog[open] {
            opacity: 1;
            transform: scale(1);
        }

        dialog::backdrop {
            background: rgba(0,0,0,.35);
            animation: fadeIn .25s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>

    <div class="main">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Gallery List</li>
            </ol>
        </nav>

        <!-- Card for Table -->
        <div class="card-custom">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Gallery List</h4>
                <div>
                    {{-- <button id="deleteAllPages" class="btn btn-danger ms-2">
                        Delete All
                    </button> --}}
                    <a href="{{ route('admin.galleries.create')}}" class="btn btn-success">Add Gallery</a>
                </div>
            </div>

            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table table-bordered table-striped no-wrap" id="service-table" style="min-width: 1000px;">
                    <thead class="text-nowrap">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Paragraph Content</th>
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
        $(function() {
            // Initialize DataTable
            var table = $('#service-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.galleries.index') }}',
                columns: [
                    { data: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
                    { data: 'name', name: 'name' },
                    { data: 'thumbnail', name: 'thumbnail' },
                    { data: 'title', name: 'title' },
                    { data: 'category', name: 'category' },
                    { data: 'status', orderable: false, searchable: false },
                    { data: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>

    <script>
        $(document).on('click', '.delete', function () {
            let button = $(this);
            let id = button.data('id');
            let url = button.data('route');
            let tableId = '#service-table'; // your datatable id

            Swal.fire({
                title: 'Are you sure?',
                text: "This gallery will be permanently deleted!",
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
                                $(tableId).DataTable().ajax.reload(null, false);
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText);
                            Swal.fire('Error!', 'Something went wrong!', 'error');
                        }
                    });

                }
            });
        });
    </script>
@endsection
