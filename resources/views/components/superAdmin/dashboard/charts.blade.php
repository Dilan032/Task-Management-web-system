<div class="card">
    <div class="card-header">Issues by Status</div>
    <div class="card-body">
        <canvas id="bar-chart-custom-tooltip"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js CDN -->

<script>
    // Bar chart with custom tooltip
    const dataBarCustomTooltip = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label: 'Traffic',
            data: [30, 15, 62, 65, 61, 65, 40],
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    };

    const optionsBarCustomTooltip = {
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let label = context.dataset.label || '';
                        label = `${label}: ${context.formattedValue} users`;
                        return label;
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    new Chart(
        document.getElementById('bar-chart-custom-tooltip'), {
            type: 'bar',
            data: dataBarCustomTooltip,
            options: optionsBarCustomTooltip
        }
    );
</script>
