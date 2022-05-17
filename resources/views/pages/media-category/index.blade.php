{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'Media Category')
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
                        <a href="{{ route('media-category.create') }}" class="btn btn-primary font-weight-bolder">
                        <span class="svg-icon svg-icon-md">
                            <i class="fa fa-plus"></i>
                        </span>New Category</a>
                    </div>
                </div>
                <div class="card-body" style="padding-top: 0px;">
                    <table class="table table-bordered table-hover table-checkable" id="kt_mediaCategory" style="margin-top: 13px !important">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Is Active</th>
                                <th style="width: 20%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mediaCategorys as $mediaCategory)
                            <tr>
                                <td>{{ $mediaCategory->id }}</td>
                                <td>{{ $mediaCategory->name }}</td>
                                <td>{{ $mediaCategory->is_active }}</td>
                                <td>
                                    <a href="{{ route('media-category.edit', $mediaCategory->id ) }}" class="btn btn-sm btn-warning btn-icon mr-2" title="Edit details">
                                        <span class="svg-icon svg-icon-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path d="M8,17.9148182 L8,5.96685884 C8,5.56391781 8.16211443,5.17792052 8.44982609,4.89581508 L10.965708,2.42895648 C11.5426798,1.86322723 12.4640974,1.85620921 13.0496196,2.41308426 L15.5337377,4.77566479 C15.8314604,5.0588212 16,5.45170806 16,5.86258077 L16,17.9148182 C16,18.7432453 15.3284271,19.4148182 14.5,19.4148182 L9.5,19.4148182 C8.67157288,19.4148182 8,18.7432453 8,17.9148182 Z" fill="#000000" fill-rule="nonzero"\ transform="translate(12.000000, 10.707409) rotate(-135.000000) translate(-12.000000, -10.707409) "/>
                                                    <rect fill="#000000" opacity="0.3" x="5" y="20" width="15" height="2" rx="1"/>
                                                </g>
                                            </svg>
                                        </span>
                                    </a>
                                    <form class="form__delete" style="display: inline-block;" method="POST" action="{{ route('media-category.destroy', $mediaCategory->id ) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-icon" title="Delete">
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
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Entry-->
</div>
<!--end::Content-->
@endsection
@section('scripts')
<!--begin::Page Vendors(used by this page)-->
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
<!--end::Page Vendors-->
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
