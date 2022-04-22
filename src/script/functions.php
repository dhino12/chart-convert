<?php

include 'conn.php';

function splitArray(array $datas)
{
    $tHead = [];
    $tBody = [];
    $tCollaction = [];
    foreach ($datas as $key => $value) {
        if (explode('-', $key)[0] === '1') {
            $tHead[] = $value;
        } else if(is_numeric(explode('-', $key)[0])) {
            $tBody[] = $value; 
        }
    } 

    array_push($tCollaction, $tHead, $tBody); 

    return $tCollaction;
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
    $tCollaction = splitArray($datas);
    $tHead[] = $tCollaction[0]; 
    
    $strThead = '';

    foreach($tHead[0] as $key => $value) {
        if(count($tHead) == $key) {
            $strThead .= "`$value` VARCHAR(180)";

        } else {
            $strThead .= "`$value` VARCHAR(180),";

        }
    }
    
    $result = query("CREATE TABLE `$tTitle` ($strThead);", '');

    if (is_string($result)) {
        return $result; // kembalikan pesan kesalahan
    }
    
    return $tCollaction;
}

function addValue($tBodyDatas, $tTitle, $tHead)
{
    
    $strTBody = '';
    var_dump(count($tBodyDatas));

    for ($i = 0; $i <= count($tBodyDatas) - 1 ; $i++) {
        if($i === 0) {
            echo 'masuk if <br>';
            $strTBody .= "('". $tBodyDatas[$i] ."',";
            
        } else if ((count($tBodyDatas) - 1) === $i) {
            echo 'masuk else if 1 <br>';
            $strTBody .= "'". $tBodyDatas[$i] ."')";
            
        } else if ($i % count($tHead) == 0) {
            echo 'masuk else if 2 <br>';
            $strTBody .= "),(";
            
        } else {
            echo 'masuk else <br>';
            $strTBody .= "'". $tBodyDatas[$i] ."',";

        }
    }

    $query = "INSERT INTO `$tTitle` VALUES $strTBody;";
    $data = query($query, '');
    var_dump($data);

    return $data;
}