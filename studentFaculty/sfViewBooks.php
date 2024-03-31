<?php
session_start();        //  Starting Session
$_SESSION;          // is a global variable that can be accessed by any page  in the site. It allows you to store information

include ("../connection.php");  //connecting to the database
include ("../functions.php");   //calling the functions

global $user_data;
$user_data = check_login($con);     // to check whether the user is logged in

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Website</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    
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
                <li><a href="sfHomepage.php">Home</a></li>
            </ul>
        </div>


    </div>


    <div class="content">

        

        <center>
            <h4 style="margin: 25px">Details of all students and faculties</h4><br>
        </center>
        <hr width=100% align="left"><br><br>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form>
                    <table class="table-bordered" width="900px" style="text-align: center">
                        <tr>
                            <th>ISBN</th>
                            <th>TITLE</th>
                            <th>AUTHOR</th>
                            <th>SUBJECT</th>
                            <th>AVAILABLE COPIES</th>
                        </tr>

                        <?php

                        $result = mysqli_query($con, view_all_books());
                        while ($user = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                
                                <td>
                                    <?php echo $user['ISBN']; ?>
                                </td>
                                <td>
                                    <?php echo $user['book_title']; ?>
                                </td>
                                <td>
                                    <?php echo $user['book_author']; ?>
                                </td>
                                <td>
                                    <?php echo $user['book_subject']; ?>
                                </td>
                                <td>
                                    <?php echo $user['available_copies']; ?>
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
            <div class="col-md-2"></div>
        </div>

    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>