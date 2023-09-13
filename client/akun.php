<?php
session_start();
if ($_SESSION['id'] == "") {
    header("Location: ../index.php");
    die();
}

$user_id = $_SESSION['id'];

include("../env.php");



$check_id_query = "SELECT * FROM akun WHERE id = '$user_id' ";
$run_query_id = mysqli_query($conn, $check_id_query);
$row_id = mysqli_fetch_assoc($run_query_id);

$data_telepon = $row_id["telepon"];
$data_ortu = $row_id["nama_ortu"];
$data_anak = $row_id["nama_anak"];
$data_alamat = $row_id["alamat"];

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
            <h5 class="card-header">Informasi Akun</h5>
            <div class="card-body">

                <form action="savestat.php" method="post">
                    <div class="card-text">
                        <div class="alert alert-warning" role="alert">
                            Silahkan isi data anda dengan benar
                        </div>


                        <div class="mt-3 mb-3">
                            <label for="telepon" class="form-label">Nomor Telpon:</label>
                            <input type="number" class="form-control" id="telepon" name="telepon"
                                value="<?php echo $data_telepon ?>" required>
                        </div>


                        <div class="mt-3 mb-3">
                            <label for="ortu" class="form-label">Nama Orang Tua:</label>
                            <input type="text" class="form-control" id="ortu" name="ortu" placeholder="Nama Anda"
                                value="<?php echo $data_ortu ?>" required>
                        </div>

                        <div class="mt-3 mb-3">
                            <label for="anak" class="form-label">Nama Anak:</label>
                            <input type="text" class="form-control" id="anak" name="anak" placeholder="Nama Anak"
                                value="<?php echo $data_anak ?>" required>
                        </div>

                        <div class="mt-3 mb-3">
                            <label for="alamat" class="form-label">Alamat:</label>
                            <textarea type="text" class="form-control" id="alamat" name="alamat" rows="4"
                                placeholder="Alamat lengkap beserta patokannya"
                                required><?php echo $data_alamat ?></textarea>
                        </div>



                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary" name="simpanakun"
                            value="simpanakun">Simpan</button>
                        <a href="index.php" class="btn btn-danger ms-2 me-2">Kembali</a>
                    </div>
                </form>

            </div>
        </div>





    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>