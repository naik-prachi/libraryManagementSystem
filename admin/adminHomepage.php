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

            <div class="profile-pic">
                <img src="../images/dummypic.png" alt="dummy profile" height="150px" width="150px">
                <br><br>
                Hello!
            </div>

            <br><br><br>
            <ul>
                <a href="addUsers.php">Add users</a>
                <br><a href="manageUsers.php">Manage users</a>
                <!-- <br><a href="searchUsers.php">Search users</a> -->
                <br><a href="searchBooks.php">Search books</a>
                <!-- <br><a href="profilePage.php">Profile</a> -->

                <br><br><br><br><br>
                <a href="../logout.php">Log Out</a><br />
            </ul>

        </div>




        <div class="content">
            <h4 style="margin: 20px">Welcome,
                <?php echo $user_data['user_fname'], " ", $user_data['user_lname']; ?>
            </h4>

            <div class="row">
                <div class="col-sm-*" style="margin: 25px">
                    <div class="card bg-light" style="width: 300px">
                        <div class="card-header">STUDENTS</div>
                        <div class="card-body">
                            <p class="card-text">No. of students:
                                <?php echo get_student_count(); ?>
                            </p>
                            <!-- <a class="btn btn-success" href="view_issued_book.php">View Issued Books</a> -->
                        </div>
                    </div>
                </div>

                <div class="col-sm-*" style="margin: 25px">
                    <div class="card bg-light" style="width: 300px">
                        <div class="card-header">FACULTY</div>
                        <div class="card-body">
                            <p class="card-text">No of faculties:
                                <?php echo get_faculty_count(); ?>
                            </p>
                            <!-- <a class="btn btn-success" href="view_issued_book.php">View Issued Books</a> -->
                        </div>
                    </div>
                </div>

                <div class="col-sm-*" style="margin: 25px">
                    <div class="card bg-light" style="width: 300px">
                        <div class="card-header">LIBRARY STAFF</div>
                        <div class="card-body">
                            <p class="card-text">No. of staff:
                                <?php echo get_staff_count(); ?>
                            </p>
                            <!-- <a class="btn btn-success" href="view_issued_book.php">View Issued Books</a> -->
                        </div>
                    </div>
                </div>

                <br><br><br><br>

                <center>
                    <h4>  STUDENT DETAILS  </h4><br>
                </center>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form>
                            <table class="table-bordered" width="900px" style="text-align: center">
                                <tr>
                                    <th>COLLEGE ID</th>
                                    <th>FIRST NAME</th>
                                    <th>LAST NAME</th>
                                    <th>EMAIL</th>
                                    <th>PHONE NO.</th>
                                </tr>

                                <?php

                                $result = mysqli_query($con, view_students());
                                while ($user = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $user['college_id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['user_fname']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['user_lname']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['user_email']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['user_phone']; ?>
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
                <br><br><br><br>

                <center>
                    <h4>  FACULTY DETAILS </h4><br>
                </center>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form>
                            <table class="table-bordered" width="900px" style="text-align: center">
                                <tr>
                                    <th>COLLEGE ID</th>
                                    <th>FIRST NAME</th>
                                    <th>LAST NAME</th>
                                    <th>EMAIL</th>
                                    <th>PHONE NO.</th>
                                </tr>

                                <?php

                                $result = mysqli_query($con, view_faculty());
                                while ($user = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $user['college_id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['user_fname']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['user_lname']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['user_email']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['user_phone']; ?>
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


                <br><br><br><br>

                <center>
                    <h4>  LIBRARY DETAILS  </h4><br>
                </center>
                <br><br>
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <form>
                            <table class="table-bordered" width="900px" style="text-align: center">
                                <tr>
                                    <th>COLLEGE ID</th>
                                    <th>FIRST NAME</th>
                                    <th>LAST NAME</th>
                                    <th>EMAIL</th>
                                    <th>PHONE NO.</th>
                                </tr>

                                <?php

                                $result = mysqli_query($con, view_staff());
                                while ($user = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $user['college_id']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['user_fname']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['user_lname']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['user_email']; ?>
                                        </td>
                                        <td>
                                            <?php echo $user['user_phone']; ?>
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

            </div>
        </div>


    </body>

</html>