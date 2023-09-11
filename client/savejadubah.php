<?php
session_start();
if($_SESSION['id'] == ""){
    header("Location: ../index.php");
}

$data_alert = "";
$user_id = $_SESSION['id'];

$id_jadwal_lama = $_POST['jadwalLama'];
$id_jadwal_baru = $_POST['jadwalBaru'];

$verif_ubah_data = $_POST['ubah'];


date_default_timezone_set("Asia/Jakarta");
$order_tgl = date("Y-m-d");
$order_jam = date("H:i");

include("../env.php");

$sql_update_jadwal_lama = "UPDATE jadwal SET id_akun = NULL, order_tgl = NULL, jam = NULL WHERE id = $id_jadwal_lama";
$run_update_jadwal_lama = mysqli_query($conn, $sql_update_jadwal_lama);

if($run_update_jadwal_lama){
$sql_update_jadwal_baru = "UPDATE jadwal SET id_akun = '$user_id', order_tgl = '$order_tgl', jam = '$order_jam' WHERE id = $id_jadwal_baru";
$run_update_jadwal_baru = mysqli_query($conn, $sql_update_jadwal_baru);

if($run_update_jadwal_baru){
$sql_update_akun = "UPDATE akun SET id_jadwal ='$id_jadwal_baru' WHERE id = $user_id";
$run_sql_update_akun = mysqli_query($conn, $sql_update_akun);

if($run_sql_update_akun){
    $data_alert = "berhasilSimpan";
}else{
    $data_alert = "gagalSimpan";
}

}else{
    $data_alert = "gagalSimpan";
}

}else{
    $data_alert = "gagalSimpan";
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
                        switch($data_alert){
                            case "berhasilSimpan":
                            ?> <div class="alert alert-success" role="alert"> <?php
                                echo "Anda berhasil merubah jadwal les privat. untuk info lebih lanjut, akan kami kabari lagi."; ?> </div> <?php
                                break;
                            case "gagalSimpan":
                                ?> <div class="alert alert-danger" role="alert"> <?php
                                echo "Gagal merubah jadwal les, kemungkinan ada kesalahan. harap hubungi kami";
                                ?> </div> <?php
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