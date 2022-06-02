<?php

include 'script/functions.php';
session_start();

if (isset($_SESSION['identity'])) {
    $result = clearData($_SESSION['identity']);
    if ($result >= 0) {
        header("Location: index.php");
    }
}
?>