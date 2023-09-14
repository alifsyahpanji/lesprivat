<?php
session_start();
if ($_SESSION['pass'] == "") {
    header("Location: login.php");
    die();
}

include("../env.php");




?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div>

        <nav class="navbar">
            <a href="index.php">
                <div class="d-flex align-items-center fw-bolder">
                    <img src="../assets/image/home.png" class="img-nav-icon me-2" alt="home">
                    <div class="ms-2">Home</div>
                </div>
            </a>

            <a href="logout.php">
                <div class="d-flex align-items-center fw-bolder">
                    <img src="../assets/image/logout.png" class="img-nav-icon me-2" alt="home">
                    <div class="ms-2">Logout</div>
                </div>
            </a>
        </nav>

        <div class="container-fluid mt-5 mb-5">
            <div class="card">
                <h5 class="card-header fw-bolder">
                    Menu Panel
                </h5>
                <div class="card-body">
                    <p class="card-text">Silahkan gunakan management menu pada panel ini.</p>
                    <div class="d-flex flex-wrap">

                        <a href="jadaktif.php" class="ms-3 mt-3 mb-3">
                            <div
                                class="menu-container text-bg-primary d-flex align-items-center justify-content-center">
                                <div>
                                    <img class="img-menu-panel" src="../assets/image/jadwal-aktif.png"
                                        alt="jadwal aktif">
                                </div>


                            </div>
                        </a>

                        <a href="" class="ms-3 mt-3 mb-3">
                            <div class="menu-container text-bg-danger d-flex align-items-center justify-content-center">
                                <div>
                                    <img class="img-menu-panel" src="../assets/image/jadwal-libur.png"
                                        alt="jadwal libur">
                                </div>


                            </div>
                        </a>

                        <a href="" class="ms-3 mt-3 mb-3">
                            <div
                                class="menu-container text-bg-success d-flex align-items-center justify-content-center">
                                <div>
                                    <img class="img-menu-panel" src="../assets/image/pembayaran.png" alt="pembayaran">
                                </div>


                            </div>
                        </a>

                        <a href="" class="ms-3 mt-3 mb-3">
                            <div
                                class="menu-container text-bg-warning d-flex align-items-center justify-content-center">
                                <div>
                                    <img class="img-menu-panel" src="../assets/image/member.png" alt="member">
                                </div>


                            </div>
                        </a>

                    </div>

                </div>
            </div>

        </div>
    </div>


    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>