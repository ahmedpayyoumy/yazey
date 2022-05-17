{{-- Extends layout --}}
@extends('layout.default')
@section('title', 'Dashboard')
@section('styles')
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/new.css') }}">
<link rel="stylesheet" href="{{ asset('css/component.css') }}">
<link rel="stylesheet" href="{{ asset('css/layout-global.css') }}">
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
h4.heading {
    font-family: Roboto;
    font-style: normal;
    font-weight: normal;
    font-size: 20px;
    line-height: 23px;
    color: #000000;
    margin-bottom: 40px;
    margin-top: 20px;
}
.boxs-social {
    display: flex;
    justify-content: flex-start;
    align-content: center;
    align-items: flex-end;
    gap: 15px;
    flex-wrap: wrap;
}
.box-icon {
    box-shadow: 0px 0px 4px 2px #c9c1c1;
}
.box-icon {
	border: 2px solid #01354a;
    box-sizing: border-box;
    max-width: 175px;
    min-height: 189px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    margin-bottom: 50px;
    padding: 15px;
    border-radius: 8px;
}
.box-icon img.img-size {
    display: block;
    max-height: 98px;
    width: auto;
}
.box-icon p {
    display: block;
    width: 100%;
    text-align: center;
}
.box-icon p {
    display: block;
    width: 100%;
    text-align: center;
    margin-top: 0;
    margin-bottom: 20px;
    font-family: Roboto;
	font-style: normal;
	font-weight: normal;
	font-size: 20px;
	line-height: 23px;
	color: #000000;

}
.box-icon p b {
    display: block;
}
.box-icon p img.update {
    width: auto;
    height: 30px;
    position: relative;
    top: 0px;
    right: -10px;
}
span.face-book {
    background: #026789;
    color: #fff;
    font-size: 65px;
    width: 90px;
    height: 90px;
    display: flex;
    flex-wrap: wrap;
    align-items: flex-end;
    border-radius: 50%;
    justify-content: center;
}
span.icon-size i {
    color: #026789;
    font-size: 5.5em;
    transition: all 0.3s ease-in-out;
}
.box-icon:hover {
    background: #026789;
}

.box-icon:hover p {
    color: #fff;
}

/*color icons*/

/*span.icon-size i.fa-facebook {*/
/*    color: #4267B2;*/
/*}*/
/*span.icon-size i.fa-google {*/
/*    color: #dd4b39;*/
/*}*/
/*span.icon-size i.fa-twitter {*/
/*    color: #55acee;*/
/*}*/
/*span.icon-size i.fa-snapchat-ghost {*/
/*    color: #FFFC00;*/
/*}*/
/*span.icon-size i.fa-pinterest {*/
/*    color: #cc2127;*/
/*}*/
/*span.icon-size i.fa-amazon {*/
/*    color: #FF9900;*/
/*}*/
/*span.icon-size i.fa-linkedin {*/
/*    color: #0976b4;*/
/*}*/
/*span.icon-size i.fa-magento {*/
/*    color: #f46f25;*/
/*}*/
/*span.icon-size i.fa-shopify {*/
/*    color: #96bf48;*/
/*}*/
.box-icon:hover span.icon-size i {
    color: #fff;
    transform: scale(1.1);
    transition: all 0.3s ease-in-out;
}
</style>
@endsection {{-- Content --}} @section('content')
<div class="container dashboard__class">
    {{-- header --}}




    {{-- section table --}}
  <main>
	<div class="heading-box">
		<h4 class="heading">Marketing Data Sources</h4>
	</div>
	<div class="boxs-social">
	    <a href="<?php echo URL::to("facebook-ads/accounts"); ?>">
		<div class="box-icon">
			<span class="icon-size"><i class="fab fa-facebook"></i></span>
			<p>Facebook <img src="<?php echo url('/images/Ok.svg');
 ?>" alt="check" class="update"></p>
		</div>
		</a>
		<a href="<?php echo URL::to("/google-analytics/accounts"); ?>">
		<div class="box-icon">
			<span class="icon-size"><i class="fab fa-google" aria-hidden="true"></i></span>
			<p>Google <img src="<?php echo url('/images/Ok.svg');
 ?>" alt="check" class="update"></p>
		</div>
		</a>
		<div class="box-icon">
			<span class="icon-size"><i class="fab fa-twitter" aria-hidden="true"></i></span>
			<p><b>Coming Soon</b>Twitter</p>
		</div>
		<div class="box-icon">
			<span class="icon-size"><i class="fab fa-snapchat-ghost" aria-hidden="true"></i></span>
			<p><b>Coming Soon</b>Snapchat</p>
		</div>
		<div class="box-icon">
			<span class="icon-size"><i class="fab fa-pinterest" aria-hidden="true"></i></span>
			<p><b>Coming Soon</b>Pinterest</p>
		</div>
		<div class="box-icon">
			<span class="icon-size"><i class="fab fa-amazon" aria-hidden="true"></i></span>
			<p><b>Coming Soon</b>Amazon Ads</p>
		</div>
		<div class="box-icon">
			<span class="icon-size"><i class="fab fa-linkedin" aria-hidden="true"></i></span>
			<p><b>Coming Soon</b>LinkedIn</p>
		</div>
		<div class="box-icon">
			<span class="icon-size"><i class="fab fa-twitter" aria-hidden="true"></i></span>
			<p><b>Coming Soon</b>Twitter</p>
		</div>
	</div>
	<div class="heading-box">
		<h4 class="heading">Sales Data Sources</h4>
	</div>
	<div class="boxs-social">
		<div class="box-icon">
			<span class="icon-size"><i class="fab fa-shopify" aria-hidden="true"></i></span>
			<p><b>Coming Soon</b>Shopify</p>
		</div>
		<div class="box-icon">
		<img style="width: 100%;" src="<?php echo url('/images/googlean.png');
        ?>" alt="check" class="update">
			<p><b>Coming Soon</b></p>
		</div>
		<div class="box-icon">
			<img style="width: 100%;" src="<?php echo url('/images/woo.png');
        ?>" alt="check" class="update">
			<p><b>Coming Soon</b></p>
		</div>
		<div class="box-icon">
			<span class="icon-size"><i class="fab fa-magento"></i></span>
			<p><b>Coming Soon</b></p>
		</div>
		<div class="box-icon">
			<span class="icon-size"><i class="fab fa-amazon" aria-hidden="true"></i></span>
			<p><b>Coming Soon</b></p>
		</div>
	</div>
</main>
     </div>



@endsection
@section('scripts')

@endsection
