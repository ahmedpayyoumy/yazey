<div class="col__left">
    <div class="tab__header custom__pst">
        <ul>
            <li class="active">
                <a href="#">Marketing Distribution</a>
            </li>
        </ul>
    </div>
    <br />
    <div class="backdrop__filter">

        <div id="visitor-by-device-chart"></div>
    </div>
</div>
@section('styles')
@endsection
@section('scripts')
@parent
<script>
    let deviceData = @json($data['devices']);
    function renderVistorByDeviceChart() {
        var options = {
            series: deviceData.value,
            labels: deviceData.label,
            chart: {
                type: 'donut',
                height: 300
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                  return val.toFixed(3) + "%"
                },
            },
        };

        let chart = new ApexCharts(document.querySelector("#visitor-by-device-chart"), options);
        chart.render();
    }
    renderVistorByDeviceChart()
</script>
@endsection
