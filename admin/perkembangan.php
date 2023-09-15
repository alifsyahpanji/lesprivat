<?php
session_start();
if ($_SESSION['pass'] == "") {
    header("Location: login.php");
    die();
}

include("../env.php");

$get_id_akun = $_GET["id"];

# Mendapatkan data perkembangan

$sql_perkembangan = "SELECT * FROM perkembangan WHERE id_akun = '$get_id_akun' ORDER BY id DESC LIMIT 12 ";
$run_perkembangan = mysqli_query($conn, $sql_perkembangan);
$count_perkembangan = mysqli_num_rows($run_perkembangan);

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

                    <p class="card-text">Ini adalah menu perkembangan murid.</p>

                    <div class="mt-2 mb-2"><a href="jadaktif.php" class="btn btn-primary">Kembali</a></div>
                </div>
            </div>






            <div class="card mt-4 mb-4">
                <h5 class="card-header fw-bolder">
                    Input Perkembangan
                </h5>
                <div class="card-body">

                    <p class="card-text">Silahkan isi data perkembangan murid anda yang bernama <span
                            class="fw-bolder"><?php echo $nama_anak; ?></span></p>


                    <form action="saveperkembangan.php" method="post">
                        <input type="hidden" name="idakun" value="<?php echo $get_id_akun; ?>">

                        <div class="mt-2 mb-2">
                            <label for="tanggal" class="form-label fw-bolder">Tanggal:</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>

                        <div class="mt-2 mb-2">
                            <label for="isidata" class="form-label fw-bolder">Isi Data:</label>
                            <textarea class="form-control" id="isidata" name="isidata" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary mt-2" name="kirim" value="kirim">Kirim</button>

                    </form>

                </div>
            </div>



            <div class="card mt-4 mb-4">
                <h5 class="card-header fw-bolder">
                    Histori Perkembangan
                </h5>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mt-2 mb-2">
                            <thead>
                                <tr>
                                <tr>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Data</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <?php
                                if ($count_perkembangan > 0) {
                                    while ($row_perkembangan = mysqli_fetch_assoc($run_perkembangan)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $row_perkembangan["tanggal"] ?>
                                            </td>
                                            <td>
                                                <?php echo $row_perkembangan["data_perkembangan"] ?>
                                            </td>
                                            <td>
                                                <a href="editperkembangan.php?id=<?php echo $get_id_akun; ?>&perkembangan=<?php echo $row_perkembangan["id"]; ?>"
                                                    class="btn btn-warning">Edit</a>
                                            </td>
                                        </tr>

                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td>-</td>
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

    </div>
    </div>


    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>