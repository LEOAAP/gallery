<?php
include "koneksi.php";
session_start();

// Mengambil data dari form

$namaalbum = $_POST['namaalbum'];
$deskripsi = $_POST['deskripsi'];
$tanggaldibuat = date("Y-m-d");
$userid = $_SESSION['userid'];


// Mendapatkan informasi file foto
$image_name = $_FILES['foto_album']['name'];
$image_size = $_FILES['foto_album']['size'];
$image_tmp_name = $_FILES['foto_album']['tmp_name'];
$folder_path = "album/"; 
$image_folder = $image_name;

// Memasukkan data album ke dalam database
$sql = "INSERT INTO album (namaalbum, deskripsi, tanggaldibuat, userid, foto_album) 
        VALUES ('$namaalbum', '$deskripsi', '$tanggaldibuat', '$userid', '$image_folder')";

if(mysqli_query($conn, $sql)){
    // Jika query berhasil dijalankan, pindahkan file foto ke folder album
    move_uploaded_file($image_tmp_name, $folder_path . $image_folder);
    $message = 'Add Album successfully!';
    header('Location: album.php');
    exit;
} else{
    // Jika terjadi kesalahan dalam query
    $message = 'Error: ' . mysqli_error($conn);
    echo $message;
}
?>
