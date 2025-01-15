<?php include 'db_connect.php' ?>

<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <style>
        span.float-right.summary_icon {
            font-size: 2.25rem;
            position: absolute;
            right: 1rem;
            top: 0;
        }
    </style>
</head>

<body class="font-roboto bg-background">
    <div class="container mx-auto mt-3">
        <div class="grid grid-cols-1 gap-4">
            <div class="col-span-1">
                <div class="card">
                    <div class="card-body">
                        <?php echo "Welcome back " . $_SESSION['login_name'] . "!"  ?>
                        <hr class="my-4">
                        <h4 class="text-lg font-bold">Available Blood per group in Liters</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mt-4">
                            <?php
                            $blood_group = array("A+", "B+", "O+", "AB+", "A-", "B-", "O-", "AB-");
                            foreach ($blood_group as $v) {
                                $bg_inn[$v] = 0;
                                $bg_out[$v] = 0;
                            }
                            $qry = $conn->query("SELECT * FROM blood_inventory ");
                            while ($row = $qry->fetch_assoc()) {
                                if ($row['status'] == 1) {
                                    $bg_inn[$row['blood_group']] += $row['volume'];
                                } else {
                                    $bg_out[$row['blood_group']] += $row['volume'];
                                }
                            }
                            ?>
                            <?php foreach ($blood_group as $v): ?>
                                <div class="card bg-gray-100 border-t-4 border-<?php echo $v == 'A+' ? 'red' : ($v == 'B+' ? 'blue' : ($v == 'O+' ? 'green' : 'yellow')) ?>-600 shadow-md">
                                    <div class="card-body relative">
                                        <span class="float-right summary_icon"> <?php echo $v ?> <i class="fa fa-tint text-red-600"></i></span>
                                        <h4 class="text-xl font-bold">
                                            <?php echo ($bg_inn[$v] - $bg_out[$v]) / 1000 ?>
                                        </h4>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <hr class="my-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div class="card bg-gray-100 shadow-md">
                                <div class="card-body relative">
                                    <span class="float-right summary_icon"> <i class="fa fa-user-friends text-blue-600"></i></span>
                                    <h4 class="text-xl font-bold">
                                        <?php echo $conn->query("SELECT * FROM donors")->num_rows ?>
                                    </h4>
                                    <p class="text-sm font-medium">Total Donors</p>
                                </div>
                            </div>
                            <div class="card bg-gray-100 shadow-md">
                                <div class="card-body relative">
                                    <span class="float-right summary_icon"> <i class="fa fa-notes-medical text-red-600"></i></span>
                                    <h4 class="text-xl font-bold">
                                        <?php echo $conn->query("SELECT * FROM blood_inventory where status = 1 and date(date_created) = '" . date('Y-m-d') . "' ")->num_rows ?>
                                    </h4>
                                    <p class="text-sm font-medium">Total Donated Today</p>
                                </div>
                            </div>
                            <div class="card bg-gray-100 shadow-md">
                                <div class="card-body relative">
                                    <span class="float-right summary_icon"> <i class="fa fa-th-list"></i></span>
                                    <h4 class="text-xl font-bold">
                                        <?php echo $conn->query("SELECT * FROM requests where date(date_created) = '" . date('Y-m-d') . "' ")->num_rows ?>
                                    </h4>
                                    <p class="text-sm font-medium">Today's Requests</p>
                                </div>
                            </div>
                            <div class="card bg-gray-100 shadow-md">
                                <div class="card-body relative">
                                    <span class="float-right summary_icon"> <i class="fa fa-check text-blue-600"></i></span>
                                    <h4 class="text-xl font-bold">
                                        <?php echo $conn->query("SELECT * FROM requests where date(date_created) = '" . date('Y-m-d') . "' and status = 1 ")->num_rows ?>
                                    </h4>
                                    <p class="text-sm font-medium">Today's Approved Requests</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="scripts/jquery-3.6.0.min.js"></script>
    <script>
        $('#manage-records').submit(function(e) {
            e.preventDefault()
            start_load()
            $.ajax({
                url: 'ajax.php?action=save_track',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success: function(resp) {
                    resp = JSON.parse(resp)
                    if (resp.status == 1) {
                        alert_toast("Data successfully saved", 'success')
                        setTimeout(function() {
                            location.reload()
                        }, 800)
                    }
                }
            })
        })
        $('#tracking_id').on('keypress', function(e) {
            if (e.which == 13) {
                get_person()
            }
        })
        $('#check').on('click', function(e) {
            get_person()
        })

        function get_person() {
            start_load()
            $.ajax({
                url: 'ajax.php?action=get_pdetails',
                method: "POST",
                data: {
                    tracking_id: $('#tracking_id').val()
                },
                success: function(resp) {
                    if (resp) {
                        resp = JSON.parse(resp)
                        if (resp.status == 1) {
                            $('#name').html(resp.name)
                            $('#address').html(resp.address)
                            $('[name="person_id"]').val(resp.id)
                            $('#details').show()
                            end_load()
                        } else if (resp.status == 2) {
                            alert_toast("Unknown tracking id.", 'danger');
                            end_load();
                        }
                    }
                }
            })
        }
    </script>
</body>

</html>