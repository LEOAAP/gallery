<?php include 'tamplate/header.php'; ?>

<style>
    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .card {
        width: 250px;
        border: 1px solid #ccc;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
    }

    .card img {
        width: 250px;
        height: 300px;
        object-fit: cover;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .card-content {
        padding: 15px;
    }

    .card-content h3 {
        margin-top: 0;
    }

    .card-content p {
        margin-bottom: 10px;
    }

    .card-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 15px 15px;
    }

    .like-icon {
        color: #ccc;
        transition: color 0.3s ease;
    }

    .like-icon:hover {
        color: #f00;
    }
    .card .profile img{
    height: 40px;
    width: 40px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 5px;  
    }
</style>

<div class="card-container">
<?php

include "koneksi.php";
$useridLoggedIn = $_SESSION['userid']; // Gantilah dengan cara Anda mendapatkan userid pengguna yang login

$sql = mysqli_query($conn, "SELECT foto.*, user.namalengkap, (SELECT COUNT(*) FROM likefoto WHERE likefoto.fotoid = foto.fotoid) AS like_count FROM foto JOIN user ON foto.userid = user.userid");

while ($data = mysqli_fetch_array($sql)) {
    // Cek apakah user sudah like foto ini
    $fotoid = $data['fotoid'];
    $checkLike = mysqli_query($conn, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$useridLoggedIn'");
    $userLiked = mysqli_num_rows($checkLike) > 0 ? true : false;
?>
<div class="card">
    <div class="flex items-center">
        <div class="profile">
        <?php
        // Mendapatkan URL root
        $rootURL = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

        // Mendapatkan data pengguna yang mengunggah foto
        $selectUser = mysqli_query($conn, "SELECT user.profile_picture FROM `user` INNER JOIN `foto` ON user.userid = foto.userid WHERE foto.fotoid = '{$data['fotoid']}'") or die('query failed');
        if(mysqli_num_rows($selectUser) > 0){
            $userData = mysqli_fetch_assoc($selectUser);
            // Cek apakah ada foto profil yang tersedia
            if(!empty($userData['profile_picture'])){
                // Gunakan foto profil pengguna yang mengunggah foto jika tersedia
                echo '<img src="'.$rootURL.'/user/'.$userData['profile_picture'].'">';
            }else{
                // Gunakan gambar default "user.png" jika tidak ada foto profil
                echo '<img src="'.$rootURL.'/image/user.png">';
            }
        }else{
            // Jika data pengguna tidak ditemukan, gunakan gambar default "user.png"
            echo '<img src="'.$rootURL.'/image/user.png">';
        }
        ?>

        </div>

        <div class="flex-1 min-w-0 ms-4">
            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                <?= $data['namalengkap'] ?>. <?= $data['judulfoto'] ?>
            </p>
        </div>    
    </div>
    
    <img src="gambar/<?= $data['lokasifile'] ?>" alt="<?= $data['judulfoto'] ?>">
    
    <div class="card-content">
        <p><?= $data['deskripsifoto'] ?></p>
    </div>

    <!-- Menampilkan jumlah like -->
    <div class="card-actions">
        <a href="like.php?fotoid=<?=$data['fotoid']?>" class="like-button inline-flex items-center px-3 py-2 text-smborder-red bg-trasnparent rounded-lg ">
            <?php if ($userLiked): ?>
                <!-- Liked icon -->
                <svg class="w-6 h-6 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="m12.7 20.7 6.2-7.1c2.7-3 2.6-6.5.8-8.7A5 5 0 0 0 16 3c-1.3 0-2.7.4-4 1.4A6.3 6.3 0 0 0 8 3a5 5 0 0 0-3.7 1.9c-1.8 2.2-2 5.8.8 8.7l6.2 7a1 1 0 0 0 1.4 0Z"/></svg>
            <?php else: ?>
                <!-- Not liked icon -->
                <svg class="w-6 h-6 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"/></svg>
            <?php endif; ?>
        </a>
        <a href="komentar.php?fotoid=<?=$data['fotoid']?>">
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.6 8.5h8m-8 3.5H12m7.1-7H5c-.2 0-.5 0-.6.3-.2.1-.3.3-.3.6V15c0 .3 0 .5.3.6.1.2.4.3.6.3h4l3 4 3-4h4.1c.2 0 .5 0 .6-.3.2-.1.3-.3.3-.6V6c0-.3 0-.5-.3-.6a.9.9 0 0 0-.6-.3Z"/>
            </svg>
        </a>
    </div>

    <!-- Menampilkan jumlah like -->
    <div class="card-actions">
        <p><?= $data['like_count'] ?> liked</p> 
    </div>
</div>
<?php } ?>

<?php include 'tamplate/footer.php'; ?>

