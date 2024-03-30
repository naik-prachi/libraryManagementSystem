<!-- acts as a website -->
<?php
session_start();        //  Starting Session
$_SESSION;          // is a global variable that can be accessed by any page  in the site. It allows you to store information

include ("../connection.php");  //connecting to the database
include ("../functions.php");   //calling the functions

$user_data = check_login($con);     // to check whether the user is logged in

// get count of borrowed copies
function get_student_count()
{
    include ("../connection.php");
    $student_count = 0;
    $query = "SELECT count(*) AS student_count FROM users WHERE user_type = 'Student'";
    $result = mysqli_query($con, $query);
    while ($user = mysqli_fetch_assoc($result)) {
        $student_count = $user['student_count'];
    }
    return ($student_count);
}

function get_faculty_count()
{
    include ("../connection.php");
    $faculty_count = 0;
    $query = "SELECT count(*) AS faculty_counts 
            FROM users
            WHERE user_type = 'Faculty'";
    $result = mysqli_query($con, $query);
    while ($user = mysqli_fetch_assoc($result)) {
        $faculty_count = $user['faculty_counts'];
    }
    return ($faculty_count);
}

function get_staff_count()
{
    include ("../connection.php");
    $staff_count = 0;
    $query = "SELECT count(*) as staff_count from users where user_type = 'Staff'";
    $result = mysqli_query($con, $query);
    while ($user = mysqli_fetch_assoc($result)) {
        $staff_count = $user['staff_count'];
    }
    return ($staff_count);
}

// view of students due to return book today
function view_students()
{
    include ("../connection.php");

    // join table books and issuedbook
    $query = "SELECT * FROM users WHERE user_type = 'Student'";

    return ($query);
}

function view_faculty()
{
    include ("../connection.php");

    // join table books and issuedbook
    $query = "SELECT * FROM users WHERE user_type = 'Faculty'";

    return ($query);
}

function view_staff()
{
    include ("../connection.php");

    // join table books and issuedbook
    $query = "SELECT * FROM users WHERE user_type = 'Staff'";

    return ($query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <style>
        /* Sidebar Styles */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40; /* Dark background color */
            padding-top: 20px;
            color: #fff; /* Text color */
        }

        /* Main Content Styles */
        .content {
            margin-left: 250px;
            padding: 20px;
        }

        /* Card Styles */
        .card {
            margin-bottom: 20px;
        }

        /* Profile Picture Styles */
        .profile-pic img {
            border-radius: 50%;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #343a40; /* Dark background color for table headers */
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2; /* Light background color for even rows */
        }
    </style>
</head>

<body>
    
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

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
                        <a class="dropdown-item" href="#">Change Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>



    <!-- Sidebar -->
    <div class="sidebar">
        <div class="profile-pic text-center">
            <img src="../images/dummypic.png" alt="dummy profile" height="150px" width="150px">
            <br><br>
            <h5>Hello, <?php echo $user_data['user_fname'], " ", $user_data['user_lname']; ?></h5>
        </div>

        <br><br><br>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="addUsers.php">Add Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manageUsers.php">Manage Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="adminViewBooks.php">Search Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../logout.php">Log Out</a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-header">STUDENTS</div>
                        <div class="card-body">
                            <p class="card-text">No. of students: <?php echo get_student_count(); ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-header">FACULTY</div>
                        <div class="card-body">
                            <p class="card-text">No. of faculties: <?php echo get_faculty_count(); ?></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-light">
                        <div class="card-header">LIBRARY STAFF</div>
                        <div class="card-body">
                            <p class="card-text">No. of staff: <?php echo get_staff_count(); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <h4>STUDENT DETAILS</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>COLLEGE ID</th>
                                <th>FIRST NAME</th>
                                <th>LAST NAME</th>
                                <th>EMAIL</th>
                                <th>PHONE NO.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = mysqli_query($con, view_students());
                            while ($user = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $user['college_id'] . "</td>";
                                echo "<td>" . $user['user_fname'] . "</td>";
                                echo "<td>" . $user['user_lname'] . "</td>";
                                echo "<td>" . $user['user_email'] . "</td>";
                                echo "<td>" . $user['user_phone'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <h4>FACULTY DETAILS</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>COLLEGE ID</th>
                                <th>FIRST NAME</th>
                                <th>LAST NAME</th>
                                <th>EMAIL</th>
                                <th>PHONE NO.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = mysqli_query($con, view_faculty());
                            while ($user = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $user['college_id'] . "</td>";
                                echo "<td>" . $user['user_fname'] . "</td>";
                                echo "<td>" . $user['user_lname'] . "</td>";
                                echo "<td>" . $user['user_email'] . "</td>";
                                echo "<td>" . $user['user_phone'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <h4>LIBRARY STAFF DETAILS</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>COLLEGE ID</th>
                                <th>FIRST NAME</th>
                                <th>LAST NAME</th>
                                <th>EMAIL</th>
                                <th>PHONE NO.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = mysqli_query($con, view_staff());
                            while ($user = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $user['college_id'] . "</td>";
                                echo "<td>" .
                                $user['user_fname'] . "</td>";
                                echo "<td>" . $user['user_lname'] . "</td>";
                                echo "<td>" . $user['user_email'] . "</td>";
                                echo "<td>" . $user['user_phone'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>