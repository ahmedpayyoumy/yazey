{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'Thống kê')
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
                <div class="card-header flex-wrap border-0 pt-6 pb-0">
                    <div class="card-toolbar">
                        <form class="kt-form kt-form--fit">
                            <div class="row">
                                <div class="col-lg-8">
                                    <label>Category:</label>
                                    <select name="cat" class="form-control datatable-input" data-col-index="6">
                                        <option value="">Select</option>
                                        @foreach ($mediaCategorys as $mediaCategory)
                                        <option
                                        @if (request()->get('cat') == $mediaCategory->id))
                                        selected="selected"
                                        @endif
                                        value="{{ $mediaCategory->id }}">{{ $mediaCategory->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <label></label>
                                    <button style="margin-top: 0.5rem;" class="btn btn-primary btn-primary--icon" id="kt_search">
                                        <span>
                                            <span>Search</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-toolbar">
                        <a style="margin-top: 1.5rem;" href="{{ route('media-file.create') }}" class="btn btn-primary font-weight-bolder">
                            <span class="svg-icon svg-icon-md">
                                <i class="fa fa-plus"></i>
                            </span>Upload File</a>
                        </div>
                    </div>
                    <div class="card-body" style="padding-top: 0px;">
                        <table class="table table-bordered table-hover table-checkable" id="kt_media">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>File Type</th>
                                    <th>Thumb</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($media as $mediaItem)
                                <tr>
                                    <td>{{ $mediaItem->id }}</td>
                                    <td>{{ $mediaItem->name }}</td>
                                    <td>{{ $mediaItem->extension }}</td>
                                    <td>
                                        @if (isset($mediaItem->file_url))
                                        <img src="{{ asset($mediaItem->file_url) }}" alt="">
                                        @endif
                                    </td>
                                    <td>
                                        <form class="form__delete" method="POST" action="{{ route('media-file.destroy', $mediaItem->id ) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-clean btn-icon" title="Delete">
                                                <span class="svg-icon svg-icon-md">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"/>
                                                            <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"/>
                                                        </g>
                                                    </svg>
                                                </span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('scripts')
    <script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('js/custom.js') }} "></script>
    <script src="{{asset('js/pages/features/miscellaneous/sweetalert2.js')}}"></script>
<script>
    $(document).ready(function(){
        $(document).on('click','.form__delete',function(e){
            let that = $(this);
            e.preventDefault();
            swal.fire({
                title: "Are you sure?",
                text: "This operation will not be unrecoverable ",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    swal.fire(
                        "Đã xóa!",
                        "",
                        "success"
                    )
                    that.submit();
                    // window.location.href = '';
                } else if (result.dismiss === "cancel") {
                    swal.fire(
                        "Đã huỷ",
                        ":)",
                        "error"
                    )
                    return false;
                }
            });
        })
    })
</script>

    @toastr_js
    @toastr_render
    @endsection
