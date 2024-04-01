<?php

session_start();

include("../connection.php");  //connecting to the database
include("../functions.php");   //calling the functions

$user_data = check_login($con);

// Check if ISBN is provided in the URL
if(isset($_GET['bn'])) {
    $isbn = $_GET['bn'];

    // Prepare the DELETE query
    $query = "DELETE FROM books WHERE ISBN = '$isbn'";

    // Execute the DELETE query
    if (mysqli_query($con, $query)) {
        // Book successfully removed
        // display alert box
        echo '<script>alert("Book removed successfully!")</script>';
                
        // Redirect after a short delay
        echo '<script>window.setTimeout(function(){ window.location.href = "manageBooks.php"; }, 400);</script>';
        exit;
    } else {
        // Error in deleting the book
        echo "Error: " . mysqli_error($con);
    }
} else {
    // Handle case when ISBN is not provided in the URL
    echo "ISBN not provided";
}