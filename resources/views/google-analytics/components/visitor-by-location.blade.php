<div class="col__left">
    <div class="tab__header custom__pst">
        <ul>
            <li class="active">
                <a href="#">Visitors by Country</a>
            </li>
        </ul>
    </div>
    <br />
    <div id="visitor-by-country-chart"></div>
</div>
@section('scripts')
@parent
<script>
    let locationData = @json($data['countries']);
    function renderVistorByCountryChart() {
        var options = {
            series: [{
                data: locationData.value
            }],
            chart: {
                type: 'bar',
                height: 400
            },
            plotOptions: {
              bar: {
                borderRadius: 4,
                horizontal: true,
              }
            },
            xaxis: {
              categories: locationData.label,
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                  return val.toFixed(3) + "%"
                },
            },
        };

        let chart = new ApexCharts(document.querySelector("#visitor-by-country-chart"), options);
        chart.render();
    }
    renderVistorByCountryChart()
</script>
@endsection
