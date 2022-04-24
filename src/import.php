<?php 

include 'script/conn.php';
include 'script/functions.php';
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
 
$file_mimes = array('application/octet-stream', 
    'application/vnd.ms-excel', 'application/x-csv', 
    'text/x-csv', 'text/csv', 'application/csv', 
    'application/excel', 'application/vnd.msexcel', 
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
);
if(isset($_FILES['excel_file']['name']) && in_array($_FILES['excel_file']['type'], $file_mimes)) {

    $arr_file = explode('.', $_FILES['excel_file']['name']);
    $extension = end($arr_file);
 
    if('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }
 
    $spreadsheet = $reader->load($_FILES['excel_file']['tmp_name']);
     
    $sheetData = $spreadsheet->getActiveSheet()->toArray(); 
    $colName = [];
    $rowValue = [];
    $tTitle = $_POST['title_table'];
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
    var_dump($result);

    // getRows
	for($i = 1;$i < count($sheetData); $i++)
	{
        for ($j = 0; $j < count($sheetData[$i]); $j++) { 
            $rowValue[] = $sheetData[$i][$j];
        }
    }
    
    $result = addValue($rowValue, $tTitle, $colName);
    var_dump($colName);
    var_dump($rowValue);
    var_dump($strThead);

    // header("Location: form_upload.html"); 
}

?>