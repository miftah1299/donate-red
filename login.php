<?php
session_start();
include('./db_connect.php');
ob_start();
if (!isset($_SESSION['system'])) {
    $system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
    foreach ($system as $k => $v) {
        $_SESSION['system'][$k] = $v;
    }
}
ob_end_flush();
if (isset($_SESSION['login_id'])) {
    header("location:index.php?page=home");
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?php echo $_SESSION['system']['name'] ?></title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- Tailwind CSS and DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primaryRedDark: '#800000',
                        secondaryGold: '#B79455',
                        background: '#DAD4B5',
                        accent: '#F2E8C6'
                    },
                    fontFamily: {
                        roboto: ['Roboto', 'sans-serif']
                    },
                }
            }
        }
    </script>
</head>

<body class="font-roboto bg-gray-100 min-h-screen">
    <!-- Navbar -->
    <nav class="sticky top-0 backdrop-blur-md bg-white/45 z-50">
        <div class="navbar w-10/12 mx-auto flex justify-between py-4 px-0">
            <div class="navbar-start">
                <a href="index.php" class="text-3xl text-red-500 font-bold hover:bg-transparent mr-4">DonateRed</a>
            </div>
            <div class="navbar-end">
                <a href="login.php" class="btn bg-primaryRedDark text-white hover:bg-secondaryGold px-8">Join Us</a>
            </div>
        </div>
    </nav>

    <!-- Login Form -->
    <div class="mt-20 flex items-center justify-center">
        <div class="bg-white p-10 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold text-center text-primaryRedDark mb-6">Login to DonateRed</h2>
            <form id="login-form">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Username</label>
                    <input type="text" id="username" name="username" class="input input-bordered w-full mt-2" required>
                </div>
                <div class="mb-6">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="input input-bordered w-full mt-2" required>
                </div>
                <button type="submit" class="btn bg-blue-800 hover:bg-blue-500 text-white w-full rounded-full">Login</button>
            </form>
            <p class="text-center mt-4">Don't have an account? <a href="register.php" class="text-primaryRedDark font-medium hover:underline">Register</a></p>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#login-form').submit(function(e) {
            e.preventDefault();
            $('#login-form button[type="submit"]').attr('disabled', true).html('Logging in...');
            if ($(this).find('.alert-danger').length > 0)
                $(this).find('.alert-danger').remove();
            $.ajax({
                url: 'ajax.php?action=login',
                method: 'POST',
                data: $(this).serialize(),
                error: function(err) {
                    console.log(err);
                    $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
                },
                success: function(resp) {
                    if (resp == 1) {
                        location.href = 'index.php?page=home';
                    } else {
                        $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>');
                        $('#login-form button[type="submit"]').removeAttr('disabled').html('Login');
                    }
                }
            });
        });
    </script>
</body>

</html>