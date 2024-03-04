<?php
    include "koneksi.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $albumid = $_POST['albumid'];
        $namaalbum = $_POST['namaalbum'];
        $deskripsi = $_POST['deskripsi'];

        
    
        if ($_FILES['foto_album']['size'] > 0) {
  
            $image_name = $_FILES['foto_album']['name'];
            $image_tmp_name = $_FILES['foto_album']['tmp_name'];
            $image_folder = "album/" . $image_name;
            
        
            $sql = "UPDATE album SET namaalbum='$namaalbum', deskripsi='$deskripsi', foto_album='$image_folder' WHERE albumid='$albumid'";
            

            move_uploaded_file($image_tmp_name, $image_folder);
        } else {

            $sql = "UPDATE album SET namaalbum='$namaalbum', deskripsi='$deskripsi' WHERE albumid='$albumid'";
        }
        

        if (mysqli_query($conn, $sql)) {
    
            header("Location: album.php");
            exit();
        } else {

            echo "Error updating record: " . mysqli_error($conn);
        }
    }
?>
