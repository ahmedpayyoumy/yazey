<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" {{ Metronic::printAttrs('html') }} {{ Metronic::printClasses('html') }}>

<head>
    <meta charset="utf-8" />

    {{-- Title Section --}}
    <title>{{ config('app.name') }} | @yield('title', $page_title ?? '')</title>

    {{-- Meta Data --}}
    <meta name="description" content="@yield('page_description', $page_description ?? '')" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('media/logos/icon.png') }}" />

    {{-- Fonts --}}
    {{ Metronic::getGoogleFontsInclude() }}

    {{-- Global Theme Styles (used by all pages) --}}
    @foreach(config('layout.resources.css') as $style)
    <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($style)) : asset($style) }}" rel="stylesheet" type="text/css" />
    @endforeach

    {{-- Layout Themes (used by all pages) --}}
    @foreach (Metronic::initThemes() as $theme)
    <link href="{{ config('layout.self.rtl') ? asset(Metronic::rtlCssPath($theme)) : asset($theme) }}" rel="stylesheet" type="text/css" />
    @endforeach

    <link rel="stylesheet" href="/css/custom-aside.css">

    {{-- Includable CSS --}}
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        #loader {
            display: none;
            position: absolute;
            left: 50%;
            z-index: 99999999;
            top: 50%;
            width: 120px;
            height: 120px;
            margin: -76px 0 0 -76px;
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            -webkit-animation: spin 2s linear infinite;
            animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Add animation to "page content" */
        .animate-bottom {
            position: relative;
            -webkit-animation-name: animatebottom;
            -webkit-animation-duration: 1s;
            animation-name: animatebottom;
            animation-duration: 1s
        }

        @-webkit-keyframes animatebottom {
            from {
                bottom: -100px;
                opacity: 0
            }

            to {
                bottom: 0px;
                opacity: 1
            }
        }

        @keyframes animatebottom {
            from {
                bottom: -100px;
                opacity: 0
            }

            to {
                bottom: 0;
                opacity: 1
            }
        }

        #myDiv {
            display: none;
            text-align: center;
        }



        /*body {*/
        /*  animation: fadeIn ease 5s;*/
        /*  -webkit-animation: fadeIn ease 5s;*/
        /*  -moz-animation: fadeIn ease 5s;*/
        /*  -o-animation: fadeIn ease 5s;*/
        /*  -ms-animation: fadeIn ease 5s;*/
        /*  animation-delay: 3s;*/
        /*  -webkit-animation-delay: 3s;*/
        /*  -moz-animation-delay: 3s;*/
        /*  -o-animation-delay: 3s;*/
        /*  -ms-animation-delay: 3s;*/
        /*}*/


        /*@keyframes fadeIn{*/
        /*  0% {*/
        /*    opacity:0;*/
        /*  }*/
        /*  100% {*/
        /*    opacity:1;*/
        /*  }*/
        /*}*/

        /*@-moz-keyframes fadeIn {*/
        /*  0% {*/
        /*    opacity:0;*/
        /*  }*/
        /*  100% {*/
        /*    opacity:1;*/
        /*  }*/
        /*}*/

        /*@-webkit-keyframes fadeIn {*/
        /*  0% {*/
        /*    opacity:0;*/
        /*  }*/
        /*  100% {*/
        /*    opacity:1;*/
        /*  }*/
        /*}*/

        /*@-o-keyframes fadeIn {*/
        /*  0% {*/
        /*    opacity:0;*/
        /*  }*/
        /*  100% {*/
        /*    opacity:1;*/
        /*  }*/
        /*}*/

        /*@-ms-keyframes fadeIn {*/
        /*  0% {*/
        /*    opacity:0;*/
        /*  }*/
        /*  100% {*/
        /*    opacity:1;*/
        /*  }*/
        /*}*/

        body {
            display: none;
        }

        .firsttable::-webkit-scrollbar {
            width: 12px;
        }

        .firsttable::-webkit-scrollbar-track {
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.4);
            border-radius: 8px;
            -webkit-border-radius: 8px;
        }

        .firsttable::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: rgba(100, 100, 100, 0.8);
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
        }


        /*popup*/

        .modal {
            position: absolute;
            z-index: 10000;
            /* 1 */
            top: 0;
            left: 0;
            visibility: hidden;
            width: 100%;
            height: 100%;
            display: block;
        }

        .modal.is-visible {
            visibility: visible;
        }

        .modal-overlay {
            position: fixed;
            z-index: 10;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: hsla(0, 0%, 0%, 0.5);
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s linear 0.3s, opacity 0.3s;
        }

        .modal.is-visible .modal-overlay {
            opacity: 1;
            visibility: visible;
            transition-delay: 0s;
        }

        .modal-wrapper {
            position: absolute;
            z-index: 9999;
            top: 6em;
            left: 0%;
            right: 0%;
            width: 550px;
            margin: auto;
            max-width: 100%;
            background-color: #fff;
            box-shadow: 0 0 1.5em hsla(0, 0%, 0%, 0.35);
        }

        .modal-transition {
            transition: all 0.3s 0.12s;
            transform: translateY(-10%);
            opacity: 0;
        }

        .modal.is-visible .modal-transition {
            transform: translateY(0);
            opacity: 1;
        }

        .modal-header,
        .modal-content {
            padding: 1em;
        }

        .modal-header {
            position: relative;
            justify-content: flex-end;
            background-color: #fff;
            box-shadow: 0 1px 2px hsla(0, 0%, 0%, 0.06);
            border-bottom: 1px solid #e8e8e8;

        }

        .modal-close {
            color: #aaa;
            background: none;
            border: 0;
        }

        .modal-close:hover {
            color: #777;
        }

        .modal-heading {
            font-size: 1.125em;
            margin: 0;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .modal-content>*:first-child {
            margin-top: 0;
        }

        .modal-content>*:last-child {
            margin-bottom: 0;
        }

        .wrapper.pop-updl {
            padding: 0;
            text-align: center;
        }

        .modal-content {
            box-shadow: none;
        }

        .dashboard__class .section__table {
            padding: 0;
            box-shadow: none;
        }
    </style>
    @yield('styles')
    @toastr_css
</head>

<body {{ Metronic::printAttrs('body') }} {{ Metronic::printClasses('body') }}>
    <div id="loader"></div>
    @if (config('layout.page-loader.type') != '')
    @include('layout.partials._page-loader')
    @endif

    @include('layout.base._layout')

    <div class="modal" id="comming-soon">
        <div class="modal-overlay modal-toggle"></div>
        <div class="modal-wrapper modal-transition">
            <div class="modal-header">
                <button class="modal-close modal-toggle">&#x2715</button>
            </div>

            <div class="modal-body">
                <div class="modal-content">
                    <div class="section__table">
                        <img src="{{asset('/images/comming-soon.jpg')}}" style="width: 100%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(auth()->user()->is_new )
    <div class="modal is-visible" id="is_new">
        <div class="modal-overlay "></div>
        <div class="modal-wrapper modal-transition">
            <div class="modal-header">
                <button class="modal-close " onclick="$('#is_new').removeClass('is-visible')">&#x2715</button>
            </div>

            <div class="modal-body">
                <div class="modal-content">
                    <div class="section__table">
                        <h4>Please connect your account to reveal data</h4>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" onclick="$('#is_new').removeClass('is-visible')">OK
                </button>
            </div>
        </div>
    </div>
    @php
    $user = auth()->user();
    $user->is_new = 0;
    $user->save();
    @endphp
    @endif
    <script>
        var HOST_URL = "{{ route('quick-search') }}";
    </script>

    {{-- Global Config (global config for global JS scripts) --}}
    <!-- <script>
        var KTAppSettings = {
            !!json_encode(config('layout.js'), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) !!
        };
    </script> -->

    {{-- Global Theme JS Bundle (used by all pages)  --}}
    @foreach(config('layout.resources.js') as $script)
    <script src="{{ asset($script) }}" type="text/javascript"></script>
    @endforeach

    {{-- Includable JS --}}
    @toastr_js
    @toastr_render

    <script>
        $(document).ready(function() {
            let flag = true
            $(document).on('click', '.drop-logout', function() {
                $(this).parent().find('.dropdown-menu-right').toggleClass('button-logout')
            })
        })
    </script>


    <script src="/js/pages/features/charts/apexcharts.js"></script>
    <script>
        jQuery(".connect_data").click(function() {
            jQuery('#loader').show();
            $.ajax({
                type: 'GET',
                url: '/updatefacebookdata',
                data: '_token = <?php echo csrf_token() ?>',
                success: function(response) {

                    jQuery('#loader').hide();
                    toastr.success('Synchronization is completed successfully', '');
                    window.location.href = "/dashboard";

                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('body').css('display', 'none');
            $('body').fadeIn(2500);
            $("body").on("contextmenu",function(e){
                return false;
            });
            $('body').bind('cut copy paste', function (e) {
                console.log(e);
                e.preventDefault();
            });

            function newPage() {
                window.location = newLocation;
            }
        });
    </script>    
    <script>
        // popup coming soon

        jQuery('.modal-toggle').on('click', function(e) {
            e.preventDefault();
            jQuery('#comming-soon').toggleClass('is-visible');
            jQuery('html,body').animate({
                scrollTop: 0
            }, 0);
        });

        jQuery('.connect-agency').on('click', function(e) {
            e.preventDefault();
            jQuery('#agency_connect_modal').toggleClass('is-visible');
            $('.thankyoumsg').hide();
            $('#payment-agree-box').show();
            $('#payment-form').hide();
            jQuery('html,body').animate({
                scrollTop: 0
            }, 0);
        });
    </script>
    <script src="https://js.stripe.com/v3/"></script>
    @yield('scripts')

    <script>
        window.intercomSettings = {
            api_base: "https://api-iam.intercom.io",
            app_id: "jbj0c34v"
        };
    </script>

    <script>
        // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/jbj0c34v'
        (function() {
            var w = window;
            var ic = w.Intercom;
            if (typeof ic === "function") {
                ic('reattach_activator');
                ic('update', w.intercomSettings);
            } else {
                var d = document;
                var i = function() {
                    i.c(arguments);
                };
                i.q = [];
                i.c = function(args) {
                    i.q.push(args);
                };
                w.Intercom = i;
                var l = function() {
                    var s = d.createElement('script');
                    s.type = 'text/javascript';
                    s.async = true;
                    s.src = 'https://widget.intercom.io/widget/jbj0c34v';
                    var x = d.getElementsByTagName('script')[0];
                    x.parentNode.insertBefore(s, x);
                };
                if (document.readyState === 'complete') {
                    l();
                } else if (w.attachEvent) {
                    w.attachEvent('onload', l);
                } else {
                    w.addEventListener('load', l, false);
                }
            }
        })();
    </script>
</body>

</html>