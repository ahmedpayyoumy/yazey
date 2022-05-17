<style>
    /*.statistic__box:before {
        content: '';
        width: 120px;
        height: 57px;
        position: absolute;
        top: 11px;
        right: 10px;
        background-image: url(https://app.yazey.com/images/coming-soon-orange.png);
        background-size: contain;
        background-position: center center;
        background-repeat: no-repeat;
    }*/
    .dddd
    {
        font-size: 24px;
        font-weight: bold;
        color: #06152B;
        border: 1px solid #06152B;
        border-radius: 5px;
        text-align: center;
        margin: 20px 0px;
        width: auto;
        display: inline-block;
        padding: 10px 20px;
    }
</style>

<div class="col__left pt-4">
    <div class="tab__header custom__pst" style="z-index: 9999;">
        <ul>
            <li class="active" id="mros" onclick="marketingroas()">
                <a href="javascript:void(0)">Marketing ROAS</a>
            </li>
            <li onclick="monthlysales()" id="ms">
                <a href="javascript:void(0)">Monthly Sales</a>
            </li>
        </ul>
    </div>
    <div id="chart4" class="text-center chart-bg-new" style="padding: 10px;">
        <div class="money" id="totalSpend" style="/*position: absolute;top: 90px;left: 0;right: 0;*/">
            <span class="dddd" style="font-size: 60px;font-weight: bold;/*display: block;*/color: #06152B;"><a href="{{url('/connect-data')}}" style="color: inherit;">Connect data</a> </span>
        </div>
        <img src="{{asset('images/comming-soon-new2.png')}}" height="300px" style="visibility: hidden" />
    </div>

</div>

@section('scripts')
<script>
    function marketingroas() {
        $("#mros").addClass("active");
        $("#ms").removeClass("active");
    }

    function monthlysales() {
        $("#mros").removeClass("active");
        $("#ms").addClass("active");
    }
</script>

@endsection