{{-- Extends layout --}}
@extends('layout.default')
@section('title', 'Google Analytics')
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/new.css') }}">
<link rel="stylesheet" href="{{ asset('css/component.css') }}">
<link rel="stylesheet" href="{{ asset('css/layout-global.css') }}">
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> @endsection {{-- Content --}} @section('content')
<div class="container dashboard__class">
    {{-- header --}}
    <div class="header__top">
        <div class="flex__header__top">
            <div class="col__left">
                <div class="flex__text__select">
                    <div class="text">
                        Dashboard Overview:
                    </div>
                    <div class="text__bold">
                        {{ $result['website_url'] }}
                    </div>
                </div>
                <div class="text__gray text__bold">
                    {{ now()->format('h:i A, jS F Y') }}
                </div>
            </div>

            <div class="col__right">
                <!-- <div class="search__box">
                    <input type="text" name="q">
                    <div class="icon">
                        <img src="/images/dashboard/search-icon.png" width="20px" alt="">
                    </div>
                </div>

                <div class="select__box">
                    <select name="" id="">
                        <option value="">This year</option>
                        <option value="">This year</option>
                        <option value="">This year</option>
                    </select>
                    <div class="icon__select">
                        <img src="/images/dashboard/chvr-down.png" width="14px" alt="">
                    </div>
                </div>

                <div class="notification__box">
                    <div class="action__noti blue"></div>
                    <img src="/images/dashboard/bell.png" width="22px" alt="">
                </div>

                <div class="change__language__box">
                    <img src="/images/dashboard/us.png" width="22px" alt="">
                </div> -->

                <div class="avatar__box">
                    <a href="/my-profile">
                        <img src="{{Auth::user()->avatar ?? '/images/logo.png'}}"
                        onerror="this.onerror=null; this.src='/images/logo.png'"
                         width="48px" alt="{{Auth::user()->name}}" />
                    </a>
                </div>

            </div>
        </div>

    </div>


    {{-- section khối thống kê --}}
    @include('google-analytics.components.general', [
        'general' => $result['data']
    ])

    <div class="grid__chart grid__chart--75-percent">
        {{-- section chart and Recent Sales --}}
        @include('google-analytics.components.visitor-by-date', [
            'data' => $result['data']
        ])
        @include('google-analytics.components.visitor-distribution', [
            'data' => $result['data']
        ])
    </div>
    <div class="grid__chart">
        @include('google-analytics.components.visitor-by-devices', [
            'data' => $result['data']
        ])
    </div>

    <div class="grid__chart grid__chart--half">
        @include('google-analytics.components.visitor-by-location', [
            'data' => $result['data']
        ])

        @include('google-analytics.components.visitor-by-sources', [
            'data' => $result['data']
        ])
    </div>


</div>
@endsection
@section('scripts')

@endsection
