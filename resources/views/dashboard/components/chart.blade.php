<style>
    #chart,
    .upgrader2,
    #chart4 {
        display: none;
    }
</style>

<div class="col__left pt-4">
    <div class="tab__header custom__pst" style="z-index: 9999;">
        <ul>
            <li class="active" onclick="cpcaverage()" id="cpc">
                <a href="javascript:void(0)">CPC Average</a>
            </li>
            <li id="mros" onclick="marketingroas()">
                <a href="javascript:void(0)">Marketing ROAS</a>
                <a href="#" class="upgrader2" style="z-index: 3;background: transparent;"><img src="{{asset('images/Upgrade.png')}}" height="57.41" width="200"/></a>
            </li>
            <li onclick="monthlysales()" id="ms">
                <a href="javascript:void(0)">Monthly Sales</a>
            </li>
        </ul>
    </div>
    <div id="chart3"></div>
    <div id="chart" class="text-center chart-bg-new roasBG" style="padding: 10px;height:365px;">
        <a href="#" class="upgrader"><img src="{{asset('images/Upgrade.png')}}" height="57.41" width="200"/></a>
    </div>
    <div id="chart4" class="text-center chart-bg-new" style="padding: 10px;height:365px;">
        <a href="#" class="upgrader"><img src="{{asset('images/Upgrade.png')}}" height="57.41" width="200"/></a>
    </div>

</div>
<?php $industry_name_s = "";
if ($industry_name) {
    $industry_name_s = $industry_name[0]->name;
} ?>
@section('scripts')
@parent
<script>
    function marketingroas() {
        $("#mros").addClass("active");
        $("#ms").removeClass("active");
        $("#cpc").removeClass("active");
        $('#chart').show();
        $('#chart4').hide();
        $('#chart3').hide();
        // renderSpendChart(insights);
        $(".upgrader2").show();
    }

    function monthlysales() {
        $("#mros").removeClass("active");
        $("#cpc").removeClass("active");
        $("#ms").addClass("active");
        $('#chart4').show();
        $('#chart').hide();
        $('#chart3').hide();
        $(".upgrader2").hide();
    }

    function cpcaverage() {
        $("#mros").removeClass("active");
        $("#ms").removeClass("active");
        $("#cpc").addClass("active");
        $('#chart4').hide();
        $('#chart').hide();
        $('#chart3').show();
        renderSpendChart2(insights);
        $(".upgrader2").hide();
    }
</script>
<script>
    var chart;
    var insights = @json($insights);

    function number_format(number, decimals, dec_point, thousands_sep) {
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function(n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }

    function getRandomChart(insights) {
        let random = [];
        const min = 0;
        const max = 0.2;
        for (let i = 0; i < insights.length; i++) {
            random[i] = ((Math.random() * (max - min) + min) * insights[i]).toFixed(0)
        }
        return random
    }

    function renderSpendChart(insights) {
        const random = getRandomChart(insights)
        var options = {
            series: [{
                name: 'Users aveage performenance',
                data: insights
            }, {
                name: 'Your Industry Average of users',
                data: random
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
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
            },
            colors: ["#1d1df9", "#f76df7"],
        };
        chart = new ApexCharts(document.querySelector("#chart"), options)
        // charts = new ApexCharts(document.querySelector("#chart3"), options)
        chart.render();
        // charts.render();
    }

    function renderSpendChart2(insights) {
        const random = getRandomChart(insights)
        var options = {
            series: [{
                name: 'Users aveage performenance',
                data: insights
            }, {
                name: 'Your Industry Average of users',
                data: random
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
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"]
            },
            legend: {
                position: 'top',
                horizontalAlign: 'right',
            },
            colors: ["#1d1df9", "#f76df7"],
        };
        charts = new ApexCharts(document.querySelector("#chart3"), options)
        charts.render();
    }

    renderSpendChart(insights)
    renderSpendChart2(insights)
    $('[name=account_id]').on('change', function() {
        let accountId = $(this).val()
        $.ajax({
            url: "/facebook-ads/accounts/" + accountId + "/insights",
            type: "GET",
            error: function(err) {
                console.log(err);
            },
            success: function(data) {
                const result = data.data
                // $('#totalSpend').text(number_format(result.spend))

                chart.updateSeries([{
                    name: 'Spend',
                    data: result.insights
                }, {
                    name: 'Industry Average: Education',
                    data: getRandomChart(result.insights)
                }])
            }
        })
    })
</script>
<?php
$performenance = [];
$industry = [];
if ($industry_everage_all_user) {
    foreach ($industry_everage_all_user as $industry_everage_all_users) {

        array_push($performenance, $industry_everage_all_users->total_roas_everage);
    }

    $data = '["' . implode('", "', $performenance) . '"]';
} else {
    $data = '[""]';
}



if ($industry_everage) {
    foreach ($industry_everage as $industry_everages) {
        array_push($industry, $industry_everages->total_roas_everage);
    }

    $industry_avg = '["' . implode('", "', $industry) . '"]';
} else {
    $industry_avg = '[""]';
}
?>
<?php
$permission = Auth::user()->permission;

if ($permission) {
    $check_permission = explode(",", $permission);
} else {
    $check_permission = [];
}

if (in_array('roas_performenance', $check_permission)) {
    $roas_performenance = $data;
} else {
    $roas_performenance = '[""]';
}

if (in_array('industry_average', $check_permission)) {
    $industry_average = $industry_avg;
} else {
    $industry_average = '[""]';
}

?>
<script>
    chart.updateSeries([{
        name: 'ROAS Performenance',
        data: <?php echo $roas_performenance; ?>
    }, {
        name: 'Industry Average : <?php echo $industry_name_s; ?>',
        data: <?php echo $industry_average; ?>
    }])
</script>
<script>
    charts.updateSeries([{
        name: 'CPC Average',
        data: <?php echo $data; ?>
    }, {
        name: 'Industry Average : <?php echo $industry_name_s; ?>',
        data: <?php echo $industry_avg; ?>
    }])
</script>
<script>
    //         var options = {
    //           series: [68],
    //           chart: {
    //           height:170,
    //           type: 'radialBar',


    //         },

    //         plotOptions: {
    //           radialBar: {
    //             hollow: {
    //               size: '55%',
    //             }
    //           },
    //         },

    //       colors: ['#016A88'],
    //       plotOptions: {
    //       radialBar: {
    //       dataLabels: {
    //       name: {
    //           show: false
    //       }
    //      }
    //   }
    // }

    //      //  labels: ['Progress'], <-- hidden


    //         };

    var options = {
        chart: {
            height: 170,
            type: "radialBar"
        },

        series: [68],
        colors: ['rgba(1,106,136,1)'],

        plotOptions: {
            radialBar: {
                track: {
                    show: true,
                    background: 'rgba(255,255,255,1)',
                    strokeWidth: '97%',
                    opacity: 2,
                    margin: 6,
                    dropShadow: {
                        enabled: false,
                        top: 0,
                        left: 0,
                        blur: 6,
                        opacity: 1
                    }
                },
                hollow: {
                    margin: 15,
                    size: "55%"
                },

                dataLabels: {
                    showOn: "always",
                    name: {
                        offsetY: -10,
                        show: false,
                        color: "#888",
                        fontSize: "13px"
                    },
                    value: {
                        offsetY: 6,
                        color: "#FFFFFF",
                        fontSize: "20px",
                        show: true
                    }
                }
            }
        },

        stroke: {
            lineCap: "round",
        },
        labels: ["Progress"]
    };

    var chart = new ApexCharts(document.querySelector("#chart2"), options);
    chart.render();
</script>
@endsection
