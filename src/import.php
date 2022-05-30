<?php

include 'script/functions.php';
include '../vendor/autoload.php';
include 'script/excelHandler.php';
session_start();
if (isset($_SESSION['identity'])) {
    $id = $_SESSION['identity'];

    $file_mimes = array('application/octet-stream',
        'application/vnd.ms-excel', 'application/x-csv',
        'text/x-csv', 'text/csv', 'application/csv',
        'application/excel', 'application/vnd.msexcel',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    );

    if(isset($_FILES['excel_file']['name']) && in_array($_FILES['excel_file']['type'], $file_mimes)) {

        $chartType = $_POST['chart_type']; 
        $spreadsheet = getExcelFile($_FILES);
        
        $excelDatas = getDataCurrentSheet($spreadsheet->getSheetNames(), $spreadsheet);
        $tableNames = crTableSheet($excelDatas, $chartType);
        // var_dump($tableNames);
        $result = query("UPDATE `users` SET `table_name`='$tableNames' WHERE `id`='$id'", '');
        // header("Location: index.php");
        // exit;
        
    } else {
        // echo "<script>alert('Maaf format file tidak didukung, pastikan .xlsx')</script>";
        // header("Location: index.php");
    }
} else {
    // header("Location: ../login.php");
    // exit;
}

?>