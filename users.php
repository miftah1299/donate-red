<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Users</title>
	<!-- Tailwind CSS and DaisyUI -->
	<link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.10/dist/full.min.css" rel="stylesheet" type="text/css" />
	<script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
	<div class="container mx-auto p-4">
		<div class="flex justify-end mb-4">
			<button class="btn btn-primary btn-sm" id="new_user">+ New user</button>
		</div>
		<div class="card w-full bg-white/45 shadow-md">
			<div class="card-body">
				<table class="table w-full">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Name</th>
							<th class="text-center">Username</th>
							<th class="text-center">Type</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						include 'db_connect.php';
						$type = array("", "Admin", "Staff", "Alumnus/Alumna");
						$users = $conn->query("SELECT * FROM users order by name asc");
						$i = 1;
						while ($row = $users->fetch_assoc()):
						?>
							<tr>
								<td class="text-center"><?php echo $i++ ?></td>
								<td class="text-center"><?php echo ucwords($row['name']) ?></td>
								<td class="text-center"><?php echo $row['username'] ?></td>
								<td class="text-center"><?php echo $type[$row['type']] ?></td>
								<td class="text-center">
									<a class="btn btn-sm btn-primary edit_user" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Edit</a>
									<a class="btn btn-sm btn-error delete_user" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Delete</a>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<script>
		$('table').dataTable();
		$('#new_user').click(function() {
			uni_modal('New User', 'manage_user.php')
		})
		$('.edit_user').click(function() {
			uni_modal('Edit User', 'manage_user.php?id=' + $(this).attr('data-id'))
		})
		$('.delete_user').click(function() {
			_conf("Are you sure to delete this user?", "delete_user", [$(this).attr('data-id')])
		})

		function delete_user($id) {
			start_load()
			$.ajax({
				url: 'ajax.php?action=delete_user',
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
</body>

</html>