<?php
    // Include file untuk koneksi ke database dan fungsi lain yang diperlukan
    include "koneksi.php";

    // Mulai sesi jika belum dimulai
    session_start();

    // Periksa apakah pengguna sudah login
    if(!isset($_SESSION['userid'])){
        // Jika tidak, redirect ke halaman login
        header("location:login.php");
        exit; // Pastikan tidak ada kode lain yang dijalankan setelah header redirect
    }

    // Periksa apakah data yang dibutuhkan telah dikirim melalui metode POST
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['namalengkap']) && isset($_POST['email'])) {
        // Tangkap data yang dikirim dari formulir
        $fullname = $_POST['namalengkap'];
        $email = $_POST['email'];

        // Ambil userid dari sesi
        $userid = $_SESSION['userid'];

        // Handle file upload
        if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] == 0) {
            $target_dir = "user/"; // Directory where the file will be saved
            $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]); // Path of the uploaded file
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
            if ($check !== false) {
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                } else {
                    // if everything is ok, try to upload file
                    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
                        // File uploaded successfully, update the database with the new profile picture path
                        $profile_picture_url = basename($_FILES["profile_picture"]["name"]);
                        $query = mysqli_query($conn, "UPDATE user SET namalengkap = '$fullname', email = '$email', profile_picture = '$profile_picture_url' WHERE userid = '$userid'");
                        
                        if ($query) {
                            // If the query executed successfully, redirect back to the profile page with a success message
                            header("location:foto.php?update=success");
                            exit;
                        } else {
                            // If the query failed, redirect back to the profile page with an error message
                            header("location:foto.php?update=error");
                            exit;
                        }
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        } else {
            // Handle case where no file was uploaded
            $query = mysqli_query($conn, "UPDATE user SET namalengkap = '$fullname', email = '$email' WHERE userid = '$userid'");
                        
            if ($query) {
                // If the query executed successfully, redirect back to the profile page with a success message
                header("location:foto.php?update=success");
                exit;
            } else {
                // If the query failed, redirect back to the profile page with an error message
                header("location:foto.php?update=error");
                exit;
            }
        }
    } else {
        // Jika data yang dibutuhkan tidak dikirim melalui metode POST, redirect kembali ke halaman profil dengan pesan kesalahan
        header("location:foto.php?update=missing_data");
        exit;
    }
?>
