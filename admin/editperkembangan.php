<?php
session_start();
if ($_SESSION['pass'] == "") {
    header("Location: login.php");
    die();
}

include("../env.php");

$get_id_akun = $_GET["id"];
$get_id_perkembangan = $_GET["perkembangan"];

# Mendapatkan data perkembangan

$sql_perkembangan = "SELECT tanggal, data_perkembangan FROM perkembangan WHERE id = $get_id_perkembangan";
$run_perkembangan = mysqli_query($conn, $sql_perkembangan);
$get_perkembangan = mysqli_fetch_assoc($run_perkembangan);

# Mendapatkan nama anak

$sql_nama_anak = "SELECT nama_anak FROM akun WHERE id = '$get_id_akun' ";
$run_nama_anak = mysqli_query($conn, $sql_nama_anak);
$get_nama_anak = mysqli_fetch_assoc($run_nama_anak);
$nama_anak = $get_nama_anak["nama_anak"];

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
                    Perkembangan Murid
                </h5>
                <div class="card-body">

                    <p class="card-text">Ini adalah menu untuk edit data perkembangan murid.</p>

                    <div class="mt-2 mb-2"><a href="perkembangan.php?id=<?php echo $get_id_akun; ?>"
                            class="btn btn-primary">Kembali</a></div>
                </div>
            </div>


            <div class="card mt-4 mb-4">
                <h5 class="card-header fw-bolder">
                    Input Perkembangan
                </h5>
                <div class="card-body">

                    <p class="card-text">Silahkan edit data perkembangan murid anda yang bernama <span
                            class="fw-bolder"><?php echo $nama_anak; ?></span></p>


                    <form action="proseseditperkembangan.php" method="post">
                        <input type="hidden" name="idakun" value="<?php echo $get_id_akun; ?>">
                        <input type="hidden" name="idperkembangan" value="<?php echo $get_id_perkembangan; ?>">

                        <div class="mt-2 mb-2">
                            <label for="tanggal" class="form-label fw-bolder">Tanggal:</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="<?php echo $get_perkembangan["tanggal"]; ?>" required>
                        </div>

                        <div class="mt-2 mb-2">
                            <label for="isidata" class="form-label fw-bolder">Isi Data:</label>
                            <textarea class="form-control" id="isidata" name="isidata"
                                rows="3"><?php echo $get_perkembangan["data_perkembangan"]; ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2" name="kirim" value="kirim">Simpan</button>

                        <a href="proseshapusperkembangan.php?id=<?php echo $get_id_akun; ?>&perkembangan=<?php echo $get_id_perkembangan; ?>"
                            class="btn btn-danger mt-2 ms-2">Hapus</a>

                    </form>

                </div>
            </div>




        </div>

    </div>
    </div>


    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>