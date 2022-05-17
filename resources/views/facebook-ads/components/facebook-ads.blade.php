<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            <div class="add__more d-flex justify-content-end mb-4">
                <a class="" onClick="logInWithFacebookAds()">
                    <div class="cdp__btn__add btn btn-primary">
                        + &nbsp; Add more data
                    </div>
                </a>
            </div>
            <div class="card card-custom">
                <div class="card-body">
                    <table class="table table-bordered table-hover table-checkable" id="facebook-ads-table" style="margin-top: 13px !important">
                        {{-- Extends layout --}}
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@section('scripts')
@parent
<script type="text/javascript">
    var accounts = JSON.parse('{!! json_encode($accounts) !!}');
</script>
<script>
    logInWithFacebookAds = function() {
        // FB.api('/me/permissions/pages_show_list', 'DELETE', function(){
        FB.login(function(response) {
            if (response.authResponse) {
                window.location.href = "/facebook-ads/get-access-token/" + response.authResponse.accessToken + "&" + response.authResponse.userID;
            } else {
                alert('User canceled login or did not fully authorize.');
            }
        }, {
            scope: 'ads_read,ads_management,read_insights,pages_show_list,read_insights,pages_read_engagement,pages_read_user_content,pages_manage_engagement,pages_manage_metadata',
            return_scopes: true,
            enable_profile_selector: false
        });

       /// ,manage_pages,pages_messaging,pages_manage_engagement,pages_manage_metadata,read_insights,pages_read_engagement,pages_read_user_content
        // });

        return false;
    };
    window.fbAsyncInit = function() {
        FB.init({
            appId: "{{ config('facebook.app_id') }}",
            cookie: true,
            version: "{{ config('facebook.app_version') }}"
        });
    };
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script src="{{ asset('js/facebook-ads.js') }} "></script>
<script src="{{asset('js/pages/features/miscellaneous/sweetalert2.js')}}"></script>

<script>
    $(document).ready(function() {
        $(document).on("click", "#facebook-ads-table .btn-delete", function(e) {
            e.preventDefault();
            let href = $(this).attr('href')
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
                    window.location.href = href
                    // result.dismiss can be "cancel", "overlay",
                    // "close", and "timer"
                } else if (result.dismiss === "cancel") {
                    swal.fire(
                        "Cancelled",
                        ":)",
                        "error"
                    )
                }
            });
        });
    })
</script>
@endsection