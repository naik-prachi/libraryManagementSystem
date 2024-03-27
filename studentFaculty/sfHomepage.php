<!-- acts as a website -->
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
    <div class="sidebar">

        <div class="profile-pic">
            <img src="../images/dummypic.png" alt="dummy profile" height="150px" width="150px">
            <br><br>
            Hello,
            <?php echo $user_data['user_fname'], $user_data['user_lname']; ?>!
        </div>

        <br><br><br>
        <ul>
            <br><a href="sfViewBooks.php">Search books</a>
            <!-- <br><a href="#">Notifications</a> -->
            <!-- <br><a href="sfProfilepage.php">Profile</a> -->

            <br><br><br><br><br>
            <a href="../logout.php">Log Out</a><br />
        </ul>

    </div>


    <div class="content">

        <h4>Welcome,
            <?php echo $user_data['user_fname'], " ", $user_data['user_lname']; ?>
        </h4>

        <div class="row">
            <div class="col-sm-*" style="margin: 25px">
                <div class="card bg-light" style="width: 300px">
                    <div class="card-header">Book Issued</div>
                    <div class="card-body">
                        <p class="card-text">No of book issued:
                            <?php echo get_user_borrowed_book_count(); ?>
                        </p>
                        <!-- <a class="btn btn-success" href="view_issued_book.php">View Issued Books</a> -->
                    </div>
                </div>
            </div>

            <div class="col-sm-*" style="margin: 25px">
                <div class="card bg-light" style="width: 300px">
                    <div class="card-header">Book Due Today</div>
                    <div class="card-body">
                        <p class="card-text">No of book due:
                            <?php echo get_user_book_due_count(); ?>
                        </p>
                        <!-- <a class="btn btn-success" href="view_issued_book.php">View Issued Books</a> -->
                    </div>
                </div>
            </div>

            <div class="col-sm-*" style="margin: 25px">
                <div class="card bg-light" style="width: 300px">
                    <div class="card-header">Book Past Due</div>
                    <div class="card-body">
                        <p class="card-text">No of books past due:
                            <?php echo get_user_past_due_count(); ?>
                        </p>
                        <!-- <a class="btn btn-success" href="view_issued_book.php">View Issued Books</a> -->
                    </div>
                </div>
            </div>
        </div>

        <br><br><br><br>

        <center>
            <h4>Issued Book's Detail</h4><br>
        </center>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <form>
                    <table class="table-bordered" width="900px" style="text-align: center">
                        <tr>
                            <th>ISBN</th>
                            <th>TITLE</th>
                            <th>AUTHOR</th>
                            <th>ISSUE DATE</th>
                            <th>DUE DATE</th>
                        </tr>

                        <?php

                        $result = mysqli_query($con, view_students_book_due());
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
                                    <?php echo $user['issue_date']; ?>
                                </td>
                                <td>
                                    
                                    <?php 
                                    // Check if the book is past due and display alert
                                    $due_date = date('Y-m-d', strtotime($user['due_date']));
                                    if ($due_date < date('Y-m-d')) {
                                        echo $due_date . ' <script>alert("Book is past due!");</script>';
                                    } elseif($due_date === date('Y-m-d')) {
                                        echo $due_date . ' <script>alert("Book is due today!");</script>';
                                    }
                                    else {
                                        echo $due_date;
                                    }
                                    ?>
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
</body>

</html>