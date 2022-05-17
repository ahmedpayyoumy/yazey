{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'QR Code')
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
@toastr_css

@endsection
{{-- Content --}}
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="card card-custom">
                <div class="card-header border-0 pt-6 pb-0">
                    <div class="card-toolbar">
                        <a data-toggle="modal" data-target="#createQRCode" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <i class="fa fa-plus"></i>
                            </span>New QR Code
                        </a>
                    </div>
                </div>
                <div class="card-body" style="padding-top: 0px;">
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>QR Image</th>
                                <th>Link</th>
                                <th>Created At</th>
                                <th style="width: 20%;">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <!-- Modal-->
                <div class="modal fade" id="createQRCode" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Create New QR Code</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i aria-hidden="true" class="ki ki-close"></i>
                                </button>
                            </div>
                            <form action="{{ route('qrcode.store') }}" method="POST">
                                <div class="modal-body">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">Link</label>
                                        <div class="col-lg-9 col-xl-9">
                                            <input class="form-control" name="link" type="text" value="" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary font-weight-bold">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
    @toastr_js
    @toastr_render
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
                'url': '{!! route('qrcode.data') !!}',
                'data': function (data) {
                }
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'image', name: 'image'},
                {data: 'link', name: 'link'},
                {data: 'created_at', name: 'created_at'},
                {data: 'actions', name: 'actions'}
            ]
        });
    </script>

@endsection
