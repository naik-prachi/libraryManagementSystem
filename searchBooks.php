<?php
    // Include the database connection file
    include("connection.php");

    // Query to select all books from the 'books' table
    $query = "SELECT * FROM books";

    // Execute the query
    $result = mysqli_query($con, $query);

    // Check if there are any books found
    if(mysqli_num_rows($result) > 0) {// Output a table structure
        echo "<table border='1'>";
        echo "<tr><th>Book no</th><th>Title</th><th>Author</th></tr>";

        // Output data of each row
        while($user = mysqli_fetch_assoc($result)) {
            // Display the details of each book within table rows
            echo "<tr>";
            echo "<td>" . $user["ISBN"] . "</td>";
            echo "<td>" . $user["book_title"] . "</td>";
            echo "<td>" . $user["book_author"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        // No books found
        echo "No books found.";
    }
// ?>