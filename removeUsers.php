<?php

    session_start();

    include("connection.php");  //connecting to the database
    include("functions.php");   //calling the functions

    // check if the user has clicked on the post button
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // something was posted
        // collect the data from post variable

        $book_no = $_POST['user_email'];

        // Check if the book number is set and not empty
        if (!empty($book_no)) {
            // Sanitize the book number to prevent SQL injection
            $book_no = mysqli_real_escape_string($con, $book_no);

            // Construct the DELETE query
            $query = "DELETE FROM userss WHERE user_email = '$book_no'";

            // Execute the DELETE query
            if (mysqli_query($con, $query)) {
                // Book successfully removed
                // display alert box
                echo '<script>alert("User removed successfully!")</script>';
                
                // Redirect after a short delay
            echo '<script>window.setTimeout(function(){ window.location.href = "adminHomepage.php"; }, 400);</script>';
                exit;
            
            } else {
                // Error in deleting the book
                echo "Error: " . mysqli_error($con);
            }
        } else {
            // Book number is not provided or empty
            echo "Please enter the user email.";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Remove users</title>
    </head>

    <body>
        <style type="text/css">
            #text {
                height: 25px;
                border-radius: 5px;
                padding: 4px;
                border: solid thin #aaa;
                width: 100%;
            }

            #button {
                padding: 10px;
                width: 100px;
                color: white;
                background-color: cadetblue;
                border: none;
            }

            #box {
                background-color: gray;
                margin: auto;
                width: 300px;
                padding: 20px;
            }
        </style>

        <div id="box">
            <form action="" method="post">
                <div style="font-size: 20px; margin: 10px;color:white">
                    Remove book
                </div>

                <input id="text" type="email" name="user_email" placeholder="Enter user email..."><br><br>

                <input id="button" type="submit" value="Remove"><br><br>

                
            </form>
        </div>


    </body>

</html>