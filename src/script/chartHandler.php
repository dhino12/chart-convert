<?php 
include 'functions.php';

$dataPertEkonomi = query("SELECT `Pertumbuhan Ekonomi (%)` FROM `Laju Pertumbuhan Ekonomi Nasional`", false);
$dataEkoNas = query("SELECT `Ekonomi Nasional` FROM `Laju Pertumbuhan Ekonomi Nasional`", false);

var_dump($dataEkoNas);

$tables = query('SHOW TABLES;', true);
?>

<script>
    const ctx = document.querySelector('#myChart1').getContext('2d');
    const grafikCanvas = document.querySelector('#canvas-grafik');
    let wrapperCanvas, canvas, title;
    
    const datasPertEkoNas = [];
    const datasEkoNas = [];
    <?php foreach($dataPertEkonomi as $key => $value) : ?>
        datasPertEkoNas.push(<?= round($value, 2) ?>)
    <?php endforeach ; ?>

    <?php foreach($dataEkoNas as $key => $value) : ?>
        datasEkoNas.push("<?= $value ?>")
    <?php endforeach ; ?>
    
    /** 
     * Chart
     */
    const myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: datasEkoNas,
            datasets: [{
                label: 'Pertumbuhan Ekonomi (%)',
                borderRadius: [11,11,11,11],
                data: datasPertEkoNas,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1,
                borderSkipped: false,
            }]
        },
        options: {
            scales: {
                y: {
                    ticks: {
                        beginAtZero:true
                    }
                }
            },
            plugins: {
                datalabels: {
                    color: '#00',
                    anchor: 'end',
                    align: 'end',
                }
            }
        },
        plugins: [ChartDataLabels]
    });
</script>