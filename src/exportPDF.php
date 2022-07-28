<?php
include 'script/functions.php';
session_start();

if (!isset($_SESSION['identity'])) {
    header("Location: ../login.php");
    exit;
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <link rel="stylesheet" href="./style/fonts.css">
    <link rel="stylesheet" href="./style/index.css">
    <link rel="stylesheet" href="./style/test.css">
    <link rel="stylesheet" href="./style/sidebar.css">
    <link rel="stylesheet" href="./style/background/colors.css">
    <link rel="stylesheet" href="./style/background/bg-side.css">
    <link rel="stylesheet" href="./style/responsive/side-responsive.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="./modules/Chart-3.7.1.min.js"></script>
    <script src="./modules/chartjs-plugin-datalabels.min.js"></script>
    <style type="text/css" media="print">
        body {
            display: inline;
            background-color: red;
        }
    </style>
</head>
<body>
    <header></header>
    <main> 
        <div class="wrapper d-flex flex-column" style="width:100%; padding-left: unset;" id="content-wrapper"> 
            <div class="container-fluid content mt-5">
                <div class="bg-red row align-items-center justify-content-between" id="canvas-grafik">
                    
                </div>
            </div>
        </div>
    </main>
    <footer>

    </footer> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./modules/createChart.js"></script>  
    
	<?php include './script/chartHandler.php' ?> 
    <script>
        const wrapCanvas = document.querySelectorAll("#wrapper-canvas");
        wrapCanvas.forEach(e => {
            e.classList.replace('col-xl-6', 'col-xl-12');
        }); 
        
        let formTable = document.createElement("table");
        formTable.className = 'table table-bordered table-striped table-hover';
        formTable.id = "form-input";

        for (let index = 0; index < <?= count($tables) ?>; index++) {
            formTable = document.createElement("table");
            formTable.className = 'table table-bordered table-striped table-hover';
            formTable.id = "form-input";

            wrapCanvas[index].appendChild(formTable);
        }
    </script>

    <script src="./modules/tableHandler.js"></script>

    <script>
        const formInputPrint = document.querySelectorAll('#form-input');
        
        function crTable(updateData, tableName, chart, formInput) {
            const valTitle = titleTable.value;

            const {
                createTable,
                createThead,
                createTbody,
                crInputTitle,
                crButtonSubmit,
            } = crElement((valTitle == "" || valTitle === undefined) ? tableName : valTitle);

            if (updateData) {
                updateDataTable(createThead, createTbody, updateData, tableName, chart);
            } else {
                addDataTable(createThead, createTbody, valTitle);
            }
            
            createTable.appendChild(createThead);
            createTable.appendChild(createTbody); 
            formInput.appendChild(crInputTitle);
            formInput.appendChild(createTable);
            formInput.appendChild(crButtonSubmit);
        }

        let column = [];
        let tmpData = [];
        let rows = [];
        let data = [];

        <?php foreach($tables as $i => $tableName) : ?>
            data = [];
            column = [];
            rows = [];
            <?php $result = query("SELECT * FROM `$tableName`", true); ?>

            <?php foreach($result as $keyNumber => $value) : ?>
                <?php foreach($value as $keyName => $data) : ?>
                    if (<?=$keyNumber?> === 0) {
                        column.push(`<?= $keyName ?>`);
                    }
                    tmpData.push(`<?= $data ?>`);
                <?php endforeach ?>
                rows.push(tmpData);
                tmpData = [];
            <?php endforeach ?>

            data.push(column);
            data.push(rows);

            console.log(data);
            crTable(data, "<?= $tableName ?>", undefined, formInputPrint[<?= $i ?>]);
        <?php endforeach ?>
        window.print();
    </script>
</body>
</html>