{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'Tag')
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
                        <h3 class="card-label">Tag
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('blog.tags.detail', 'add') }}" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <i class="fa fa-plus"></i>
                            </span>Thêm mới</a>
                    </div>
                </div>
                <div style="padding-top: 0px;" class="card-body">
                    <table class="table table-bordered table-hover" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th width="30%">Tên tag</th>
                            <th>Mô tả</th>
                            <th>Người tạo</th>
                            <th>Ngày tạo</th>
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
                'url': '{!! route('blog.tags.data') !!}',
                'data': function (data) {
                }
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'title', name: 'title'},
                {data: 'description', name: 'description'},
                {data: 'created_by', name: 'created_by'},
                {data: 'created_at', name: 'created_at'},
                {data: 'actions', name: 'actions'}
            ]
        });

        $(document).on("click", ".btn-delete", function (e) {
            e.preventDefault();
            let href = $(this).attr('href')
            swal.fire({
                title: "Xóa tag?",
                html: "Bạn đang chuẩn bị xóa tag này.<br> Tag sau khi xóa sẽ không thể phục hồi được. Are you sure?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Xóa",
                cancelButtonText: "Quay lại",
                showCloseButton: true,
                reverseButtons: false
            }).then(function (result) {
                if (result.value) {
                    swal.fire(
                        "Đã xoá!",
                        "Tag đã xóa.",
                        "success"
                    )
                    window.location.href = href
                } else if (result.dismiss === "cancel") {
                    swal.fire(
                        "Đã huỷ",
                        "Tag được giữ lại :)",
                        "error"
                    )
                }
            });
        });
    </script>
@endsection
