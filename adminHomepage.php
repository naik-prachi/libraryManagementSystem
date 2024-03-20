<!-- acts as a website -->
<?php
session_start();        //  Starting Session
    $_SESSION;          // is a global variable that can be accessed by any page  in the site. It allows you to store information

    include("connection.php");  //connecting to the database
    include("functions.php");   //calling the functions

    // Include sidebar, navbar, and content files
    include ("sidebar.php");
    include ("navbar.php");
    
    $user_data = check_login($con);     // to check whether the user is logged in
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
    <h1>Welcome admin</h1>

    <br>
    Hello, <?php echo $user_data['user_name']; ?>.
</body>
</html>