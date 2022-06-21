<?php
include 'script/functions.php';
session_start();

if (!isset($_SESSION['identity'])) {
    header("Location: ../login.php");
    exit;
}
$id = $_SESSION['identity'];
$level = $_SESSION['level'];
$data = query("SELECT * FROM $level WHERE id='$id';", true)[0];
$users = query("SELECT * FROM users WHERE level='user' AND id='$id' ", true);

if (isset($_POST['submit'])) {
    $data = splitArray($_POST);
    $data[0] = ['name', 'password', 'level', 'email','username', 'status', 'username_hidden']; 
    $msgUpdateUser = updateValue($data, 'users', []); 

    if ($msgUpdateUser >= 0) {
        echo "<script>
                alert('Data berhasil diubah');
            </script>";
        header("Location: userManagement.php");
    } else {
        echo "<script>alert('Data gagal diubah')</script>";
    }
}

if (isset($_GET['username'])) {
    $username = $_GET['username'];
    $query = "DELETE FROM users WHERE username = '$username';";
    $result = query($query, '');

    if ($result === true) {
        echo "<script>alert('user $username berhasil dihapus')</script>";
        header("Location: userManagement.php");
    } else {
        echo "<script>alert('user $username berhasil dihapus')</script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Management</title>
    <link rel="stylesheet" href="./style/fonts.css">
    <link rel="stylesheet" href="./style/index.css">
    <link rel="stylesheet" href="./style/test.css">
    <link rel="stylesheet" href="./style/background/colors.css">
    <link rel="stylesheet" href="./style/background/bg-side.css">
    <link rel="stylesheet" href="./style/responsive/side-responsive.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="./modules/Chart-3.7.1.min.js"></script>
    <script src="./modules/chartjs-plugin-datalabels.min.js"></script>
</head>
<body>
    <header></header>
    <main>
        <div id="offcanvasNavbar" class="offcanvas aside bg-side-wrapper drawer drawer-start" aria-labelledby="aside-toggler">
            <div class="aside-menu">
                <div class="my-2 py-2 px-2" id="item-side">
                    <a href="index.php">
                        <div class="menu-link" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="bi bi-columns" id="icon-side"></i>
                            <span>
                                <span class="t-sidebar">Dashboard</span>
                                <span id="expand">></span>
                            </span>
                        </div>
                    </a>

                    <div class="ms-4 collapse" id="navbarToggleExternalContent">
                        <a href="default.html" class="text-decoration-none">
                            <div class="menu-item">
                                Default
                            </div>
                        </a>
                        <a href="default.html" class="text-decoration-none">
                            <div class="menu-item">
                                E-Comernce
                            </div>
                        </a>
                    </div>
                </div>
                <a href="list.php">
                    <div class="my-2 py-2 px-2" id="item-side">
                        <div class="menu-link text-white" >
                            <i class="bi bi-list-ul"></i>
                            <span>
                                <span class="t-sidebar">List</span>
                                <span id="expand">></span>
                            </span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="aside-footer ">
                <div class="img-user me-2 d-inline-block" id="img-user">
                    <img src="./media/userImg/<?= $data['foto']?>" alt="" width="40px" height="40px">
                </div>
                <div class="d-inline-block" id="user">  
                    <h5 class="m-0"><?= $data['name']?></h5>
                    <p class="m-0 fs-6">Software Engineer</p>
                </div>
                <div class="logout d-inline-block">
                    <a href="logout.php">
                        <button class="btn btn-icon btn-active-color-primary me-n4">
                            <i class="bi bi-box-arrow-left" id="icon-side"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="wrapper d-flex flex-column" style="width:100%;" id="content-wrapper">
            <div class="header">
                <div class="header-brand bg-side-wrapper">
                    <div class="logo">
                        <img src="./media/logo/logo-kemendagri.png" width="50px">
                        <p><b> e - Database </b> ※ <b>SIPD Pusat</b></p>
                        <p>Kementrian Dalam Negeri</p>
                        <div id="toggle" class="sidebar-toggle">
                            <i class="bi bi-list" style="font-size: 20px;" id="icon-side"></i>
                        </div>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <span class="navbar-toggler-icon">[ ]</span>
                    </button>
                </div>

                <div style="width: 100%">
                    <div class="topbar">
                        <div class="container-fluid content h- py-6 py-lg-0 d-flex flex-column flex-sm-row align-items-stretch justify-content-sm-between mt-2">
                            <div class="page-title d-flex flex-column me-5">
                                <h1 class="fs-5 mb-0 text-dark my-3">User Manajemen</h1> 
                            </div>
                            <div class="d-flex align-items-center overflow-auto me-5">
                                <form action="" class="mx-3">
                                    <span class="position-absolute ms-2 mt-1">
                                        <img src="./media/icon/search.svg" alt="" srcset="">
                                    </span>
                                    <input type="email" class="form-control ps-5" style="border-radius: 8px;" id="exampleFormControlInput1" placeholder="search">
                                </form>
                                
                                <div class="d-flex align-center btn btn-outline-light round-cs-6 me-2" id="btn-header">
                                    <a href="">
                                        <img src="./media/icon/square.svg" alt="" srcset="">
                                    </a>
                                </div>
                                <div class="d-flex align-center btn btn-outline-light round-cs-6 me-2" id="btn-header">
                                    <a href="">
                                        <img src="./media/icon/message.svg" alt="" srcset="">
                                    </a>
                                </div>
                                <div class="d-flex align-center btn btn-outline-light round-cs-6 me-2 bg-info">
                                    <a href="" class="text-decoration-none light fw-bold" style="color: white;">
                                        2
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid content mt-5">    
                <button type="button" class="btn btn-outline-primary" id="btnCreateTable" data-bs-toggle="modal" data-bs-target="#modalUser">Tambah User</button>
                <?php include './modalTambahUser.php' ?>
                
                <form action="" id="form-input" class="mt-5" method="POST">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr class="py-2">
                                <th>No</th>
                                <th>name</th>
                                <th>password</th>
                                <th>level</th>
                                <th>email</th>
                                <th>username</th>
                                <th>status</th>
                                <th>action</th>
                                <th hidden>username</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($users as $rowIndex => $dataWrap) : ?>
                                <tr>
                                    <td><?=$rowIndex + 1  ?></td>
                                    <td><input class="form-control border-0 bg-transparent" placeholder="Masukan Data" type="text" name="<?= $rowIndex + 1?>-0" autocomplete="off" value="<?= $dataWrap['name']?>"></td>
                                    <td><input class="form-control border-0 bg-transparent w-75 d-inline" placeholder="Masukan Data" id="input-password" type="password" name="<?= $rowIndex + 1?>-1" autocomplete="off" value="<?= $dataWrap['password']?>"><button type="button" class="btn btn-outline-primary" id="btn-show" onclick="showPassword()"><i class="bi bi-eye"></i></button></td>
                                    <td><input class="form-control border-0 bg-transparent" placeholder="Masukan Data" type="text" name="<?= $rowIndex + 1?>-2" autocomplete="off" value="<?= $dataWrap['level']?>"></td>
                                    <td><input class="form-control border-0 bg-transparent" placeholder="Masukan Data" type="text" name="<?= $rowIndex + 1?>-3" autocomplete="off" value="<?= $dataWrap['email']?>"></td>
                                    <td><input class="form-control border-0 bg-transparent" placeholder="Masukan Data" type="text" name="<?= $rowIndex + 1?>-4" autocomplete="off" value="<?= $dataWrap['username']?>"></td>
                                    <td><input type="text" readonly class="btn <?php
                                        if ($dataWrap['status'] === 'active') echo "btn-success";
                                        else echo "btn-danger";
                                    ?>" id="status" value="<?= $dataWrap['status']?>" name="<?= $rowIndex + 1?>-5"/></td>

                                    <td style="width: 18vh;">
                                        <a href="userManagement.php?username=<?= $dataWrap['username'] ?>" onclick="return confirm('delete <?= $dataWrap['username']?> ?')">
                                            <button type="button" class="btn btn-outline-danger me-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                </svg>
                                            </button>
                                        </a>
                                        <a href="userManagement.php?email=<?= $dataWrap['email'] ?>&level=<?= $dataWrap['level'] ?>">
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                </svg>
                                            </button>
                                        </a>
                                    </td>
                                    <th><input class="form-control border-0 bg-transparent" placeholder="Masukan Data" type="text" name="<?= $rowIndex + 1?>-6" autocomplete="off" value="<?= $dataWrap['username']?>" hidden></th>
                                </tr>
                            <?php endforeach; ?>
                            
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-outline-primary" name="submit" title="edit semua data user" >Submit</button>
                </form>

                <?php if (isset($_GET['email'])) : ?>
                    <?php
                        $email = $_GET['email'];
                        $levelEdit = $_GET['level'] . "s";
                        $data = query("SELECT * FROM $levelEdit WHERE email='$email';", true)[0];
                    ?>
                    <div class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" role="dialog" style="display: block;">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="post" action="" id="form-input">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="return window.location.replace('userManagement.php');"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Nama:</label>
                                            <input type="text" class="form-control" name="1-0" value="<?= $data['name']?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Password:</label>
                                            <input type="text" class="form-control" name="1-1" value="<?= $data['password']?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Level:</label>
                                            <input type="text" class="form-control" name="1-2" value="<?= $data['level']?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Email:</label>
                                            <input type="text" class="form-control" name="1-3" value="<?= $data['email']?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Username:</label>
                                            <input type="text" class="form-control" name="1-4" value="<?= $data['username']?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="recipient-name" class="col-form-label">Status:</label>
                                            <input type="text" class="form-control" name="1-5" value="<?= $data['status']?>">
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="1-6" value="<?= $data['username']?>" hidden>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="return window.location.replace('userManagement.php');">Close</button>
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-backdrop fade show"></div>
                <?php endif ?>
            </div>
        </div>
    </main>
    <footer>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./modules/sideBar.js"></script>
    <script src="./modules/index.js"></script>  

    <script>
        let indicator = true;
        const buttonStatus = document.querySelector("#status");
        buttonStatus.addEventListener('click', () => {
            if (indicator) {
                buttonStatus.classList.replace('btn-danger', 'btn-success');
                buttonStatus.value = "active"
                indicator = false;
            } else {
                buttonStatus.classList.replace('btn-success', 'btn-danger');
                buttonStatus.value = "unactive"
                indicator = true;
            }
        })

        function showPassword() {
            const inputPassword = document.querySelector('#input-password');
            const btnShow = document.querySelector("#btn-show");
            if (inputPassword.type === "password") {
                inputPassword.type = "text";
                btnShow.style.backgroundColor = "#0d6efd";
                btnShow.style.color = "#fff"
            } else {
                inputPassword.type = "password";
                btnShow.style.backgroundColor = "transparent";
                btnShow.style.color = "#0d6efd"
            }
        }
    </script>
</body>
</html>