<?php
session_start();
if ($_SESSION['id'] == "") {
    header("Location: ../login.php");
    die();
}

$data_alert = "";
$user_id = $_SESSION['id'];

$data_telepon = $_POST['telepon'];
$data_ortu = $_POST['ortu'];
$data_anak = $_POST['anak'];
$data_alamat = $_POST['alamat'];
;

include("../env.php");

$simpan_akun = $_POST['simpanakun'];

if ($simpan_akun) {
    $sql_update_data = "UPDATE akun SET telepon = '$data_telepon', nama_ortu = '$data_ortu', nama_anak = '$data_anak', alamat = '$data_alamat' WHERE id = $user_id";
    $update_data = mysqli_query($conn, $sql_update_data);
    if ($update_data) {
        $data_alert = "berhasilSimpan";
    } else {
        $data_alert = "gagalSimpan";
    }
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
                                echo "Data anda yang terbaru berhasil disimpan, silahkan cek hasil perubahan ini di halaman beranda"; ?>
                            </div>
                            <?php
                            break;
                        case "gagalSimpan":
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <?php
                                echo "Gagal menyimpan data akun, kemungkinan ada kesalahan. harap hubungi kami";
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