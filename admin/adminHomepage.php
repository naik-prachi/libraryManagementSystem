<!-- acts as a website -->
<?php
session_start();        //  Starting Session
    $_SESSION;          // is a global variable that can be accessed by any page  in the site. It allows you to store information

    include("../connection.php");  //connecting to the database
    include("../functions.php");   //calling the functions

    // Include sidebar, navbar, and content files
    // include ("sidebar.php");
    // include ("navbar.php");
    
    $user_data = check_login($con);     // to check whether the user is logged in
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my Website</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            /* CSS styles for the sidebar */
            .sidebar {
                height: 100%;
                width: 250px;
                position: fixed;
                top: 0;
                left: 0;
                background-color: #f8f9fa;
                padding-top: 20px;
            }

            /* CSS styles for the main content */
            .content {
                margin-left: 250px;
                /* Adjust this value to match the width of your sidebar */
                padding: 20px;
            }
        </style>
</head>
<body>
<body>
        <div class="sidebar">

            <div class="profile-pic" >
                <img src="../images/dummypic.png" alt="dummy profile" height="150px" width="150px">
                <br><br>
                Hello, <?php echo $user_data['user_fname']," ", $user_data['user_lname']; ?>!
            </div>

            <br><br><br>
            <ul >
                <a href="addUsers.php" >Add users</a>
                <br><a href="updateUsers.php">Update user details</a>
                <br><a href="removeUsers.php" >Remove users</a>
                <br><a href="searchUsers.php" >Search users</a>
                <br><a href="searchBooks.php">Search books</a>
                <br><a href="#">Notifications</a>
                <br><a href="profilePage.php">Profile</a>

                <br><br><br><br><br>
            <a href="../logout.php" >Log Out</a><br />
            </ul>

        </div>

        


        <div class="content">
            <h1>Welcome <?php echo $user_data['user_type']; ?></h1>
        </div>
</body>
</html>