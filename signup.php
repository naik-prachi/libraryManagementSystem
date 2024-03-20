<?php
    session_start();

    include("connection.php");  //connecting to the database
    include("functions.php");   //calling the functions

    // check if the user has clicked on the post button
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // something was posted
        // collect the data from post variable
        $user_type = $_POST['user_type'];
        $user_name = $_POST['user_name'];
        $user_email = $_POST['user_email'];
        $password = $_POST['password'];
        $conPwd = $_POST['conPwd'];

        // check if both are not empty
        if(!empty($user_name) && !empty($user_type) && !empty($user_email) && !empty($password) && !is_numeric($user_name) ){
            if($password != $conPwd)
                echo "Passwords do not match";
            else{
                // save to db
                $user_id = random_num(20);
                $query = "insert into userss (user_id, user_type, user_name, user_email, password) values ('$user_id', '$user_type', '$user_name', '$user_email', '$password')";

                mysqli_query($con, $query);

                // redirect the user to the login page
                header("Location: login.php");
                die;
            }
        }
        else{
            echo "Please enter valid information";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <style type="text/css">

        #text{
            height: 25px;
            border-radius: 5px;
            padding: 4px;
            border: solid thin #aaa;
            width: 100%;
        }
        #button{
            padding: 10px;
            width: 100px;
            color: white;
            background-color: cadetblue;
            border: none;
        }

        #box{
            background-color: gray;
            margin: auto;
            width: 300px;
            padding: 20px;
        }
    </style>

    <div id="box">
        <form action="" method="post">
            <div style="font-size: 20px; margin: 10px;color:white">
                Sign up
            </div>

            <!-- usertype dropdown menu-->
            <select id="text" name="user_type">
                <option value="Student">Student</option>
                <option value="Faculty">Faculty</option>
                <option value="Staff">Staff</option>
                <option value="Admin">Admin</option>
            </select><br><br>
            <!--  username -->
            <input id="text" type="text" name="user_name" placeholder="Name"><br><br>
            <!-- user email -->
            <input id="text" type="email" name="user_email" placeholder="Email ID"><br><br>
            <!-- password -->
            <input id="text" type="password" name="password" placeholder="Password"><br><br>
            <!-- confirm password -->
            <input id="text" type="password" name="conPwd" placeholder="Confirm Password"><br><br>

            <!-- submit button -->
            <input id="button" type="submit" value="Sign Up"><br><br>

            <a href="login.php">Click to log in</a>
        </form>
    </div>
</body>
</html>