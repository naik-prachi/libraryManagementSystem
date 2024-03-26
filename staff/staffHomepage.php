<!-- acts as a website -->
<?php
session_start();        //  Starting Session
$_SESSION;          // is a global variable that can be accessed by any page  in the site. It allows you to store information

include ("../connection.php");  //connecting to the database
include ("../functions.php");   //calling the functions

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
    <title>My Website</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* CSS styles for the sidebar */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40; /* Dark background color */
            padding-top: 20px;
            color: #fff; /* Text color */
            overflow-y: auto; /* Enable scrolling if content exceeds height */
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #fff;
        }

        .sidebar a:hover {
            background-color: #495057; /* Darker background color on hover */
        }

        /* CSS styles for the main content */
        .content {
            margin-left: 250px;
            /* Adjust this value to match the width of your sidebar */
            padding: 20px;
        }

        .profile-pic img {
            border-radius: 50%; /* Make the profile picture round */
        }

        h1 {
            color: #495057; /* Text color for the heading */
        }
    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">My Website</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Settings
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../profilePage.php">Change Password</a>
                    <a class="dropdown-item" href="../logout.php">Logout</a>
                </div>
            </li>
        </ul>
    </div>
</nav>


    <div class="sidebar">

        <div class="profile-pic">
            <img src="../images/dummypic.png" alt="dummy profile" height="150px" width="150px">
            <br><br>
            Hello,
            <?php echo $user_data['user_fname'], $user_data['user_lname']; ?>!
        </div>

        <br><br><br>
        <ul>
            <li><a href="issueBooks.php">Issue book</a></li>
            <li><a href="returnBooks.php">Return books</a></li>
            <li><a href="addBooks.php">Add books</a></li>
            <li><a href="manageBooks.php">Manage Books</a></li>
            <li><a href="removeBook.php">Remove books</a></li>
            <li><a href="staffViewUsers.php">Search users</a></li>
            <li><a href="searchBooks.php">Search books</a></li>
            <li><a href="#">Notifications</a></li>
        </ul>

    </div>


    <div class="content">

        <h1>Welcome
            <?php echo $user_data['user_type']; ?>
        </h1>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
