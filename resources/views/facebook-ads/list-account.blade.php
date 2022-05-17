@extends('layout.default')

@section('styles')
@section('title', 'Facebook Ads Accounts')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
<script type="text/javascript" src="//connect.facebook.net/en_US/all.js#xfbml=1&appId={{config('facebook.app_id')}}" id="facebook-jssdk"></script>
<style>
.warehouse__action {
    margin-right: 7px;
}
.fanpage_logo {
    border-radius: 4px;
    box-shadow: 0 0.5px 1.5px 0.5px rgb(0 0 0 / 10%);
    margin-right: 5px;
}
</style>
@endsection

@section('content')
@include('facebook-ads.components.facebook-pages', [
    'pages' => $pages,
    'isDisabledSelectBtn' => $isDisabledSelectBtn
])
@include('facebook-ads.components.facebook-ads', [
    'accounts' => $accounts,
    'isDisabledSelectBtn' => $isDisabledSelectBtn
])

@endsection
