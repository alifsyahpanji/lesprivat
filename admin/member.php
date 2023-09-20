<?php
session_start();
if ($_SESSION['pass'] == "") {
    header("Location: login.php");
    die();
}

include("../env.php");

$batas = 20;
$halaman = isset($_GET['halaman']) ? (int) $_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1) ? ($halaman * $batas) - $batas : 0;

$previous = $halaman - 1;
$next = $halaman + 1;


$sql_get_data = "SELECT id, telepon, nama_ortu, nama_anak, alamat, kehadiran FROM akun";
$data = mysqli_query($conn, $sql_get_data);
$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);

$data_member = mysqli_query($conn, "SELECT id, telepon, nama_ortu, nama_anak, alamat, kehadiran FROM akun LIMIT $halaman_awal, $batas");


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



            <div class="card mb-5">
                <h5 class="card-header fw-bolder">
                    Member
                </h5>
                <div class="card-body">
                    <p class="card-text">Ini adalah menu member yang sudah gabung di aplikasi les privat.</p>

                    <form action="" method="post">
                        <div class="mt-3 mb-3">
                            <label for="carinomor" class="form-label">Nomor Telepon:</label>
                            <input type="number" class="form-control" id="carinomor" name="carinomor">
                        </div>

                        <button type="submit" class="btn btn-primary mt-2 mb-3">Cari</button>


                    </form>

                </div>
            </div>


            <nav aria-label="Page navigation example" class="mt-1 mb-5">
                <ul class="pagination justify-content-center">

                    <li class="page-item <?php if ($halaman == 1) {
                        echo "disabled";
                    } ?>">
                        <a class="page-link" <?php if ($halaman > 1) {
                            echo "href=?halaman=" . $previous;
                        } ?>>Previous</a>
                    </li>

                    <?php
                    for ($x = 1; $x <= $total_halaman; $x++) {
                        ?>
                        <li class="page-item"><a class="page-link <?php if ($x == $halaman) {
                            echo "active";
                        } ?>" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a>
                        </li>
                        <?php
                    }

                    ?>

                    <li class="page-item <?php if ($halaman == $total_halaman) {
                        echo "disabled";
                    } ?>">
                        <a class="page-link" <?php if ($halaman < $total_halaman) {
                            echo "href=?halaman=" . $next;
                        } ?>>Next</a>
                    </li>


                </ul>
            </nav>



            <?php
            if ($jumlah_data > 0) {
                while ($row_akun = mysqli_fetch_assoc($data_member)) {
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
    <script>
        function hapus(txt, lokasi) {
            const datakonfirmasi = confirm(txt);

            if (datakonfirmasi == true) {
                location = lokasi;
            }
        }
    </script>

</body>

</html>