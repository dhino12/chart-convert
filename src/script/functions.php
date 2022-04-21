<?php

include 'conn.php';

function conncatQuery(array $tData, string $flag)
{
    $strTCon = "";
    foreach ($tData as $key => $value) {
        if ((count($tData) - 1) == $key) {
            $strTCon .= "`$value` $flag";

        } else {
            $strTCon .= "`$value` $flag,";
        }
    }

    return $strTCon;
}

function query(String $query, $assoc)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        return mysqli_error($conn);;
    }

    if ($assoc === true) {
        // kembalikan data array assosiative
        $datas = [];
        while ($data = mysqli_fetch_assoc($result)) {
            $datas[] = $data;
        }
    }else if ($assoc === false) {
        // kembalikan data array numerik
        $datas = [];
        while ($data = mysqli_fetch_row($result)) {
            foreach($data as $key => $value) {
                $datas[] = $value;
                
            }
        }
    } else {
        // jika input data
        return $result;
    }

    return $datas;
}

function crTableDb($datas)
{
    $tTitle = $datas['titleTable'];
    $tHead = [];
    $tBody = []; 
    foreach ($datas as $key => $value) {
        if (explode('-', $key)[0] === '1') {
            $tHead[] = $value;
        } else if(is_numeric(explode('-', $key)[0])) {
            $tBody[] = $value; 
        }
    }
    
    $strThead = conncatQuery($tHead, 'VARCHAR(180)');
    
    $result = query("CREATE TABLE `$tTitle` ($strThead);", '');

    if (is_string($result)) {
        return $result; // kembalikan pesan kesalahan
    }
    
    return $tBody;
}

function addValue($tBodyDatas, $tTitle)
{
    
    $strTBody = conncatQuery($tBodyDatas, '');
    $fixStrTBody = str_replace('`', "'", $strTBody);
    var_dump($fixStrTBody);
    $query = "INSERT INTO `$tTitle` VALUES ($fixStrTBody);";
    var_dump($query);
    $data = query($query, '');

    return $data;
}