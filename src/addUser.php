<?php 

include 'script/functions.php';

session_start();

if (isset($_POST['submit'])) {
    $id = $_SESSION['identity'];
    $name = $_POST['fullName'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "INSERT INTO users (
            status, foto, username, name, password,
            level, email, id
        ) VALUES (
            'unactive', 'person.svg', '$username',
            '$name', '$password',
            'user', '$email', '$id'
        );";
    $msgHandler = query($query, '');
    
    if ($msgHandler === true) {
        header("Location: userManagement.php");
        exit;
    } else {
        echo "<script>alert('gagal menambahkan user')</script>";
    }
}

?>