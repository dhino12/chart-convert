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
    $fixArr2 = [];
    $tmpArr2 = [];
    $counter = 0;
    
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
    
    foreach($fixArr as $key => $datas){
        foreach($datas as $value) {
            $tmpArr2[$counter][] = $value;
        }
        if (count($datas) === 0 || count($fixArr) - 1 === $key) {
            $fixArr2[] = $tmpArr2;
            $tmpArr2 = [];
            $counter = -1;
        }
        $counter++;
    }
    return $fixArr2;
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

function crTableSheet(array $sheetDatas, $chartType)
{
    $tableName = '';
    $strField = '';
    $counter = 0;
    $rowValue = [];
    $colValue = [];

    foreach($sheetDatas as $sheet) { // sheet
        foreach($sheet as $keyTable => $table){ // table
            $strField = '';
            $tableName = '';

            if ($table[0] !== NULL && count($table[0]) === 1) {
                // dengan judul table
                $tableName = $table[0][0];
                $table[1][] = "chart_type";
                $table[1][] = "id";

                foreach($table[1] as $key => $data) { // column
                    $data = trim(preg_replace('/\s\s+/', ' ', $data)); // remove line-break (enter)
                    if((count($table[1]) - 1) == $key) {
                        $strField .= "`$data` VARCHAR(180)";

                    } else {
                        $strField .= "`$data` VARCHAR(180),";

                    }

                    $colValue[] = $data;
                }
                query("CREATE TABLE `$tableName` ($strField);", '');
                
                foreach($table as $key => $data) { // row
                    if ($key > 1) {
                        foreach($data as $dataRecord) {
                            $rowValue[] = $dataRecord;
                        }
                        $rowValue[] = $chartType;
                        $rowValue[] = uniqid();
                    }

                    if (count($table) - 1 === $key) {
                        var_dump($rowValue);
                        // var_dump($colValue);
                        $result = addValue($rowValue, $tableName, $colValue);
                        var_dump($result);
                        // var_dump($strField);
                        $rowValue = [];
                        $colValue = [];
                    }
                }
            } else if (count($table) !== 0) {
                // tanpa judul table
                $tableName = 'untitled'. $counter;
                $table[0][] = "chart_type";
                $table[0][] = "id";

                foreach($table[0] as $key => $data) { // col
                    $data = trim(preg_replace('/\s\s+/', ' ', $data)); // remove line-break (enter)
                    if((count($table[0]) - 1) == $key) {
                        $strField .= "`$data` VARCHAR(180)";

                    } else {
                        $strField .= "`$data` VARCHAR(180),";

                    }

                    $colValue[] = $data;
                }

                query("CREATE TABLE `$tableName` ($strField);", '');

                foreach($table as $key => $data) { // row
                    if ($key > 0) {
                        foreach($data as $dataRecord) {
                            $rowValue[] = $dataRecord;
                        }
                        $rowValue[] = $chartType;
                        $rowValue[] = uniqid();
                    }

                    if (count($table) - 1 === $key) {
                        var_dump($rowValue);
                        // var_dump($strField);
                        // var_dump($colValue);
                        $result = addValue($rowValue, $tableName, $colValue);
                        var_dump($result);
                        $rowValue = [];
                        $colValue = [];
                    }
                }
            }
            
            $counter++;
        }
    }
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