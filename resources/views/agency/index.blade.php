{{-- Extends layout --}}
@extends('layout.default')
@section('title', 'Dashboard')
@section('styles')
<style>
        .pricing{
    margin:40px 0px;
    }
    .pricing .table{
    border-top:1px solid #ddd;
    background:#fff;
    }
    .pricing .table th,
    .pricing .table {
    text-align: center;
    }
    .pricing .table th,
    .pricing .table td {
    padding: 20px 10px;
    border:1px solid #ddd;
    border: 1px solid rgba(255, 255, 255, 0.1);
    }
    .pricing .table th {
    width: 25%;
    font-size: 30px;
    font-weight: 400;
    border-bottom: 0;
    background:#2F313A;
    color: #EBEDF3;
    text-transform: uppercase;
    }
    .pricing .table th.highlight{
    border-top: 4px solid #4caf50 !important;
    }
    .pricing .table tr:nth-child(odd){
    background: #f0f8ff;
    }
    .pricing .table td:first-child{
    padding-left: 20px;
    text-align: left;
    padding-top:35px;
    background: #5F97FB;
    }
    .pricing tr td .ptable-title {
    font-size: 22px;
    font-weight:400;
    color: #fff;
    }
    .pricing tr td .ptable-title i {
    width: 23px;
    line-height: 25px;
    text-align: right;
    margin-right: 5px;
    }
    .pricing .ptable-star {
    position: relative;
    display: block;
    text-align: center;
    }
    .pricing .ptable-star.red{
    color: #e91e63;
    }
    .pricing .ptable-star.green{
    color: #4caf50;
    }
    .pricing .ptable-star.lblue{
    color: #03a9f4;
    }
    .pricing .ptable-star i {
    width: 8px;
    font-size: 13px;
    }
    .pricing .ptable-price {
    display: block;
    }
    .pricing tr td {
    font-size: 16px;
    line-height:32px;
    text-transform:uppercase;
    }
    .pricing tr td.bg-red{
    background: #e91e63;
    }
    .pricing tr td.bg-green{
    background: #4caf50;
    }
    .pricing tr td.bg-lblue{
    background: #03a9f4;
    }
    .pricing tr td.bg-red a,
    .pricing tr td.bg-green a,
    .pricing tr td.bg-lblue a{
    color: #fff;
    }
    .pricing tr td i {
    display: block;
    margin-bottom: 12px;
    font-size: 30px;
    }
    .pricing tr td i.red{
    color: #e91e63;
    }
    .pricing tr td i.green{
    color: #4caf50;
    }
    .pricing tr td i.lblue{
    color: #03a9f4;
    }
    .pricing tr td:first-child i{
    display:inline;
    margin-bottom:0px;
    font-size:22px;
    }
</style>
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




    {{-- section table --}}
    <div class="section__table">
    <!-- <div style="z-index: 1;">
        <a href="#" style="cursor: pointer;z-index:2;" class="upgrader"><img src="{{asset('images/Upgrade.png')}}" width="200" class="img" alt=""></a>
    </div> -->
    <img src="{{asset('images/agencySpy.png')}}" style="width: 100%;">
    <div style="z-index: 1;">
        <a href="#" style="cursor: pointer;z-index:2;" class="upgrader"><img src="{{asset('images/Upgrade.png')}}" width="200" class="img" alt=""></a>
    </div>

  </div>

@endsection
@section('scripts')
<script>
        jQuery(document).ready(function() {
            $(".upgrader").on('click', function(e){
                console.log("Good");
                e.preventDefault();
                $('html,body').animate({
                    scrollTop: 0
                }, 0);
                $("#exampleModal").modal('show');
                $("#exampleModal").css('visibility', 'visible');
            });
        });
    </script>
@endsection

@include('dashboard.components.uplgradeModal')
