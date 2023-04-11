<h2 class="page-title mb-3">
    รายได้ย้อนหลัง 12 เดือน
</h2>
<div class="card">
    <div class="card-body">
        <div id="chart-income-month" class="chart-lg"></div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-income-month'), {
            series: {{ Illuminate\Support\Js::from($chartIncomeMonth['series']) }},
            chart: {
                type: 'bar',
                height: 400,
                stacked: true,
                toolbar: {
                    show: true
                },
                zoom: {
                    enabled: true
                }
            },
            colors: ["#3366cc", "#dc3912", "#ff9900", "#109618", "#990099", "#0099c6", "#dd4477", "#66aa00", "#b82e2e", "#316395", "#3366cc", "#994499", "#22aa99", "#aaaa11", "#6633cc", "#e67300", "#8b0707", "#651067", "#329262", "#5574a6", "#3b3eac", "#b77322", "#16d620", "#b91383", "#f4359e", "#9c5935", "#a9c413", "#2a778d", "#668d1c", "#bea413", "#0c5922", "#743411"],
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
                plotOptions: {
                    bar: {
                        horizontal: false,
                        borderRadius: 0,
                        dataLabels: {
                            total: {
                                enabled: true,
                                style: {
                                    fontSize: '13px',
                                    fontFamily: 'Helvetica, Arial, sans-serif',
                                    fontWeight: 900,
                                    offsetY: 500,
                                },
                                formatter: function (val, opts) {
                                    return '฿' + val
                                },
                            }
                        }
                    },
                },
                xaxis: {
                    categories: {{ Illuminate\Support\Js::from($chartIncomeMonth['categories']) }},

                },
                yaxis: {
                    type: 'numeric',
                    labels: {
                        formatter: function (value) {
                            return value + "฿";
                        }
                    },
                    title: {
                        text: 'จำนวนเงิน (บาท)'
                    }
                },
                legend: {
                    position: 'bottom',
                    offsetY: 0,
                },
                fill: {
                    opacity: 1
                }
            }
        )).render();
    });
</script>
