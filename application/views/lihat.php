<!DOCTYPE html>
<html>
<head>
    <title><?= strtolower($judul)?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <canvas id="chart"></canvas>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $(document).ready(function() {
            var chartData = <?php echo json_encode($chart_data); ?>;
            var labels = [];
            var values = [];
			
            chartData.forEach(function(data) {
                labels.push(data.label);
                values.push(data.total);
            });
			
			var ctx = document.getElementById('chart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: <?= json_encode($tipe) ?>,
                data: {
                    labels: labels,
                    datasets: [{
                        label: <?= json_encode($judul) ?>,
                        data: values,
                        backgroundColor: <?= json_encode($warna) ?>, 
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            stepSize: 1
                        }
                    },
                    
        plugins: {
            legend: {
                display: false
            }
        }
                }
            });
        });
    </script>
</body>
</html>
