<?php
session_start();
if ($_SESSION['pass'] == "") {
    header("Location: login.php");
    die();
}

$tanggalawal = $_POST["tanggalawal"];
$tanggalakhir = $_POST["tanggalakhir"];


include("../env.php");

$alert = "";

$sql_get_pendapatan = "SELECT SUM(jumlah) AS pendapatan FROM pembayaran WHERE stat_pembayaran = 'terima' AND tanggal BETWEEN '$tanggalawal' AND '$tanggalakhir' ";
$run_get_pendapatan = mysqli_query($conn, $sql_get_pendapatan);
$count_get_pendapatan = mysqli_num_rows($run_get_pendapatan);
$get_pendapatan = mysqli_fetch_assoc($run_get_pendapatan);
$data_pendapatan = $get_pendapatan["pendapatan"];

if ($data_pendapatan == NULL) {
    $alert = "gagal";

} else {

    $alert = "berhasil";
}


# Format rupiah

include("../utility/rupiah.php");

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
                    Pendapatan Anda
                </h5>
                <div class="card-body">

                    <?php
                    if ($alert == "berhasil") {
                        ?>
                        <div class="alert alert-success" role="alert">
                            Selamat, pendapatan anda tanggal
                            <?php echo $tanggalawal; ?> sampai
                            <?php echo $tanggalakhir; ?> adalah <span class="fw-bolder">Rp
                                <?php echo rupiah($data_pendapatan); ?>
                            </span>
                        </div>
                        <?php
                    } elseif ($alert == "gagal") {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            Sepertinya belum ada pembayaran.
                        </div>
                        <?php
                    }
                    ?>

                    <div class="mt-2 mb-2"><a href="riwayatpembayaran.php" class="btn btn-primary">Kembali</a></div>
                </div>
            </div>


        </div>

    </div>
    </div>


    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>