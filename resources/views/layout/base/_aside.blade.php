{{-- Aside --}}

@php
    $kt_logo_image = 'logo-light.png';
@endphp

@if (config('layout.brand.self.theme') === 'light')
    @php $kt_logo_image = 'logo-dark.png' @endphp
@elseif (config('layout.brand.self.theme') === 'dark')
    @php $kt_logo_image = 'logo-light.png' @endphp
@endif

<div class="aside aside-left {{ Metronic::printClasses('aside', false) }} d-flex flex-column flex-row-auto" id="kt_aside">

    {{-- Brand --}}
    <div class="brand flex-column-auto {{ Metronic::printClasses('brand', false) }}" id="kt_brand">
        <div class="brand-logo">
            <a href="{{ url('/') }}">
                <img src="{{asset('/images/logo.png')}}" alt="" width="40px">
                <!-- <img src="{{asset('/images/logo-text.png')}}" alt="" width="200px"> -->
            </a>
        </div>

        @if (config('layout.aside.self.minimize.toggle'))
            {{-- <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                {{ Metronic::getSVG("media/svg/icons/Navigation/Angle-double-left.svg", "svg-icon-xl") }}
            </button> --}}
        @endif

    </div>

    {{-- Aside menu --}}
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">

        @if (config('layout.aside.self.display') === false)
            <div class="header-logo">
                <a href="{{ url('/') }}">
                    <img alt="{{ config('app.name') }}" src="{{ asset('media/logos/login-logo.svg') }}"/>
                </a>
            </div>
        @endif

        <div
            id="kt_aside_menu"
            class="aside-menu my-4 {{ Metronic::printClasses('aside_menu', false) }}"
            data-menu-vertical="1"
            {{ Metronic::printAttrs('aside_menu') }}>

            <ul class="menu-nav {{ Metronic::printClasses('aside_menu_nav', false) }}">
                <?php if(Auth::user()->user_role=='1'){ ?>
                {{ Menu::renderVerMenu(config('menu_aside_admin.items')) }}
                <?php }else{ ?>
                {{ Menu::renderVerMenu(config('menu_aside.items')) }}
                <?php } ?>
            </ul>
        </div>

        <div id="bottom-menu-user" class="d-flex justify-content-between align-items-center">
            <div class="custom__user w-100 d-flex justify-content-between align-items-center">
                <div class="user d-flex align-items-center justify-content-start" style="flex: 1; cursor: pointer">
                    @php
                        $companyId = session('company_id');
                    @endphp
                    <span class="user-avatar">
                        <img id="company_avatar"
                        src="{{Auth::user()->avatar ?? '/images/logo.png'}}"
                        onerror="this.onerror=null; this.src='/images/logo.png'"
                        height='100%' alt="{{Auth::user()->name}}" />
                        <div class="active__btn"></div>
                    </span>
                    <div style="overflow: hidden; margin-left: 14px" class="user__name font-weight-bolder d-md-inline mr-3 none-minimize" data-toggle="tooltip" title="{{Auth::user() && Auth::user()->name ? Auth::user()->name : 'User'}}">
                        <div class="profile__name">
                            {{Auth::user() && Auth::user()->name ? Auth::user()->name : 'User'}}
                        </div>
                        <div class="edit__profile">
                            <a href="/my-profile">
                                Edit profile
                            </a>
                        </div>
                    </div>
                </div>
                <div class="btn-group dropup">
                    <span class="drop-logout" style="font-size: 18px; cursor: pointer; color: #94A3B8;font-weight: bold;">...</span>
                    <div class="dropdown-menu dropdown-menu-right" style="width: 180px;height: auto;left: -40px;">
                        <form class="mb-0" action="/my-profile" method="get">
                            <button type="submit" class="dropdown-item">User Profile</button>
                        </form>
                        <a type="button" href="{{url('/connect-data')}}" class="dropdown-item" style="color: black;">Connect Data</a>
                        <form id="aside-logout-form" class="mb-0" action="/logout" method="get">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
