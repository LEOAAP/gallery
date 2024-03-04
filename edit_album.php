<?php include 'tamplate/header.php'; ?>
<style>
    .card-container {
        height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;

        }
</style>
<?php
    include "koneksi.php";
    $albumid=$_GET['albumid'];
    $sql=mysqli_query($conn,"SELECT * from album where albumid='$albumid'");
    $data=mysqli_fetch_array($sql);
?>

<div class=" w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
    <form class="space-y-6" action="update_album.php" method="post">
    <input type="text" name="albumid" value="<?=$data['albumid']?>" hidden>
        <h5 class="text-xl font-medium text-gray-900 dark:text-white">Edit My Album</h5>
        <div>
            <label for="namaalbum" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Album</label>
            <input type="text" name="namaalbum" id="namaalbum" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="<?=$data['namaalbum']?>"/>
        </div>
        <div>
            <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
            <input type="text" name="deskripsi" id="deskripsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="<?=$data['deskripsi']?>" />
        </div>
        <label for="foto_album" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Foto Album</label>
        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" name="foto_album">
        <br>
        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" value="Ubah">Ubah Album</button>
    </form>
</div>

<?php include 'tamplate/footer.php'; ?>

