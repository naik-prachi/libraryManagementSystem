<!-- acts as a website -->
<?php
session_start();        //  Starting Session
$_SESSION;          // is a global variable that can be accessed by any page  in the site. It allows you to store information

include ("../connection.php");  //connecting to the database
include ("../functions.php");   //calling the functions


global $user_data;
$user_data = check_login($con);     // to check whether the user is logged in

// get count of borrowed copies
function get_borrowed_book_count()
{
    include ("../connection.php");
    $borrowed_book_count = 0;
    $query = "SELECT sum(borrowed_copies) AS borrowed_copy_count FROM books";
    $query_run = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($query_run)) {
        $borrowed_book_count = $row['borrowed_copy_count'];
    }
    return ($borrowed_book_count);
}

function get_due_book_count()
{
    include ("../connection.php");
    $due_book_count = 0;
    $query = "SELECT count(*) as due_book_count from issuedbook where due_date = CURDATE()";
    $query_run = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($query_run)) {
        $due_book_count = $row['due_book_count'];
    }
    return ($due_book_count);
}

// view of students due to return book today
function view_issued_book()
{
    include ("../connection.php");
    $user_data = check_login($con);

    // join table books and issuedbook
    $query = "SELECT * FROM issuedbook i 
          JOIN books b ON i.ISBN = b.ISBN 
          JOIN users u ON i.college_id = u.college_id
          WHERE i.due_date > CURDATE() AND i.returned_date IS NULL";

    return ($query);
}

function view_students_past_due()
{
    include ("../connection.php");

    // join table books and issuedbook
    $query = "SELECT * FROM issuedbook i 
          JOIN books b ON i.ISBN = b.ISBN 
          JOIN users u ON i.college_id = u.college_id
          WHERE i.due_date < CURDATE() AND i.returned_date IS NULL";

    return ($query);
}
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
            background-color: #343a40;
            /* Dark background color */
            padding-top: 20px;
            color: #fff;
            /* Text color */
            overflow-y: auto;
            /* Enable scrolling if content exceeds height */
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
            background-color: #495057;
            /* Darker background color on hover */
        }

        /* CSS styles for the main content */
        .content {
            margin-left: 250px;
            /* Adjust this value to match the width of your sidebar */
            padding: 20px;
        }

        .profile-pic img {
            border-radius: 50%;
            /* Make the profile picture round */
        }

        h1 {
            color: #495057;
            /* Text color for the heading */
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
                        <a class="dropdown-item" href="../changePassword.php">Change Password</a>
                        <a class="dropdown-item" href="../logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>


    <div class="sidebar">

        <div class="side-bar-margin" style="margin: 40px">

            <div class="profile-pic">
                <img src="../images/dummypic.png" alt="dummy profile" height="150px" width="150px">

            </div>

            <br><br><br>
            <ul>
                <li><a href="issueBooks.php">Issue Books</a></li>
                <li><a href="returnBooks.php">Return Books</a></li>
                <li><a href="addBooks.php">Add Books</a></li>
                <li><a href="manageBooks.php">Manage Books</a></li>
                <li><a href="staffViewUsers.php">View Users</a></li>
                <li><a href="searchBooks.php">View Books</a></li>
                <!-- <li><a href="#">Notifications</a></li> -->
            </ul>
        </div>


    </div>


    <div class="content">

        <h4 style="margin: 20px">Welcome,
            <?php echo $user_data['user_fname'], " ", $user_data['user_lname']; ?>
        </h4>

        <div class="row">
            <div class="col-sm-*" style="margin: 25px">
                <div class="card bg-light" style="width: 300px">
                    <div class="card-header">Book Issued</div>
                    <div class="card-body">
                        <p class="card-text">No. of books issued:
                            <?php echo get_borrowed_book_count(); ?>
                        </p>
                        <!-- <a class="btn btn-success" href="view_issued_book.php">View Issued Books</a> -->
                    </div>
                </div>
            </div>

            <div class="col-sm-*" style="margin: 25px">
                <div class="card bg-light" style="width: 300px">
                    <div class="card-header">Book Due Today</div>
                    <div class="card-body">
                        <p class="card-text">No of books due:
                            <?php echo get_due_book_count(); ?>
                        </p>
                        <!-- <a class="btn btn-success" href="view_issued_book.php">View Issued Books</a> -->
                    </div>
                </div>
            </div>
        </div>

        <br><br><br><br>

        <center>
            <h4>Details of Students' Past Return Date</h4><br>
        </center>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form>
                    <table class="table-bordered" width="900px" style="text-align: center">
                        <tr>
                            <th>ISBN</th>
                            <th>TITLE</th>
                            <th>COLLEGE ID</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>DUE DATE</th>
                        </tr>

                        <?php

                        $query_run = mysqli_query($con, view_students_past_due());
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['ISBN']; ?>
                                </td>
                                <td>
                                    <?php echo $row['book_title']; ?>
                                </td>
                                <td>
                                    <?php echo $row['college_id']; ?>
                                </td>
                                <td>
                                    <?php echo $row['user_fname'], " ", $row['user_lname']; ?>
                                </td>
                                <td>
                                    <?php echo $row['user_email']; ?>
                                </td>
                                <td>
                                    <?php echo $row['due_date']; ?>
                                </td>

                            </tr>

                            <?php
                        }
                        ?>
                    </table>

                    
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>

<br><br><br>
<!-- draw a horizontal line between the two tables -->
<hr width=100% align="left"> 
<br><br><br>


        <center>
            <h4>Issued Book Details</h4><br>
        </center>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-sm-*">
                <form>
                    <table class="table-bordered" width="900px" style="text-align: center">
                        <tr>
                            <th>ISBN</th>
                            <th>TITLE</th>
                            <th>COLLEGE ID</th>
                            <th>NAME</th>
                            <th>EMAIL</th>
                            <th>ISSUE DATE</th>
                            <th>DUE DATE</th>
                        </tr>

                        <?php

                        $query_run = mysqli_query($con, view_issued_book());
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['ISBN']; ?>
                                </td>
                                <td>
                                    <?php echo $row['book_title']; ?>
                                </td>
                                <td>
                                    <?php echo $row['college_id']; ?>
                                </td>
                                <td>
                                <?php echo $row['user_fname'], " ", $row['user_lname']; ?>
                                </td>
                                <td>
                                    <?php echo $row['user_email']; ?>
                                </td>
                                <td>
                                    <?php echo $row['issue_date']; ?>
                                </td>
                                <td>
                                    <?php echo $row['due_date']; ?>
                                </td>

                            </tr>

                            <?php
                        }
                        ?>
                    </table>

                    
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>

    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>