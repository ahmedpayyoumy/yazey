<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Eastplayers CMS">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('media/logos/icon.png') }}" />

    <link href="{{ asset('css/custom-css.css') }}" rel="stylesheet" /> {{-- Fonts --}} {{ Metronic::getGoogleFontsInclude() }} {{-- Global Theme Styles (used by all pages) --}} @foreach(config('layout.resources.css') as $style)
    <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}" rel="stylesheet" type="text/css" /> @endforeach {{-- Layout Themes (used by all pages) --}} @foreach(Metronic::initThemes() as $theme)
    <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($theme)) : asset($theme) }}" rel="stylesheet" type="text/css" /> @endforeach @toastr_css
</head>

<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <div class="bg__yezy__si">
            <div class="block__form">
                <div class="logo">
                    <img src="/images/logo.png" width="50px" alt="">
                    <img src="/images/logo-text.png" width="190px" alt="">
                </div>

                <div class="form">
                    <form novalidate="novalidate" method="POST"
                    action="{{ route('authenticate.forgotPost') }}">
                        @csrf
                        <div class="header__form">
                            Forgotten Password ?
                        </div>
                        <div class="des__header">
                            Enter your email to reset your password
                        </div>

                        <div class="bl__input">
                            <div class="input__group">
                                <div for="" class="lb__input">Email Address</div>
                                <input type="email" name="email" placeholder="You@email.com" required>
                            </div>
                        </div>

                        <div class="action">
                            <button type="submit" class="btn btn__submit">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        var HOST_URL = "{{ route('quick-search') }}";
    </script>

    {{-- Global Config (global config for global JS scripts) --}}
    <script>
        var KTAppSettings = {!!json_encode(config('layout.js'), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!
        };
    </script>

    {{-- Global Theme JS Bundle (used by all pages) --}} @foreach(config('layout.resources.js') as $script)
    <script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach
</body>
@jquery
@toastr_js 
@toastr_render
</html>