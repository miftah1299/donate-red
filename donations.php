<?php include('db_connect.php'); ?>

<div class="container mx-auto p-4">
    <div class="flex justify-end mb-4">
        <button class="btn btn-primary" id="new_donation">
            <i class="fa fa-plus"></i> New Entry
        </button>
    </div>
    <div class="card w-full bg-white shadow-md">
        <div class="card-body">
            <h2 class="card-title text-2xl font-bold mb-4">List of Donations</h2>
            <div class="overflow-x-auto">
                <table class="table w-full">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Date</th>
                            <th>Donor</th>
                            <th>Blood Group</th>
                            <th>Volume (ml)</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $donations = $conn->query("SELECT d.*, concat(d.lastname, ', ', d.firstname, ' ', d.middlename) as name, b.blood_group FROM donations d inner join donors b on b.id = d.donor_id order by unix_timestamp(d.date_created) desc ");
                        while ($row = $donations->fetch_assoc()):
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i++ ?></td>
                                <td><?php echo date("M d, Y", strtotime($row['date_created'])) ?></td>
                                <td><?php echo ucwords($row['name']) ?></td>
                                <td><?php echo $row['blood_group'] ?></td>
                                <td><?php echo $row['volume'] ?></td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary edit_donation" data-id="<?php echo $row['id'] ?>">Edit</button>
                                    <button class="btn btn-sm btn-error delete_donation" data-id="<?php echo $row['id'] ?>">Delete</button>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $('#new_donation').click(function() {
        uni_modal('New Donation', 'manage_donation.php')
    })
    $('.edit_donation').click(function() {
        uni_modal('Edit Donation', 'manage_donation.php?id=' + $(this).attr('data-id'))
    })
    $('.delete_donation').click(function() {
        _conf("Are you sure to delete this donation?", "delete_donation", [$(this).attr('data-id')])
    })

    function delete_donation(id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_donation',
            method: 'POST',
            data: {
                id: id
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