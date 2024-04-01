<!-- acts as a website -->
<?php
session_start();        //  Starting Session
$_SESSION;          // is a global variable that can be accessed by any page  in the site. It allows you to store information

include ("../connection.php");  //connecting to the database
include ("../functions.php");   //calling the functions
include ("../navbar.php");     //include the navbar


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
    <link rel="stylesheet" href="../css/style.css">


</head>

<body>


    <!-- Sidebar -->
    <div class="sidebar">

        <div class="profile-pic text-center">
            <img src="../images/dummypic.png" alt="dummy profile">
            <br><br>
            Hello,
            <?php echo $user_data['user_fname'], " ", $user_data['user_lname']; ?>!
        </div>

        <br><br><br>
        <ul class="nav flex-column">
            <br><a href="sfViewBooks.php">Search Books</a>
        </ul>

    </div>


    <div class="content">



        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Books Issued</div>
                    <div class="card-body">
                        <p class="card-text">Number of books issued:
                            <?php echo get_user_borrowed_book_count(); ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Books Due Today</div>
                    <div class="card-body">
                        <p class="card-text">Number of books due:
                            <?php echo get_user_book_due_count(); ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Books Past Due</div>
                    <div class="card-body">
                        <p class="card-text">Number of books past due:
                            <?php echo get_user_past_due_count(); ?>
                        </p>
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
                    while ($book = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td>
                                <?php echo $book['ISBN']; ?>
                            </td>
                            <td>
                                <?php echo $book['book_title']; ?>
                            </td>
                            <td>
                                <?php echo $book['book_author']; ?>
                            </td>
                            <td>
                                <?php echo $book['issue_date']; ?>
                            </td>
                            <td>
                                <?php
                                // Check if the book is past due and display alert
                                $due_date = date('Y-m-d', strtotime($book['due_date']));
                                if ($due_date < date('Y-m-d')) {
                                    echo '<span class="text-danger">' . $due_date . ' (Past Due)</span>';
                                } elseif ($due_date === date('Y-m-d')) {
                                    echo '<span class="text-warning">' . $due_date . ' (Due Today)</span>';
                                } else {
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