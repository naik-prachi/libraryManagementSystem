<!-- acts as a website -->
<?php
session_start();        //  Starting Session
    $_SESSION;          // is a global variable that can be accessed by any page  in the site. It allows you to store information

    include("connection.php");  //connecting to the database
    include("functions.php");   //calling the functions
    
    $user_data = check_login($con);     // to check whether the user is logged in

    $user_type = $user_data['user_type'];

    // if user_type ==  "admin" then redirect to admin page in admin folder
    if($user_type === 'Admin'){
        header("Location: adminHomepage.php");
        exit;
    }

    // if user_type ==  "staff" then redirect to admin page else go to homepage
    if($user_type === 'Staff'){
        header("Location: staffHomepage.php");
        die;
    }

    // if user_type ==  "student/teacher" then redirect to admin page else go to homepage
    if($user_type === 'Student' || $user_type === 'Faculty'){
        header("Location: sfHomepage.php");
        die;
    }






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my Website</title>
</head>
<body>
    <a href="logout.php">Log Out</a><br/>
    <h1>this is the index page</h1>

    <br>
    Hello, <?php echo $user_data['user_name']; ?>.
</body>
</html>