<?php 

session_start();
include 'script/functions.php';

if (isset($_GET['tableName'])) {
    $tableName = $_GET['tableName'];
    $id = $_SESSION['identity'];
    $strTables = '';

    $tableNames = query("SELECT table_name FROM `users` WHERE id='$id'", true)[0]['table_name'];

    $tableNames = deleteData("DROP TABLE `$tableName`", $tableNames, $tableName);
    
    if (is_string($tableNames)) {
        $result = query("UPDATE `users` SET `table_name`='$tableNames' WHERE `id`='$id'", '');
        echo "<script>alert('Data $tableName berhasil dihapus')</script>";

        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Data $tableName gagal dihapus')</script>";
    }
}

?>