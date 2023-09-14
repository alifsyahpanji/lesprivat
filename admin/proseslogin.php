<?php
session_start();
$admin_pass = $_POST['pass'];

include("../env.php");

$sql_admin = "SELECT pass FROM admintb WHERE pass = '$admin_pass'";
$run_sql_admin = mysqli_query($conn, $sql_admin);
$check_row_admin = mysqli_num_rows($run_sql_admin);

if ($check_row_admin > 0) {
    $_SESSION['pass'] = $admin_pass;
    header("Location: index.php");
    die();
} else {
    header("Location: login.php?msg=salah");
    die();
}


?>