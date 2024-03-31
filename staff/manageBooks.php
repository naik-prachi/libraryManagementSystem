<?php

session_start();

include ("../connection.php");
require ("../functions.php");
include ("../navbar.php");


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
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>

    <div class="container-fluid">
        <div class="row">
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
            <div >
                <div ">
                    <h4 class=" text-center">Manage Books</h4>
                    <table style="margin-left:300px">
                        <thead class="thead-dark">
                            <tr>
                                <th>ISBN No.</th>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Subject</th>
                                <th>Total </th>
                                <th>Available </th>
                                <th>Borrowed</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM books";
                            $result = mysqli_query($con, $query);
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
                                        <?php echo $book['book_subject']; ?>
                                    </td>
                                    <td>
                                        <?php echo $book['total_copies']; ?>
                                    </td>
                                    <td>
                                        <?php echo $book['available_copies']; ?>
                                    </td>
                                    <td>
                                        <?php echo $book['borrowed_copies']; ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary"
                                            href="updateBooks.php?bn=<?php echo $book['ISBN']; ?>">Update</a>
                                        <a class="btn btn-sm btn-danger"
                                            href="removeBook.php?bn=<?php echo $book['ISBN']; ?>">Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="../bootstrap-4.4.1/js/jquery_latest.js"></script>
    <script src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
</body>

</html>



</html>