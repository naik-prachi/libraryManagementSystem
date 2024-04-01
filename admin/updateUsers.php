<?php
session_start();

// Include necessary files (e.g., connection and functions)
include ("../connection.php");
include ("../functions.php");

// Initialise variable to track if email exists
$user_data = check_login($con);

$query = "SELECT * FROM users WHERE college_id = $_GET[cid]";
$result = mysqli_query($con, $query);
// Retrieve existing user details from the database
$user = mysqli_fetch_assoc($result);

// Check if the user has clicked on the post button
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted, collect the data from post variable
    if (isset($_POST['update'])) {

        // Query the database to check if the email exists
        $query = "SELECT * FROM users WHERE college_id = $_GET[cid]";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {

            // Retrieve existing user details from the database
            $book = mysqli_fetch_assoc($result);

            // Handle the second POST request for updating user details
            if (isset($_POST['update'])) {
                $new_user_fname = $_POST['new_user_fname'];
                $new_user_lname = $_POST['new_user_lname'];
                $new_user_email = $_POST['new_user_email'];
                $new_user_phone = $_POST['new_user_phone'];

                // Update user details in the database
                $query = "UPDATE users SET user_fname = '$new_user_fname', user_lname = '$new_user_lname', user_email = '$new_user_email', user_phone = '$new_user_phone' WHERE college_id = $_GET[cid]";
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
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="admin_dashboard.php">Library Management System (LMS)</a>
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
                        <a class="dropdown-item" href="../changePassword.php">Change Password</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav><br>
    <span>
        <marquee>This is library mangement system. Library opens at 8:00 AM and close at 8:00 PM</marquee>
    </span><br><br>
    <center>
        <h4>Edit Book</h4><br>
    </center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">

                <!-- user type -->
                <div class="form-group">
                    <label for="mobile">User Type:</label>
                    <input type="text" name="user_type" value="<?php echo $user['user_type']; ?>" class="form-control"
                        disabled required>
                </div>

                <!-- college id -->
                <div class="form-group">
                    <label for="mobile">College ID:</label>
                    <input type="text" name="college_id" value="<?php echo $user['college_id']; ?>" class="form-control"
                        disabled required>
                </div>

                <!-- user fname -->
                <div class="form-group">
                    <label for="email">First Name:</label>
                    <input type="text" name="new_user_fname" value="<?php echo $user['user_fname']; ?>"
                        class="form-control" required>
                </div>

                <!-- user lname -->
                <div class="form-group">
                    <label for="mobile">Last Name:</label>
                    <input type="text" name="new_user_lname" value="<?php echo $user['user_lname']; ?>"
                        class="form-control" required>
                </div>

                <!-- user name -->
                <div class="form-group">
                    <label for="mobile">Email:</label>
                    <input type="text" name="new_user_email" value="<?php echo $user['user_email']; ?>"
                        class="form-control" required>
                </div>

                <!-- user phone -->
                <div class="form-group">
                    <label for="mobile">Phone No.:</label>
                    <input type="text" name="new_user_phone" value="<?php echo $user['user_phone']; ?>"
                        class="form-control" required>
                </div>

                <!--  submit button -->
                <button type="submit" name="update" class="btn btn-primary">Update User</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>

</html>