<h2 class="page-title mb-3">
    หน่วยไฟฟ้าที่ใช้ไปย้อนหลัง 12 เดือน
</h2>
<div class="card">
    <div class="card-body">
        <div id="chart-electric-summary" class="chart-lg"></div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-electric-summary'), {
                series: {{ Js::from($chartUtilityExpense['series']['electric']) }},
                chart: {
                    type: 'line',
                    height: 300,
                    fontFamily: 'inherit',
                    toolbar: {
                        show: true
                    },
                    zoom: {
                        enabled: true
                    }
                },
                colors: ['#ff9966'],
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
                xaxis: {
                    categories: {{ Js::from($chartUtilityExpense['categories']) }},
                },
                yaxis: {
                    type: 'numeric',
                    title: {
                        text: 'หน่วยที่ใช้'
                    }
                },
                dataLabels: {
                    enabled: true,
                },
                stroke: {
                    width: 5,
                    curve: 'smooth'
                },
            }
        )).render();
    });
</script>
