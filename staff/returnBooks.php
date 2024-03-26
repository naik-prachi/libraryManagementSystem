<?php
	session_start();

	include ("../connection.php");
	include ("../functions.php");

	global $user_data;
    $user_data = check_login($con);

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // join table books and issuedbook
        $query = "UPDATE issuedbook
                    SET returned_date = CURDATE() 
                    WHERE college_id = '$_POST[college_id]'";

        $result = mysqli_query($con, $query);

        if ($result) {
            // User details updated successfully

            // Display the alert box  
            echo '<script>alert("Book returned!")</script>';

            // Redirect after a short delay
            echo '<script>window.setTimeout(function(){ window.location.href = "staffHomepage.php"; }, 400);</script>';
            exit; // Terminate script execution
        } else {
            // Error occurred while updating user details
            // Display an error message or handle the error accordingly
            echo "Error returning book: " . mysqli_error($con);
        }
    }


?>

<!DOCTYPE html>
<html>

<head>
	<title>Issue Book</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
	<script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
	<script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
	
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="staffHomepage.php">Library Management System (LMS)</a>
			</div>
			<font style="color: white"><span><strong>Welcome:
						<?php echo $user_data['user_fname']; ?>
					</strong></span></font>
			<font style="color: white"><span><strong>Email:
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
					<a class="nav-link" href="staffHomepage.php">Dashboard</a>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown">Books </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="addBooks.php">Add New Book</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="manageBook.php">Manage Books</a>
					</div>
				</li>


				<li class="nav-item">
					<a class="nav-link" href="returnBooks.php">Issue Book</a>
				</li>
			</ul>
		</div>
	</nav><br>
	<br><br>
	<center>
		<h4>Book Return</h4><br>
	</center>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<form action="" method="post">

				

				<!-- college_id -->
				<div class="form-group">
					<label for="college_id">College ID:</label>
					<select class="form-control" name="college_id">
						<option>-Select College ID-</option>
						<?php
						$query = "SELECT DISTINCT college_id FROM users WHERE user_type = 'Student' OR user_type = 'Faculty'";
						$query_run = mysqli_query($con, $query);
						while ($row = mysqli_fetch_assoc($query_run)) {
							?>
							<option>
								<?php echo $row['college_id']; ?>
							</option>
							<?php
						}
						?>
					</select>
				</div>

                <!-- ISBN -->
				<div class="form-group">
					<label for="ISBN">ISBN:</label>
					<select class="form-control" name="ISBN">
						<option>-Select ISBN-</option>
						<?php
						$query = "SELECT DISTINCT ISBN FROM issuedbook";
						$query_run = mysqli_query($con, $query);
						while ($row = mysqli_fetch_assoc($query_run)) {
							?>
							<option>
								<?php echo $row['ISBN']; ?>
							</option>
							<?php
						}
						?>
					</select>
				</div>

				<!-- issue date -->
				<!-- <div class="form-group">
					<label for="returned_date">Return Date:</label>
					<input type="text" name="returned_date" class="form-control" value="<?php echo date("y-m-d"); ?>"
						required>
				</div> -->


				<button type="submit" name="return_book" class="btn btn-primary">Retrun Book</button>
			</form>

		</div>
		<div class="col-md-4"></div>
	</div>
</body>

</html>

<?php
	if (isset($_POST['issue_book'])) {
        include("../connection.php");
        $issued_id = random_num(20);

        // Sanitize user inputs to prevent SQL injection
        $ISBN = mysqli_real_escape_string($con, $_POST['ISBN']);
        $college_id = mysqli_real_escape_string($con, $_POST['college_id']);
        $issue_date = mysqli_real_escape_string($con, $_POST['issue_date']);
        $due_date = mysqli_real_escape_string($con, $_POST['due_date']);

        // Ensure due_date is in the correct format (YYYY-MM-DD) for MySQL
        $due_date = date('Y-m-d', strtotime($due_date));

        // Construct the SQL query with sanitized values
        $query = "INSERT INTO issuedbook (issued_id, ISBN, college_id, issue_date, due_date) VALUES ('$issued_id', '$ISBN', '$college_id', '$issue_date', '$due_date')";

        $query_run = mysqli_query($con, $query);

        // Check if the query was successful
        if ($query_run) {
            header("Location: staffHomepage.php");
            exit; // exit script to prevent further execution
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
?>