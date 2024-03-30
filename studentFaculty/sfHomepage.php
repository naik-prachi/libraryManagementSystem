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
    <title>My Website</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* CSS styles for the sidebar */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40; /* Changed background color to match navbar */
            padding-top: 20px;
            color: #fff; /* Text color */
        }

        /* CSS styles for the main content */
        .content {
            margin-left: 270px; /* Adjusted margin-left to accommodate for sidebar width */
            padding: 20px;
        }

        .profile-pic img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
        }

        .card {
            margin-bottom: 20px;
        }

        .sidebar a {
            color: #fff; /* Text color for sidebar links */
        }

        .sidebar a:hover {
            color: #f8f9fa; /* Text color for hovered sidebar links */
        }

        .sidebar .logout-link {
            color: #fff;
        }

        .sidebar .logout-link:hover {
            color: #f8f9fa;
        }
    </style>

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">My Website</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
            <img src="../images/dummypic.png" alt="dummy profile">
            <br><br>
            Hello, <?php echo $user_data['user_fname'], $user_data['user_lname']; ?>!
        </div>

        <br><br><br>
        <ul class="nav flex-column">
            <br><a href="sfViewBooks.php">Search Books</a>
            <!-- <br><a href="#">Notifications</a> -->
            <!-- <br><a href="sfProfilepage.php">Profile</a> -->
            <br><br>
            <a href="../logout.php" class="logout-link">Logout</a><br />
        </ul>

    </div>


    <div class="content">

        <h4>Welcome, <?php echo $user_data['user_fname'], " ", $user_data['user_lname']; ?>!</h4>

        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Books Issued</div>
                    <div class="card-body">
                        <p class="card-text">Number of books issued: <?php echo get_user_borrowed_book_count(); ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Books Due Today</div>
                    <div class="card-body">
                        <p class="card-text">Number of books due: <?php echo get_user_book_due_count(); ?></p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Books Past Due</div>
                    <div class="card-body">
                        <p class="card-text">Number of books past due: <?php echo get_user_past_due_count(); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <br><br>

        <h4>Issued Book's Details</h4>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ISBN</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Issue Date</th>
                        <th>Due Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($con, view_students_book_due());
                    while ($user = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $user['ISBN']; ?></td>
                            <td><?php echo $user['book_title']; ?></td>
                            <td><?php echo $user['book_author']; ?></td>
                            <td><?php echo $user['issue_date']; ?></td>
                            <td>
                                <?php 
                                // Check if the book is past due and display alert
                                $due_date = date('Y-m-d', strtotime($user['due_date']));
                                if ($due_date < date('Y-m-d')) {
                                    echo '<span class="text-danger">' . $due_date . ' (Past Due)</span>';
                                } elseif($due_date === date('Y-m-d')) {
                                    echo '<span class="text-warning">' . $due_date . ' (Due Today)</span>';
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
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
