<?php 

/** 
 * require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadSheet = new Spreadsheet();
$sheet = $spreadSheet->getActiveSheet();

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=exportData');
header('Cache-Control: max-age=0');
header('Cache-Control: max-age=1');

$writer = IOFactory::createWriter($spreadSheet, 'Xlsx');
$writer->save('php://output');
*/

include 'script/functions.php';
session_start();

if (!isset($_SESSION['identity'])) {
    header("Location: ../login.php");
    exit;
} else {
    $id = $_SESSION['identity'];
    $level = $_SESSION['level'];

    $tables = query("SELECT table_name FROM $level WHERE id='$id'", true)[0];
    $tables = explode(',', $tables['table_name']);
}
$now = time();
header("Content-Disposition: attachment; filename=$now.xls");
header("Content-Type: application/vnd.ms-excel"); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Export Excel</title>
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
            <div class="container-fluid content mt-5" id="table-data">
                <?php foreach($tables as $i => $tableName) : ?>  
                    <span style="display: inline; background-color: yellow;"><?= $tableName ?></span> 
                    <table class="table table-bordered table-striped table-hover" border="1">
                        <?php $result = query("SELECT * FROM `$tableName`", true); ?>
                        <thead>
                            <?php foreach($result[0] as $keyColName => $dataCol) : ?>
                                <?php if($keyColName !== 'chart_type' && $keyColName !== 'id') : ?>
                                    <th><?= $keyColName ?></th>
                                <?php endif ?>
                            <?php endforeach ?>
                        </thead>
                        <tbody>
                            <?php foreach($result as $keyNumber => $dataField) : ?>
                                <tr>
                                    <?php foreach($dataField as $keyCol => $data) : ?>
                                        <?php if($keyCol !== 'chart_type' && $keyCol !== 'id') : ?>
                                            <td><?= $data ?></td>
                                        <?php endif ?>  
                                    <?php endforeach ?>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                <?php endforeach ?>
            </div>
        </div>
    </main>
    <footer>

    </footer> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>