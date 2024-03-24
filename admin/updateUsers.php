<?php
session_start();

// Include necessary files (e.g., connection and functions)
include ("../connection.php");
include ("../functions.php");

// Initialise variable to track if email exists
$email_exists = false;

// Check if the user has clicked on the post button
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted, collect the data from post variable
    if (isset ($_POST['user_email'])) {
        $user_email = $_POST['user_email'];

        // Query the database to check if the email exists
        $query = "SELECT * FROM users WHERE user_email = '$user_email'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            // Email exists, flag it true
            $email_exists = true;

            // Retrieve existing user details from the database
            $user = mysqli_fetch_assoc($result);

            // Check if user details were found
            if (!$user) {
                // User not found in the database
                // Handle the error accordingly (e.g., display an error message)
                echo "User not found.";
                exit; // Terminate script execution
            }
        }
    }

    // Handle the second POST request for updating user details
    if ($email_exists && isset ($_POST['new_user_name']) && isset ($_POST['new_user_email'])) {
        $new_college_id = $_POST['new_college_id'];
        $new_user_fname = $_POST['new_user_fname'];
        $new_user_lname = $_POST['new_user_lname'];
        $new_user_email = $_POST['new_user_email'];
        $new_user_phone = $_POST['new_user_phone'];

        // Update user details in the database
        $query = "UPDATE users SET college_id = '$new_college_id', user_fname = '$new_user_fname', user_lname = '$new_user_lname', user_email = '$new_user_email', user_phone = '$new_user_phone' WHERE user_email = '$user_email'";
        $result = mysqli_query($con, $query);

        if ($result) {
            // User details updated successfully

            // Display the alert box  
            echo '<script>alert("User update is successful!")</script>';

            // Redirect after a short delay
            echo '<script>window.setTimeout(function(){ window.location.href = "adminHomepage.php"; }, 400);</script>';
            exit; // Terminate script execution
        } else {
            // Error occurred while updating user details
            // Display an error message or handle the error accordingly
            echo "Error updating user details: " . mysqli_error($con);
        }
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
        <!-- Form for entering user email -->
        <form action="" method="post">
            <input id="text" type="email" name="user_email" placeholder="Enter User Email"><br><br>
            <input id="button" type="submit" value="Search">
        </form>
    </div>

    <?php if ($email_exists): ?>
        <!-- Display the second half of the form only if email exists -->
        <div>
            <!-- Update user details form -->
            <form action="" method="post">
                <!-- Add input fields for updating user details -->
                <!-- Populate the value attribute with existing values -->
                <input id="text" type="text" name="new_college_id" placeholder="New College ID"
                    value="<?php echo $user['college_id']; ?>"><br><br>
                <input id="text" type="text" name="new_user_fname" placeholder="New First name"
                    value="<?php echo $user['user_fname']; ?>"><br><br>
                <input id="text" type="text" name="new_user_lname" placeholder="New last Name"
                    value="<?php echo $user['user_lname']; ?>"><br><br>
                <input id="text" type="email" name="new_user_email" placeholder="New Email"
                    value="<?php echo $user['user_email']; ?>"><br><br>
                <input id="text" type="text" name="new_user_phone" placeholder="New Phone no"
                    value="<?php echo $user['user_phone']; ?>"><br><br>
                <!-- Add hidden input field to store user_email -->
                <input type="hidden" name="user_email" value="<?php echo $user_email; ?>">
                <!-- Add more input fields as needed -->
                <input id="button" type="submit" value="Update">
            </form>
        </div>
    <?php endif; ?>
</body>

</html>