<?php
    session_start();
    $_SESSION;

    include ("../connection.php");
    include ("../functions.php");

    $user_data = check_login($con);

    function get_borrowed_book_count()
    {
        include ("../connection.php");
        $user_data = check_login($con);
        $user_issue_book_count = 0;
        $query = "select count(*) as user_issue_book_count from issuedbook where college_id = $user_data[college_id]";
        $query_run = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($query_run)) {
            $user_issue_book_count = $row['user_issue_book_count'];
        }
        return ($user_issue_book_count);
    }

    function get_book_due_count()
    {
        include ("../connection.php");
        $user_data = check_login($con);
        $user_due_book_count = 0;
        $query = "select count(*) as user_due_book_count from issuedbook where due_date = CURDATE()";
        $query_run = mysqli_query($con, $query);
        while ($row = mysqli_fetch_assoc($query_run)) {
            $user_due_book_count = $row['user_due_book_count'];
        }
        return ($user_due_book_count);
    }

    function view_students_book_due()
    {
        include ("../connection.php");
        $user_data = check_login($con);

        // join table books and issuedbook
        $query = "select * from issuedbook i 
                join books b 
                where i.ISBN = b.ISBN and college_id = $user_data[college_id]";
        return ($query);
    }
?>



<!DOCTYPE html>
<html>

    <head>
        <title>Dashboard</title>
        <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
        <link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
        <script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
        <script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="sfHomepage.php">Library Management System (LMS)</a>
                </div>
                <font style="color: white"><span><strong>Welcome:
                            <?php echo $user_data['user_fname']; ?>
                        </strong></span></font>
                <font style="color: white"><span><strong>Email:
                            <?php echo $user_data['user_email']; ?>
                        </strong></font>
                <ul class="nav navbar-nav navbar-right">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown">My Profile </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="view_profile.php">View Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="edit_profile.php">Edit Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="change_password.php">Change Password</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav><br>
        <span>
            <marquee>This is library mangement system. Library opens at 8:00 AM and close at 8:00 PM</marquee>
        </span><br><br>
        <div class="row">
            <div class="col-sm-*" style="margin: 25px">
                <div class="card bg-light" style="width: 300px">
                    <div class="card-header">Book Issued</div>
                    <div class="card-body">
                        <p class="card-text">No of book issued:
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
                        <p class="card-text">No of book due:
                            <?php echo get_book_due_count(); ?>
                        </p>
                        <!-- <a class="btn btn-success" href="view_issued_book.php">View Issued Books</a> -->
                    </div>
                </div>
            </div>
        </div>

        <br><br><br><br>

        <center><h4>Issued Book's Detail</h4><br></center>
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
                        
                            $query_run = mysqli_query($con, view_students_book_due());
                            while ($row = mysqli_fetch_assoc($query_run)){
                                ?>
                                <tr>
                                <td><?php echo $row['ISBN'];?></td>
                                <td><?php echo $row['book_title'];?></td>
                                <td><?php echo $row['book_author'];?></td>
                                <td><?php echo $row['issue_date'];?></td>
                                <td><?php echo $row['due_date'];?></td>
                                
                            </tr>

                        <?php
                            }
                        ?>	
                    </table>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>

    </body>

</html>