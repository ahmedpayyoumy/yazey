<div class="">
    <div class="tab__header custom__pst">
        <ul>
            <li class="active">
                <a href="#">Visitor Distribution</a>
            </li>
        </ul>
    </div>
    <br />
    <div id="visitor-distribution-chart"></div>
</div>
@section('scripts')
@parent
<script>
    let newUsers = @json($data['newUsers']);
    let users = @json($data['users']);
    function renderVistorByDistributionChart() {
        var options = {
            series: [(newUsers / users * 100), ((users - newUsers) / users * 100)],
            labels: ['New Visitors', 'Returning Visitors'],
            chart: {
                type: 'donut',
                width: 320,
                height: 320
            },
            legend: {
                position: 'bottom'
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                  return val.toFixed(3) + "%"
                },
            },
        };

        let chart = new ApexCharts(document.querySelector("#visitor-distribution-chart"), options);
        chart.render();
    }
    renderVistorByDistributionChart()
</script>
@endsection
