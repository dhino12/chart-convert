<?php 

include 'src/script/functions.php';

session_start();

if (isset($_SESSION['identity'])) {
    header("Location: src/index.php");
    exit;
}

if (isset($_POST['login'])) {
    $username = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' OR email='$username'";
    $result = query($query, true)[0];
    
    var_dump($result);
    if (!is_null($result)) {
        if (password_verify($password, $result['password'])) {
            $_SESSION['identity'] = $result['id'];

            header("Location: src/index.php");
            exit;
        }
    } else {
        echo "<script>alert('ooppss user tidak ditemukan')</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./src/style/index.css">
    <link rel="stylesheet" href="./src/style/background/colors.css">
    <link rel="stylesheet" href="./src/style/responsive/side-responsive.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="sd-background m-0">
            </div>
            <div class="sd-login">
                <div class="content-login my-5 mx-5">
                    <h2 class="text-center text-purple">Login Form</h2>
                    <p class="text-center text-secondary">Silahkan login untuk menggunakan aplikasi ini</p>

                    <form action="" method="POST" class="form-login">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Username / Email <b style="color: red;">*</b></label>
                            <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password <b style="color: red;">*</b></label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-purple" id="login" >Login</button>
                        <button type="button" class="btn btn-outline-danger" id="clear">Clear</button>

                        <label class="form-text mt-3 text-secondary" for="exampleCheck1">Belum punya akun ? silahkan <a href="register.php" style="font-size: medium;">Register</a></label>
                    </form>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</body>
</html>