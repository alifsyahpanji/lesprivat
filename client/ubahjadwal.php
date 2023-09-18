<?php
session_start();
if($_SESSION['id'] == ""){
    header("Location: ../login.php");
    die();
}

$user_id = $_SESSION['id'];

include("../env.php");

$data_alert = "";

$check_id_query = "SELECT * FROM akun WHERE id = '$user_id' ";
$run_query_id = mysqli_query($conn,$check_id_query);
$row_id = mysqli_fetch_assoc($run_query_id);

$data_jadwal = $row_id["id_jadwal"];

if($data_jadwal){
    $get_jadwal_query = "SELECT hari FROM jadwal WHERE id = '$data_jadwal' ";
    $run_query_jadwal = mysqli_query($conn,$get_jadwal_query);
    $row_jadwal = mysqli_fetch_assoc($run_query_jadwal);

    $data_hari = $row_jadwal["hari"];
}

$get_jadwal_query = "SELECT * FROM jadwal WHERE id_akun IS NULL";
$run_jadwal_query = mysqli_query($conn,$get_jadwal_query);
$count_jadwal = mysqli_num_rows($run_jadwal_query);
if($count_jadwal > 0){
    $data_alert = "tersedia";
} else {
    $data_alert = "kosong";
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

        <div class="card mt-5 mb-4">
            <h5 class="card-header">Perubahan Jadwal</h5>
            <div class="card-body">

                <form action="savejad.php" method="post">
                    <div class="card-text">

                        <?php
                    switch($data_alert){
                        case "tersedia":
                            ?>
                        <div class="alert alert-warning" role="alert">
                            <?php echo "Silahkan pilih jadwal les yang tersedia untuk merubah jadwal yang baru."; ?>
                        </div>
                        <?php
                            break;
                        case "kosong":
                            ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo "Sepertinya tidak ada jadwal les yang tersedia, anda tidak bisa merubah jadwal. silahkan hubungi kami untuk info lebih lanjut"; ?>
                        </div>
                        <?php
                            break; 
                    } 
                    ?>

                        <div class="card-text fw-bolder">Jadwal anda sebelumnya:
                            <?php echo $data_hari ?>
                        </div>



                    </div>

                </form>

            </div>
        </div>


        <div class="card mt-3 mb-5">
            <h5 class="card-header">Jadwal baru yang tersedia</h5>
            <div class="card-body">
                <div class="card-text">
                    <form action="savejadubah.php" method="post">
                        <label for="jadwalBaru" class="form-label">Jadwal baru yang tersedia:</label>
                        <select class="form-select" id="jadwalBaru" name="jadwalBaru" required>
                        <?php 
                            if($count_jadwal){
                                while($row_jadwal_loop = mysqli_fetch_assoc($run_jadwal_query)) {
                                    ?> <option value="<?php echo $row_jadwal_loop["id"] ?>"> <?php echo $row_jadwal_loop["hari"] ?></option> <?php
                                }
                            }
                            ?>
                        </select>
                       
                        <input type="hidden" id="jadwalLama" name="jadwalLama" value="<?php echo $data_jadwal ?>">

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary" name="ubah" value="ubah">Ubah</button>
                            <a href="index.php" class="btn btn-danger ms-2 me-2">Kembali</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>





    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>