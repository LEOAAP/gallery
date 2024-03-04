<?php include 'tamplate/header.php'; ?>

<style>
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
    .form-container {
        width: 100%;
        max-width: 400px; /* Ubah lebar sesuai kebutuhan */
        margin-left: auto;
        margin-right: auto;
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
                    $sql=mysqli_query($conn,"select * from foto where fotoid='$fotoid'");
                    while($data=mysqli_fetch_array($sql)){
                ?>
                <div class="col-md-6">
                    <img class="rounded-s-lg"src="gambar/<?=$data['lokasifile']?>">
                </div>
                <div class="col-md-6 d-flex flex-column">
                    <div class="card-body flex-grow-1">
                        <h5 class="card-title flex items-center justify-between"><?=$data['judulfoto']?>
                            <a href="foto.php" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex  items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close</span>
                            </a>
                        </h5>

                        <!-- Form di samping foto -->
                        <div class="form-container">
                            <form action="update_foto.php" method="post" enctype="multipart/form-data">
                                <input type="text" name="fotoid" value="<?=$data['fotoid']?>" hidden>
                                <label for="website-admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Foto</label>
                                <input class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="judulfoto" value="<?=$data['judulfoto']?>">

                                <label for="website-admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                                <input class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" type="text" name="deskripsifoto" value="<?=$data['deskripsifoto']?>">

                                <label for="website-admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto</label>
                                <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="lokasifile">

                                <label for="website-admin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Album</label>
                                <select name="albumid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <?php
                                        include "koneksi.php";
                                        $userid=$_SESSION['userid'];
                                        $sql=mysqli_query($conn,"SELECT * from album where userid='$userid'");
                                        while($data=mysqli_fetch_array($sql)){
                                    ?>
                                    <option value="<?=$data['albumid']?>"><?=$data['namaalbum']?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                
                                
                                <br>
                                <button type="submit" class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="Ubah">
                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                    Update Album
                                </button>
                            </form>
                        </div>
                        <!-- Form di samping foto -->
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include 'tamplate/footer.php'; ?>
