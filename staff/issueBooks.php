<?php
	session_start();

	include ("../connection.php");
	include ("../functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Issue Book</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
    <script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>

    <style>
        /* Style for sidebar */
        .sidebar {
            height: 100%;
            width: 200px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color:  #ffffff;
            display: block;
        }

        .sidebar a:hover {
            background-color: #e9ecef;
        }

        .content {
            margin-left: 200px;
            padding: 20px;
        }
    </style>
</head>

<body>
<div class="sidebar">

<div class="side-bar-margin" style="margin: 40px">

	<div class="profile-pic">
		<img src="../images/dummypic.png" alt="dummy profile" height="150px" width="150px">

	</div>

	<br><br><br>
	<ul>
		<li><a href="issueBooks.php">Issue Books</a></li>
		<li><a href="returnBooks.php">Return Books</a></li>
		<li><a href="addBooks.php">Add Books</a></li>
		<li><a href="manageBooks.php">Manage Books</a></li>
		<li><a href="staffViewUsers.php">View Users</a></li>
		<!-- <li><a href="searchBooks.php">View Books</a></li> -->
		<!-- <li><a href="#">Notifications</a></li> -->
	</ul>
</div>


</div>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">

			<font style="color: white"><span><strong>Welcome:
						<?php echo $user_data['user_fname']; ?>
					</strong></span></font>
			<font style="color: white"><span><strong>Email:
						<?php echo $user_data['user_email']; ?>
					</strong></font>
			<ul class="nav navbar-nav navbar-right">

				<li class="nav-item">
					<a class="nav-link" href="../logout.php">Logout</a>
				</li>
			</ul>
		</div>
	</nav><br>

	<br><br>
	
	<center>
		<h4>Issue Book</h4><br>
	</center>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<form action="" method="post">

				<!-- ISBN -->
				<div class="form-group">
					<label for="ISBN">ISBN:</label>
					<select class="form-control" name="ISBN">
						<option>-Select ISBN-</option>
						<?php
						$query = "SELECT ISBN FROM books";
						$result = mysqli_query($con, $query);
						while ($user = mysqli_fetch_assoc($result)) {
							?>
							<option>
								<?php echo $user['ISBN']; ?>
							</option>
							<?php
						}
						?>
					</select>
				</div>

				<!-- college_id -->
				<div class="form-group">
					<label for="college_id">College ID:</label>
					<select class="form-control" name="college_id">
						<option>-Select College ID-</option>
						<?php
						$query = "SELECT college_id FROM users WHERE user_type = 'Student' OR user_type = 'Faculty'";
						$result = mysqli_query($con, $query);
						while ($user = mysqli_fetch_assoc($result)) {
							?>
							<option>
								<?php echo $user['college_id']; ?>
							</option>
							<?php
						}
						?>
					</select>
				</div>

				<!-- issue date -->
				<div class="form-group">
					<label for="issue_date">Issue Date:</label>
					<input type="text" name="issue_date" class="form-control" value="<?php echo date("y-m-d"); ?>"
						required>
				</div>

				<!-- due date -->
				<div class="form-group">
					<label for="due_date">Due Date:</label>
					<?php
					// Calculate due date 7 days from issue date
					$issue_date = date("y-m-d");
					$due_date = date("y-m-d", strtotime($issue_date . " +7 days"));
					?>
					<input type="text" name="due_date" class="form-control" value="<?php echo $due_date; ?>" required>
				</div>

				<button type="submit" name="issue_book" class="btn btn-primary">Issue Book</button>
			</form>

		</div>
		<div class="col-md-4"></div>
	</div>
</body>

</html>

<?php
	if (isset($_POST['issue_book'])) {
        include("../connection.php");

		// Prepare and bind parameters
		$stmt = $con->prepare("CALL IssueBook(?, ?, ?, ?, ?)");
		$stmt->bind_param("issss", $issued_id, $ISBN, $college_id, $issue_date, $due_date);

		// Set parameters and execute
		$issued_id = random_num(20);

        // Sanitize user inputs to prevent SQL injection
        $ISBN = mysqli_real_escape_string($con, $_POST['ISBN']);
        $college_id = mysqli_real_escape_string($con, $_POST['college_id']);
        $issue_date = mysqli_real_escape_string($con, $_POST['issue_date']);
        $due_date = mysqli_real_escape_string($con, $_POST['due_date']);

        // Ensure due_date is in the correct format (YYYY-MM-DD) for MySQL
        $due_date = date('Y-m-d', strtotime($due_date));
		$stmt->execute();

		
		$result = mysqli_query($con, $query);

            if ($result) {
                // Display success message and redirect
                echo '<script>alert("Book issue is successful!")</script>';
                echo '<script>window.setTimeout(function(){ window.location.href = "issueBooks.php"; }, 400);</script>';
				// Close statement
		$stmt->close();
                die;

            } else {
                echo "Error: " . mysqli_error($con);
            }
		}
		
?>