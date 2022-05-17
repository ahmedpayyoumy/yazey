{{-- Extends layout --}}
@extends('layout.default')

@section('title', 'Google Analytics')
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
                    <form action="{{ route('google-analytics.accounts.select-website') }}" method="POST" id="form_select_website">
                        @csrf
                        <table class="table table-bordered table-hover table-checkable" id="website_url" style="margin-top: 13px !important">
                            {{-- Extends layout --}}

                        </table>
                        <br />
                        @if (!$isDisabledSelectBtn)
                            <button type="button" class="btn btn-primary" style="float:right" id="select_website">Select website</button>
                        @endif
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="content d-flex flex-column flex-column-fluid">
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">

                <div class="add__more d-flex justify-content-end mb-4">
                    <a class="" onClick="logInWithGGAnalytics()">
                        <div class="cdp__btn__add btn btn-primary">
                            + &nbsp; Add more data
                        </div>
                    </a>
                </div>
            
            <div class="card card-custom">
                <div class="card-body">
                    <table class="table table-bordered table-hover table-checkable" id="google_analytics_accounts" style="margin-top: 13px !important">
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
    var ggAnalyticsData = JSON.parse('{!! json_encode($accounts) !!}');
    var websiteData = JSON.parse('{!! json_encode($websiteUrls) !!}');
    // console.log('websiteData', websiteData);
</script>
<script>
    logInWithGGAnalytics = function() {
        $.ajax({
            url: '/google-analytics/accounts/add',
            type: 'GET',
            success: function (data) {
                window.open(data);
            }
        })
    };
</script>
<script src="{{ asset('js/google-analytics.js') }} "></script>
<script src="{{asset('js/pages/features/miscellaneous/sweetalert2.js')}}"></script>
<script>
    $(document).ready(function(){
        // Popup confirm select website
        $(document).on('click','#select_website',function(e){
            const form = $('#form_select_website')[0];
            console.log('form', form);
            e.preventDefault();
            swal.fire({
                title: "Confirm select website",
                text: "The website is selected only one time.",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Confirm",
                cancelButtonText: "Cancel",
                reverseButtons: true
            }).then(function(result) {
                if (result.value) {
                    swal.fire(
                        "Success!",
                        "",
                        "success"
                    )
                    form.submit();
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
                        "Deleted!",
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
