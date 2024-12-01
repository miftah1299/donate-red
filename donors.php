<?php include('db_connect.php'); ?>

<div class="container mx-auto p-4">

    <div class="w-full">
        <div class="mb-4 mt-4">
            <div class="w-full">

            </div>
        </div>
        <div class="w-full">
            <!-- FORM Panel -->

            <!-- Table Panel -->
            <div class="w-full">
                <div class="bg-white shadow-md rounded-lg">
                    <div class="bg-gray-800 text-white p-4 rounded-t-lg">
                        <b>List of Donors</b>
                        <span class="float-right">
                            <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block" href="javascript:void(0)" id="new_donor">
                                <i class="fa fa-plus"></i> New Entry
                            </a>
                        </span>
                    </div>
                    <div class="p-4">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="text-center border px-4 py-2">#</th>
                                    <th class="border px-4 py-2">Donor</th>
                                    <th class="border px-4 py-2">Blood Group</th>
                                    <th class="border px-4 py-2">Information</th>
                                    <th class="border px-4 py-2">Previous Donation</th>
                                    <th class="text-center border px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $donors = $conn->query("SELECT * FROM donors order by name asc ");
                                while ($row = $donors->fetch_assoc()):
                                    $prev  = $conn->query("SELECT * FROM blood_inventory where status = 1 and donor_id = " . $row['id'] . " order by date(date_created) desc limit 1 ");
                                    $prev = $prev->num_rows > 0 ? $prev->fetch_array()['date_created'] : '';
                                ?>
                                    <tr>
                                        <td class="text-center border px-4 py-2"><?php echo $i++ ?></td>
                                        <td class="border px-4 py-2">
                                            <p class="font-bold"><?php echo ucwords($row['name']) ?></p>
                                        </td>
                                        <td class="border px-4 py-2">
                                            <p class="font-bold"><?php echo $row['blood_group'] ?></p>
                                        </td>
                                        <td class="border px-4 py-2">
                                            <p>Email: <b><?php echo $row['email']; ?></b></p>
                                            <p>Contact #: <b><?php echo $row['contact']; ?></b></p>
                                            <p>Address: <b><?php echo $row['address']; ?></b></p>
                                        </td>
                                        <td class="border px-4 py-2">
                                            <?php echo !empty($prev) ? date('M d, Y', strtotime($prev)) : 'New' ?>
                                        </td>
                                        <td class="text-center border px-4 py-2">
                                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded edit_donor" type="button" data-id="<?php echo $row['id'] ?>">Edit</button>
                                            <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded delete_donor" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>

</div>
<style>
    td {
        vertical-align: middle !important;
    }

    td p {
        margin: unset
    }

    img {
        max-width: 100px;
        max-height: 150px;
    }
</style>
<script>
    $(document).ready(function() {
        $('table').dataTable()
    })

    $('#new_donor').click(function() {
        uni_modal("New Donor", "manage_donor.php", "mid-large")

    })
    $('.edit_donor').click(function() {
        uni_modal("Manage donor Details", "manage_donor.php?id=" + $(this).attr('data-id'), "mid-large")

    })
    $('.delete_donor').click(function() {
        _conf("Are you sure to delete this donor?", "delete_donor", [$(this).attr('data-id')])
    })

    function delete_donor($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_donor',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }
</script>