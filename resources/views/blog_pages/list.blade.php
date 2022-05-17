{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'Page')
@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

{{-- Content --}}
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-title">
                        <h3 class="card-label">Page
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('blog.pages.detail', 'add') }}" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <i class="fa fa-plus"></i>
                            </span>Add new Page</a>
                    </div>
                </div>
                <div class="card-body" style="padding-top: 0px;">
                    <table class="table table-bordered table-hover" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th width="20%">Name</th>
                            <th>Content</th>
                            <th>User</th>
                            <th>Created At</th>
                            <th width="15%">Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script>
        // Datatable
        let table = $('#kt_datatable');
        table = table.DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            searching: false,
            lengthChange: false,
            info: false,
            pageLength: 10,
            ordering: false,
            order: [0, 'desc'],
            ajax: {
                'url': '{!! route('blog.pages.data') !!}',
                'data': function (data) {
                }
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'content', name: 'content'},
                {data: 'created_by', name: 'created_by'},
                {data: 'created_at', name: 'created_at'},
                {data: 'actions', name: 'actions'}
            ]
        });

        $(document).on("click", ".btn-delete", function (e) {
            e.preventDefault();
            let href = $(this).attr('href')
            swal.fire({
                title: "Delete Page?",
                html: "Are you sure delete this page?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Xóa",
                cancelButtonText: "Quay lại",
                showCloseButton: true,
                reverseButtons: false
            }).then(function (result) {
                if (result.value) {
                    swal.fire(
                        "Deleted!",
                        "Page deleted.",
                        "success"
                    )
                    window.location.href = href
                } else if (result.dismiss === "cancel") {
                    swal.fire(
                        "Cancel",
                        "Cancel delete Action :)",
                        "error"
                    )
                }
            });
        });
    </script>
@endsection
