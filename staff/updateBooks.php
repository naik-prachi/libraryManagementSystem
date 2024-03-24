<?php
	session_start();
	include("../connection.php");
    include("../functions.php");
    
	$user_data = check_login($con);

	$query = "select * from books where ISBN = $_GET[bn]";
	$query_run = mysqli_query($con,$query);
	while ($row = mysqli_fetch_assoc($query_run)){
		$ISBN = $row['ISBN'];
		$book_title = $row['book_title'];
		$book_author = $row['book_author'];
		$book_subject = $row['book_subject'];
		$total_copies = $row['total_copies'];
		$borrowed_copies = $row['borrowed_copies'];
        $available_copies = $row['available_copies'];
	}


	if(isset($_POST['update'])){

		$query = "update books set book_title = '$_POST[new_book_title]', book_author = '$_POST[new_book_author]', 
                book_subject = '$_POST[new_book_subject]', total_copies = $_POST[new_total_copies], 
                borrowed_copies = $_POST[new_borrowed_copies], available_copies = $_POST[new_available_copies]
                where ISBN = $_GET[bn]";

		$query_run = mysqli_query($con,$query);
		header("location: manageBooks.php");
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="admin_dashboard.php">Library Management System (LMS)</a>
			</div>
			<font style="color: red"><span><strong>Welcome: <?php echo $user_data['user_fname'];?></strong></span></font>
			<font style="color: red"><span><strong>Email: <?php echo $user_data['user_email'];?></strong></font>
		    <ul class="nav navbar-nav navbar-right">
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown">My Profile </a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="">View Profile</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="#">Edit Profile</a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="../changePassword.php">Change Password</a>
	        	</div>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="../logout.php">Logout</a>
		      </li>
		    </ul>
		</div>
	</nav><br>
	<span><marquee>This is library mangement system. Library opens at 8:00 AM and close at 8:00 PM</marquee></span><br><br>
		<center><h4>Edit Book</h4><br></center>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<form action="" method="post">
					<div class="form-group">
						<label for="mobile">ISBN:</label>
						<input type="text" name="ISBN" value="<?php echo $ISBN;?>" class="form-control" disabled required>
					</div>
					<div class="form-group">
						<label for="email">Book Title:</label>
						<input type="text" name="new_book_title" value="<?php echo $book_title;?>" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile">Author:</label>
						<input type="text" name="new_book_author" value="<?php echo $book_author;?>" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile">Book Subject:</label>
						<input type="text" name="new_book_subject" value="<?php echo $book_subject;?>" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile">Total Copies:</label>
						<input type="text" name="new_total_copies" value="<?php echo $total_copies;?>" class="form-control" required>
					</div>
                    <div class="form-group">
						<label for="mobile">Borrowed Copies:</label>
						<input type="text" name="new_borrowed_copies" value="<?php echo $borrowed_copies;?>" class="form-control">
					</div>
                    <div class="form-group">
						<label for="mobile">Available Copies:</label>
						<input type="text" name="new_available_copies" value="<?php echo $available_copies;?>" class="form-control" required>
					</div>
					<button type="submit" name="update" class="btn btn-primary">Update Book</button>
				</form>
			</div>
			<div class="col-md-4"></div>
		</div>
</body>
</html>
