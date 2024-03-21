<?php
    session_start();

    if (isset($_SESSION['user_id'])) {
        # code...
        unset($_SESSION['user_id']);
    }

    // Close the database connection
    // mysqli_close($con);

    // display alert box
    echo '<script>alert("Logged out successfully!")</script>';

    // Redirect after a short delay
    echo '<script>window.setTimeout(function(){ window.location.href = "login.php"; }, 400);</script>';
    die;