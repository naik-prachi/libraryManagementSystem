<?php

session_start();

include ("../connection.php");
require ("../functions.php");

$user_data = check_login($con);


?>

<!DOCTYPE html>
<html>

<head>
	<title>Manage Book</title>
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
			<font style="color: red"><span><strong>Welcome:
						<?php echo $user_data['user_fname']; ?>
					</strong></span></font>
			<font style="color: red"><span><strong>Email:
						<?php echo $user_data['user_email']; ?>
					</strong></font>
			<ul class="nav navbar-nav navbar-right">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown">My Profile </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="">View Profile</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Edit Profile</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="change_password.php">Change Password</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="../logout.php">Logout</a>
				</li>
			</ul>
		</div>
	</nav><br>
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd">
		<div class="container-fluid">

			<ul class="nav navbar-nav navbar-center">
				<li class="nav-item">
					<a class="nav-link" href="adminHomepage.php">Dashboard</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown">Books </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="#">Add New Book</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="manageBooks.php">Manage Books</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown">Category </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="add_cat.php">Add New Category</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="manage_cat.php">Manage Category</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown">Authors</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="add_author.php">Add New Author</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="manage_author.php">Manage Author</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="issueBooks.php">Issue Book</a>
				</li>
			</ul>
		</div>
	</nav><br>
	<span>
		<marquee>This is library mangement system. Library opens at 8:00 AM and close at 8:00 PM</marquee>
	</span><br><br>
	<center>
		<h4>Manage Books</h4><br>
	</center>
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
				$result = mysqli_query($con, $query);
				while ($book = mysqli_fetch_assoc($result)) {
					?>
					<tr>
						<td>
							<?php echo $book['user_type']; ?>
						</td>
						<td>
							<?php echo $book['college_id']; ?>
						</td>
						<td>
							<?php echo $book['user_fname']; ?>
						</td>
						<td>
							<?php echo $book['user_lname']; ?>
						</td>
						<td>
							<?php echo $book['user_email']; ?>
						</td>
						<td>
							<?php echo $book['user_phone']; ?>
						</td>

						<td><button class="btn" name=""><a
									href="updateUsers.php?cid=<?php echo $book['college_id']; ?>">Update</a></button>
							<button class="btn"><a
									href="removeUsers.php?cid=<?php echo $book['college_id']; ?>">Delete</a></button>
						</td>
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