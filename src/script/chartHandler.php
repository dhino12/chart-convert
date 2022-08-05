<?php 
include 'dbToArray.php';

if (isset($_GET['title']) && isset($_SESSION['identity'])) {
    // detail
    $tableName = $_GET['title'];
    $tables = explode(',', $tableName); 
    $column = dbToArray($tables);  
    $indicator = "true";
    
} else if (isset($_SESSION) && count($_SESSION) !== 0) {
    // index 
    $id = $_SESSION['identity'];
    $level = $_SESSION['level'];

    if(isset($_GET['search'])) { 
        $searchData = $_GET['search'];
        
        if (strlen($searchData) === 0) return header("Location: index.php");

        $dataTables = query("SHOW TABLES FROM chart_generator LIKE '%$searchData%'", true);
        
        if (count($dataTables) !== 0) {
            foreach ($dataTables as $key => $value) {
                $tables[] = $value["Tables_in_chart_generator (%$searchData%)"]; 
            }
        } else {
            $tables[] = '';
        }
    } else {
        $tables = query("SELECT table_name FROM $level WHERE id='$id'", true)[0];
        $tables = explode(',', $tables['table_name']); 
    }

    if (strlen($tables[0]) !== 0) {
        $column = dbToArray($tables);
    }

    $indicator = "true";
} else {
    if(isset($_GET['search'])) { 
        $searchData = $_GET['search'];
        
        if (strlen($searchData) === 0) return header("Location: index.php");

        $dataTables = query("SHOW TABLES FROM chart_generator LIKE '%$searchData%'", true);
        foreach ($dataTables as $key => $value) {
            $tables[] = $value["Tables_in_chart_generator (%$searchData%)"]; 
        }
        $column = dbToArray($tables);
    } else {
        //  guest
        if (isset($_GET['title'])) {
            $tableName = $_GET['title'];
            $tables = explode(',', $tableName); 
            $column = dbToArray($tables);
        } else {
            $tables = query("SHOW TABLES
            WHERE NOT Tables_in_chart_generator = 'users'
            AND NOT Tables_in_chart_generator = 'tag'
            AND NOT Tables_in_chart_generator = 'admins';",
            false);
            // var_dump($tables);
            $column = dbToArray($tables);    
        }
    }
    $indicator = "false";
}
$index = 0; 
?>

<script>
    const grafikCanvas = document.querySelector('#canvas-grafik');
    let wrapperCanvas, canvas, title, ctx, canvasContainer, myChart, searchEscapeString, tmp, role;
    let chartIndex = 1;
    let dataLabels = [];
    let dataValue = []; 
    let dataCharts = [];
    let randomColor = 0;
    // let randomColor = Math.floor(Math.random() * 16777215).toString(16);
    
    // currency converter
    // const rupiah = (number)=>{
    //     return new Intl.NumberFormat("id-ID", {
    //         style: "currency",
    //         currency: "IDR"
    //     }).format(number);
    // }

    <?php if($tables[0] !== '') : ?>
        <?php for ($i = 0; $i <= count($tables) - 1 ; $i++) : ?> 
            canvasContainer = crCanvas("<?= $tables[$i] ?>", <?= $i + 1 ?>, <?= $indicator ?>);
            grafikCanvas.appendChild(canvasContainer);        
        <?php endfor; ?>
    <?php endif ?>
        
    <?php foreach($column as $keyTable => $valTable) : ?>
        ctx = document.querySelector(`#myChart${chartIndex}`).getContext('2d');
        <?php $index = 0 ?>;
        dataLabels = [];
        dataValue = [];
        dataCharts = [];

        <?php foreach($valTable as $key => $value) : ?>
            randomColor = Math.floor(Math.random() * 16777215).toString(16);

            <?php if(
                trim(strtolower("$key")) === "no." || 
                trim(strtolower("$key")) === "no" || 
                "$key" === "chart_type" || 
                "$key" === "id") :?>
                <?php continue?>

            <?php elseif($index == 1): ?>
                <?php foreach($value as $keyCol => $valCol) : ?>
                    dataLabels.push("<?= $valCol ?>");
                <?php endforeach?>

            <?php elseif($index > 1): ?>
                <?php foreach($value as $keyCol => $valCol) : ?>
                    if (<?= $keyCol ?> === 0) dataValue = [];
                    
                    if ("<?= trim($valCol) ?>" === "") dataValue.push("0");
                    else dataValue.push(parseFloat("<?= trim($valCol)?>"));
                <?php endforeach?> 
                
                dataCharts.push({
                    label: '<?= $key ?>',
                    borderRadius: [11,11,11,11],
                    data: dataValue,
                    backgroundColor: [
                        `#${randomColor}`,
                    ],
                    borderColor: [
                        `#${randomColor}`,
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