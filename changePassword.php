<?php
	session_start();

	include("navbar.php");
?>
<!DOCTYPE html>
<html>
<head>
	
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	
<!-- TODO: add the sidebar -->
	
		<center><h4 style="margin:80px">Change Password</h4><br></center>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<form action="updatePassword.php" method="post">
					<div class="form-group">
						<label for="password">Enter Password:</label>
						<input type="password" class="form-control" name="password">
					</div>
					<div class="form-group">
						<label for="New Password">Enter New Password:</label>
						<input type="password" name="new_password" class="form-control">
					</div>
					<button type="submit" name="update" class="btn btn-primary">Update Password</button>
				</form>
			</div>
			<div class="col-md-4"></div>
		</div>
</body>
</html>
