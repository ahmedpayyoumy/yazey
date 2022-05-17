<div class="col__left">
    <div class="tab__header custom__pst">
        <ul>
            <li class="active">
                <a href="#">Visitors by Sources</a>
            </li>
        </ul>
    </div>
    <br />
    <div id="visitor-by-source-chart"></div>
</div>
@section('scripts')
@parent
<script>
    let sourceData = @json($data['sources']);
    function renderVistorBySourceChart() {
        var options = {
            series: sourceData.value,
            labels: sourceData.label,
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

        let chart = new ApexCharts(document.querySelector("#visitor-by-source-chart"), options);
        chart.render();
    }
    renderVistorBySourceChart()
</script>
@endsection
