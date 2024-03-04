<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <style>
        html, body {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
             /* Background image */
             background-image: url('background.png');
            /* Background image size */
            background-size: 1540px;
            /* Background image position */
            background-position: center;
            /* Background fixed */
            background-attachment: fixed;
        }

        /* Wrapper untuk mengatur lebar body */
        .wrapper {
            width: 500px;
        }

        /* Adjust max-width to make the container larger */
        .login-container {
            max-width: 400px; /* Adjust the max-width as needed */
        }

        /* Mengatur posisi ikon mata */
        .eye-icon {
            position: absolute;
            top: 50%;
            right: 10px; /* Mengatur jarak dari sisi kanan */
            transform: translateY(-50%);
            cursor: pointer;
        }

        /* Mengatur posisi teks di tengah */
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700 login-container">
        <form class="space-y-6" action="proses_login.php" method="post">
            <h5 class="text-xl font-medium text-gray-900 dark:text-white text-center">Login Gallery</h5>
            <div class="flex flex-col">
                <label for="username" class="text-sm font-medium text-gray-900 dark:text-white">Username</label>
                <input type="text" name="username" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
            </div>
            <div class="flex flex-col relative">
                <label for="password" class="text-gray-800 dark:text-white">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-800 dark:border-gray-700 dark:text-white" placeholder="Enter your password" required>
                    <div id="togglePassword" class="eye-icon" role="button" aria-label="Toggle password visibility">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path id="eyeIcon" stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4 6-9 6s-9-4.8-9-6c0-1.2 4-6 9-6s9 4.8 9 6Z"/>
                            <path id="eyeSlashIcon" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 14c-.5-.6-.9-1.3-1-2 0-1 4-6 9-6m7.6 3.8A5 5 0 0 1 21 12c0 1-3 6-9 6h-1m-6 1L19 5m-4 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                    </div>
                </div>
            </div>
            <script>
                const passwordInput = document.getElementById('password');
                const toggleButton = document.getElementById('togglePassword');
                const eyeIcon = document.getElementById('eyeIcon');
                const eyeSlashIcon = document.getElementById('eyeSlashIcon');

                toggleButton.addEventListener('click', function() {
                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        eyeIcon.style.display = 'none';
                        eyeSlashIcon.style.display = 'block';
                    } else {
                        passwordInput.type = 'password';
                        eyeIcon.style.display = 'block';
                        eyeSlashIcon.style.display = 'none';
                    }
                });
            </script>
            <div class="flex justify-between">
                <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Login</button>
            </div>
            <div class="flex justify-center">
                <a href="register.php" class="w-full py-2 px-4 text-sm text-center font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-80 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Registered</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
