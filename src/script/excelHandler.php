<?php 

require '../vendor/autoload.php';

function getExcelFile($dataFiles)
{
    $arr_file = explode('.', $dataFiles['excel_file']['name']);
    $extension = end($arr_file);
 
    if('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }
 
    $spreadsheet = $reader->load($dataFiles['excel_file']['tmp_name']);
    
    return $spreadsheet;
}

function fixArray(array $datas)
{
    $fixArr = [];

    foreach($datas as $data) {
        $tmpArr = [];
        foreach($data as $value) {
            if ($value === NULL) {
                continue;
            } else {
                $tmpArr[] = $value;
            }
        }
        $fixArr[] = $tmpArr;
    }

    return $fixArr;
}

function getDataCurrentSheet($sheetNames, $spreadsheet)
{
    $dataAllSheet = [];
    $dataSheet = [];
    $titleTable = [];
    foreach($sheetNames as $name) {
        if($name === NULL) continue;
        $tmpData = fixArray($spreadsheet->getSheetByName($name)->toArray());
        $dataSheet = $tmpData;
        
    }
    var_dump($dataSheet);
}

?>