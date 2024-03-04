<?php
include 'koneksi.php';

if(isset($_POST['submit'])){

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $namalengkap = mysqli_real_escape_string($conn, $_POST['namalengkap']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; 
    $image = $_FILES['profile_picture']['name'];
    $image_size = $_FILES['profile_picture']['size'];
    $image_tmp_name = $_FILES['profile_picture']['tmp_name'];
    $folder_path = "user/"; 
    $image_folder = $image;

    $select = mysqli_query($conn, "SELECT * FROM `user` WHERE username = '$username'") or die('Query failed');

    if(mysqli_num_rows($select) < 0){
        $message[] = 'Username already exists'; 
    }else{
        if($image_size > 2000000){
            $message[] = 'Image size is too large!';
        }else{
            $insert = mysqli_query($conn, "INSERT INTO `user`(username, password, email, namalengkap, profile_picture) VALUES('$username', '$password', '$email', '$namalengkap', '$image_folder')") or die('Query failed');

            if($insert){
                move_uploaded_file($image_tmp_name, $folder_path . $image_folder);
                $message[] = 'Registered successfully!';
                header('Location: login.php');
                exit;
            }else{
                $message[] = 'Registration failed!';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />

</head>
<body class="h-screen flex justify-center items-center bg-gray-100 dark:bg-gray-900">
    <div class="max-w-sm w-full p-8 bg-white border border-gray-200 rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700">
        <h1 class="text-2xl font-semibold mb-6 text-gray-900 dark:text-white">Registered</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="space-y-4">
                <?php
                if(isset($message)){
                    foreach($message as $msg){
                        echo '<div class="message">'.$msg.'</div>';
                    }
                }
                ?>
                <div>
                    <label for="namalengkap" class="block text-sm font-medium text-gray-900 dark:text-white">Nama Lengkap</label>
                    <input type="text" name="namalengkap" class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none p-2.5 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" required>
                </div>
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-900 dark:text-white">Username</label>
                    <input type="text" name="username" placeholder="Enter username" class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none p-2.5 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" required>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" name="email" placeholder="Enter email" class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none p-2.5 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" required>
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" name="password" placeholder="Enter password" class="w-full text-sm text-gray-900 border border-gray-300 rounded-lg focus:outline-none p-2.5 dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" required>
                </div>
                <div>
                    <input type="file" name="profile_picture" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" accept="user/jpg, user/jpeg, user/png">
                </div>
                <div>
                    <input type="submit" name="submit" value="Register now" class="w-full py-2 px-4 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm text-white dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                </div>  
                <div class="flex justify-center">
                    <a href="login.php" class="w-full py-2 px-4 text-sm text-center font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Login now</a>
                </div>            
            </div>
        </form>
    </div>

</body>
</html>
