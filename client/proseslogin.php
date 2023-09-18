<?php
session_start();
$user_telepon = $_POST['telepon'];

include("../env.php");
$check_telepon_query = "SELECT * FROM akun WHERE telepon = '$user_telepon' ";
$run_query_telepon = mysqli_query($conn,$check_telepon_query);
if (mysqli_num_rows($run_query_telepon) > 0) {
    $row_telepon = mysqli_fetch_assoc($run_query_telepon);
        $_SESSION['id'] = $row_telepon["id"];
        header("Location: index.php");
die();
   
      
} else {
    $query_telepon = "INSERT INTO akun (telepon)
    VALUES ('$user_telepon')";
    $insert_telepon = mysqli_query($conn,$query_telepon);
    if($insert_telepon){
        $get_telepon_query = "SELECT * FROM akun WHERE telepon = '$user_telepon' ";
        $run_get_telepon = mysqli_query($conn,$get_telepon_query);
if (mysqli_num_rows($run_get_telepon) > 0) {
    $get_telepon = mysqli_fetch_assoc($run_get_telepon);
        $_SESSION['id'] = $get_telepon["id"];
        header("Location: index.php");
die();
}
} else {
    header("Location: index.php");
    die();
    }
}
?>