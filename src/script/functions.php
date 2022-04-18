<?php 

include 'conn.php';

function query(String $query)
{
    global $conn;
    $result = mysqli_query($conn, $query);

    if (!$result) {
        return mysqli_error($conn);;
    }

    $datas = [];
    while ($data = mysqli_fetch_assoc($result)) {
        $datas[] = $data;
    }

    return $datas;
}

?>