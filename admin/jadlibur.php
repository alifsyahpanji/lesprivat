<?php
session_start();
if ($_SESSION['pass'] == "") {
    header("Location: login.php");
    die();
}

include("../env.php");

$sql_jadwal_aktif = "SELECT akun.id, akun.telepon, akun.nama_ortu, akun.nama_anak, akun.alamat, jadwal.hari, tgl_libur, alasan_izin, jadwal.id AS jadwal_id FROM akun INNER JOIN jadwal ON akun.id = jadwal.id_akun WHERE akun.kehadiran = 'libur' ORDER BY jadwal.order_tgl DESC";
$run_jadwal_aktif = mysqli_query($conn, $sql_jadwal_aktif);
$count_jadwal = mysqli_num_rows($run_jadwal_aktif);


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
                    Jadwal Libur
                </h5>
                <div class="card-body">

                    <p class="card-text">Ini adalah jadwal les yang sedang libur. Ada <span class="fw-bolder">
                            <?php echo $count_jadwal; ?> murid
                        </span> yang libur.</p>


                </div>
            </div>



            <?php
            if ($count_jadwal > 0) {
                while ($row_jadwal = mysqli_fetch_assoc($run_jadwal_aktif)) {
                    ?>

                    <div class="card mt-4 mb-4">

                        <h5 class="card-header fw-bolder">
                            <?php echo $row_jadwal['nama_anak']; ?>
                        </h5>
                        <div class="card-body">

                            <div class="mt-2 mb-2 fw-bolder">Hari Les:
                                <?php echo $row_jadwal['hari']; ?>
                            </div>
                            <div class="mt-2 mb-2 fw-bolder">Alamat:
                                <?php echo $row_jadwal['alamat']; ?>
                            </div>
                            <div class="mt-2 mb-2 fw-bolder">Telepon:
                                <?php echo $row_jadwal['telepon']; ?>
                            </div>
                            <div class="mt-2 mb-2 fw-bolder">Nama Ortu:
                                <?php echo $row_jadwal['nama_ortu']; ?>
                            </div>
                            <div class="mt-2 mb-2 fw-bolder">Tanggal Libur:
                                <?php echo $row_jadwal['tgl_libur']; ?>
                            </div>
                            <div class="mt-2 mb-2 fw-bolder">Alasan Izin:
                                <?php echo $row_jadwal['alasan_izin']; ?>
                            </div>


                            <div class="d-flex flex-wrap">



                                <a class="ms-3 mt-3 mb-3"
                                    onclick="aksi('Apakah murid anda aktif lagi yang bernama <?php echo $row_jadwal['nama_anak']; ?> ?', 'savesiapaktif.php?jadwal=<?php echo $row_jadwal['jadwal_id']; ?>');">
                                    <div
                                        class="menu-admin-edit text-bg-primary d-flex align-items-center justify-content-center">
                                        <div>
                                            <img src="../assets/image/send.png" alt="Aktif">
                                        </div>


                                    </div>
                                </a>



                                <a class="ms-3 mt-3 mb-3"
                                    onclick="aksi('Apakah anda ingin mengkosongkan jadwal murid anda yang bernama <?php echo $row_jadwal['nama_anak']; ?> ?', 'hapusjadlibur.php?id=<?php echo $row_jadwal['id']; ?>&jadwal=<?php echo $row_jadwal['jadwal_id']; ?>');">
                                    <div
                                        class="menu-admin-edit text-bg-danger d-flex align-items-center justify-content-center">
                                        <div>
                                            <img src="../assets/image/hapus.png" alt="Edit">
                                        </div>


                                    </div>
                                </a>



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
        function aksi(txt, lokasi) {
            const datakonfirmasi = confirm(txt);

            if (datakonfirmasi == true) {
                location = lokasi;
            }
        }
    </script>

</body>

</html>