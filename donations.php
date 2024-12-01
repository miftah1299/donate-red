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
                        <b>List of Donations</b>
                        <span class="float-right">
                            <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block" href="javascript:void(0)" id="new_donation">
                                <i class="fa fa-plus"></i> New Entry
                            </a>
                        </span>
                    </div>
                    <div class="p-4">
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="text-center border px-4 py-2">#</th>
                                    <th class="border px-4 py-2">Date</th>
                                    <th class="border px-4 py-2">Donor</th>
                                    <th class="border px-4 py-2">Blood Group</th>
                                    <th class="border px-4 py-2">Volume (ml)</th>
                                    <th class="text-center border px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                $donor = $conn->query("SELECT * FROM donors");
                                while ($row = $donor->fetch_assoc()) {
                                    $dname[$row['id']] = ucwords($row['name']);
                                }
                                $donations = $conn->query("SELECT * FROM blood_inventory where status = 1 order by date(date_created) desc ");
                                while ($row = $donations->fetch_assoc()):

                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++ ?></td>
                                        <td>
                                            <?php echo date('M d, Y', strtotime($row['date_created'])) ?>
                                        </td>
                                        <td class="text-center">
                                            <p> <b><?php echo isset($dname[$row['donor_id']]) ? $dname[$row['donor_id']] : 'Donor was removed from the list.' ?></b></p>
                                        </td>
                                        <td class="text-center">
                                            <p> <b><?php echo $row['blood_group'] ?></b></p>
                                        </td>
                                        <td class="text-center">
                                            <p><b><?php echo $row['volume']; ?></b></p>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn-outline-primary edit_donation" type="button" data-id="<?php echo $row['id'] ?>">Edit</button>
                                            <button class="btn btn-sm btn-outline-danger delete_donation" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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

<!-- <script>
    $(document).ready(function() {
        $('table').dataTable()
    })

    $('#new_donation').click(function() {
        uni_modal("New donation", "manage_donation.php", "mid-large")

    })
    $('.edit_donation').click(function() {
        uni_modal("Manage donation Details", "manage_donation.php?id=" + $(this).attr('data-id'), "mid-large")

    })
    $('.delete_donation').click(function() {
        _conf("Are you sure to delete this donation?", "delete_donation", [$(this).attr('data-id')])
    })

    function delete_donation($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_donation',
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
</script> -->