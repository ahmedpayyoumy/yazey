{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'Script')
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
                        <h3 class="card-label">Script
                        </h3>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('scripts.detail', 'add') }}" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <i class="fa fa-plus"></i>
                            </span>Thêm mới</a>
                    </div>
                </div>
                <div class="card-body" style="padding-top: 0px;">
                    <table class="table table-bordered table-hover" id="kt_datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Ngày tạo</th>
                            <th>Tiêu đề</th>
                            <th>Actions</th>
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
                'url': '{!! route('scripts.data') !!}',
                'data': function (data) {
                }
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'created_at', name: 'created_at',
                    render: function(row) {
                        var d = new Date(row);
                        let formatted_date = d.getDate() + "." + (d.getMonth() + 1) + "." + d.getFullYear()
						return formatted_date;
					}},
                {data: 'title', name: 'title'},
                {data: 'actions', name: 'actions'}
            ]
        });

        $(document).on("click", ".btn-delete", function (e) {
            e.preventDefault();
            let href = $(this).attr('href')
            swal.fire({
                title: "Xóa script?",
                html: "Bạn đang chuẩn bị xóa script này.<br> Script sau khi xóa sẽ không thể phục hồi được. Are you sure?",
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
                        "Script đã xóa.",
                        "success"
                    )
                    window.location.href = href
                } else if (result.dismiss === "cancel") {
                    swal.fire(
                        "Đã huỷ",
                        "Script được giữ lại :)",
                        "error"
                    )
                }
            });
        });
    </script>
@endsection
