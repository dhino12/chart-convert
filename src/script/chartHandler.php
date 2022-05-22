<?php 
include 'functions.php';
include 'dbToArray.php';

$tables = query('SHOW TABLES;', true);
$column = dbToArray($tables);
// $dataDb = [];

// var_dump($column['Laju Pertumbuhan Ekonomi Nasional']['column'][1]);
// var_dump($column['Laju Pertumbuhan Ekonomi Nasional']);
// print_r($column);
$index = 0;
?>

<script>
    const grafikCanvas = document.querySelector('#canvas-grafik');
    // const wraperCanvas = document.querySelector("#wrapper-canvas");
    let wrapperCanvas, canvas, title, ctx, canvasContainer, myChart, searchEscapeString, tmp;
    let chartIndex = 1;
    let dataLabels = [];
    let dataValue = []; 
    let dataCharts = [];
    const tmpCharts = [];
    
    <?php for ($i = 0; $i <= count($tables) - 1 ; $i++) : ?>
        canvasContainer = crCanvas("<?= $tables[$i]['Tables_in_chart_generator'] ?>", <?= $i + 1 ?>);
        grafikCanvas.appendChild(canvasContainer);        
    <?php endfor; ?>
        
    <?php foreach($column as $keyTable => $valTable) : ?>
        ctx = document.querySelector(`#myChart${chartIndex}`).getContext('2d');
        <?php $index = 0 ?>;
        dataLabels = []
        dataValue = []
        dataCharts = []

        <?php foreach($valTable as $key => $value) : ?>
            <?php if(trim(strtolower("$key")) === "no." || trim(strtolower("$key")) === "no" || "$key" === "chart_type" ) :?>
                <?php continue?>

            <?php elseif($index == 1): ?>
                <?php foreach($value as $keyCol => $valCol) : ?>
                    dataLabels.push("<?= $valCol ?>");
                <?php endforeach?>

            <?php elseif($index > 1): ?>
                <?php foreach($value as $keyCol => $valCol) : ?>
                    if (<?= $keyCol ?> === 0) dataValue = [];
                    
                    if ("<?= trim($valCol) ?>" === "") dataValue.push("0");
                    else dataValue.push(parseFloat("<?= trim($valCol)?>").toLocaleString());
                <?php endforeach?> 
                
                dataCharts.push({
                    label: '<?= $key ?>',
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
                })
            <?php endif; ?>

            <?php $index++ ?>
        <?php endforeach ?>
        chartIndex++;
        
        // chartnya taruh disini
        myChart = new Chart(ctx, {
            type: "<?= (empty($valTable['chart_type'][0]))? 'line' : $valTable['chart_type'][0] ?>",
            data: {
                labels: dataLabels,
                datasets: dataCharts
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