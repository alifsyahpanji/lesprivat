<?php
session_start();
if ($_SESSION['pass'] == "") {
    header("Location: login.php");
    die();
}

$id_akun = $_GET["id"];


include("../env.php");

$alert = "";

$sql_delete_akun = "DELETE FROM akun WHERE id = $id_akun";
$run_delete_data = mysqli_query($conn, $sql_delete_akun);

if ($run_delete_data) {
    $alert = "berhasil";
} else {
    $alert = "gagal";
}

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
                    Hapus Member
                </h5>
                <div class="card-body">

                    <?php
                    if ($alert == "berhasil") {
                        ?>
                        <div class="alert alert-success" role="alert">
                            Proses hapus member berhasil, silahkan lihat pada halaman member atau cek dengan pencarian
                        </div>
                        <?php
                    } elseif ($alert == "gagal") {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            Proses hapus member gagal, sepertinya ada kesalahan sistem.
                        </div>
                        <?php
                    }
                    ?>

                    <div class="mt-2 mb-2"><a href="member.php" class="btn btn-primary">Kembali</a></div>
                </div>
            </div>


        </div>

    </div>
    </div>


    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>