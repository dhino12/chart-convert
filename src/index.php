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
    <link rel="stylesheet" href="./style/test.css">
    <link rel="stylesheet" href="./style/background/bg-side.css">
    <link rel="stylesheet" href="./style/responsive/side-responsive.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="./modules/Chart-3.7.1.min.js"></script>
    <script src="./modules/chartjs-plugin-datalabels.min.js"></script>
</head>
<body>
    <header></header>
    <main>
        <div class="wrapper d-flex flex-column" style="width:100%;">
            <div class="header">
                <div class="header-brand bg-side-wrapper">
                    <div class="logo">
                        <img src="./media/logo/logo.png" width="50px">
                        <h5>e - Database</h1>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                        <span class="navbar-toggler-icon">[ ]</span>
                    </button> 
                </div>

                <div style="width: 100%">
                    <div class="topbar">
                        <div class="container-fluid content h- py-6 py-lg-0 d-flex flex-column flex-sm-row align-items-stretch justify-content-sm-between mt-2">
                            <div class="page-title d-flex flex-column me-5">
                                <h1 class="fs-5 mb-0 text-dark my-3">Dashboard</h1>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" style="text-decoration: none;">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Halaman Utama</li>
                                </ul>
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
                <div class="d-flex mb-3">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalChart">Import Excel</button>
                    <?php include 'modalChart.php' ?>
                </div>
                
                <div class="bg-red row align-items-center justify-content-between" id="canvas-grafik">
                    
                </div>
            </div>
        </div>
        
        <div id="offcanvasNavbar" class="offcanvas aside bg-side-wrapper drawer drawer-start d-none" aria-labelledby="aside-toggler">
            <div class="aside-menu">
                <div class="my-2 py-2 px-2" id="item-side">
                    <div class="menu-link active-menu" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                        <p>Dashboard</p>
                        <p>></p>
                    </div>

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
                <a href="tambah.php">
                    <div class="my-2 py-2 px-2" id="item-side">
                        <div class="menu-link">
                            <p>Tambah Data</p>
                        </div>
                    </div>
                </a>
                <div class="my-2 py-2 px-2" id="item-side">
                    <div class="menu-link">
                        <p>Chart</p>
                        <p>></p>
                    </div>
                </div>
                <div class="my-2 py-2 px-2" id="item-side">
                    <div class="menu-link">
                        <p>Chart</p>
                        <p>></p>
                    </div>
                </div>
                <div class="my-2 py-2 px-2" id="item-side">
                    <div class="menu-link">
                        <p>Chart</p>
                        <p>></p>
                    </div>
                </div>
                <div class="my-2 py-2 px-2" id="item-side">
                    <div class="menu-link">
                        <p>Chart</p>
                        <p>></p>
                    </div>
                </div>
                <div class="my-2 py-2 px-2" id="item-side">
                    <div class="menu-link">
                        <p>Chart</p>
                        <p>></p>
                    </div>
                </div>
            </div>
            <div class="aside-footer ">
                <div class="d-flex align-items-sm-center justify-content-center">
                    <div class="img-user me-3">
                        <img src="./media/logo/android.svg" alt="" width="40px" height="40px">
                    </div>
                    <div class="d-flex flex-column" id="user">
                        <h5 class="m-0">Asep Wijaya</h5>
                        <p class="m-0 fs-6">Software Engineer</h5>
                    </div>
                    <div class="logout">
                        <button class="btn btn-icon btn-active-color-primary me-n4">
                            <span class="svg-icon svg-icon-2 svg-icon-gray-400">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mh-50px"><rect opacity="0.3" width="12" height="2" rx="1" transform="matrix(-1 0 0 1 15.5 11)" fill="black"></rect><path d="M13.6313 11.6927L11.8756 10.2297C11.4054 9.83785 11.3732 9.12683 11.806 8.69401C12.1957 8.3043 12.8216 8.28591 13.2336 8.65206L16.1592 11.2526C16.6067 11.6504 16.6067 12.3496 16.1592 12.7474L13.2336 15.3479C12.8216 15.7141 12.1957 15.6957 11.806 15.306C11.3732 14.8732 11.4054 14.1621 11.8756 13.7703L13.6313 12.3073C13.8232 12.1474 13.8232 11.8526 13.6313 11.6927Z" fill="black"></path><path d="M8 5V6C8 6.55228 8.44772 7 9 7C9.55228 7 10 6.55228 10 6C10 5.44772 10.4477 5 11 5H18C18.5523 5 19 5.44772 19 6V18C19 18.5523 18.5523 19 18 19H11C10.4477 19 10 18.5523 10 18C10 17.4477 9.55228 17 9 17C8.44772 17 8 17.4477 8 18V19C8 20.1046 8.89543 21 10 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3H10C8.89543 3 8 3.89543 8 5Z" fill="#C4C4C4"></path></svg>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>  
    </main>
    <footer>

    </footer> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="./modules/createChart.js"></script>
	<?php include './script/chartHandler.php' ?>
    <script src="./modules/index.js"></script>
</body>
</html>
