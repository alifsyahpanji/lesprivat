<?php
session_start();
if ($_SESSION['pass'] == "") {
    header("Location: login.php");
    die();
}

include("../env.php");

$get_id_akun = $_GET["id"];
$get_id_pembayaran = $_GET["pembayaran"];

# Mendapatkan data pembayaran

$sql_pembayaran = "SELECT * FROM pembayaran WHERE id = $get_id_pembayaran";
$run_pembayaran = mysqli_query($conn, $sql_pembayaran);
$count_pembayaran = mysqli_num_rows($run_pembayaran);
$row_pembayaran = mysqli_fetch_assoc($run_pembayaran);

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
                    Edit Pembayaran
                </h5>
                <div class="card-body">

                    <p class="card-text">Ini adalah menu untuk edit pembayaran.</p>

                    <div class="mt-2 mb-2"><a href="inputpembayaran.php?id=<?php echo $get_id_akun; ?>"
                            class="btn btn-primary">Kembali</a></div>
                </div>
            </div>






            <div class="card mt-4 mb-4">
                <h5 class="card-header fw-bolder">
                    Edit Pembayaran
                </h5>
                <div class="card-body">

                    <p class="card-text">Silahkan isi data pembayaran murid anda yang bernama <span
                            class="fw-bolder"><?php echo $nama_anak; ?></span></p>

                    <form action="proseseditinputpembayaran.php" method="post">

                        <input type="hidden" name="idpembayaran" value="<?php echo $row_pembayaran["id"]; ?>">
                        <input type="hidden" name="idakun" value="<?php echo $get_id_akun; ?>">



                        <div class="mt-3 mb-3">
                            <label for="tanggal" class="form-label fw-bolder">Tanggal:</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="<?php echo $row_pembayaran["tanggal"]; ?>" required>
                        </div>


                        <div class="mt-3 mb-3">
                            <label for="statuspembayaran" class="form-label fw-bolder">Status Pembayaran:</label>
                            <select class="form-select" id="statuspembayaran" name="statuspembayaran"
                                aria-label="Default select example" required>
                                <option value="menunggu" <?php if ($row_pembayaran["stat_pembayaran"] == "menunggu") {
                                    echo "selected";
                                } ?>>Proses Verifikasi</option>
                                <option value="terima" <?php if ($row_pembayaran["stat_pembayaran"] == "terima") {
                                    echo "selected";
                                } ?>>Diterima</option>

                            </select>
                        </div>


                        <div class="mt-3 mb-3">
                            <label for="metodepembayaran" class="form-label fw-bolder">Metode Pembayaran:</label>
                            <select class="form-select" id="metodepembayaran" name="metodepembayaran"
                                aria-label="Default select example" required>
                                <option value="cash" <?php if ($row_pembayaran["metode_pembayaran"] == "cash") {
                                    echo "selected";
                                } ?>>Cash Langsung</option>
                                <option value="gopay" <?php if ($row_pembayaran["metode_pembayaran"] == "gopay") {
                                    echo "selected";
                                } ?>>Gopay</option>
                                <option value="dana" <?php if ($row_pembayaran["metode_pembayaran"] == "dana") {
                                    echo "selected";
                                } ?>>Dana</option>
                            </select>
                        </div>

                        <div class="mt-3 mb-3">
                            <label for="jumlahuang" class="form-label fw-bolder">Jumlah Pembayaran:</label>
                            <input type="number" class="form-control" id="jumlahuang" name="jumlahuang"
                                placeholder="90000" value="<?php echo $row_pembayaran["jumlah"]; ?>" required>
                        </div>

                        <div class="mt-2"><button type="submit" class="btn btn-success" name="ubahpemb"
                                value="ubahpemb">Ubah</button></div>
                    </form>




                </div>
            </div>





        </div>

    </div>
    </div>


    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>