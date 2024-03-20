<?php

    session_start();

    include("connection.php");  //connecting to the database
    include("functions.php");   //calling the functions

    // check if the user has clicked on the post button
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // something was posted
        // collect the data from post variable

        $book_no = $_POST['book_no'];

        // Check if the book number is set and not empty
        if (!empty($book_no)) {
            // Sanitize the book number to prevent SQL injection
            $book_no = mysqli_real_escape_string($con, $book_no);

            // Construct the DELETE query
            $query = "DELETE FROM books WHERE book_no = '$book_no'";

            // Execute the DELETE query
            if (mysqli_query($con, $query)) {
                // Book successfully removed
                echo "Book removed successfully.";
            } else {
                // Error in deleting the book
                echo "Error: " . mysqli_error($con);
            }
        } else {
            // Book number is not provided or empty
            echo "Please enter the book number.";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Remove books</title>
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

                <input id="text" type="number" name="book_no" placeholder="Enter book number..."><br><br>

                <input id="button" type="submit" value="Remove"><br><br>

                
            </form>
        </div>


    </body>

</html>