<?php
session_start();
if($_SESSION['id'] == ""){
    header("Location: ../index.php");
}

include("../env.php");

$user_id = $_SESSION['id'];

$check_id_query = "SELECT * FROM akun WHERE id = '$user_id' ";
$run_query_id = mysqli_query($conn,$check_id_query);
$row_id = mysqli_fetch_assoc($run_query_id);

   $data_telepon = $row_id["telepon"];
   $data_jadwal = $row_id["id_jadwal"];
   $data_ortu = $row_id["nama_ortu"];
   $data_anak = $row_id["nama_anak"];
   $data_alamat = $row_id["alamat"];

if($data_jadwal){
    $get_jadwal_query = "SELECT hari FROM jadwal WHERE id = '$data_jadwal' ";
    $run_query_jadwal = mysqli_query($conn,$get_jadwal_query);
    $row_jadwal = mysqli_fetch_assoc($run_query_jadwal);

    $data_hari = $row_jadwal["hari"];
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

        <div class="card mt-5">
            <h5 class="card-header">Beranda</h5>
            <div class="card-body">
                <p class="card-text">Silahkan pilih jadwal untuk memulai les privat.</p>
                <a href="jadwal.php" class="btn btn-primary">Pilih Jadwal</a>
            </div>
        </div>

        <div class="card mt-4">
            <h5 class="card-header">Jadwal Les</h5>
            <div class="card-body">
                <?php
if($data_jadwal == NULL) {
?>
                <div class="card-text fw-bolder">Belum ada jadwal yang anda pesan.</div>
                <?php
} else {
    ?>
                <div class="card-text">
                    <div class="fw-bolder">Hari: <?php echo $data_hari ?>
                    </div>
                </div>
                <?php
}
                ?>


            </div>
        </div>

        <div class="card mt-4">
            <h5 class="card-header">Pembayaran</h5>
            <div class="card-body">
                <div class="card-text">
                    <p>Untuk pembayaran, bisa dibayarkan minggu depan setelah les privat.</p>
                    <p>Contohnya: jika les hari senin tanggal 1, maka pembayarannya adalah senin depan tanggal 8.</p>
                </div>
            </div>
        </div>

        <div class="card mt-4 mb-5">
            <h5 class="card-header">Informasi Akun</h5>
            <div class="card-body">
                <div class="card-text">
                    <div class="fw-bolder">Telepon:
                        <?php echo $data_telepon; ?>
                    </div>
                    <div class="fw-bolder">Nama Orang Tua:
                        <?php echo $data_ortu ?>
                    </div>
                    <div class="fw-bolder">Nama Anak:
                        <?php echo $data_anak ?>
                    </div>
                    <div class="fw-bolder">Alamat:
                        <?php echo $data_alamat; ?>
                    </div>
                </div>
                <a href="akun.php" class="btn btn-warning mt-3">Ubah</a>
                <a href="logout.php" class="btn btn-danger mt-3 ms-2 me-2">Keluar</a>
            </div>
        </div>

    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>