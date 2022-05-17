<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onboarding</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Eastplayers CMS">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('media/logos/icon.png') }}" />

    <link href="{{ asset('css/pages/users/login-1.css') }}" rel="stylesheet" />
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
                            action="{{ route('authenticate.onboarding') }}">
                        @csrf
                        <input type="hidden" id="user_id" name="user_id" value="{{$user->id}}" />
                        <div class="header__form">
                            Onboarding
                        </div>
                        <div class="des__header">
                            Enter to continue.
                        </div>

                        <div class="bl__input">
                            <div class="input__group">
                                <div for="" class="lb__input">What is your industry?</div>
                                <select id="industry_id" required>
                                    @if (count($industries))
                                        @foreach ($industries as $industry)
                                            <option value="{{$industry->id}}">{{$industry->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <input type="hidden" name="industry_id" value="{{$user->industry_id}}" id="industry_id_hidden">
                            </div>
                        </div>

                        <div class="bl__input">
                            <div class="input__group">
                                <div for="" class="lb__input">Are you working with an marketing agency?</div>
                                <select id="has_agency" required 
                                    @if($user->has_agency)
                                        disabled
                                    @endif
                                    >
                                    <option value="" 
                                    @if(is_null($user->has_agency))
                                        selected
                                    @endif
                                    >
                                    Select option</option>
                                    <option value="{{ App\User::HAS_AGENCY }}"
                                    @if($user->has_agency == App\User::HAS_AGENCY)
                                        selected
                                    @endif
                                    >Yes</option>
                                    <option value="{{ App\User::HAS_NOT_AGENCY }}"
                                    @if($user->has_agency == App\User::HAS_NOT_AGENCY)
                                        selected
                                    @endif
                                    >No</option>
                                </select>
                                <input type="hidden" name="has_agency" value="{{$user->has_agency}}" id="has_agency_hidden">
                            </div>
                        </div>

                        <div class="bl__input 
                        @if($user->has_agency !== App\User::HAS_AGENCY)
                        hide
                        @endif
                        " id="agency_info_group">
                            <div class="input__group">
                                <div for="" class="lb__input">Can you provide us your agency info</div>
                                <input name="agency_info" id="agency_info"/>
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

<script>
    $(document).ready(function(){
        let flag = true;
        $(document).on('click', '.icon__eye', function(){
            if(flag){
                $(this).find(".visibility__eye").removeClass('show');
                $(this).find(".visibility__off__eye").addClass('show');
                $(this).parent().find('input').attr("type", "text")
                flag = false;
            }
            else{
                $(this).find(".visibility__eye").addClass('show');
                $(this).find(".visibility__off__eye").removeClass('show');
                $(this).parent().find('input').attr("type", "password")
                flag = true;
            }
        })

        $(document).on('change', '#has_agency', function(){
            if(this.value != ""){
                // Update in DB, can't change in next time
                var value = this.value;
                var that = this;
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/has_agency',
                    data: {
                        user_id: $("#user_id").val(),
                        has_agency: this.value,
                    },
                    dataType: 'json',
                    success: function(data) {
                        $(that).attr('disabled', 'disabled');
                        $('#has_agency_hidden').val(value);
                        if(value == '{{ App\User::HAS_AGENCY }}'){
                            $('#agency_info_group').show();
                            $('#agency_info').focus();
                        }
                    }
                });
            }
        })

        $(document).on('change', '#industry_id', function(){
            if(this.value != ""){
                // Update in DB, can't change in next time
                var value = this.value;
                $('#industry_id_hidden').val(value);
            }
        })
    })
</script>
</html>
