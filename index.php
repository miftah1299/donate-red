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
    <style>
        main#view-panel {
            margin-left: 250px;
            width: calc(100% - 250px);
            margin-top: 3.5rem;
            padding: .5em
        }
    </style>
</head>

<body class="font-roboto bg-background">
    <!-- navbar -->
    <?php include 'navbar.php' ?>

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <?php include 'sidebar.php' ?>

        <!-- Main Content -->
        <div class="flex-1 p-10">
            <h1 class="text-3xl font-bold mb-6">Welcome to the Dashboard</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-bold mb-4">Total Donations</h2>
                    <p class="text-3xl">150</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-bold mb-4">Total Donors</h2>
                    <p class="text-3xl">75</p>
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-xl font-bold mb-4">Total Recipients</h2>
                    <p class="text-3xl">50</p>
                </div>
            </div>
        </div>

        <!-- donations -->
        <div id="donations" class="section hidden bg-white p-6 rounded-lg shadow-lg w-1/3 mt-10">
            <h2 class="text-xl font-bold mb-4">Recent Donations</h2>
            <ul>
                <li class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="font-bold">Alex</h3>
                        <p class="text-gray-500">Donated 1 pint of blood</p>
                    </div>
                    <button class="btn bg-secondaryGold text-white">View</button>
                </li>
                <li class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="font-bold">Jane</h3>
                        <p class="text-gray-500">Donated 2 pints of blood</p>
                    </div>
                    <button class="btn bg-secondaryGold text-white">View</button>
                </li>
                <li class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="font-bold">Mark</h3>
                        <p class="text-gray-500">Donated 1.5 pints of blood</p>
                    </div>
                    <button class="btn bg-secondaryGold text-white">View</button>
                </li>
            </ul>
        </div>

        <!-- donors -->
        <div id="donors" class="section hidden bg-white p-6 rounded-lg shadow-lg w-1/3 mt-10">
            <h2 class="text-xl font-bold mb-4">Donors</h2>
            <ul>
                <li class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="font-bold">Alex</h3>
                        <p class="text-gray-500">Blood Type: O+</p>
                    </div>
                    <button class="btn bg-secondaryGold text-white">View</button>
                </li>
                <li class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="font-bold">Jane</h3>
                        <p class="text-gray-500">Blood Type: A-</p>
                    </div>
                    <button class="btn bg-secondaryGold text-white">View</button>
                </li>
                <li class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="font-bold">Mark</h3>
                        <p class="text-gray-500">Blood Type: B+</p>
                    </div>
                    <button class="btn bg-secondaryGold text-white">View</button>
                </li>
            </ul>
        </div>

        <!-- recipients -->
        <div id="recipients" class="section hidden bg-white p-6 rounded-lg shadow-lg w-1/3 mt-10">
            <h2 class="text-xl font-bold mb-4">Recipients</h2>
            <ul>
                <li class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="font-bold">Alice</h3>
                        <p class="text-gray-500">Blood Type: AB+</p>
                    </div>
                    <button class="btn bg-secondaryGold text-white">View</button>
                </li>
                <li class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="font-bold">Siri</h3>
                        <p class="text-gray-500">Blood Type: O-</p>
                    </div>
                    <button class="btn bg-secondaryGold text-white">View</button>
                </li>
                <li class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="font-bold">Charlie</h3>
                        <p class="text-gray-500">Blood Type: A+</p>
                    </div>
                    <button class="btn bg-secondaryGold text-white">View</button>
                </li>
            </ul>
        </div>
    </div>

    <main id="view-panel">
        <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home'; ?>
        <?php include $page . '.php' ?>
    </main>
</body>

</html>