<?php
include 'script/functions.php';
session_start();

if (!isset($_SESSION['identity'])) {
    // GUEST
    $tables = mysqli_query($conn, "SHOW TABLES;");
    $tablesData = mysqli_query($conn, "SELECT FOUND_ROWS();");
    $tablesData = mysqli_fetch_assoc($tablesData);

    $tables = pagination($_GET, (int)$tablesData['FOUND_ROWS()'] - 3 );
    $halaman = $tables['halaman'];
    $next = $tables['next'];
    $prev = $tables['previous'];

    $totalRows;
    foreach ($tables['datas'] as $key => $value) {
        $totalRows[] = query("SELECT COUNT(*) FROM `$value`", false);
    } 
} else {
    // ROLL USED
    $id = $_SESSION['identity'];
    $level = $_SESSION['level'];
    $data = query("SELECT * FROM $level WHERE id='$id';", true)[0];
    $tables = explode(",", $data['table_name']);

    $tables = pagination($_GET, count($tables));
    $halaman = $tables['halaman'];
    $next = $tables['next'];
    $prev = $tables['previous'];

    $totalRows;
    foreach ($tables['datas'] as $key => $value) {
        $totalRows[] = query("SELECT COUNT(*) FROM `$value`", false);
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
    <title>List Data</title>
    <link rel="stylesheet" href="./style/fonts.css">
    <link rel="stylesheet" href="./style/index.css">
    <link rel="stylesheet" href="./style/sidebar.css">
    <link rel="stylesheet" href="./style/test.css">
    <link rel="stylesheet" href="./style/list.css">
    <link rel="stylesheet" href="./style/background/colors.css">
    <link rel="stylesheet" href="./style/background/bg-side.css">
    <link rel="stylesheet" href="./style/responsive/side-responsive.css">
    <link rel="stylesheet" href="./modules/sorTable.css">
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
                    <a href="<?php if (isset($_SESSION['identity'])) echo "index.php"; else echo "../"; ?>">
                        <div class="menu-link text-white" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="bi bi-columns" id="icon-side"></i>
                            <span>
                                <span class="t-sidebar">Dashboard</span>
                                <span id="expand">></span>
                            </span>
                        </div>
                    </a> 
                </div>
                <a href="list.php">
                    <div class="my-2 py-2 px-2 active-menu" id="item-side">
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
            <div class="aside-footer">
                <div class="img-user me-2 d-inline-block" id="img-user">
                    <img src="./media/userImg/<?= $data['foto']?>" alt="" width="40px" height="40px">
                </div>
                <div class="d-inline-block" id="user">  
                    <h5 class="m-0"><?php if (isset($_SESSION['identity'])) echo $data['name']; else echo "Guest" ?></h5>
                    <p class="m-0 fs-6">Software Engineer</p>
                </div>
                <?php if(isset($level)) : ?>
                    <div class="logout d-inline-block">
                        <a href="logout.php">
                            <button class="btn btn-icon btn-active-color-primary me-n4">
                                <i class="bi bi-box-arrow-left" id="icon-side"></i>
                            </button>
                        </a>
                    </div>
                <?php endif ?>
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

                <div style="width: 100%"  class="mt-3">
                    <div class="topbar">
                        <div class="container-fluid content h- py-6 py-lg-0 d-flex flex-column flex-sm-row align-items-stretch justify-content-sm-between mt-2">
                            <div class="page-title d-flex flex-column me-5">
                                <h1 class="fs-5 text-dark my-3">List Data</h1> 
                            </div>
                            <div class="d-flex align-items-center overflow-auto me-5">
                                <!-- <form action="" class="mx-3">
                                    <span class="position-absolute ms-2 mt-1">
                                        <img src="./media/icon/search.svg" alt="" srcset="">
                                    </span>
                                    <input type="text" class="form-control ps-5" style="border-radius: 8px;" id="exampleFormControlInput1" placeholder="search">
                                </form> --> 
                                <?php if (!isset($_SESSION['level'])) : ?>
                                    <a href="../login.php">
                                        <div class="d-flex align-center btn btn-outline-light round-cs-6 me-2 text-primary" id="btn-header">
                                            <h6>Login</h6>
                                        </div>
                                    </a>
                                <?php endif ?>
                                <div class="d-flex align-center btn btn-outline-light round-cs-6 me-2 bg-info">
                                    <a href="help.php" class="text-decoration-none light fw-bold" style="color: white;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-question-lg" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4.475 5.458c-.284 0-.514-.237-.47-.517C4.28 3.24 5.576 2 7.825 2c2.25 0 3.767 1.36 3.767 3.215 0 1.344-.665 2.288-1.79 2.973-1.1.659-1.414 1.118-1.414 2.01v.03a.5.5 0 0 1-.5.5h-.77a.5.5 0 0 1-.5-.495l-.003-.2c-.043-1.221.477-2.001 1.645-2.712 1.03-.632 1.397-1.135 1.397-2.028 0-.979-.758-1.698-1.926-1.698-1.009 0-1.71.529-1.938 1.402-.066.254-.278.461-.54.461h-.777ZM7.496 14c.622 0 1.095-.474 1.095-1.09 0-.618-.473-1.092-1.095-1.092-.606 0-1.087.474-1.087 1.091S6.89 14 7.496 14Z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (count($tables["datas"]) !== 0): ?> 
                <div class="container-fluid content mt-5">
                    <div class="statisk">
                    </div>                
                    <div class="feature-list">
                        <?php if(isset($level)) : ?>
                            <button type="button" class="btn btn-outline-purple" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                                Tambah Tag
                            </button>
                        <?php endif ?>
                        <?php include 'modalTag.php' ?>

                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" id="most-tags-asc">Tag terbanyak ASC</a></li>    
                                <li><a class="dropdown-item" id="most-tags-desc">Tag terbanyak DESC</a></li>   
                            </ul>
                        </div>
                    </div>
                    
                    <table class="sortable table table-striped table-hover" id="myTable3">
                        <thead>
                            <tr>
                                <th mytable2="" onclick="sortTable(0, 'myTable3')">No</th>
                                <th mytable2="" onclick="sortTable(1, 'myTable3')">Name</th>
                                <th mytable2="" onclick="sortTable(2, 'myTable3')">Jumlah Data</th>
                                <th mytable2="" onclick="sortTable(3, 'myTable3')">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tables['datas'] as $index => $value) : ?>
                                <tr>
                                    <td><?= $index + 1?></td>
                                    <td>
                                        <a href="detail.php?title=<?= $value ?>" id="toDetail" class="text-decoration-none text-black">
                                            <?= explode('-', $value)[0] ?>
                                        </a><br>
                                        
                                        <?php if(array_search($value, $tableNames) !== false) : ?> 
                                            <?php 
                                                $tableIndex = array_search($value, $tableNames);
                                                $tableIndex = $tableNames[$tableIndex];
                                                $tagsAll = query("SELECT tag_name FROM tag WHERE table_name = '$tableIndex'", true);
                                            ?>
                                            <?php $tagsNameStr = explode(',', $tagsAll[0]['tag_name']); ?>
                                            <?php foreach ($tagsNameStr as $key => $tag) :?>
                                                <?php if($tag === '') continue ?>
                                                <span class="badge bg-primary me-0" id="tag">
                                                    <span> <i class="bi bi-tag"></i> </span>
                                                    <span> <?= $tag ?> </span>
                                                </span>
                                            <?php endforeach ?>
                                        <?php endif ?> 
                                    </td> 
                                    <td><?= $totalRows[$index][0] ?></td>
                                    <td><a href="index.php#<?=$value?>"><button type="button" class="btn btn-outline-primary"><i class="bi bi-eye"></i> Kunjungi</button></a></td>
                                </tr>
                            <?php endforeach ?>
                        </thead>
                    </table>

                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                            <li class="page-item"> 
                                <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$prev'"; } ?>>Previous</a>
                            </li>
                            <?php for($x = 1; $x <= $tables['totalHalaman']; $x++) : ?>
                                <li class="page-item"><a class="page-link" href="?halaman=<?= $x ?>"><?= $x ?></a></li>
                                <li class="page-item">
                            <?php endfor; ?>
                            <a  class="page-link" <?php if($halaman < $tables['totalHalaman']) { echo "href='?halaman=$next'"; } ?>>Next</a>
                        </ul>
                    </nav>
                </div>
            <?php endif ?>
        </div>
    </main>
    <footer>

    </footer>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./modules/sorTable.min.js"></script>
    <script src="./modules/sideBar.js"></script>
    <script src="./modules/index.js"></script>
    <script src="./modules/filter.js"></script>
    <?php if(isset($_SESSION)) : ?>
        <script>
            const userManagement = document.querySelector("#user");
            userManagement.onclick = () => {
                window.location.href = "userManagement.php";
            }
        </script>
    <?php endif ?>
    <script>
        function inputTag(e) {
            const tagElement = document.querySelector(`#${e.target.value.replace(/\s/g, '')}`);
            if (tagElement === null) {
                document.getElementById('input-tag').value = ''
            } else {
                document.getElementById('input-tag').value = tagElement.innerText
            }
        }

        const tagWrap = document.querySelector('#tag-wrapper');
        const inputTagEl = document.querySelector('#input-tag');

        tagWrap.addEventListener('click', (e) => {
            console.log(e.target.id );
            if (inputTagEl.value.includes(`${e.target.innerText}`)) {
                return;
            } else if (e.target.id.includes('tag')) {
                inputTagEl.value += `${e.target.innerText},`
            }
        })
    </script>
    
</body>
</html>