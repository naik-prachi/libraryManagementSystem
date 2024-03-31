<!-- acts as a website -->
<?php
session_start();        //  Starting Session
$_SESSION;          // is a global variable that can be accessed by any page  in the site. It allows you to store information

include ("../connection.php");  //connecting to the database
include ("../functions.php");   //calling the functions

$user_data = check_login($con);     // to check whether the user is logged in

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">

    
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