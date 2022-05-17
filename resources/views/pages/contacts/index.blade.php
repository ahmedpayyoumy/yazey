{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'Contact')
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
                <div class="card-body">
                    <table class="table table-bordered table-hover table-checkable" id="kt_contact" style="margin-top: 13px !important">
                       {{-- Extends layout --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    var contactData = JSON.parse('{!! json_encode($contacts) !!}');
    var APP_URL = JSON.parse('{!! json_encode(url('/')) !!}');
    console.log(APP_URL);
</script>
<script src="{{ asset('js/contacts.js') }} "></script>
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
                        "Cancelled",
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
