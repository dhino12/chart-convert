<?php 
include 'functions.php';
include 'dbToArray.php';

$tables = query("SHOW TABLES;", true);
$dataPertEkonomi = query("SELECT `Pertumbuhan Ekonomi (%)` FROM `Laju Pertumbuhan Ekonomi Nasional`", false);
$dataEkoNas = query("SELECT `Ekonomi Nasional` FROM `Laju Pertumbuhan Ekonomi Nasional`", false);

$tables = query('SHOW TABLES;', true);
$column = dbToArray($tables);
// $dataDb = [];

// var_dump($column['Laju Pertumbuhan Ekonomi Nasional']['column'][1]);
var_dump($column);
?>

<script>
    const grafikCanvas = document.querySelector('#canvas-grafik');
    const wraperCanvas = document.querySelector("#wrapper-canvas");
    let canvasContainer;
    
    <?php for ($i = 0; $i <= count($tables) - 1 ; $i++) : ?>
        canvasContainer = crCanvas("<?= $tables[$i]['Tables_in_chart_convert'] ?>", <?= $i + 1 ?>);
        grafikCanvas.appendChild(canvasContainer);        
    <?php endfor; ?>
    
    const ctx = document.querySelector('#myChart1').getContext('2d');
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
                pointStyle: 'circle',
                pointRadius: 7,
                pointHoverRadius: 5,
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