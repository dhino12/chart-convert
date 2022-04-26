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
// var_dump($column['Laju Pertumbuhan Ekonomi Nasional']);
print_r($column);
?>

<script>
    const grafikCanvas = document.querySelector('#canvas-grafik');
    // const wraperCanvas = document.querySelector("#wrapper-canvas");
    let wrapperCanvas, canvas, title, ctx, canvasContainer, myChart, searchEscapeString, tmp;
    let chartIndex = 1;
    let index = 0
    let dataLabels = [];
    let dataValue = [];
    
    <?php for ($i = 0; $i <= count($tables) - 1 ; $i++) : ?>
        canvasContainer = crCanvas("<?= $tables[$i]['Tables_in_chart_convert'] ?>", <?= $i + 1 ?>);
        grafikCanvas.appendChild(canvasContainer);        
    <?php endfor; ?>
        
    <?php foreach($column as $keyTable => $valTable) : ?> 
        ctx = document.querySelector(`#myChart${chartIndex}`).getContext('2d');
        index = 0;
        dataLabels = []
        dataValue = []

        <?php foreach($valTable as $key => $value) : ?>

            if (index === 1) {
                <?php foreach($valTable[$key] as $keyCol => $valCol) : ?>
                    dataLabels.push("<?= $valCol ?>");
                    // console.log("<?= $valCol ?>");
                    <?php endforeach?>
                    
                } else if (index > 1) {
                    <?php foreach($valTable[$key] as $keyCol => $valCol) : ?>
                        if ("<?= trim($valCol) ?>" === "") dataValue.push("0");
                        else dataValue.push(parseFloat("<?= trim($valCol)?>").toFixed(2));
                        console.log("<?= trim($valCol) ?>");
                        
                <?php endforeach?>
            }
            
            index++;
        <?php endforeach ?>
        chartIndex++;
        console.log(dataValue);
        // chartnya taruh disini
        myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dataLabels,
                datasets: [{
                    label: ['Pertumbuhan Ekonomi (%)'],
                    borderRadius: [11,11,11,11],
                    data: dataValue,
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
    <?php endforeach ?>
</script>