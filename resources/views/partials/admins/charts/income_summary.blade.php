<h2 class="page-title mb-3">
    รายรับทั้งหมด
</h2>
<div class="card" style="height: 448px;">
    <div class="card-body">
        <div class="row-cards">
            <div class="card-title h2 mb-2 text-center">
                รายรับทั้งหมด
                <p class="fw-bold">
                    {{ number_format(array_sum($chartIncomeSummary['series'])) }}
                </p>
            </div>
            <div class="col-auto">
                <div id="chart-income-summary" class="chart-lg"></div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-income-summary'), {
            chart: {
                type: "pie",
                fontFamily: 'inherit',
                height: 370,
                animations: {
                    enabled: true
                },
                toolbar: {
                    show: true
                },
            },
            fill: {
                opacity: 1,
            },
            series: {{ Illuminate\Support\Js::from($chartIncomeSummary['series']) }},
            labels: {{ Illuminate\Support\Js::from($chartIncomeSummary['labels']) }},
            tooltip: {
                theme: 'dark'
            },
            grid: {
                strokeDashArray: 4,
            },
            colors: ["#3366cc", "#dc3912", "#ff9900", "#109618", "#990099", "#0099c6", "#dd4477", "#66aa00", "#b82e2e", "#316395", "#3366cc", "#994499", "#22aa99", "#aaaa11", "#6633cc", "#e67300", "#8b0707", "#651067", "#329262", "#5574a6", "#3b3eac", "#b77322", "#16d620", "#b91383", "#f4359e", "#9c5935", "#a9c413", "#2a778d", "#668d1c", "#bea413", "#0c5922", "#743411"],
            legend: {
                show: true,
                position: 'bottom',
            },
            tooltip: {
                fillSeriesColor: true
            },
        })).render();
    });
</script>
