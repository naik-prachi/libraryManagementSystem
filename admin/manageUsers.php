<?php
	
	session_start();

    include("../connection.php");
    require("../functions.php");

	$user_data = check_login($con);


?>

<!DOCTYPE html>
<html>
<head>
	<title>Manage Users</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="adminHomepage.php">Library Management System (LMS)</a>
			</div>
			<font style="color: white"><span><strong>Welcome: <?php echo $user_data['user_fname'];?></strong></span></font>
			<font style="color: white"><span><strong>Email: <?php echo $user_data['user_email'];?></strong></font>
		    <ul class="nav navbar-nav navbar-right">

		      <li class="nav-item">
		        <a class="nav-link" href="../logout.php">Logout</a>
		      </li>
			  <li><a class="nav-link" href="adminHomepage.php">Home</a></li>
		    </ul>
		</div>
	</nav><br>

	<span><marquee>This is library mangement system. Library opens at 8:00 AM and close at 8:00 PM</marquee></span><br><br>
		<center><h4>Manage Books</h4><br></center>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-*">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
                            <th>User Type.</th>
							<th>College ID</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email</th>
                            <th>Phone</th>
						</tr>
					</thead>
					<?php
						$query = "select * from users";
						$result = mysqli_query($con,$query);
						while ($user = mysqli_fetch_assoc($result)){
							?>
							<tr>
                                <td><?php echo $user['user_type'];?></td>
								<td><?php echo $user['college_id'];?></td>
								<td><?php echo $user['user_fname'];?></td>
								<td><?php echo $user['user_lname'];?></td>
								<td><?php echo $user['user_email'];?></td>
								<td><?php echo $user['user_phone'];?></td>
                                
								<td><button class="btn" name=""><a href="updateUsers.php?cid=<?php echo $user['college_id'];?>">Update</a></button>
								<button class="btn"><a href="removeUsers.php?cid=<?php echo $user['college_id'];?>">Delete</a></button></td>
							</tr>
							<?php
						}
					?>
				</table>
			</div>
			<div class="col-md-2"></div>
		</div>
</body>
</html>
