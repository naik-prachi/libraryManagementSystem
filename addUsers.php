<?php
    session_start();

    include("connection.php");  //connecting to the database
    include("functions.php");   //calling the functions

    // Function to send email
    function sendEmail($to, $subject, $message) {
        $admin_email = "library@college.in";
        $headers = "From: $admin_email\r\n";
        $headers .= "Reply-To: $admin_email\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        return mail($to, $subject, $message, $headers);
    }

    // check if the user has clicked on the post button
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // something was posted
        // collect the data from post variable
        $user_type = $_POST['user_type'];
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $password = $_POST['password'];
        $conPwd = $_POST['conPwd'];

        // check if all fields are not empty
        if (!empty($user_name) && !empty($user_type) && !empty($user_email) && !empty($password) && !empty($conPwd)) {
            // check if passwords match
            if ($password != $conPwd) {
                echo "Passwords do not match";
            } else {
                // save to database
                $user_id = random_num(20);
                $query = "INSERT INTO userss (user_id, user_type, user_name, user_email, password) VALUES ('$user_id', '$user_type', '$user_name', '$user_email', '$password')";
                $result = mysqli_query($con, $query);

                if ($result) {
                    // Send email to the registered user
                    $to = $user_email;
                    $subject = "Library Registration Confirmation";
                    $message = "Dear $user_name,<br><br>Your registration with our library system was successful. Your password is: 260515. <br><br>Best regards,<br>Library Administration";
                    $headers = "From: woozinotwhoshe@gmail.com";
                    // $email_sent = sendEmail($user_email, $subject, $message);

                    // Set SMTP server and port for Gmail
                    ini_set("SMTP", "smtp.gmail.com");
                    ini_set("smtp_port", "587");

                    // Enable TLS
                    ini_set("sendmail_from", "woozinotwhoshe@gmail.com"); // Replace with your Gmail address
                    ini_set("sendmail_path", "C:\\xampp\\sendmail\\sendmail.exe -t -i"); // Path to sendmail executable

                    // Additional headers for sending emails via Gmail
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= "X-Mailer: PHP/" . phpversion();

                    // Set email sender and recipient
                    $from = "woozinotwhoshe@gmail.com"; // Replace with your Gmail address
                    $to = $user_email; // Replace with recipient's email address


                    // if ($email_sent) {
                    if(mail($to, $subject, $message, $headers)){
                        // Display success message and redirect
                        echo '<script>alert("Registration is successful! Email sent to registered user.")</script>';
                        echo '<script>window.setTimeout(function(){ window.location.href = "adminHomepage.php"; }, 400);</script>';
                        die;
                    } else {
                        // Display error message if email could not be sent
                        echo '<script>alert("Registration is successful! Email could not be sent.")</script>';
                    }
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
    <title>Sign Up</title>
</head>

<body>
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
            <!--  username -->
            <input id="text" type="text" name="user_name" placeholder="Name"><br><br>
            <!-- user email -->
            <input id="text" type="email" name="user_email" placeholder="Email ID"><br><br>
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
