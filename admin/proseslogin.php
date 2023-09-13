<?php
session_start();
$admin_pass = $_POST['pass'];

if ($admin_pass == "123") {
    $_SESSION['pass'] = $admin_pass;
    header("Location: index.php");
    die();
} else {
    header("Location: login.php?msg=salah");
    die();
}

?>