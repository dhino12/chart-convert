<?php

include 'conn.php';

function splitArray(array $datas)
{
    $tHead = [];
    $tBody = [];
    $tCollaction = [];
    foreach ($datas as $key => $value) {
        if (explode('-', $key)[0] === '0') {
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
        if((count($tHead[0]) - 1) == $key) {
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

    for ($i = 0; $i <= count($tBodyDatas) - 1 ; $i++) {
        if($i === 0) { 
            $strTBody .= "('". $tBodyDatas[$i] ."',";
            
        } else if ((count($tBodyDatas) - 1) === $i) { 
            $strTBody .= "'". $tBodyDatas[$i] ."')";
            
        } else if ($i % count($tHead) == 0) { 
            $strTBody .= "),('". $tBodyDatas[$i] ."',";
            
        } else { 
            $strTBody .= "'". $tBodyDatas[$i] ."',";

        }
    }

    $fixString = str_replace(',)', ')', $strTBody); 
    // var_dump($fixString);
    $query = "INSERT INTO `$tTitle` VALUES $fixString;";

    $data = query($query, '');

    return $data;
}   

function updateValue($datas, $tTable, $oldData)
{
    global $conn;
    $columns = $datas[0];
    $rows = $datas[1];
    $query = "";
    $counter = 0;

    if (count($oldData) !== 0) {
        foreach($columns as $key => $newCol) {
            $oldCol = array_keys($oldData)[$key];
            $result = query("ALTER TABLE `$tTable` CHANGE `$oldCol` `$newCol` VARCHAR(180)", '');
        }
    }

    foreach($rows as $row) {
        $column = htmlspecialchars($columns[$counter]);
        $row = htmlspecialchars($row);

        if (count($columns) - 1 === $counter) {
            if (count($oldData) !== 0) {
                // update data
                $query .= "`$column`='$row'";
                $counter = -1;
                $querySQL = "UPDATE `$tTable` SET $query WHERE id='$row';";
            } else {
                // update user
                $counter = -1;
                $queryTmp = "UPDATE `$tTable` SET $query WHERE username='$row';";
                $querySQL = str_replace(", ", " ", $queryTmp);
            }
            $result = query($querySQL, ""); 
            $query = "";

        } else {
            $query .= "`$column`='$row',";
        }

        $counter++;
    }

    return mysqli_affected_rows($conn);
}

function updateColumns($cols, $tTitle, $oldCols)
{
    global $conn;
    $oldDataCols = [];
    foreach($oldCols as $key => $value) {
        $oldDataCols[] = $key;
    }

    foreach($cols as $key => $col) {
        $oldCols = $oldDataCols[$key];
        query("ALTER TABLE `$tTitle` COLUMN `$oldCols` TO `$col` VARCHAR(180)", '');
    }

    return mysqli_affected_rows($conn);
}

function clearData($id, $level) {
    global $conn;
    
    $tablesName = query("SELECT table_name FROM $level WHERE id='$id';", true)[0]; 
    $tablesName = explode(',', $tablesName['table_name']);
    foreach ($tablesName as $value) {
        if ($value !== $level) {
            mysqli_query($conn, "DROP TABLE `$value`");
            mysqli_query($conn, "DELETE FROM tag WHERE table_name = '$value' AND id_user = '$id'");
        };

    }
    query("UPDATE `$level` SET `table_name`=NULL WHERE id='$id'", '');
    return mysqli_affected_rows($conn);
}

function deleteData($query, $tableNames, $tableName) {
    global $conn;

    $strTables = '';
    $tables = explode(',', $tableNames);
    foreach ($tables as $table) {
        if ($table !== $tableName) $strTables .= "$table,";
    }
    $strTables = substr($strTables, 0, strlen($strTables) - 1);
    $result = mysqli_query($conn ,$query);
    
    if ($result !== false) {
        return $strTables;
    }

    return mysqli_affected_rows($conn);
}

function uploadFile()
{
    $fileName = $_FILES['foto']['name'];
    $sizeFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpImg = $_FILES['foto']['tmp_name'];

    $extensionImgValid = ['jpg', 'png', 'jpeg'];
    $extensionImg = explode('.', $fileName);
    $extensionImg = strtolower(end($extensionImg));

    if (!in_array($extensionImg, $extensionImgValid)) {
        echo "
            <script>
                alert('Pastikan yang anda upload gambar');
            </script>
        ";
        return false;
    }

    // if ($sizeFile > 10_000_000) {
    //     echo "
    //     <script>
    //        alert('Ukuran file terlalu besar');
    //     </script>
    //     ";
    //     return false;
    // }

    $newNameFile = uniqid() . '.' . $extensionImg;

    $result = move_uploaded_file($tmpImg, '../media/userImg/'. $newNameFile);

    return $newNameFile; 
}

function register($data) {
    global $conn;

    $username = htmlspecialchars(strtolower(stripslashes($data['username'])));
    $password = htmlspecialchars(mysqli_real_escape_string($conn, $data['password']));
    $name = htmlspecialchars(mysqli_real_escape_string($conn, $data['name']));
    $email = htmlspecialchars(mysqli_real_escape_string($conn, $data['email']));

    $usernameCheck = query("SELECT username FROM admins WHERE username='$username'", true);
    
    if (count($usernameCheck) > 0) {
        echo "<script>
            alert('username sudah ada');
        </script>";
        return false;
    }

    $checkCodeImg = 4;
    
    if ($checkCodeImg === 4) {
        $foto = 'person.svg';
    } else {
        $foto = uploadFile();

        if ($foto === false) {
            return false;
        }
    }

    $queryInsert = "INSERT INTO admins (
        foto, username, 
        name, password, 
        level, email, id
        ) VALUES (
        '$foto', '$username', 
        '$name', '$password', 
        'admin', '$email', '". uniqid() ."'
        )";
    query($queryInsert, '');
    
    return mysqli_affected_rows($conn);
}

function pagination ($halaman) {
    global $conn;

    $batas = 10;
    $halamanAwal = ($halaman > 1) ? ( ($halaman * $batas) - $batas ) : 0;

    $previous = $halaman - 1;
    $next = $halaman + 1;

    
    return $dataTables;
}