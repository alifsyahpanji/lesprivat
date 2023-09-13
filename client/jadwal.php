<?php
session_start();
if ($_SESSION['id'] == "") {
    header("Location: ../index.php");
    die();
}

$user_id = $_SESSION['id'];

include("../env.php");

# Pesan alert
$data_alert = "";

# Mendapatkan data akun
$check_id_query = "SELECT * FROM akun WHERE id = '$user_id' ";
$run_query_id = mysqli_query($conn, $check_id_query);
$row_id = mysqli_fetch_assoc($run_query_id);

$data_ortu = $row_id["nama_ortu"];
$data_anak = $row_id["nama_anak"];
$data_alamat = $row_id["alamat"];

# Mendapatkan data jadwal
$get_jadwal_query = "SELECT * FROM jadwal WHERE id_akun IS NULL";
$run_jadwal_query = mysqli_query($conn, $get_jadwal_query);
$count_jadwal = mysqli_num_rows($run_jadwal_query);
if ($count_jadwal > 0) {
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

        <div class="card mt-5 mb-5">
            <h5 class="card-header">Pendaftaran Jadwal</h5>
            <div class="card-body">

                <form action="savejad.php" method="post">
                    <div class="card-text">

                        <?php
                        switch ($data_alert) {
                            case "tersedia":
                                ?>
                                <div class="alert alert-warning" role="alert">
                                    <?php echo "Segera pilih jadwal yang tersedia sebelum jadwalnya kosong dipesan murid lain."; ?>
                                </div>
                                <?php
                                break;
                            case "kosong":
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    <?php echo "Sepertinya jadwal les sudah penuh, tidak ada jadwal yang tersedia. silahkan hubungi kami
                            untuk
                            info lebih lanjut 083842368811"; ?>
                                </div>
                                <?php
                                break;
                        }
                        ?>


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
                            <textarea class="form-control" id="alamat" name="alamat" rows="4"
                                placeholder="Alamat lengkap beserta patokannya"
                                required><?php echo $data_alamat ?></textarea>
                        </div>

                        <label for="jadwal" class="form-label">Jadwal Tersedia:</label>
                        <select class="form-select" id="jadwal" name="jadwal" required>
                            <?php
                            if ($count_jadwal) {
                                while ($row_jadwal = mysqli_fetch_assoc($run_jadwal_query)) {
                                    ?>
                                    <option value="<?php echo $row_jadwal["id"] ?>"> <?php echo $row_jadwal["hari"] ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>

                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary" name="daftar" value="daftar">Daftar</button>
                        <a href="index.php" class="btn btn-danger ms-2 me-2">Kembali</a>
                    </div>
                </form>

            </div>
        </div>





    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>