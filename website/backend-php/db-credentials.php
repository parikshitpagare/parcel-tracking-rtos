<?php
require 'db-connect.php';

if (isset($_POST['username']) || isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = false;
    $error = false;

    $query_select_user = "SELECT * FROM tbl_user WHERE value_username ='$username' AND value_password = '$password'";
    $result_select_user = mysqli_query($conn, $query_select_user);

    $num = mysqli_num_rows($result_select_user);

    if ($num == 1) {
        $login = true;

        session_start();

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;

        header("location: track.php");
    } 
    else {
        $error = true;
    }
}
?>