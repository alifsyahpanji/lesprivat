<?php
session_start();
if ($_SESSION['id'] == "") {
    header("Location: ../index.php");
    die();
}

# Isi pesan
$data_alert = "";
$user_id = $_SESSION['id'];


include("../env.php");

# Mendapatkan data akun
$check_id_query = "SELECT * FROM akun WHERE id = '$user_id' ";
$run_query_id = mysqli_query($conn, $check_id_query);
$row_id = mysqli_fetch_assoc($run_query_id);

$data_status = $row_id["kehadiran"];

if ($data_status == "libur") {
    $sql_update_data = "UPDATE akun SET kehadiran = 'masuk', tgl_libur = NULL, alasan_izin = NULL WHERE id = $user_id";
    $update_data = mysqli_query($conn, $sql_update_data);
    if ($update_data) {
        $data_alert = "berhasilSimpan";
    } else {
        $data_alert = "gagalSimpan";
    }
} elseif ($data_status == "masuk") {
    $data_alert = "sudahSiap";
} else {
    $data_alert = "belumAda";
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
                                echo "Konfirmasi berhasil,Sepertinya anda sudah siap untuk les kembali. tunggu kedatangan kami ya"; ?>
                            </div>
                            <?php
                            break;
                        case "gagalSimpan":
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <?php
                                echo "Konfirmasi gagal, kemungkinan ada kesalahan sistem. harap hubungi kami";
                                ?>
                            </div>
                            <?php
                            break;
                        case "sudahSiap":
                            ?>
                            <div class="alert alert-primary" role="alert">
                                <?php
                                echo "Anda sebelumnya sudah siap untuk les, anda tidak perlu untuk konfirmasi lagi.";
                                ?>
                            </div>
                            <?php
                            break;
                        case "belumAda":
                            ?>
                            <div class="alert alert-warning" role="alert">
                                <?php
                                echo "Anda belum memiliki jadwal les, mohon untuk memilih jadwal les dulu di halaman beranda";
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