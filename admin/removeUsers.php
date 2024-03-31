<?php

    session_start();

    include ("../connection.php");  //connecting to the database
    include ("../functions.php");   //calling the functions

    $user_data = check_login($con);

    $query = "DELETE FROM users WHERE college_id = $_GET[cid]";
    
    // Execute the DELETE query
    if (mysqli_query($con, $query)) {
        // Book successfully removed
        // display alert box
        echo '<script>alert("User removed successfully!")</script>';

        // Redirect after a short delay
        echo '<script>window.setTimeout(function(){ window.location.href = "manageUsers.php"; }, 400);</script>';
        exit;
    } 
    else {
        // Error in deleting the book
        echo "Error: " . mysqli_error($con);
    }


