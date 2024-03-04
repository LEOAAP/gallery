<?php
include "koneksi.php";
session_start();

// Pastikan semua variabel yang diperlukan telah didefinisikan
if(isset($_POST['judulfoto'], $_POST['deskripsifoto'], $_POST['albumid']) && isset($_FILES['lokasifile'])) {
    $judulfoto = $_POST['judulfoto'];
    $deskripsifoto = $_POST['deskripsifoto'];
    $albumid = $_POST['albumid'];
    $tanggalunggah = date("Y-m-d");
    $userid = $_SESSION['userid'];

    // Pastikan direktori penyimpanan file tersedia dan memiliki izin tulis
    $targetDirectory = 'gambar/';
    if(!is_dir($targetDirectory)) {
        echo "Error: Directory $targetDirectory tidak ditemukan.";
        exit();
    }

    // Pastikan file telah diunggah dengan benar
    if($_FILES['lokasifile']['error'] !== UPLOAD_ERR_OK) {
        echo "Error: Terjadi kesalahan saat mengunggah file.";
        exit();
    }

    // Periksa ekstensi file yang diunggah
    $filename = $_FILES['lokasifile']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $allowedExtensions = array('png', 'jpg', 'jpeg', 'gif');
    if(!in_array($ext, $allowedExtensions)) {
        echo "Error: Ekstensi file tidak diizinkan.";
        exit();
    }

    // Periksa ukuran file yang diunggah
    $ukuran = $_FILES['lokasifile']['size'];
    if($ukuran > 1044070) {
        echo "Error: Ukuran file terlalu besar.";
        exit();
    }

    // Generate nama unik untuk file
    $rand = uniqid();
    $newFilename = $rand . '_' . $filename;
    $targetPath = $targetDirectory . $newFilename;

    // Pindahkan file ke direktori penyimpanan
    if(move_uploaded_file($_FILES['lokasifile']['tmp_name'], $targetPath)) {
        // Jika file berhasil diunggah, tambahkan data ke database
        $query = "INSERT INTO foto (judulfoto, deskripsifoto, tanggalunggah, lokasifile, albumid, userid) VALUES (?, ?, ?, ?, ?, ?)";
        $statement = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($statement, 'ssssii', $judulfoto, $deskripsifoto, $tanggalunggah, $newFilename, $albumid, $userid);
        
        if(mysqli_stmt_execute($statement)) {
            // Redirect to success page or desired location
            header("Location: foto.php");
            exit();
        } else {
            echo "Error: Gagal menambahkan data ke database.";
        }
    } else {
        echo "Error: Gagal menyimpan file.";
    }
} else {
    echo "Error: Data yang diperlukan tidak lengkap.";
}
?>
