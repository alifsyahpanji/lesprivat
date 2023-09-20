<?php
session_start();
if ($_SESSION['pass'] == "") {
    header("Location: login.php");
    die();
}

include("../env.php");

$user_id = $_GET["id"];

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
                    Edit member
                </h5>
                <div class="card-body">
                    <p class="card-text">Silahkan ubah data member anda.</p>


                </div>
            </div>


            <div class="card mt-5 mb-5">
                <h5 class="card-header">Informasi Akun</h5>
                <div class="card-body">

                    <form action="proseseditmember.php" method="post">
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

                            <input type="hidden" name="id" value="<?php echo $user_id ?>">



                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary" name="simpanakun"
                                value="simpanakun">Simpan</button>
                            <a href="member.php" class="btn btn-danger ms-2 me-2">Kembali</a>
                        </div>
                    </form>

                </div>
            </div>



        </div>
    </div>


    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>