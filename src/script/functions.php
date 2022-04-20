<?php

use function PHPSTORM_META\type;

include 'conn.php';

function query(String $query, bool $assoc)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        return mysqli_error($conn);;
    }

    if ($assoc) {
        $datas = [];
        while ($data = mysqli_fetch_assoc($result)) {
            $datas[] = $data;
        }
    }else {
        $datas = [];
        while ($data = mysqli_fetch_row($result)) {
            foreach($data as $key => $value) {
                $datas[] = $value;

            }
        }
    }

    return $datas;
}

function crTableDb($datas)
{
    global $conn;

    $tTitle = $datas['titleTable'];
    $tHead = [];
    $tBody = []; 
    foreach ($datas as $key => $value) { 
        if (explode('-', $key)[0] === '1') {
            $tHead[] = $value;
        } else {
            $tBody = $value; 
        }
    }
    
    $strThead = "";
    foreach ($tHead as $key => $value) {
        $strThead .= "$value VARCHAR(180), ";
    }
    var_dump($strThead);
    $result = query("CREATE TABLE `$tTitle` ($strThead)", true);

    return $result;
}