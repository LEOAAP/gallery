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
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card img {
        width: 250px;
        height: 300px;
        object-fit: cover;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .card-content {
        padding: 20px;
    }

    .card-content h3 {
        margin: 0;
        font-size: 20px;
    }

    .card-content p {
        margin: 4px 0;
    }

    .btn-container {
        display: flex;
        justify-content:;
        margin-top: 10px;
    }

    .btn {
        padding: 8px 8px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }

    .btn-delete {
        background-color: #ff4d4f;
        color: red;
    }

    .btn-edit {
        background-color: #1890ff;
        color: white;
    }
</style>

<button data-modal-target="add-album-modal" data-modal-toggle="add-album-modal" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path>
    </svg>
    Add Album
</button>



<!-- Main modal -->
<div id="add-album-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Add Your Album
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="add-album-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close Add</span>
                </button>

            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form action="tambah_album.php" method="post" class="space-y-4" enctype="multipart/form-data">
                    <label for="namaalbum" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Album :</label>
                    <div class="flex">
                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2c.6 0 1-.4 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                        <input class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="namaalbum">
                    </div>
                    

                    <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                    <div class="flex">
                            <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.6 8.5h8m-8 3.5H12m7.1-7H5c-.2 0-.5 0-.6.3-.2.1-.3.3-.3.6V15c0 .3 0 .5.3.6.1.2.4.3.6.3h4l3 4 3-4h4.1c.2 0 .5 0 .6-.3.2-.1.3-.3.3-.6V6c0-.3 0-.5-.3-.6a.9.9 0 0 0-.6-.3Z"/>
                                </svg>
                            </span>
                        <input class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="deskripsi">
                    </div>
                    <label for="foto_album" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Album</label>
                    <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="foto_album">
                    <br>
                    <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="Tambah">
                        <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                        Add new album
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="card-container">
    <?php
        include "koneksi.php";
        $userid=$_SESSION['userid'];
        $sql=mysqli_query($conn,"SELECT album.albumid, album.namaalbum, album.deskripsi, album.tanggaldibuat, album.foto_album, foto.judulfoto
                                FROM album
                                LEFT JOIN foto ON album.albumid = foto.albumid
                                WHERE album.userid='$userid'
                                GROUP BY album.albumid
                                ORDER BY album.tanggaldibuat DESC");
        while($data=mysqli_fetch_array($sql)){
    ?>
        <div class="card">
        <?php
                // Mengatur lokasi file gambar default
                $gambarDefault = "image/user.png";

                // Cek apakah ada gambar yang tersedia
                if (!empty($data['foto_album'])) {
                    // Gunakan gambar yang tersedia
                    $lokasiGambar = "album/" . $data['foto_album'];
                } else {
                    // Gunakan gambar default jika tidak ada gambar tersedia
                    $lokasiGambar = $gambarDefault;
                }
                // Membuat tag img dengan menggunakan lokasi gambar yang sudah ditentukan
                echo '<img src="' . $lokasiGambar . '" alt="' . $data['namaalbum'] . '" alt="' . $data['judulfoto'] . '">'; 
        ?>

            <div class="card-content">
                <h3><?=$data['namaalbum']?></h3>
                <p><?=$data['deskripsi']?></p>
                <p>Tanggal dibuat: <?=$data['tanggaldibuat']?></p>
                <div class="btn-container">
                    <a href="hapus_album.php?albumid=<?=$data['albumid']?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                        </svg>
                    </a>
                    <a href="edit_album.php?albumid=<?=$data['albumid']?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-yellow-300 rounded-lg hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                    </svg>
                    </a>
                    <!-- Tombol Detail Gambar -->
                    <button data-modal-target="detail-gambar-<?=$data['albumid']?>" data-modal-toggle="detail-gambar-<?=$data['albumid']?>" class="inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-gray-300 rounded-lg hover:bg-gray-500 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 6H5m2 3H5m2 3H5m2 3H5m2 3H5m11-1a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2M7 3h11c.6 0 1 .4 1 1v16c0 .6-.4 1-1 1H7a1 1 0 0 1-1-1V4c0-.6.4-1 1-1Zm8 7a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"/>
                    </svg>
                    </button>
                </div>
            </div>
        </div> 

<!-- Modal Detail Gambar -->
<div id="detail-gambar-<?= $data['albumid'] ?>" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full bg-gray-900 bg-opacity-90">
    <!-- Konten modal -->
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Detail Gambar <?= $data['namaalbum'] ?>
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="detail-gambar-<?= $data['albumid'] ?>">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close Detail</span>
                </button>
            </div>
            <div class="p-4 md:p-5">
                <!-- Tampilkan gambar -->
                <img src="<?= $lokasiGambar ?>" alt="<?= $data['namaalbum'] ?>" class="w-full h-auto">
                <!-- Tampilkan nama gambar -->
                <p>Nama Gambar: <?= $data['judulfoto'] ?></p>
                <!-- Tampilkan jumlah like -->
            </div>
        </div>
    </div>
</div>

    <?php
        }
    ?>
</div>


<?php include 'tamplate/footer.php'; ?>