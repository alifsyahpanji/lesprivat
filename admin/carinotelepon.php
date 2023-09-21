<?php
session_start();
if ($_SESSION['pass'] == "") {
    header("Location: login.php");
    die();
}

$telepon = $_POST["carinomor"];

include("../env.php");

$sql_get_data = "SELECT id, telepon, nama_ortu, nama_anak, alamat, kehadiran FROM akun WHERE telepon = '$telepon' ";
$data = mysqli_query($conn, $sql_get_data);
$jumlah_data = mysqli_num_rows($data);


?>

<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div>

        <nav class="navbar">
            <a href="index.php">
                <div class="d-flex align-items-center fw-bolder">
                    <img src="../assets/image/home.png" class="img-nav-icon me-2" alt="home">
                    <div class="ms-2">Home</div>
                </div>
            </a>

            <a href="logout.php">
                <div class="d-flex align-items-center fw-bolder">
                    <img src="../assets/image/logout.png" class="img-nav-icon me-2" alt="home">
                    <div class="ms-2">Logout</div>
                </div>
            </a>
        </nav>

        <div class="container-fluid mt-5 mb-5">
            <div class="card">
                <h5 class="card-header fw-bolder">
                    Pencarian Member
                </h5>
                <div class="card-body">
                    <p class="card-text">
                        <?php if ($jumlah_data > 0) {
                            ?>
                        <div class="alert alert-success" role="alert">
                            Data telepon
                            <?php echo $telepon; ?> berhasil ditemukan, silahkan gunakan menu pada aplikasi ini.
                        </div>
                        <?php
                        } else {
                            ?>
                        <div class="alert alert-danger" role="alert">
                            Data telepon
                            <?php echo $telepon; ?> tidak ditemukan, mungkin salah nomor atau tidak terdaftar pada aplikasi
                            ini.
                        </div>
                        <?php
                        } ?>
                    </p>

                    <div class="mt-2"><a href="member.php" class="btn btn-primary">Kembali</a></div>


                </div>
            </div>



            <?php
            if ($jumlah_data > 0) {
                while ($row_akun = mysqli_fetch_assoc($data)) {
                    ?>
                    <div class="card mt-3 mb-4">
                        <h5 class="card-header fw-bolder">
                            <?php echo $row_akun["telepon"]; ?>
                        </h5>
                        <div class="card-body">
                            <div class="card-text fw-bolder">



                                <div class="mt-2">Nama Ortu:
                                    <?php echo $row_akun["nama_ortu"]; ?>
                                </div>
                                <div class="mt-2">Nama Anak:
                                    <?php echo $row_akun["nama_anak"]; ?>
                                </div>
                                <div class="mt-2">Alamat:
                                    <?php echo $row_akun["alamat"]; ?>
                                </div>
                                <div class="mt-2">Status Kehadiran:
                                    <?php echo $row_akun["kehadiran"]; ?>
                                </div>




                                <div class="mt-3">
                                    <a href="editmember.php?id=<?php echo $row_akun['id']; ?>" class="btn btn-warning">Edit</a>
                                    <a class="btn btn-danger ms-2"
                                        onclick="hapus('Apakah anda ingin menghapus akun <?php echo $row_akun['telepon']; ?> ?', 'proseshapusmember.php?id=<?php echo $row_akun['id']; ?>');">Hapus</a>
                                </div>


                            </div>
                        </div>
                    </div>

                    <?php

                }
            }
            ?>




        </div>








    </div>


    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>