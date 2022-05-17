<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{env('APP_NAME')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('media/logos/icon.png') }}" />

    <link href="{{ asset('css/pages/users/login-1.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/custom-css.css') }}" rel="stylesheet" /> {{-- Fonts --}} {{ Metronic::getGoogleFontsInclude() }} {{-- Global Theme Styles (used by all pages) --}} @foreach(config('layout.resources.css') as $style)
    <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}" rel="stylesheet" type="text/css" /> @endforeach {{-- Layout Themes (used by all pages) --}} @foreach(Metronic::initThemes() as $theme)
    <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($theme)) : asset($theme) }}" rel="stylesheet" type="text/css" /> @endforeach @toastr_css
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .animation-boxs {
            display: none;
        }
    </style>
</head>

<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v13.0&appId=630037578026405&autoLogAppEvents=1" nonce="eg6Zq93I"></script>

    <!--begin::Main-->
    <div class="d-flex flex-column flex-root form-users">
        <div class="bg__yezy__si">
            <div class="animation-boxs">
                <div class="form-look">
                    <div class="fix-form">
                        <img src="/images/back-1.png" alt="" class="form-img">
                    </div>
                    <div class="block__form">
                        <div class="logo">
                            <img src="/images/logo.png" width="50px" alt="">
                            <img src="/images/logo-text.png" width="190px" alt="">
                        </div>

                        <div class="form">
                            <form novalidate="novalidate" method="POST" action="{{ route('authenticate.loginPost') }}">
                                @csrf
                                <div class="header__form">
                                    Sign in
                                </div>
                                <div class="des__header">
                                    Enter to continue to your dashboard.
                                </div>

                                <div class="bl__input">
                                    <div class="input__group">
                                        <div for="" class="lb__input">Email Address</div>
                                        <input type="email" name="email" placeholder="You@email.com" required>
                                    </div>

                                    <div class="input__group">
                                        <div for="" class="lb__input">Password</div>
                                        <div class="input__with__eye">
                                            <input type="password" name="password" placeholder="Enter your password" required>
                                            <div class="icon__eye">
                                                <img src="/images/visibility-eye.svg" class="visibility__eye hide show" alt="">
                                                <img src="/images/visibility-off-eye.svg" class="visibility__off__eye hide" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="action">
                                    <button type="submit" class="btn btn__submit">
                                        Login
                                    </button>

                                    <div class="row">
                                        <div class="col-md-12" style="margin-bottom:20px;">
                                            <a onclick="loginV2()" class="btn btn-primary dddd" style="max-width:fit-content;font-size:17px;background: #2026E9;display: flex;margin-top:8px;padding:13px 35px;align-items: center;color: #FFF;border-radius: 10px;font-family: sans-serif;text-transform: none;">
                                                <i class="fa-brands fa-facebook-square fa-2x"></i>
                                                <span style="margin-left:10px;">Login With Facebook</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="link__signup">
                                        Don’t have an account ? <a href="{{url('register')}}">Sign up</a>
                                    </div>
                                    <div class="link__signup" style="padding-top: 10px;">
                                        <a href="{{url('forgot-password')}}">Forgot Password ?</a>
                                    </div>
                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var HOST_URL = "{{ route('quick-search') }}";
    </script>

    {{-- Global Config (global config for global JS scripts) --}}
    <script>
        var KTAppSettings = {
            !!json_encode(config('layout.js'), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!
        };
    </script>

    {{-- Global Theme JS Bundle (used by all pages) --}} @foreach(config('layout.resources.js') as $script)
    <script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach

</body>
@jquery
@toastr_js
@toastr_render

<script>
    $(document).ready(function() {
        let flag = true;
        $(document).on('click', '.icon__eye', function() {
            if (flag) {
                $(".visibility__eye").removeClass('show');
                $(".visibility__off__eye").addClass('show');
                $(this).parent().find('input').attr("type", "text")
                flag = false;
            } else {
                $(".visibility__eye").addClass('show');
                $(".visibility__off__eye").removeClass('show');
                $(this).parent().find('input').attr("type", "password")
                flag = true;
            }
        })
    })
</script>

<script>
    $(document).ready(function() {
        $('.animation-boxs').css('display', 'none');
        $('.animation-boxs').fadeIn(2500);

        function newPage() {
            window.location = newLocation;
        }
    });
</script>

<script>
loginV2 = function() {
    FB.login(function(response){
        // handle the response
        FB.api(
            "/"+response.authResponse.userID+"?fields=name,email,id,picture{url}",
            function (data) {
                if (data && !data.error) {
                    /* handle the result */
                    $.ajax({
                        method: "POST",
                        url : "{{url('/fbregister')}}",
                        data: {_token : "{{csrf_token()}}", request1 : response, request2 :data},
                        success: function(res){
                            if(res){
                                $('#loader').show();
                                FB.api("me/accounts?fields=picture{url},name,access_token,page_token,website",
                                    function(res){
                                        $.ajax({
                                            method: "POST",
                                            url : "{{url('/fbregisterPage')}}",
                                            data: {_token : "{{csrf_token()}}", payload : res},
                                            success: function(d) {
                                                console.log(d);
                                                if(d === "good"){
                                                    window.location.href = "/facebook-ads/get-access-tokenV2/" + response.authResponse.accessToken + "&" + response.authResponse.userID;
                                                } else {
                                                    console.log(d);
                                                }
                                            }
                                        });
                                    }
                                );
                            }
                        }
                    });
                }
            }
        );
    },
    {
        scope: 'public_profile,ads_read,ads_management,read_insights,pages_read_engagement,pages_manage_ads',
        return_scopes: true,
        enable_profile_selector: true
    });
    // var page = "https://www.facebook.com/v13.0/dialog/oauth?response_type=token&display=popup&client_id=630037578026405&redirect_uri=https%3A%2F%2Fdevelopers.facebook.com%2Ftools%2Fexplorer%2Fcallback%3Fmethod%3DGET%26path%3Dme%252Faccounts%26version%3Dv13.0&auth_type=rerequest&scope=email%2Cpages_manage_metadata%2Cpublic_profile%2Cpages_manage_ads%2Cads_read%2Cads_management%2Cpages_show_list%2Cpages_read_engagement%2Cpages_read_user_content%2Cpages_manage_posts%2Cpages_manage_engagement%2Cpages_manage_instant_articles%2Cpages_manage_cta";

    // var $dialog = $('<div></div>')
    //             .html('<iframe style="border: 0px; " src="' + page + '" width="100%" height="100%"></iframe>')
    //             .dialog({
    //                 autoOpen: false,
    //                 modal: true,
    //                 height: 625,
    //                 width: 500,
    //                 title: "Some title"
    //             });
    // $dialog.dialog('open');
};
</script>

</html>