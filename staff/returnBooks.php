<?php
session_start();

include ("../connection.php");
include ("../functions.php");
include ("../navbar.php");

global $user_data;
$user_data = check_login($con);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // join table books and issuedbook
    $query = "UPDATE issuedbook
                    SET returned_date = CURDATE() 
                    WHERE college_id = '$_POST[college_id]' AND ISBN = '$_POST[ISBN]'";

    $result = mysqli_query($con, $query);

    if ($result) {
        // User details updated successfully

        // Display the alert box  
        echo '<script>alert("Book returned!")</script>';

        // Redirect after a short delay
        echo '<script>window.setTimeout(function(){ window.location.href = "staffHomepage.php"; }, 400);</script>';
        exit; // Terminate script execution
    } else {
        // Error occurred while updating user details
        // Display an error message or handle the error accordingly
        echo "Error returning book: " . mysqli_error($con);
    }
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Issue Book</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
    <script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">


</head>

<body>

    <div class="sidebar">

        <div class="side-bar-margin" style="margin: 40px">

            <div class="profile-pic">
                <img src="../images/dummypic.png" alt="dummy profile" height="150px" width="150px">

            </div>

            <br><br><br>
            <ul>
                <li><a href="staffHomepage.php">Home</a></li>
                <li><a href="issueBooks.php">Issue Books</a></li>
                <li><a href="addBooks.php">Add Books</a></li>
                <li><a href="manageBooks.php">Manage Books</a></li>
                <li><a href="staffViewUsers.php">View Users</a></li>
            </ul>
        </div>


    </div>
    <br><br>
    <center>
        <h4>Book Return</h4><br>
    </center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">



                <!-- college_id -->
                <div class="form-group">
                    <label for="college_id">College ID:</label>
                    <select class="form-control" name="college_id">
                        <option>-Select College ID-</option>
                        <?php
                        $query = "SELECT DISTINCT college_id FROM users WHERE user_type = 'Student' OR user_type = 'Faculty'";
                        $result = mysqli_query($con, $query);
                        while ($user = mysqli_fetch_assoc($result)) {
                            ?>
                            <option>
                                <?php echo $user['college_id']; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>

                <!-- ISBN -->
                <div class="form-group">
                    <label for="ISBN">ISBN:</label>
                    <select class="form-control" name="ISBN">
                        <option>-Select ISBN-</option>
                        <?php
                        $query = "SELECT DISTINCT ISBN FROM issuedbook";
                        $result = mysqli_query($con, $query);
                        while ($user = mysqli_fetch_assoc($result)) {
                            ?>
                            <option>
                                <?php echo $user['ISBN']; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>


                <button type="submit" name="return_book" class="btn btn-primary">Return Book</button>
            </form>

        </div>
        <div class="col-md-4"></div>
    </div>
</body>

</html>

<?php
    if (isset($_POST['issue_book'])) {
        include ("../connection.php");
        $issued_id = random_num(20);

        // Sanitize user inputs to prevent SQL injection
        $ISBN = mysqli_real_escape_string($con, $_POST['ISBN']);
        $college_id = mysqli_real_escape_string($con, $_POST['college_id']);
        $issue_date = mysqli_real_escape_string($con, $_POST['issue_date']);
        $due_date = mysqli_real_escape_string($con, $_POST['due_date']);

        // Ensure due_date is in the correct format (YYYY-MM-DD) for MySQL
        $due_date = date('Y-m-d', strtotime($due_date));

        // Construct the SQL query with sanitized values
        $query = "INSERT INTO issuedbook (issued_id, ISBN, college_id, issue_date, due_date) VALUES ('$issued_id', '$ISBN', '$college_id', '$issue_date', '$due_date')";

        $result = mysqli_query($con, $query);

        // Check if the query was successful
        if ($result) {
            header("Location: staffHomepage.php");
            exit; // exit script to prevent further execution
        } else {
            echo "Error: " . mysqli_error($con);
        }
    }
?>