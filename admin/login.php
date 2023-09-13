<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel Alifsyah Panji</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
</head>

<body>
    <div class="perfect-center">

        <div class="container-margin">

            <div class="title">Admin Panel</div>
            <div class="card">
                <div class="card-body">

                    <div class="card-text">
                        <p>Selamat datang, ini adalah aplikasi untuk mengatur management les privat.</p>
                    </div>

                    <form action="proseslogin.php" method="post">

                        <div class="mt-3 mb-3">
                            <label for="pass" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="pass" name="pass" required>
                        </div>

                        <div class="mt-3">
                            <?php
                            $cek_data_alert = "";
                            if (empty($_GET)) {
                                $cek_data_alert = false;
                            } else {
                                $cek_data_alert = true;
                            }

                            if ($cek_data_alert) {
                                ?>
                                <div class="alert alert-danger" role="alert">
                                    Maaf password salah, silahkan masukan password yang benar.
                                </div>
                                <?php
                            } else {
                                ?>
                                <div class="alert alert-primary" role="alert">
                                    Silahkan masukan password akses admin dengan benar.
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <button type="submit" class="btn btn-primary" name="login" value="login">Masuk</button>
                    </form>


                </div>
            </div>

        </div>

    </div>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>