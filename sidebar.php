<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - DonateRed</title>
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <!-- tailwind css and daisy ui -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- css  -->
    <link rel="stylesheet" href="styles/style.css">

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
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="bg-primaryRed text-white w-64 p-6">
            <h2 class="text-2xl font-bold mb-6">DonateRed Dashboard</h2>
            <ul class="space-y-4">
                <li><a href="index.php?page=home">Dashboard</a></li>
                <li><a href="index.php?page=donations">Donations</a></li>
                <li><a href="index.php?page=donors">Donors</a></li>
                <li><a href="index.php?page=requests">Requests</a></li>
                <li><a href="index.php?page=reciepients">Recipients</a></li>
                <li><a href="index.html">Logout</a></li>
            </ul>
        </div>
    </div>

    <!-- <script src="js/index.js"></script> -->
    <script>
        $('.nav_collapse').click(function() {
            console.log($(this).attr('href'))
            $($(this).attr('href')).collapse()
        })
        $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
    </script>
</body>

</html>