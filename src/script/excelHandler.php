<?php 

require '../vendor/autoload.php';

function getExcelFile($dataFiles)
{
    $arr_file = explode('.', $dataFiles['excel_file']['name']); // pecah kedalam array diantara . 
    $extension = end($arr_file); // mndapatkan extension .xlsx / .xls`
 
    if('csv' == $extension) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
    } else {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
    }
 
    $spreadsheet = $reader->load($dataFiles['excel_file']['tmp_name']);
    
    return $spreadsheet;
}

function fixArray(array $datas): array
{
    // remove NULL data
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
    $dataSheet = [];
    foreach($sheetNames as $name) {
        if($name === NULL) continue;
        $dataSheet[] = fixArray($spreadsheet->getSheetByName($name)->toArray());
    }
    
    return $dataSheet;
}

function  crTableSheet(array $sheetDatas)
{
    $tmpTitle = [];
    foreach($sheetDatas as $currSheetDatas) {
        foreach($currSheetDatas as $key => $data) {
            if (count($data) === 1 ) {
                $tmpTitle[] = ($data[0] === NULL)? "untitled" : $data[0] ;
            }

        }
    }
    // var_dump($tmpTitle);
}

/*
array(7) {
    [0]=>
    array(73) {
      [0]=>
      array(1) {
        [0]=>
        string(33) "Laju Pertumbuhan Ekonomi Nasional"
      }
      [1]=>
      array(2) {
        [0]=>
        string(16) "Ekonomi Nasional"
        [1]=>
        string(23) "Pertumbuhan Ekonomi (%)"
      }
      [2]=>
      array(2) {
        [0]=>
        string(9) "2018 (Q1)"
        [1]=>
        float(5.07000000000000028421709430404007434844970703125)
      }
      [3]=>
      array(2) {
        [0]=>
        string(9) "2018 (Q2)"
        [1]=>
        float(5.269999999999999573674358543939888477325439453125)
      }
      [4]=>
      array(2) {
        [0]=>
        string(9) "2018 (Q3)"
        [1]=>
        float(5.1699999999999999289457264239899814128875732421875)
      }
      [5]=>
      array(2) {
        [0]=>
        string(9) "2018 (Q4)"
        [1]=>
        float(5.17999999999999971578290569595992565155029296875)
      }
    ]
]
*/
?>