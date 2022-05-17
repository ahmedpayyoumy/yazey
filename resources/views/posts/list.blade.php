{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'Post')
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
                    <div class="card-title">Post</div>

                    <div class="card-toolbar">
                        <a href="{{ route('blog.posts.detail', 'add') }}" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <i class="fa fa-plus"></i>
                            </span>Add new</a>
                    </div>
                </div>
                <div class="card-body" style="padding-top: 0px;">
                    <ul class="tab__custom tab__status">
                        <li class="{{ (!request()->get('status') || (request()->get('status') === 'published')) ? 'active' : ''  }}">
                            <a href="?status=published" data-status="published">Published posts</a>
                        </li>
                        <li class="{{ (request()->get('status') === 'scheduled') ? 'active' : ''  }}">
                            <a href="?status=scheduled" data-status="scheduled">Scheduled posts</a>
                        </li>
                        <li class="{{ (request()->get('status') === 'draft') ? 'active' : ''  }}">
                            <a href="?status=draft" data-status="draft">Draft posts</a>
                        </li>
                    </ul>
                    <table class="table table-bordered table-hover" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th width="20%">Title</th>
                            <th>Content</th>
                            <th>User</th>
                            <th>Publish Time</th>
                            <th>Status schedule</th>
                            <th width="15%">Actions</th>
                        </tr>
                        </thead>
                    </table>
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
@endsection

@section('styles')
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>
    <script>
        let status = "published";
        // Datatable
        let table = $('#kt_datatable');
        table = table.DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            searching: false,
            lengthChange: false,
            info: true,
            pageLength: 10,
            ordering: false,
            order: [0, 'desc'],
            stateSave: true,
            ajax: {
                'url': '{!! route('blog.posts.data') !!}',
                data: function (data) {
                    let status = "{{ request()->get('status') }}";
                    data.status = status;
                },
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'excerpt', name: 'excerpt'},
                {data: 'created_by', name: 'created_by'},
                {data: 'created_at', name: 'created_at'},
                {data: 'scheduled_time', name: 'scheduled_time'},
                {data: 'actions', name: 'actions'}
            ]
        });

        // $(document).on("click", ".tab__status li a", function (e) {
        //     e.preventDefault();
        //     status = $(this).data('status');
        //     $('.tab__status li').removeClass('active');
        //     $(this).parent('li').addClass('active');
        //     table.draw();
        // })

        $(document).on("click", ".btn-delete", function (e) {
            e.preventDefault();
            let href = $(this).attr('href')
            swal.fire({
                title: "Delete?",
                html: "Are you sure delete this post?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                showCloseButton: true,
                reverseButtons: false
            }).then(function (result) {
                if (result.value) {
                    swal.fire(
                        "Deleted!",
                        "Deleted Post.",
                        "success"
                    )
                    window.location.href = href
                } else if (result.dismiss === "cancel") {
                    swal.fire(
                        "Cancel",
                        "Cancel Delete Action :)",
                        "error"
                    )
                }
            });
        });
    </script>
@endsection
