<?php
session_start();

// Include necessary files (e.g., connection and functions)
include("connection.php");
include("functions.php");

// Initialise variable to track if email exists
$bookno_exists = false;

// Check if the user has clicked on the post button
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted, collect the data from post variable
    if(isset($_POST['book_no'])) {
        $book_no = $_POST['book_no'];

        // Query the database to check if the email exists
        $query = "SELECT * FROM books WHERE book_no = '$book_no'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            // Email exists, flag it true
            $bookno_exists = true;

            // Retrieve existing user details from the database
            $book = mysqli_fetch_assoc($result);

            // Check if user details were found
            if (!$book) {
                // User not found in the database
                // Handle the error accordingly (e.g., display an error message)
                echo "Book not found.";
                exit; // Terminate script execution
            }
        }
    }

    // Handle the second POST request for updating user details
    if ($bookno_exists && isset($_POST['new_book_no']) && isset($_POST['new_book_title']) && isset($_POST['new_book_author']) && isset($_POST['new_book_subject']) && isset($_POST['new_total_copies']) && isset($_POST['new_available_copies'])) {
        $new_book_no = $_POST['new_book_no'];
        $new_book_title = $_POST['new_book_title'];
        $new_book_author = $_POST['new_book_author'];
        $new_book_subject = $_POST['new_book_subject'];
        $new_total_copies = $_POST['new_total_copies'];
        $new_borrowed_copies = $_POST['new_borrowed_copies'];
        $new_available_copies = $_POST['new_available_copies'];

        // Update user details in the database
        $query = "UPDATE books SET book_no = '$new_book_no', book_title = '$new_book_title', book_author = '$new_book_author', book_subject = '$new_book_subject', total_copies = '$new_total_copies', borrowed_copies = '$new_borrowed_copies', available_copies = '$new_available_copies' WHERE book_no = '$book_no'";
        $result = mysqli_query($con, $query);

        if ($result) {
            // User details updated successfully
           
            // Display the alert box  
            echo '<script>alert("Book update is successful!")</script>';
            
            // Redirect after a short delay
            echo '<script>window.setTimeout(function(){ window.location.href = "staffHomepage.php"; }, 400);</script>';
            exit; // Terminate script execution
        } else {
            // Error occurred while updating user details
            // Display an error message or handle the error accordingly
            echo "Error updating user details: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Update</title>
</head>

<body>
    <div>
        <!-- Form for entering user email -->
        <form action="" method="post">
            <input id="text" type="number" name="book_no" placeholder="Enter Book No."><br><br>
            <input id="button" type="submit" value="Search">
        </form>
    </div>

    <?php if ($bookno_exists): ?>
    <!-- Display the second half of the form only if email exists -->
    <div>
        <!-- Update user details form -->
        <form action="" method="post">
            <!-- Add input fields for updating user details -->

            <input id="text" type="text" name="new_book_no" value="<?php echo $book['book_no']; ?>"><br><br>
            <input id="text" type="text" name="new_book_title" value="<?php echo $book['book_title']; ?>"><br><br>
            <input id="text" type="text" name="new_book_author" value="<?php echo $book['book_author']; ?>" ><br><br>
            <input id="text" type="text" name="new_book_subject" value="<?php echo $book['book_subject']; ?>" ><br><br>
            <input id="text" type="text" name="new_total_copies" value="<?php echo $book['total_copies']; ?> "><br><br>
            <input id="text" type="text" name="new_borrowed_copies" value="<?php echo $book['borrowed_copies']; ?>"><br><br>
            <input id="text" type="text" name="new_available_copies" value="<?php echo $book['available_copies']; ?>"><br><br>

            <!-- Add hidden input field to store user_email -->
            <input type="hidden" name="book_no" value="<?php echo $book_no; ?>">

            <!-- Add more input fields as needed -->
            <input id="button" type="submit" value="Update">
        </form>
    </div>
    <?php endif; ?>
</body>

</html>
