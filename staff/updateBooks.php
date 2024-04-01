<?php
session_start();

// Include necessary files (e.g., connection and functions)
include ("../connection.php");
include ("../functions.php");
include ("../navbar.php");


// Initialise variable to track if email exists
$user_data = check_login($con);

$isbn = $_GET['bn'];

$query = "SELECT * FROM books WHERE ISBN = '$isbn'";
$result = mysqli_query($con, $query);
// Retrieve existing user details from the database
$book = mysqli_fetch_assoc($result);

// Check if the user has clicked on the post button
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	// Something was posted, collect the data from post variable
	if (isset($_POST['update'])) {

		// Query the database to check if the email exists
		$query = "SELECT * FROM books WHERE ISBN = '$isbn'";
		$result = mysqli_query($con, $query);

		if (mysqli_num_rows($result) > 0) {

			// Retrieve existing user details from the database
			$book = mysqli_fetch_assoc($result);

			// Handle the second POST request for updating user details
			if (isset($_POST['update'])) {
				$new_book_title = $_POST['new_book_title'];
				$new_book_author = $_POST['new_book_author'];
				$new_book_subject = $_POST['new_book_subject'];
				$new_total_copies = $_POST['new_total_copies'];
				$new_available_copies = $_POST['new_available_copies'];
				$new_borrowed_copies = $_POST['new_borrowed_copies'];

				// Update user details in the database
				$query = "UPDATE books SET book_title = '$new_book_title', book_author = '$new_book_author', book_subject = '$new_book_subject', total_copies = '$new_total_copies', available_copies = '$new_available_copies', available_copies = '$new_available_copies' WHERE ISBN = '$isbn'";
				$result = mysqli_query($con, $query);

				if ($result) {
					// User details updated successfully

					// Display the alert box  
					echo '<script>alert("Book update is successful!")</script>';

					// Redirect after a short delay
					echo '<script>window.setTimeout(function(){ window.location.href = "manageBooks.php"; }, 400);</script>';
					exit; // Terminate script execution
				} else {
					// Error occurred while updating user details
					// Display an error message or handle the error accordingly
					echo "Error updating book details: " . mysqli_error($con);
				}
			}
		}
	}


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
	<br><br>
	<center>
		<h4>Edit Book</h4><br>
	</center>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<form action="" method="post">

				<!-- ISBN -->
				<div class="form-group">
					<label for="text">ISBN:</label>
					<input type="text" name="ISBN" value="<?php echo $book['ISBN']; ?>" class="form-control"
						readonly required>
				</div>

				<!-- title -->
				<div class="form-group">
					<label for="text">Book Title:</label>
					<input type="text" name="new_book_title" value="<?php echo $book['book_title']; ?>" class="form-control" required>
				</div>

				<!-- author -->
				<div class="form-group">
					<label for="text">Book Author:</label>
					<input type="text" name="new_book_author" value="<?php echo $book['book_author']; ?>"
						class="form-control" required>
				</div>

				<!-- subject -->
				<div class="form-group">
					<label for="mobile">Book Subject:</label>
					<input type="text" name="new_book_subject" value="<?php echo $book['book_subject']; ?>"
						class="form-control" required>
				</div>

				<!-- total copies -->
				<div class="form-group">
					<label for="mobile">Total Copies:</label>
					<input type="text" name="new_total_copies" value="<?php echo $book['total_copies']; ?>"
						class="form-control" required>
				</div>

				<!-- available copies -->
				<div class="form-group">
					<label for="mobile">Available Copies:</label>
					<input type="text" name="new_available_copies" value="<?php echo $book['available_copies']; ?>"
						class="form-control" required>
				</div>

				<!-- burrowed copies -->
				<div class="form-group">
					<label for="mobile">Borrowed Copies:</label>
					<input type="text" name="new_borrowed_copies" value="<?php echo $book['borrowed_copies']; ?>"
						class="form-control" required>
				</div>

				<!--  submit button -->
				<button type="submit" name="update" class="btn btn-primary">Update Book</button>
			</form>
		</div>
		<div class="col-md-4"></div>
	</div>
</body>

</html>