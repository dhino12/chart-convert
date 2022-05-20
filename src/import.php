<?php

include 'script/conn.php';
include 'script/functions.php';
include '../vendor/autoload.php';
include 'script/excelHandler.php';

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
    crTableSheet($excelDatas, $chartType);
    // var_dump($spreadsheet->getSheetByName("Ekonomi")->toArray());
    // var_dump($excelDatas);
    header("Location: index.php");
    die;
    
    $sheetData[0][] = 'chart_type';
    $colName = [];
    $rowValue = [];
    $tTitle = $_POST['title_table'];
    $chartType = $_POST['type'];
    $strThead = '';
    
    // getColumn
    for ($i = 0; $i < count($sheetData[0]) ; $i++) {
        if ($sheetData[0][$i] === NULL) {
            $colName[] = '-';
        } else {
            $colName[] = $sheetData[0][$i];
        }
    }

    foreach($colName as $key => $value) {
        if((count($colName) - 1) == $key) {
            $strThead .= "`$value` VARCHAR(180)";

        } else {
            $strThead .= "`$value` VARCHAR(180),";

        }
    }
    
    $result = query("CREATE TABLE `$tTitle` ($strThead);", '');
    var_dump($tmp);

    // getRows
	for($i = 1;$i < count($sheetData); $i++)
	{
        for ($j = 0; $j < count($sheetData[$i]); $j++) {
            if (str_contains($sheetData[$i][$j], "-")) {
                $rowValue[] = '0';
            } else {
                $rowValue[] = $sheetData[$i][$j];
            }

            if ((count($sheetData[$j]) - 1 === $j)) {
                // tambah chart pada index terakhir
                $rowValue[] = $chartType;
            }
        }
    }
    
    $result = addValue($rowValue, $tTitle, $colName);

    // header("Location: form_upload.html"); 
    // if ($result === true) {
    //     echo "
    //         <script>

    //         </script>
    //     ";
    // }
}

?>