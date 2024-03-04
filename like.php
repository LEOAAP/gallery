<?php
include "koneksi.php";
session_start();

if(!isset($_SESSION['userid'])){
    // Jika pengguna tidak login, alihkan ke halaman login
    header("location:index.php");
} else {
    $fotoid = $_GET['fotoid'];
    $userid = $_SESSION['userid'];
    
    // Cek apakah user sudah pernah like foto ini
    $query = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

    if(mysqli_num_rows($query) == 1){
        // Jika user sudah pernah like foto ini, maka lakukan unlike
        mysqli_query($conn, "DELETE FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
        header("location:index.php");
    } else {
        // Jika user belum pernah like foto ini, lakukan like
        $tanggallike = date("Y-m-d");
        mysqli_query($conn, "INSERT INTO likefoto VALUES('', '$fotoid', '$userid', '$tanggallike')");
        header("location:index.php");
    }
}
?>
