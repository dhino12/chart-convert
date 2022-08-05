<?php
include 'script/functions.php';
session_start();

if (!isset($_SESSION['username'])) header("Location: ../login.php");

$tableName = $_GET['tableName'];
$level = $_SESSION['level'];
$username = $_SESSION['username'];

$result = query("SELECT * FROM `$tableName`", true);

if (isset($_POST['submit'])) {
    $idTableName = explode("-", $tableName)[1]; // get id table
    $idTableName = $_POST['titleTable'] . "-" . $idTableName; 
    query("RENAME TABLE `$tableName` TO `". $idTableName . "`", '');

    // update table_name di admins/users tables pada database
    $tablesName = query("SELECT table_name FROM $level WHERE username = '$username' OR email = '$username';", false); 
    $updateTableName = str_replace($tableName, $idTableName, $tablesName[0]);  
    query("UPDATE $level SET table_name = '$updateTableName' WHERE username= '$username' OR email = '$username'", "");

    $data = splitArray($_POST);
    $msgUpdate = updateValue($data,  $idTableName, $result[0]); 

    if ($msgUpdate >= 0) {
        echo "
            <script>
                alert('Data berhasil diubah');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo "<script>alert('Data gagal diubah')</script>";
    }
}
$id = $_SESSION['identity'];
$level = $_SESSION['level'];
$data = query("SELECT * FROM $level WHERE id='$id';", true)[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="./style/fonts.css">
    <link rel="stylesheet" href="./style/index.css">
    <link rel="stylesheet" href="./style/sidebar.css">
    <link rel="stylesheet" href="./style/test.css">
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
        
        <div id="offcanvasNavbar" class="offcanvas aside bg-side-wrapper drawer drawer-start " aria-labelledby="aside-toggler">
            <div class="aside-menu">
                <div class="my-2 py-2 px-2" id="item-side">
                    <div class="menu-link active-menu" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="bi bi-columns" id="icon-side"></i>
                        <span>
                            <span class="t-sidebar">Dashboard</span>
                            <span id="expand">></span>
                        </span>
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
                    <div class="img-user me-3 d-inline-block" id="img-user">
                        <img src="./media/logo/android.svg" alt="" width="40px" height="40px">
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
        <div class="wrapper d-flex flex-column" style="width:100%; background: #f7f7f7;" id="content-wrapper">
            <div class="header">
                <div class="header-brand bg-side-wrapper">
                    <div class="logo">
                        <img src="./media/logo/logo-kemendagri.png" width="50px">
                        <p><b> e - Database </b> Ẋ <b>SIPD Pusat</b></p> 
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
                                <h1 class="fs-5 mb-0 text-dark my-3">Update Data <?= $tableName ?></h1> 
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
                <?php include './modalTable.php' ?>
                
                <form action="" id="form-input" class="mt-5" method="POST">
                    <table class="table table-bordered table-striped table-hover">

                    </table>
                </form>
            </div>
        </div>
    </main>
    <footer>

    </footer> 
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./modules/sideBar.js"></script>
    <script src="./modules/index.js"></script>
    <script src="./modules/tableHandler.js"></script>
    <script>
        const column = [];
        let tmp = [];
        const rows = [];
        const data = [];
        <?php foreach($result as $keyNumber => $value) : ?>
            <?php foreach($value as $keyName => $data) : ?>
                if (<?=$keyNumber?> === 0) {
                    column.push(`<?=$keyName?>`);
                }
                tmp.push(`<?= $data ?>`);
            <?php endforeach ?>
            rows.push(tmp);
            tmp = [];
        <?php endforeach ?>
        data.push(column);
        data.push(rows);
        
        console.log(data);
        crTable(data, "<?= $tableName ?>", true);
    </script>
</body>
</html>
