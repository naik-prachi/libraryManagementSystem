<?php
    session_start();

    include("connection.php");  //connecting to the database
    include("functions.php");   //calling the functions

    $query = "select * from users where user_type = '$user_type'";
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

    // Display the alert box  
    // echo '<script>alert("Registration is successful!")</script>'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View users</title>
</head>
<body>
    <!-- usertype dropdown menu-->
    <select id="userType" name="user_type">
        <option value="All">All users</option>
        <option value="Student">Student</option>
        <option value="Faculty">Faculty</option>
        <option value="Staff">Staff</option>
        <option value="Admin">Admin</option>
    </select><br><br>

    <!-- Container to display user details -->
    <div id="userDetails"></div>

    <!-- JavaScript to handle dropdown change -->
    <script>
        document.getElementById("userType").addEventListener("change", function() {
            var userType = this.value;
            // Send AJAX request to retrieve user details
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("userDetails").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "getUserDetails.php?user_type=" + userType, true);
            xhttp.send();
        });
    </script>
</body>
</html>

