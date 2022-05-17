{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'Facebook')
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
            <div class="add__more d-flex justify-content-end mb-4">
                <a class="" onClick="logInWithFacebook()">
                    <div class="cdp__btn__add btn btn-primary">
                        + &nbsp; Add your fanpages
                    </div>
                </a>
            </div>
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
    var fbData = JSON.parse('{!! json_encode($fbData) !!}');
    var APP_URL = JSON.parse('{!! json_encode(url('/')) !!}');
    console.log(APP_URL);
</script>
<script>
    logInWithFacebook = function() {
            FB.login(function(response) {
                if (response.authResponse) {
                    window.location.href = "/facebook-fanpage/get-access-token/" + response.authResponse.accessToken + "&" + response.authResponse.userID;
                } else {
                    alert('User canceled login or did not fully authorize.');
                }
            }, {
                scope:'pages_show_list,manage_pages,pages_messaging,pages_manage_engagement,pages_manage_metadata,read_insights,pages_read_engagement,pages_read_user_content,pages_manage_ads',
                return_scopes: true,
                enable_profile_selector: true
            });

        return false;
    };
    window.fbAsyncInit = function() {
        FB.init({
            appId: "{{ config('facebook.app_id') }}",
            cookie: true,
            version: "{{ config('facebook.app_version') }}"
        });
    };
    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>
<script src="{{ asset('js/facebook.js') }} "></script>
<script src="{{asset('js/pages/features/miscellaneous/sweetalert2.js')}}"></script>
<script>
    $(document).ready(function(){
        $(document).on('click','.form__delete',function(e){
            let that = $(this);
            e.preventDefault();
            swal.fire({
                title: "Are you sure?",
                text: "This operation will not be unrecoverable",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    swal.fire(
                        "Deleted!",
                        "",
                        "success"
                    )
                    window.location.href = that.attr('href');
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
