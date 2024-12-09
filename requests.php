<?php include('db_connect.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Requests</title>
	<!-- tailwind css and daisy ui -->
	<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
	<script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
	<div class="container mx-auto">
		<div class="my-4">
			<div class="mb-4 mt-4">
				<div class="w-full">
					<!-- Additional content can go here -->
				</div>
			</div>
			<div class="row">
				<!-- FORM Panel -->

				<!-- Table Panel -->
				<div class="w-full">
					<div class="card">
						<div class="card-header">
							<b>List of Requests</b>
							<span class="float-right">
								<a class="btn btn-primary btn-block btn-sm col-sm-2 float-right" href="javascript:void(0)" id="new_request">
									<i class="fa fa-plus"></i> New Entry
								</a>
							</span>
						</div>
						<div class="card-body">
							<table class="table table-condensed table-bordered table-hover">
								<thead>
									<tr>
										<th class="text-center">#</th>
										<th class="">Date</th>
										<th class="">Reference Code</th>
										<th class="">Patient Name</th>
										<th class="">Blood Group</th>
										<th class="">Information</th>
										<th class="">Status</th>
										<th class="text-center">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									$requests = $conn->query("SELECT * FROM requests order by date(date_created) desc ");
									while ($row = $requests->fetch_assoc()):

									?>
										<tr>
											<td class="text-center"><?php echo $i++ ?></td>
											<td>
												<?php echo date('M d, Y', strtotime($row['date_created'])) ?>
											</td>
											<td class="">
												<p> <b><?php echo $row['ref_code'] ?></b></p>
											</td>
											<td class="">
												<p> <b><?php echo ucwords($row['patient']) ?></b></p>
											</td>
											<td class="">
												<p> <b><?php echo $row['blood_group'] ?></b></p>
											</td>
											<td class="">
												<p>Volume Needed: <b><?php echo ($row['volume'] / 1000) . ' L' ?></b></p>
												<p>Physician Name: <b><?php echo ucwords($row['physician_name']) ?></b></p>
											</td>
											<td class=" text-center">
												<?php if ($row['status'] == 0): ?>
													<span class="badge badge-primary">Pending</span>
												<?php else: ?>
													<span class="badge badge-success">Approved</span>
												<?php endif; ?>
											</td>
											<td class="text-center">
												<button class="btn btn-sm btn-outline-primary edit_request" type="button" data-id="<?php echo $row['id'] ?>">Edit</button>
												<button class="btn btn-sm btn-outline-danger delete_request" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
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
</body>

</html>

<script>
	$(document).ready(function() {
		$('table').dataTable()
	})

	$('#new_request').click(function() {
		uni_modal("New request", "manage_request.php", "mid-large")

	})
	$('.edit_request').click(function() {
		uni_modal("Manage request Details", "manage_request.php?id=" + $(this).attr('data-id'), "mid-large")

	})
	$('.delete_request').click(function() {
		_conf("Are you sure to delete this request?", "delete_request", [$(this).attr('data-id')])
	})

	function delete_request($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_request',
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