{{-- Extends layout --}}
@extends('layout.default')
@section('title', 'Dashboard')
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
<script>
    window.intercomSettings = {
        api_base: "https://api-iam.intercom.io",
        app_id: "jbj0c34v"
    };
    </script>
    
    <script>
    // We pre-filled your app ID in the widget URL: 'https://widget.intercom.io/widget/jbj0c34v'
    (function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',w.intercomSettings);}else{var d=document;var i=function(){i.c(arguments);};i.q=[];i.c=function(args){i.q.push(args);};w.Intercom=i;var l=function(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/jbj0c34v';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);};if(document.readyState==='complete'){l();}else if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
    </script>
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}"> @endsection {{-- Content --}} @section('content')


<style>
    .yo{
        font-size: 24px;
        font-weight: bold;
        color: #06152B;
        border: 1px solid #06152B;
        border-radius: 5px;
        text-align: center;
        margin: 20px 0px;
        width: auto;
        display: inline-block;
        padding: 2px 20px;
    }
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


<?php
$permission = Auth::user()->permission;

if ($permission) {
    $check_permission = explode(",", $permission);
} else {
    $check_permission = [];
}
?>
<div class="container dashboard__class">
    {{-- header --}}
    <div class="header__top">
        <div class="flex__header__top">
            <div class="col__left">
                <div class="flex__text__select">
                    <div class="text">
                        Dashboard Overview:
                    </div>
                    <div class="select">
                        <b>{{isset(Auth::user()->facebook_page[0]) ? Auth::user()->facebook_page[0]->website :''}}</b>
                        <!--{{ $selectedAccount ? $selectedAccount : 'Not selected' }}-->
                        <!-- <select name="account_id" id="">
                            @if (count($accounts))
                                @foreach ($accounts as $account)
                                    <option value="{{$account->id}}">
                                        {{$account->name}}
                                    </option>
                                @endforeach
                            @endif
                        </select> -->
                    </div>
                </div>
                <div class="text__bold">
                    Industry ROI rank:


                    <?php $rank = 1;
                    $roas = 0 ?>
                    @if (count($current_user_reports))
                    @foreach ($current_user_reports as $current_user_report)
                    <?php if ($current_user_report->user_id == Auth::user()->id) {
                        $roas = $current_user_report->roas;
                    ?>
                        {{$rank}}

                    <?php } ?>
                    <?php $rank++; ?>
                    @endforeach
                    @endif

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

                <!-- <div class="avatar__box">
                    <a href="#">
                        <img src="{{Auth::user()->avatar ? asset(Auth::user()->avatar) : asset('/images/logo.png')}}" width="130px" alt="{{Auth::user()->name}}" />
                    </a>
                </div> -->
                <div style="z-index: 1;">
                    <a href="#" style="cursor: pointer;z-index:2;" class="upgrader3"><img src="{{asset('images/Upgrade.png')}}" width="200" class="img" alt=""></a>
                </div>
                <div class="btn-group dropup" style="margin-left: 10px;">
                    <span class="drop-logout" style="font-size: 18px; cursor: pointer; color: #94A3B8;font-weight: bold;">...</span>
                    <div class="dropdown-menu dropdown-menu-right" style="width: 180px;height: auto;left: -40px;margin-bottom: -9.875rem;">
                        <form class="mb-0" action="/my-profile" method="get">
                            <button type="submit" class="dropdown-item">User Profile</button>
                        </form>
                        <form id="aside-logout-form" class="mb-0" action="{{url('logout')}}" method="get">
                            @csrf
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- section khối thống kê --}}
    <div class="statistic__section box-size">



        <div class="statistic__box">
            <div class="statistic__header">
                <div class="icon__stt">
                    <img src="{{asset('/images/Increase.jpeg')}}">
                    <!--<i class="fas fa-credit-card text-primary icon-lg"></i>-->
                    <div class="col__stt__right">
                        <div class="box__icon__arr_red">
                            <img src="{{asset('/images/dashboard/arrow-red.png')}}" width="8px" alt="">
                        </div>
                        <div class="text__red">
                            -0.0%
                        </div>
                    </div>
                </div>
            </div>
            <div class="stt__total">
                <div class="head__total">
                    Your ROAS
                </div>
                <div class="money" id="totalSpend">
                    <!--dynamic roas-->
                    <!--@if (!empty($total_spend_data))-->
                    <!--{{ $total_spend_data[0]->roas_total? $total_spend_data[0]->roas_total:0 }} x-->
                    <!--@else-->
                    <!--0 x-->
                    <!--@endif-->

                    @if (in_array('dashboard_roas',$check_permission) && $has_user)
                    {{$roas}} x
                    @else
                    <span class="yo" style="font-size: 24px;font-weight: bold;color: #06152B;"><a href="{{url('/connect-data')}}" style="color: inherit;">Connect data</a> </span>
                    <span style="filter: blur(5px);">$209,879</span>
                    @endif



                </div>
                <div class="text__gray">
                    Compared to ({{(isset($lastMonthData)) ? $lastMonthData->roas : 0}} last month)
                </div>
            </div>
        </div>

        <div class="statistic__box">


            <div class="statistic__header">
                <div class="icon__stt">
                    <img src="{{asset('/images/people.jpeg')}}">
                    <!--<i class="fas fa-credit-card text-primary icon-lg"></i>-->
                    <div class="col__stt__right">
                        <div class="box__icon__arr__green">
                            <img src="{{asset('/images/dashboard/arrow-green.png')}}" width="8px" alt="">
                        </div>
                        <div class="text__green">
                            +0.0 %
                        </div>
                    </div>
                </div>
            </div>
            <div class="stt__total">
                <div class="head__total">
                    Your Traffic
                </div>

                <div class="money" id="totalSpend">

                    @if (in_array('dashboard_traffic',$check_permission) && $has_user)
               

                    {{ $siteTraffic }}

                    @else
                    <span class="yo" style="font-size: 24px;font-weight: bold;color: #06152B;"><a href="{{url('/connect-data')}}" style="color: inherit;">Connect data</a> </span>
                    <span style="filter: blur(5px);">$209,879</span>
                    @endif


                </div>
                <div class="text__gray">
                    Compared to ({{(isset($lastMonthData) && $lastMonthData->traffic != null) ? $lastMonthData->traffic : 0 }} last month)
                </div>
            </div>

        </div>

        <div class="statistic__box statistic__box_cs__">
            <div class="statistic__header">
                <div class="icon__stt">
                    <img src="{{asset('/images/Money Bag.jpeg')}}">
                    <!--<i class="fas fa-credit-card text-primary icon-lg"></i>-->
                    <div class="col__stt__right">
                        <div class="box__icon__arr__green">
                            <img src="{{asset('/images/dashboard/arrow-green.png')}}" width="8px" alt="">
                        </div>
                        <div class="text__green">
                            +0.0%
                        </div>
                    </div>
                </div>
            </div>
            <div class="stt__total">
                <div class="head__total">
                    Your Sales
                </div>
                <div class="money" id="totalSpend">
                    <!--@if (!empty($total_spend_data))-->
                    <!--    <?php // echo currency_convert($total_spend_data[0]->account_currency);
                            ?> -->
                    <!--     {{ number_format($total_spend_data[0]->spend_total? $total_spend_data[0]->spend_total:0) }}-->

                    <!--  @else-->
                    <!--  0-->
                    <!--  @endif-->



                    @if (in_array('dashboard_sales',$check_permission))
                    <span style="filter: blur(5px);">$209,879</span>
                    @else
                    <span class="yo" style="font-size: 24px;font-weight: bold;">Coming Soon</span>
                    <span style="filter: blur(5px);">$209,879</span>
                    @endif
                </div>
                <div class="text__gray" style="filter: blur(5px);">
                    Compared to ($193,400 last year)
                </div>
            </div>
        </div>




        <div class="statistic__box statistic__box_cs__">


            <div class="statistic__header">
                <div class="icon__stt">
                    <div class="head__total">
                        Your sales goal for <spna>the past year</spna>

                        <div class="stt__total">

                            <div class="money" id="totalSpend">

                                @if (in_array('dashboard_past_year_sales',$check_permission))
                                <span style="filter: blur(5px);">$308,647</span>
                                <p style="font-size: 13px;margin: 0px;line-height: 30px;">Coming Soon</p>
                                @else
                                <span class="yo" style="font-size: 24px;font-weight: bold;display: block;color: #ffffff;border-color: #ffffff !important;">Coming Soon</span>
                                <span style="filter: blur(5px);">$308,647</span>
                                <!--<p style="font-size: 13px;margin: 0px;line-height: 30px;">Coming Soon</p>-->

                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="col__stt__right" id="chart2">

                    </div>
                </div>
            </div>

        </div>



        {{-- box 4 --}}

    </div>


    {{-- section chart and Recent Sales --}}
    
    <div class="grid__chart">
    @if($userSelectAccount)
        @include('dashboard.components.chart', [
        'insights' => $insights
        ])

        @else
        @include('dashboard.components.new-user-chart')
        @endif
    </div>


    {{-- section table --}}
    <div class="section__table">
        <div class="tb__header">
            <div class="hd__left">
                Brand Ranking Table
            </div>
            <div class="hd__right">
                <div class="btn btn__download">
                    <img src="/images/dashboard/download.png" width="16px" alt=""> Generate Report
                </div>
                <div class="icon__dots">
                    <img src="/images/dashboard/dotted-icon.png" width="28px" alt="">
                </div>
            </div>
        </div>


        <?php

        function currency_convert($curreny)
        {
            //     $currency_symbols =[
            //     'USD' => '$', // US Dollar
            //     'EUR' =>  '€', // Euro
            //     'CRC'=>  '₡', // Costa Rican Colón
            //     'GBP'=>  '£', // British Pound Sterling
            //     'ILS'=>  '₪', // Israeli New Sheqel
            //     'INR'=>  '₹', // Indian Rupee
            //     'JPY'=>  '¥', // Japanese Yen
            //     'KRW'=>  '₩', // South Korean Won
            //     'NGN'=>  '₦', // Nigerian Naira
            //     'PHP'=>  '₱', // Philippine Peso
            //     'PLN'=>  'zł', // Polish Zloty
            //     'PYG'=>  '₲', // Paraguayan Guarani
            //     'THB'=>  '฿', // Thai Baht
            //     'UAH'=>  '₴', // Ukrainian Hryvnia
            //     'VND'=>  '₫', // Vietnamese Dong
            // ];
            $currency_symbols = [
                'USD' => '$', // US Dollar
                'EUR' =>  '$', // Euro
                'CRC' =>  '$', // Costa Rican Colón
                'GBP' =>  '$', // British Pound Sterling
                'ILS' =>  '$', // Israeli New Sheqel
                'INR' =>  '$', // Indian Rupee
                'JPY' =>  '$', // Japanese Yen
                'KRW' =>  '$', // South Korean Won
                'NGN' =>  '$', // Nigerian Naira
                'PHP' =>  '$', // Philippine Peso
                'PLN' =>  '$', // Polish Zloty
                'PYG' =>  '$', // Paraguayan Guarani
                'THB' =>  '$', // Thai Baht
                'UAH' =>  '$', // Ukrainian Hryvnia
                'VND' =>  '$', // Vietnamese Dong
            ];
            if ($curreny !== "") {
                return $currency_symbols[$curreny];
            } else {
                return '';
            }
        }
        // die(print_r($userSelectAccount));
?>
@if($userSelectAccount)
        @include('dashboard.components.roi-table', [
        'totalSpend' => $totalSpend,
        'totalUsers' => $totalUsers,
        'userIndustry' => $userIndustry,
        'userSelectAccount' => $userSelectAccount,
        'reports' => $reports,
        'currUrl' => $currUrl
        ])
@else
        @include('dashboard.components.roi-new-user');
        @endif
    </div>
    <!-- Messenger Chat plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
        var chatbox = document.getElementById('fb-customer-chat');
        chatbox.setAttribute("page_id", "100894342331082");
        chatbox.setAttribute("attribution", "biz_inbox");

        window.fbAsyncInit = function() {
            FB.init({
                xfbml: true,
                version: 'v12.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

</div>

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
            scope: 'ads_read,ads_management,read_insights',
            return_scopes: true,
            enable_profile_selector: true
        });
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    jQuery(document).ready(function() {
        $(".upgrader").on('click', function(e){
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 0);
            $("#exampleModal").modal('show');
            $("#exampleModal").css('visibility', 'visible');
        });
        $(".upgrader2").on('click', function(e){
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 0);
            $("#exampleModal").modal('show');
            $("#exampleModal").css('visibility', 'visible');
        });
        $(".upgrader3").on('click', function(e){
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 0);
            $("#exampleModal").modal('show');
            $("#exampleModal").css('visibility', 'visible');
        });
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
<!--<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>-->
<!--  <script>-->
<!--$(document).ready(function(){-->
<!--     $(window).scroll(function () {-->
<!--            if ($(window).scrollTop() + $(window).height() >= $(document).height()) {-->
<!--                load_data();-->
<!--            }-->
<!--        });-->

<!-- function load_data()-->
<!-- {-->
<!--    var _token = $('input[name="_token"]').val();-->
<!--  var id = $('.ajaxdata').last().attr("data-id");-->
<!--  $.ajax({-->
<!--   url:"https://app.yazey.com/load_more",-->
<!--   method:"POST",-->
<!--   data:{id:id, _token:_token},-->
<!--   success:function(data)-->
<!--   {-->
<!--    $('#load_more_button').html('<b>Load More</b>');-->
<!--    $('#post_data').html(data);-->
<!--   }-->
<!--  })-->
<!-- }-->

<!--});-->
<!--</script>-->

@endsection
@section('scripts')
@endsection
