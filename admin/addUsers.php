<?php
session_start();

include ("../connection.php");  //connecting to the database
include ("../functions.php");   //calling the functions


// Function to send email
// function sendEmail($to, $subject, $message) {
//     $admin_email = "library@college.in";
//     $headers = "From: $admin_email\r\n";
//     $headers .= "Reply-To: $admin_email\r\n";
//     $headers .= "MIME-Version: 1.0\r\n";
//     $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

//     return mail($to, $subject, $message, $headers);
// }

// check if the user has clicked on the post button
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // something was posted
    // collect the data from post variable
    $user_type = $_POST['user_type'];
    $college_id = $_POST['college_id'];
    $user_fname = $_POST['user_fname'];
    $user_lname = $_POST['user_lname'];
    $user_email = $_POST['user_email'];
    $user_phone = $_POST['user_phone'];
    $password = $_POST['password'];
    $conPwd = $_POST['conPwd'];

    // check if all fields are not empty
    if (!empty ($user_fname) && !empty ($college_id) && !empty ($user_lname) && !empty ($user_type) && !empty ($user_email) && !empty ($password) && !empty ($conPwd)) {
        // check if passwords match
        if ($password != $conPwd) {
            echo "Passwords do not match";
        } else {
            // save to database
            $user_id = random_num(20);
            $query = "INSERT INTO users (user_id, user_type, college_id, user_fname, user_lname, user_email, user_phone, password) VALUES ('$user_id', '$user_type', '$college_id', '$user_fname', '$user_lname', '$user_email', '$user_phone', '$password')";
            $result = mysqli_query($con, $query);

            if ($result) {
                // Display success message and redirect
                echo '<script>alert("Registration is successful!")</script>';
                echo '<script>window.setTimeout(function(){ window.location.href = "adminHomepage.php"; }, 400);</script>';
                die;

            } else {
                echo "Error: " . mysqli_error($con);
            }
        }
    } else {
        echo "Please enter valid information";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Sign Up</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="adminHomepage.php">Library Management System (LMS)</a>
			</div>

		    <ul class="nav navbar-nav navbar-right">

		      <li class="nav-item">
		        <a class="nav-link" href="../logout.php">Logout</a>
		      </li>
			  <li><a class="nav-link" href="adminHomepage.php">Home</a></li>
		    </ul>
		</div>
	</nav><br>

    <style type="text/css">
        #text {
            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
            width: 100%;
        }

        #button {
            padding: 10px;
            width: 100px;
            color: white;
            background-color: cadetblue;
            border: none;
        }

        #box {
            background-color: gray;
            margin: auto;
            width: 300px;
            padding: 20px;
            margin-top: 50px; 
        }
    </style>

    <div id="box">
        <form action="" method="post">
            <div style="font-size: 20px; margin: 10px;color:white">
                Register Users
            </div>

            <!-- usertype dropdown menu-->
            <select id="text" name="user_type">
                <option value="Student">Student</option>
                <option value="Faculty">Faculty</option>
                <option value="Staff">Staff</option>
                <option value="Admin">Admin</option>
            </select><br><br>
            <!-- college id -->
            <input id="text" type="text" name="college_id" placeholder="College ID"><br><br>
            <!--  username -->
            <input id="text" type="text" name="user_fname" placeholder="First Name"><br><br>
            <input id="text" type="text" name="user_lname" placeholder="Last Name"><br><br>
            <!-- user email -->
            <input id="text" type="email" name="user_email" placeholder="Email ID"><br><br>
            <!-- phone no -->
            <input id="text" type="text" name="user_phone" placeholder="Phone no."><br><br>
            <!-- password -->
            <input id="text" type="password" name="password" placeholder="Password"><br><br>
            <!-- confirm password -->
            <input id="text" type="password" name="conPwd" placeholder="Confirm Password"><br><br>

            <!-- submit button -->
            <input id="button" type="submit" value="Sign Up"><br><br>

            <!-- <a href="login.php">Click to log in</a> -->
        </form>
    </div>
</body>

</html>