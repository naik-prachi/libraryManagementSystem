<?php
	
	session_start();

    include("../connection.php");
    require("../functions.php");
	

	$user_data = check_login($con);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Book</title>
    <link rel="stylesheet" href="../bootstrap-4.4.1/css/bootstrap.min.css">
    <script src="../bootstrap-4.4.1/js/jquery_latest.js"></script>
    <script src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>

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
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="adminHomepage.php">Library Management System (LMS)</a>
        <span class="navbar-text ml-auto">
            <strong>Welcome: <?php echo $user_data['user_fname'];?></strong>
            <br>
            <strong>Email: <?php echo $user_data['user_email'];?></strong>
        </span>
        <ul class="navbar-nav ml-auto">

            <li class="nav-item">
                <a class="nav-link" href="../logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="sidebar bg-dark"> <!-- Apply bg-dark class here -->
    <div class="side-bar-margin" style="margin: 40px">
        <div class="profile-pic">
            <img src="../images/dummypic.png" alt="dummy profile" height="150px" width="150px">
        </div>
        <br><br><br>
        <ul>
            <li><a href="staffHomepage.php">Home</a></li>
            <li><a href="issueBooks.php">Issue Books</a></li>
            <li><a href="returnBooks.php">Return Books</a></li>
            <li><a href="addBooks.php">Add Books</a></li>
            <li><a href="staffViewUsers.php">View Users</a></li>
        </ul>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center">Manage Books</h4>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ISBN No.</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Subject</th>
                        <th>Total copies</th>
                        <th>Available copies</th>
                        <th>Borrowed copies</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $query = "SELECT * FROM books";
                        $result = mysqli_query($con, $query);
                        while ($user = mysqli_fetch_assoc($result)){
                    ?>
                    <tr>
                        <td><?php echo $user['ISBN'];?></td>
                        <td><?php echo $user['book_title'];?></td>
                        <td><?php echo $user['book_author'];?></td>
                        <td><?php echo $user['book_subject'];?></td>
                        <td><?php echo $user['total_copies'];?></td>
                        <td><?php echo $user['available_copies'];?></td>
                        <td><?php echo $user['borrowed_copies'];?></td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="updateBooks.php?bn=<?php echo $user['ISBN'];?>">Update</a>
                            <a class="btn btn-sm btn-danger" href="removeBook.php?bn=<?php echo $user['ISBN'];?>">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>


