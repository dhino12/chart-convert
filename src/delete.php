<?php 

session_start();
include 'script/functions.php';

if (isset($_GET['tableName'])) {
    $tableName = $_GET['tableName'];
    $id = $_SESSION['identity'];

    $tableNames = query("SELECT table_name FROM `users` WHERE id='$id'", true)[0]['table_name'];
    $tableNames = str_replace("$tableName,", '', $tableNames);
    $result = query("DROP TABLE `$tableName`;", ''); 
    if (!$result) {
        echo "Data $tableName gagal dihapus";
    } else {
        $result = query("UPDATE `users` SET `table_name`='$tableNames' WHERE `id`='$id'", '');
        echo "Data $tableName berhasil dihapus";
        // header("Location: index.php");
    }
}

?>

?>