<?php
    $conn=mysqli_connect("localhost","root","","gallery");

    if (!$conn) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }
?>