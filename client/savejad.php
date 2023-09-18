<?php
session_start();
if ($_SESSION['id'] == "") {
    header("Location: login.php");
    die();
}

$data_alert = "";
$user_id = $_SESSION['id'];

$id_jadwal = $_POST['jadwal'];

$data_ortu = $_POST['ortu'];
$data_anak = $_POST['anak'];
$data_alamat = $_POST['alamat'];
;

date_default_timezone_set("Asia/Jakarta");
$order_tgl = date("Y-m-d");
$order_jam = date("H:i");

include("../env.php");

$check_jadwal_user = "SELECT id_jadwal FROM akun WHERE id = '$user_id' ";
$run_jadwal_user = mysqli_query($conn, $check_jadwal_user);
$row_jadwal_user = mysqli_fetch_assoc($run_jadwal_user);
$data_jadwal_user = $row_jadwal_user["id_jadwal"];

if ($data_jadwal_user == NULL) {
    $sql_update_data = "UPDATE akun SET nama_ortu = '$data_ortu', nama_anak = '$data_anak', alamat = '$data_alamat', id_jadwal = $id_jadwal, kehadiran = 'masuk' WHERE id = $user_id";
    $update_data = mysqli_query($conn, $sql_update_data);
    if ($update_data) {
        $sql_update_jadwal = "UPDATE jadwal SET id_akun = '$user_id', order_tgl = '$order_tgl', jam = '$order_jam' WHERE id = $id_jadwal";
        $update_jadwal = mysqli_query($conn, $sql_update_jadwal);
        $data_alert = "berhasilSimpan";
    } else {
        $data_alert = "gagalSimpan";
    }
} else {
    $data_alert = "adaJadwal";
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
                                echo "Terimakasih sudah memilih jadwal les privat, silahkan cek di beranda untuk melihat jadwalnya. untuk info lebih lanjut, akan kami kabari lagi."; ?>
                            </div>
                            <?php
                            break;
                        case "gagalSimpan":
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <?php
                                echo "Gagal memilih jadwal les, kemungkinan ada kesalahan. harap hubungi kami";
                                ?>
                            </div>
                            <?php
                            break;
                        case "adaJadwal":
                            ?>
                            <div class="alert alert alert-warning" role="alert">
                                <?php
                                echo "Sepertinya anda sudah memiliki jadwal les, silahkan klik ubah jadwal jika ingin pindah jadwal";
                                ?>
                            </div>
                            <div class="my-3"><a href="ubahjadwal.php" class="btn btn-danger">Ubah Jadwal</a></div>
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