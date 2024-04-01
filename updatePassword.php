<?php
session_start();

// Include necessary files (e.g., connection and functions)
include ("connection.php");
include ("functions.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
	// Redirect the user to the login page if not logged in
	header("Location: login.php");
	exit; // Terminate script execution
}

// initialise variable to track if email exists
// $email_exists = false;

// Retrieve existing user details from the database
$user_id = $_SESSION['user_id']; // Assuming user ID is stored in the session
$query = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($con, $query);
$book = mysqli_fetch_assoc($result);

// Check if user details were found
if (!$book) {
	// User not found in the database
	// Handle the error accordingly (e.g., display an error message)
	echo "User not found.";
	exit; // Terminate script execution
}



// Handle the second POST request for updating user details
if (isset($_POST['new_password'])) {
	$new_password = $_POST['new_password'];

	// Update user details in the database
	$query = "UPDATE users SET password = '$new_password' WHERE user_id = '$user_id'";
	$result = mysqli_query($con, $query);

	if ($result) {
		// User details updated successfully

		// Display the alert box  
		echo '<script>alert("Password is successful!")</script>';

		// Redirect after a short delay
		echo '<script>window.setTimeout(function(){ window.location.href = "changePassword.php"; }, 400);</script>';
		exit; // Terminate script execution
	} else {
		// Error occurred while updating user details
		// Display an error message or handle the error accordingly
		echo "Error updating user details: " . mysqli_error($con);
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Update</title>
</head>

<body>

	<div>
		<!-- Update user details form -->
		<form action="" method="post">

			<input id="text" type="text" name="new_password" placeholder="New password"
				value="<?php echo $book['password']; ?>"><br><br>
			<!-- Add hidden input field to store user_email -->
			<input type="hidden" name="user_email" value="<?php echo $user_email; ?>">
			<!-- Add more input fields as needed -->
			<input id="button" type="submit" value="Update">
		</form>
	</div>
</body>

</html>






<!-- <php -->
<!-- session_start();

	include("connection.php");
	include("functions.php");
	
	$query = "select * from users where user_email = '$_SESSION[user_email]'";
	$query_run = mysqli_query($con, $query);
	while ($row = mysqli_fetch_assoc($query_run)){
		$password = $row['password'];
	}
	if($password == $_POST['new_password']){
		$query = "update users set password = '$_POST[new_password]' where user_email = '$_SESSION[user_email]'";
		$query_run = mysqli_query($con, $query);
		?>
		<script type="text/javascript">
			alert("Updated successfully...");
			window.location.href = "profilePage.php";
		</script> -->
<!-- <php -->
<!-- } -->
<!-- else{ -->
<!-- ?> -->
<!-- <script type="text/javascript">
			alert("Wrong User Password...");
			window.location.href = "changePassword.php";
		</script> -->
<!-- <php -->
<!-- } -->
<!-- ?> -->