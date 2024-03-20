<?php
    session_start();

    if (isset($_SESSION['user_id'])) {
        # code...
        unset($_SESSION['user_id']);
    }

    // Close the database connection
    // mysqli_close($con);

    header("Location: login.php");
    die;