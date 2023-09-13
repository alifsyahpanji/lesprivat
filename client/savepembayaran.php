<?php
session_start();
if ($_SESSION['id'] == "") {
    header("Location: ../index.php");
    die();
}

$jumlah_pembayaran = $_POST['jumlahuang'];
$metode_pembayaran = $_POST['metodepembayaran'];

$data_alert = "";
$user_id = $_SESSION['id'];

date_default_timezone_set("Asia/Jakarta");
$pembayaran_tgl = date("Y-m-d");

# Cek input decimal


include("../env.php");

if (!str_contains($jumlah_pembayaran, '.')) {
    $sql_input_pembayaran = "INSERT INTO pembayaran (id_akun, tanggal, metode_pembayaran, jumlah, stat_pembayaran) VALUES ('$user_id', '$pembayaran_tgl', '$metode_pembayaran', '$jumlah_pembayaran', 'menunggu')";
    $run_input_pembayaran = mysqli_query($conn, $sql_input_pembayaran);

    if ($run_input_pembayaran) {
        $data_alert = "berhasilSimpan";
    } else {
        $data_alert = "gagalSimpan";
    }
} else {
    $data_alert = "inputsalah";
}



?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Les Privat Alifsyah Panji</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="container-fluid">

        <div class="card mt-5 mb-5">
            <h5 class="card-header">Status</h5>
            <div class="card-body">

                <div class="card-text">

                    <?php
                    switch ($data_alert) {
                        case "berhasilSimpan":
                            ?>
                            <div class="alert alert-success" role="alert">
                                <?php
                                echo "Terimakasih sudah membayar, selanjutnya akan kami proses verifikasi dulu ya. untuk riwayat dan status pembayaran, bisa dilihat pada halaman beranda"; ?>
                            </div>
                            <?php
                            break;
                        case "gagalSimpan":
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <?php
                                echo "Pembayaran gagal, kemungkinan ada kesalahan sistem. harap hubungi kami";
                                ?>
                            </div>
                            <?php
                            break;
                        case "inputsalah":
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <?php
                                echo "Pembayaran gagal, mohon isi input jumlah pembayaran dengan format yang benar.";
                                ?>
                            </div>
                            <?php
                            break;
                    }
                    ?>

                </div>

                <div class="mt-3">
                    <a href="index.php" class="btn btn-primary">Beranda</a>
                </div>
            </div>
        </div>





    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>