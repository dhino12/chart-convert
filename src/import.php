<?php

include 'script/functions.php';
include '../vendor/autoload.php';
include 'script/excelHandler.php';
session_start();

if (isset($_SESSION['identity'])) {
    $id = $_SESSION['identity'];
    $level = $_SESSION['level']; // admins / users

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
        if (is_string($excelDatas)) {
            $field = '';
            $getMerge = $spreadsheet->getSheetByName($excelDatas)->getMergeCells();
            foreach ($getMerge as $fieldData) {
                $field .= "<span style='border: 1px solid red; padding-left: 5px; padding-right: 5px; border-radius: 5px;'>$fieldData</span> \t";
            }
            $msg = "untuk sementara aplikasi tidak dapat menghandle mergeCell pada sheet <b> $excelDatas </b> di Field $field";
            $_SESSION['msg'] = $msg;
            header("Location: index.php");

        } else {
            $_SESSION['msg'] = '';
            $tableNames = crTableSheet($excelDatas, $chartType);
            $data = query("SELECT table_name FROM `$level` WHERE id='$id'", false)[0];

            if (strlen($data) !== 0) $tableNames .= ',' . $data;

            $result = query("UPDATE `$level` SET `table_name`='$tableNames' WHERE `id`='$id'", '');
            header("Location: index.php");
        }

        exit;
        
    } else {
        echo "<script>alert('Maaf format file tidak didukung, pastikan .xlsx')</script>";
    }
} else {
    header("Location: ../login.php");
    exit;
}

?>