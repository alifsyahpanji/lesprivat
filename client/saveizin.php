<?php
session_start();
if($_SESSION['id'] == ""){
    header("Location: ../index.php");
}

# Isi pesan
$data_alert = "";
$user_id = $_SESSION['id'];

$tgl_izin = $_POST["tglizin"];

$alasanizin = $_POST["alasanizin"];

include("../env.php");

$simpan_izin = $_POST['izin'];

if($simpan_izin){
$sql_update_data = "UPDATE akun SET kehadiran = 'libur', tgl_libur = '$tgl_izin', alasan_izin = '$alasanizin' WHERE id = $user_id";
$update_data = mysqli_query($conn,$sql_update_data);
if($update_data){
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
                        switch($data_alert){
                            case "berhasilSimpan":
                            ?> <div class="alert alert-success" role="alert"> <?php
                                echo "Izin libur berhasil di terima, selamat beristirahat, sampai jumpa lagi ya"; ?> </div> <?php
                                break;
                            case "gagalSimpan":
                                ?> <div class="alert alert-danger" role="alert"> <?php
                                echo "Izin libur gagal, kemungkinan ada kesalahan. harap hubungi kami";
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