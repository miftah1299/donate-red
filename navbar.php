<?php
session_start();
if (!isset($_SESSION['system'])) {
    // Assuming you have a database connection file included here
    include('db_connect.php');
    $system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
    foreach ($system as $k => $v) {
        $_SESSION['system'][$k] = $v;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Tailwind CSS and DaisyUI -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primaryRed: '#800000',
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

<body class="font-roboto bg-background">
    <nav class="navbar sticky top-0 backdrop-blur-md z-50 bg-primaryRed p-0 min-h-12">
        <div class="container mx-auto mt-2 mb-2 flex justify-between items-center">
            <div class="flex items-center">
                <div class="logo"></div>
            </div>
            <div class="text-white">
                <span class="text-lg font-bold">
                    <?php echo isset($_SESSION['system']['name']) ? $_SESSION['system']['name'] : '' ?>
                </span>
            </div>
            <div class="flex items-center">
                <div class="dropdown dropdown-end mr-4">
                    <label tabindex="0" class="text-white cursor-pointer"><?php echo isset($_SESSION['login_name']) ? $_SESSION['login_name'] : 'Guest' ?> <i class="fa fa-caret-down"></i></label>
                    <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                        <li><a href="javascript:void(0)" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a></li>
                        <li><a href="ajax.php?action=logout"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <script>
        $('#manage_my_account').click(function() {
            uni_modal("Manage Account", "manage_user.php?id=<?php echo $_SESSION['login_id'] ?>&mtype=own")
        })
    </script>
</body>

</html>