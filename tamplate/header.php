<?php
    session_start();
    if(!isset($_SESSION['userid'])){
        header("location:login.php");
    }
    $conn=mysqli_connect("localhost","root","","gallery");
    $query = "SELECT profile_picture FROM user WHERE userid = " . $_SESSION['userid'];
    $result = mysqli_query($conn, $query);

    $currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';
    $data = array(
        'namalengkap' => htmlspecialchars($_SESSION['namalengkap']),
        'email' => htmlspecialchars($_SESSION['email']),
        'profile_picture' => ''
);

$userid = $_SESSION['userid'];

    // Query database untuk mendapatkan informasi lengkap pengguna berdasarkan ID
    $query = mysqli_query($conn, "SELECT * FROM user WHERE userid = '$userid'");
    
    // Periksa apakah query berhasil dieksekusi dan data pengguna ditemukan
    if ($query && mysqli_num_rows($query) > 0) {
        // Jika ya, ambil data pengguna
        $user = mysqli_fetch_assoc($query);
    } else {
        // Jika tidak, tampilkan pesan kesalahan
        echo "Failed to fetch user data.";
        exit; // Keluar dari skrip karena tidak ada data pengguna yang ditemukan
    }



    function getPageInfo($page) {
        switch($page) {
            case 'home':
                return array('Halaman Home', 'Home');
            case 'album':
                return array('Halaman Album', 'Album');
            case 'foto':
                return array('Halaman Profile', 'Profile');
            case 'edit_album':
                return array('Halaman Edit Album', 'Edit Album');
            // Tambahkan halaman lain jika diperlukan
            default:
                return array('Halaman Tidak Dikenal', 'Tidak Dikenal');
        }
    }

    list($pageTitle, $pageHeading) = getPageInfo($currentPage);

// komentar
    $sql_komentar = "SELECT * FROM komentarfoto WHERE fotoid = ?";
    $stmt_komentar = $conn->prepare($sql_komentar);

    if ($stmt_komentar) {
        $stmt_komentar->bind_param("i", $foto_id);
        $stmt_komentar->execute();
        $result_komentar = $stmt_komentar->get_result();

    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    
    <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
    <style>
    .logo{
        im
    }
        /* Style for User List */
.user-list {
    display: flex;
    flex-wrap: wrap;
}

.user {
    margin: 10px;
    text-align: center;
}

.user img {
    width: 150px;
    height: 150px;
    border-radius: 50%;
}

/* Style for Modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
}

.modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}


    </style>
</head>
<body>

<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start rtl:justify-end">
        <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
            <span class="sr-only">Open sidebar</span>
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
               <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
            </svg>
         </button>
         
        <a href="index.php" class="logo flex ms-2 md:me-24">
            <img width="46" height="46" src="https://img.icons8.com/arcade/64/gallery.png" alt="gallery"/>
            <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">Gallery</span>
        </a>
      </div>
      <img src="logo.png" alt="">
      <div class="flex items-center">
    
      <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
    <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover" type="button" class="flex text-sm bg-gray-800 rounded-full md:me-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
        
        <?php
                $select = mysqli_query($conn, "SELECT profile_picture FROM `user` WHERE userid = '$userid'") or die('query failed');
                if(mysqli_num_rows($select) > 0){
                    $fetch = mysqli_fetch_assoc($select);
                }
                if($fetch['profile_picture'] == ''){
                    echo '<img src="image/user.png" class=" w-10 h-10 rounded-full shadow-lg ">';
                }else{
                    echo '<img src="user/'.$fetch['profile_picture'].'" class="flex justify-center items-center w-10 h-10 rounded-full shadow-lg object-cover">';
                }
            ?>
      </button>


        <!-- Dropdown menu -->
    <div id="dropdownHover" class="w-auto hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
        <button id="dropdownInformationButton" data-dropdown-toggle="dropdownInformation" class="text-black bg-transparent focus:ring-2 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-300 dark:hover:bg-gray-300 dark:focus:ring-gray-300" type="button">
            <div class="flex flex-col items-center pb-10 w-full">
            <?php
                $select = mysqli_query($conn, "SELECT profile_picture FROM `user` WHERE userid = '$userid'") or die('query failed');
                if(mysqli_num_rows($select) > 0){
                    $fetch = mysqli_fetch_assoc($select);
                }
                if($fetch['profile_picture'] == ''){
                    echo '<img src="image/user.png" class="w-24 h-24 mb-3 rounded-full shadow-lg">';
                }else{
                    echo '<img src="user/'.$fetch['profile_picture'].'" class="flex justify-center items-center w-24 h-24 mb-3 rounded-full shadow-lg object-cover">';
                }
            ?>
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white"><?php echo $user['namalengkap']; ?></h5>
                    <span class="text-sm text-gray-500 dark:text-gray-400"><?php echo $user['email']; ?></span>
                    <div class="flex mt-4 md:mt-6 space-x-3">
                        <a href="foto.php" class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">My Profil</a>
                        <a href="logout.php" class="py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Logout</a>
                    </div>
                </div>
            </div>
        </button>
  </div>
</nav>
  <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
        <ul>
            <li>
                <a href="index.php?page=home">
                <a href="index.php?page=home" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="w-6 h-6 text-gray-600 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19c0 .6.4 1 1 1h3v-3c0-.6.4-1 1-1h2c.6 0 1 .4 1 1v3h3c.6 0 1-.4 1-1v-8.5"/>
            </svg>
            <span class="ms-3">Home</span>
            </a>
            </li>
            <li>   
                <a href="album.php?page=album" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2c.6 0 1-.4 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z" clip-rule="evenodd"/>
                    </svg>
                    <span class="ms-3">Album</span>
                </a>
            </li>
            <li>
                <a href="foto.php?page=foto" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                    <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
                </svg>
                    <span class="ms-3">Profile</span>
                </a>
            </li>
            <li>
                <a href="logout.php" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">  
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2"/>
                </svg>
                    <span class="ms-3">Logout</span>
                </a>
            </li>
        </ul>
    </div>
    </aside>

    <div class="p-4 sm:ml-64">
<div class="p-4 rounded-lg dark:border-gray-700 mt-14">

