<?php
// Include necessary files (e.g., connection and functions)
include("../connection.php");
include("../functions.php");

// Query the view_student_faculty to retrieve user details
$query = "SELECT * FROM view_student_faculty";
$result = mysqli_query($con, $query);

// Check if query executed successfully
if ($result) {
    // Display user details in a table
    echo "<table border='1'>";
    echo "<tr><th>User ID</th><th>User Type</th><th>User Name</th><th>User Email</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['user_id'] . "</td>";
        echo "<td>" . $row['user_type'] . "</td>";
        echo "<td>" . $row['college_id'] . "</td>";
        echo "<td>" . $row['user_fname'] . "</td>";
        echo "<td>" . $row['user_lname'] . "</td>";
        echo "<td>" . $row['user_email'] . "</td>";
        echo "<td>" . $row['user_phone'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    // Display an error message if query fails
    echo "Error: " . mysqli_error($con);
}

// Close the database connection
// mysqli_close($con);
?>
