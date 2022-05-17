<div class="col__left">
    <div class="tab__header custom__pst">
        <ul>
            <li class="active">
                <a href="#">Visitors in the last 30 days</a>
            </li>
        </ul>
    </div>
    <br />
    <div id="visitor-by-date-chart"></div>
</div>
@section('scripts')
@parent
<script>
    let visitorData = @json($data['visitors_30']);
    function renderVistorByDateChart() {
        var options = {
            series: [{
                name: 'Visitors',
                data: visitorData.value
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                },
                toolbar: {
                    show: false,
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                type: 'String',
                categories: visitorData.label
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
            },
            colors: ["#1d1df9"],
        };

        let chart = new ApexCharts(document.querySelector("#visitor-by-date-chart"), options);
        chart.render();
    }
    renderVistorByDateChart()
</script>
@endsection
