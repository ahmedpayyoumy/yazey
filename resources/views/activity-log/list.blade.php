{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'Activity Log')
@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
@endsection

{{-- Content --}}
@section('content')
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-toolbar">
                        <select class="form-control mr-2" name="bulk_action" style="width: fit-content">
                            <option value="">Bulk action</option>
                            <option value="delete-selected">Xoá các log đã chọn</option>
                        </select>
						<div class="input-icon input-icon-right" style="width: fit-content">
							<input type="text" class="form-control" placeholder="Tìm kiếm..." name="search">
							<span>
								<i class="flaticon2-search-1 icon-md" id="search-log" style="cursor:pointer"></i>
							</span>
						</div>
                    </div>
                    <div class="card-toolbar">
                        <a href="{{ route('activity-log.delete-all') }}" class="btn btn-primary font-weight-bolder mr-2">
                            <span class="svg-icon svg-icon-md">
                                <i class="la la-trash"></i>
                            </span>Xoá tất cả</a>
                        <a href="{{ route('activity-log.list') }}" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <i class="la la-refresh"></i>
                            </span>Reload</a>
                    </div>
                </div>
                <div class="card-body" style="padding-top: 0px;">
                    <table class="table table-bordered table-hover" id="kt_datatable">
                        <thead>
                        <tr>
                            <th><input type="checkbox" name="checkAll" value="" /></th>
                            <th>#</th>
                            <th width="30%">Nội dung</th>
                            <th>User Agent</th>
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
            order: [1, 'desc'],
            stateSave: true,
            ajax: {
                'url': '{!! route('activity-log.data') !!}',
                'data': function (data) {
                    const search = $('input[name=search]').val()
                    data.search = search
                }
            },
            select: {
                style:    'os',
                selector: 'td:first-child'
            },
            columnDefs: [ {
                orderable: false,
                className: 'select-checkbox',
                targets:   0
            } ],
            columns: [
                {data: 'select_activity', name: 'select_activity'},
                {data: 'id', name: 'id'},
                {data: 'description', name: 'description'},
                {data: 'user_agent', name: 'user_agent'},
                {data: 'actions', name: 'actions'}
            ],
            drawCallback: function() {
                let checked = $('input[name=checkAll]').is(":checked");
                let idChecked = $('input[name="id[]"]').prop('checked');
                $('input[name="id[]"]').prop('checked', idChecked || checked);
                if (checked) {
                    $('input[name="id[]"]').each(function(){
                        if ($(this).prop('checked')) {
                            var id = $(this).attr('value');
                            if (arrIds.indexOf(id) === -1) {
                                arrIds.push(id);
                            }
                        } else {
                            arrIds.splice(id, 1);
                        }
                    });
                }
            }
        });

        $(document).on("click", ".btn-delete", function (e) {
            e.preventDefault();
            let href = $(this).attr('href')
            swal.fire({
                title: "Xóa log?",
                html: "Bạn đang chuẩn bị xóa log này.<br> Activity Log sau khi xóa sẽ không thể phục hồi được. Are you sure?",
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
                        "Activity Log đã xóa.",
                        "success"
                    )
                    window.location.href = href
                } else if (result.dismiss === "cancel") {
                    swal.fire(
                        "Đã huỷ",
                        "Activity Log được giữ lại :)",
                        "error"
                    )
                }
            });
        });
    </script>
    <script>
        let arrIds = [];
        $(document).ready(function() {
            $('input[name=checkAll]').on('change', function() {
                let checked = $(this).is(":checked")
                $('input[name="id[]"]').prop('checked', checked)
                $('input[name="id[]"]').each(function(){
                    if ($(this).prop('checked')) {
                        var id = $(this).attr('value');
                        if (arrIds.indexOf(id) === -1) {
                            arrIds.push(id);
                        }
                    } else {
                        arrIds.splice(id, 1);
                    }
                });
            });
            $('#kt_datatable').on('click', 'input[name="id[]"]', function() {
                const checked = $(this).is(':checked')
                const value = $(this).val()
                if (!checked) {
                    const idx = arrIds.indexOf(value)
                    if (idx !== -1) {
                        arrIds.splice(idx, 1)
                    }
                }
            });
            $('[name=bulk_action]').change(function() {
                const value = $(this).val()
                if (value) {
                    if (value === 'delete-selected') {
                        $.ajax({
                            url: "{!! route('activity-log.delete-selected') !!}",
                            type: "post",
                            data: { id: JSON.stringify(arrIds) },
                            success: function(data){ location.reload() }
                        })
                    }
                }
            });
            $('#search-log').click(function() {
                table.draw()
            })
            $('[name=search]').on('keypress', function(e) {
                if (e.which == 13) {
                    $('#search-log').click();
                }
            })
        })
    </script>
@endsection
