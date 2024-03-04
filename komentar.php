<?php include 'tamplate/header.php'; ?>   

<style>
    body {
            background-color: #f5f5f5;
            padding-bottom: 60px;
        }
    .mb-10 img {
        height: 26px;
        width: 26px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 5px;  
    }

    .foto-details {
            max-width: 1100px;
            margin: 20px auto;
            border-radius: 25px;
        }

        .card {
            border-radius: 25px;
            position: relative;
        }

        .card {
            border: none;
            border-radius: 25px;
            height: 100%;
        }

        .card-footer {
            position: sticky;
            bottom: 0;
            background-color: white;
            padding: 5px;
            width: 100%;
            z-index: 1;
        }

        .flex-grow-1 {
            flex: 1;
        }

        /* Menambahkan gaya untuk dropdown */
        .dropdown {
            position: fixed;
            bottom: 100%;
            left: 0;
            z-index: 1000; /* Atur z-index agar dropdown selalu berada di atas elemen lain */
            width: auto; /* Atur lebar dropdown sesuai kebutuhan */
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-height: 300px; /* Atur maksimum tinggi dropdown agar dapat di-scroll jika terlalu panjang */
            overflow-y: auto; /* Aktifkan overflow-y agar dropdown bisa di-scroll */
        }
        .side-button {
        position: fixed;
        top: 20%;
        right: 20px; /* Sesuaikan jarak dari tepi kanan */
        transform: translateY(-50%);
        }

</style>

<div class="container foto-details">
        <div class="position-absolute top-2 start-0 ms-3">
            <a href="javascript:history.back()" class="btn btn-light"><i class="fas fa-arrow-left"></i> </a>
        </div>
        <div class="container">
            <div class="card mt-3" style="box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">
                <div class="row g-0">
                <?php
                        include "koneksi.php";
                        $fotoid=$_GET['fotoid'];
                        $sql=mysqli_query($conn,"SELECT * from foto where fotoid='$fotoid'");
                        while($data=mysqli_fetch_array($sql)){
                    ?>
                    
                    <input type="text" name="fotoid" value="<?=$data['fotoid']?>" hidden>
                        <table hidden>
                            <tr>
                                <td>Judul</td>
                                <td><input type="text" name="judulfoto" value="<?=$data['judulfoto']?>" hidden></td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td><input type="text" name="deskripsifoto" value="<?=$data['deskripsifoto']?>" hidden></td>
                            </tr>
                            <tr>
                                <td>Foto</td>
                                <td><img src="gambar/<?=$data['lokasifile']?>" width="200px" hidden></td>
                            </tr>
                            <tr>
                                <td>Komentar</td>
                                <td><input type="text" name="isikomentar"></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input type="submit" value="Tambah"></td>
                            </tr>
                        </table>
                    <div class="col-md-6">
                        <img class="rounded-s-lg"src="gambar/<?=$data['lokasifile']?>">
                    </div>
                    <div class="col-md-6 d-flex flex-column">
                        <div class="card-body flex-grow-1 ">
                            <h5 class="card-title flex items-center justify-between">
                                <?=$data['judulfoto']?>
                            
                            <a href="index.php" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex  items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close</span>
                            </a>
                            </h5>
                            <p class="card-text">
                                <?=$data['deskripsifoto']?><br>
                                <strong>Dibuat pada:</strong>
                                <?=$data ['tanggalunggah'] ?>
                            </p>
                            
                            <p class="card-text"><strong>Uploader:</strong></p>
                            
                            <div class="flex items-center">
                                
        <div class="profile">
        <?php
        // Mendapatkan URL root
        $rootURL = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

        // Mendapatkan data pengguna yang mengunggah foto
        $selectUser = mysqli_query($conn, "SELECT user.profile_picture, user.namalengkap FROM `user` INNER JOIN `foto` ON user.userid = foto.userid WHERE foto.fotoid = '{$data['fotoid']}'") or die('query failed');
        if(mysqli_num_rows($selectUser) > 0){
            $userData = mysqli_fetch_assoc($selectUser);
            // Cek apakah ada foto profil yang tersedia
            if(!empty($userData['profile_picture'])){
                // Gunakan foto profil pengguna yang mengunggah foto jika tersedia
                echo '<img class="w-10 h-10 rounded-full" src="'.$rootURL.'/user/'.$userData['profile_picture'].'">';
            }else{
                // Gunakan gambar default "user.png" jika tidak ada foto profil
                echo '<img class="w-10 h-10 rounded-full" src="'.$rootURL.'/image/user.png">';
            }
        }else{
            // Jika data pengguna tidak ditemukan, gunakan gambar default "user.png"
            echo '<img class="w-10 h-10 rounded-full" src="'.$rootURL.'/image/user.png">';
        }
        ?>

        </div>

        <div class="flex-1 min-w-0 ms-4">
            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                <?= $userData['namalengkap'] ?>. <?= $data['judulfoto'] ?>
            </p>
        </div>    
    </div>
                            <br>
                            <button id="dropdownUsersButton" data-dropdown-toggle="dropdownUsers" data-dropdown-placement="bottom" class=" w-full text-black bg-white-700 focus:ring-2 focus:outline-none hover:bg-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center" type="button">
                                Komentar 
                                <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            </button>


                                <div id="dropdownUsers" class=" w-full bg-transparent rounded-lg ">
                                <ul class="h-80 py-2 overflow-y-auto text-gray-700 dark:text-gray-200" aria-labelledby="dropdownUsersButton">
                                    <li>
                                            <?php
                                                include "koneksi.php";
                                                $userid=$_SESSION['userid'];
                                                $sql=mysqli_query($conn,"SELECT * from komentarfoto,user where komentarfoto.userid=user.userid AND komentarfoto.fotoid=$fotoid");
                                                while($data=mysqli_fetch_array($sql)){
                                            ?>
                                            <div class="komentar-container flex items-start gap-2.5">
                                                <div><span>  
                                                    <?php
                                                        $rootURL = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
                                                        $selectUser = mysqli_query($conn, "SELECT user.profile_picture FROM `user` INNER JOIN `komentarfoto` ON user.userid = komentarfoto.userid WHERE komentarfoto.komentarid = '{$data['komentarid']}'") or die('query failed');
                                                        if(mysqli_num_rows($selectUser) > 0){
                                                            $userData = mysqli_fetch_assoc($selectUser);
                                                            if(!empty($userData['profile_picture'])){
                                                                echo '<img class="w-8 h-8 rounded-full" src="'.$rootURL.'/user/'.$userData['profile_picture'].'">';
                                                            }else{
                                                                echo '<img class="w-8 h-8 rounded-full" src="'.$rootURL.'/image/user.png">';
                                                            }
                                                        }else{
                                                            echo '<img class="w-8 h-8 rounded-full" src="'.$rootURL.'/image/user.png">';
                                                        }
                                                    ?>

                                                </span></div>
                                                    <div class="teks-komentar flex flex-col gap-1 w-full">
                                                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                                                            <span class="text-sm font-semibold text-gray-900 dark:text-white"><?=$data['namalengkap']; ?></span>
                                                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400"><?=$data['tanggalkomentar']; ?></span>
                                                        </div>
                                                        <div class="w-full flex flex-col leading-1 p-3 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                                                            <p class="text-sm font-normal text-gray-900 dark:text-white"><?=$data['isikomentar']; ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </li>
                                    </ul>
                                </div>
                                <script>
                                    var dropdownButton = document.getElementById('dropdownUsersButton');
                                    var dropdownMenu = document.getElementById('dropdownUsers');
                                    dropdownButton.addEventListener('click', function() {
                                        dropdownMenu.classList.toggle('hidden');
                                    });
                                    var dropdownButton = document.getElementById('dropdownUsersButton');
                                    var dropdownMenu = document.getElementById('dropdownUsers');
                                    
                                    // Menyesuaikan lebar dropdown dengan lebar tombol dropdown
                                    dropdownMenu.style.width = dropdownButton.offsetWidth + 'px';
                                    
                                    dropdownButton.addEventListener('click', function() {
                                        dropdownMenu.classList.toggle('hidden');
                                    });
                                </script>
                                </div>
                                
                                            
                                            <div class="card-footer w-full">
                                            <form id="commentForm" action="tambah_komentar.php" method="post">
                                                <input type="hidden" name="fotoid" value="<?php echo $fotoid; ?>">
                                                <div class="flex items-center px-3 py-2 rounded-lg bg-gray-50 dark:bg-gray-700">
                                                    <textarea class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-800 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  id="isikomentar" name="isikomentar" rows="1"
                                                        placeholder="Tambahkan komentar Anda..." required></textarea>
                                                    <button class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 dark:text-blue-500 dark:hover:bg-gray-600" type="submit">
                                                    <svg class="w-5 h-5 rotate-90 rtl:-rotate-90" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                                                        <path d="m17.914 18.594-8-18a1 1 0 0 0-1.828 0l-8 18a1 1 0 0 0 1.157 1.376L8 18.281V9a1 1 0 0 1 2 0v9.281l6.758 1.689a1 1 0 0 0 1.156-1.376Z"/>
                                                    </svg>
                                                    <span class="sr-only">Send message</span>
                                                    </button>
                                                </div>
                                            </form>
                                            </div>
        </div>
        <?php } ?>
    </div>
</div>


<?php include 'tamplate/footer.php'; ?>
