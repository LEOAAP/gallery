<?php
include "koneksi.php";
session_start();

if (isset($_POST['namalengkap'], $_POST['email'])) {
    $namalengkap = $_POST['namalengkap'];
    $email = $_POST['email'];
    
    // Memeriksa apakah ada file foto yang diunggah
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $targetDirectory = 'user/';
        
        // Memeriksa ekstensi file yang diunggah
        $filename = $_FILES['foto']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $allowedExtensions = array('png', 'jpg', 'jpeg');
        if (!in_array($ext, $allowedExtensions)) {
            echo "Error: Ekstensi file tidak diizinkan.";
            exit();
        }

        // Memeriksa ukuran file yang diunggah (maksimum 1 MB)
        $ukuran = $_FILES['foto']['size'];
        if ($ukuran > 1048576) { // 1 MB = 1048576 bytes
            echo "Error: Ukuran file terlalu besar (maksimum 1 MB).";
            exit();
        }

        // Generate nama unik untuk file
        $newFilename = uniqid() . '_' . $filename;
        $targetPath = $targetDirectory . $newFilename;

        // Memindahkan file ke direktori penyimpanan
        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $targetPath)) {
            echo "Error: Gagal menyimpan file.";
            exit();
        }

        // Perbarui foto pengguna di database
        $query = "UPDATE user SET foto = ? WHERE userid = ?";
        $statement = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($statement, 'si', $newFilename, $_SESSION['userid']);
        mysqli_stmt_execute($statement);
    }

    // Perbarui informasi pengguna (username dan email) di database
    $query = "UPDATE user SET namalengkap = ?, email = ? WHERE userid = ?";
    $statement = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($statement, 'ssi', $namalengkap, $email, $_SESSION['userid']);
    
    if (mysqli_stmt_execute($statement)) {
        // Redirect ke halaman profil pengguna atau lokasi yang diinginkan
        header("Location: index.php");
        exit();
    } else {
        echo "Error: Gagal memperbarui informasi pengguna.";
    }
} else {
    echo "Error: Data yang diperlukan tidak lengkap.";
}
?>
