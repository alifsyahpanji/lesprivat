<?php
session_start();
if($_SESSION['id'] == ""){
    header("Location: ../index.php");
}

# Mengatur tanggal

date_default_timezone_set("Asia/Jakarta");
$tglini = date("Y-m-d");

include("../env.php");

$user_id = $_SESSION['id'];

# Mendapatkan data akun

$check_id_query = "SELECT * FROM akun WHERE id = '$user_id' ";
$run_query_id = mysqli_query($conn,$check_id_query);
$row_id = mysqli_fetch_assoc($run_query_id);

# Menyimpan data dari mysql ke variabel

   $data_telepon = $row_id["telepon"];
   $data_jadwal = $row_id["id_jadwal"];
   $data_ortu = $row_id["nama_ortu"];
   $data_anak = $row_id["nama_anak"];
   $data_alamat = $row_id["alamat"];
   $data_status = $row_id["kehadiran"];
   $data_tgl_libur = $row_id["tgl_libur"];
   

# Mendapatkan data jadwal

if($data_jadwal){
    $get_jadwal_query = "SELECT hari FROM jadwal WHERE id = '$data_jadwal' ";
    $run_query_jadwal = mysqli_query($conn,$get_jadwal_query);
    $row_jadwal = mysqli_fetch_assoc($run_query_jadwal);

    $data_hari = $row_jadwal["hari"];
}

# Mendapatkan data perkembangan

$sql_perkembangan = "SELECT * FROM perkembangan WHERE id_akun = '$user_id' ORDER BY id DESC LIMIT 12 ";
$run_perkembangan = mysqli_query($conn, $sql_perkembangan);
$count_perkembangan = mysqli_num_rows($run_perkembangan);

$alert_perkembangan = "";

if($count_perkembangan == 0){
    $alert_perkembangan = "Mulai pertemuan les privat untuk melihat data perkembangan anak anda";
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
                    <div class="fw-bolder">Hari:
                        <?php echo $data_hari ?>
                    </div>
                    <div class=" mt-3 mb-2"><a href="ubahjadwal.php" class="btn btn-warning">Ubah Jadwal</a></div>
                </div>
                <?php
}
                ?>


            </div>
        </div>

        <div class="card mt-4">
            <h5 class="card-header">Perkembangan Anak</h5>
            <div class="card-body">
                <div class="card-text">
                    <?php 
if($alert_perkembangan){
    ?>
                    <div class="alert alert-primary" role="alert">
                        <?php echo $alert_perkembangan ?>
                    </div>
                    <?php
} ?>



                    <div>
                        <table class="table table-striped table-bordered table-responsive">

                            <thead>
                                <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Data</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php 
                                if($count_perkembangan > 0){
                                    while($row_perkembangan = mysqli_fetch_assoc($run_perkembangan)){
?>
                                <tr>
                                    <td>
                                        <?php echo $row_perkembangan["tanggal"] ?>
                                    </td>
                                    <td>
                                        <?php echo $row_perkembangan["data_perkembangan"] ?>
                                    </td>
                                </tr>

                                <?php
                                    }
                                }else{
                                    ?>
                                <tr>
                                    <td>-</td>
                                    <td>-</td>
                                </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>

        <div class="card mt-4">
            <h5 class="card-header">Status Kehadiran</h5>
            <div class="card-body">
                <p class="card-text">Jika sebelumnya sedang libur, dan ingin les kembali. mohon beritahu kami jika anda
                    sudah siap untuk les.</p>

                <div class="mt-2">
                    <span class="fw-bolder">Status anda:</span>

                    <?php 
                    switch($data_status){
                        case "masuk":
                            ?> <span class="fw-bolder font-green ms-2">Siap Les</span>  <?php
                            break;
                        case "libur":
                            ?> <span class="fw-bolder font-red ms-2">Sedang Libur</span>  
                            <div class="mt-2"> 
                            <span class="fw-bolder">Dari Tanggal:</span>
                            <span class="fw-bolder ms-1"><?php echo $data_tgl_libur; ?></span>
                            </div>
                            <?php
                            break;
                        default:
                            ?> <span class="fw-bolder font-blue ms-2">Belum Ada</span>  <?php
                    }
?>

                </div>

                <a href="savesiap.php" class="btn btn-primary mt-3">Les Lagi</a>
            </div>
        </div>

        <div class="card mt-4">
            <h5 class="card-header">Izin Libur</h5>
            <div class="card-body">
                <p class="card-text">Jika ingin libur, mohon beritahu kami dengan mengisi data di bawah ini.</p>

                <form action="saveizin.php" method="post">
                    <div class="mt-3">
                        <label for="tglizin" class="form-label fw-bolder">Tanggal Libur:</label>
                        <input type="date" id="tglizin" name="tglizin" required>
                    </div>

                    <div class="mt-3 mb-3">
                        <label for="alasanizin" class="form-label">Alasan:</label>
                        <textarea class="form-control" id="alasanizin" name="alasanizin" rows="3"
                            placeholder="Kenapa anda libur ?" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" name="izin" value="izin">Izin</button>
                </form>


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