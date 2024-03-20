<?php
    session_start();

    include ("connection.php");  //connecting to the database
    include ("functions.php");   //calling the functions

    // check if the user has clicked on the post button
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        // something was posted
        // collect the data from post variable
        $user_email = $_POST['user_email'];
        $password = $_POST['password'];

        // check if both are not empty
        if (!empty ($user_email) && !empty ($password) && !is_numeric($user_email)) {
            // read from db
            $query = "select * from userss where user_email = '$user_email' limit 1";

            // need the result
            $result = mysqli_query($con, $query);

            if ($result) {
                // check if the result is positive & no. of rows is greater than zero
                if ($result && mysqli_num_rows($result) > 0) {
                    $user_data = mysqli_fetch_assoc($result);       // assoc -> associated array

                    if ($user_data['password'] === $password) {
                        $_SESSION['user_id'] = $user_data['user_id'];

                        // redirect to admin homepage
                        if($user_data['user_type'] === 'Admin'){
                            header("Location: adminHomepage.php");
                            exit;
                        }

                        // redirect to staff homepage
                        if($user_data['user_type'] === 'Staff'){
                            header("Location: staffHomepage.php");
                            exit;
                        }

                        // redirect to s/f homepage
                        if($user_data['user_type'] === 'Student' || $user_data['user_type'] === 'Faculty'){
                            header("Location: sfHomepage.php");
                            exit;
                        }


                        // redirect the user to the index page
                        // header("Location: index.php");
                        // die;
                    }
                }
            }
            echo "Wrong username or password!";


        } else {
            echo "Please enter some valid information";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
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
                    Login
                </div>

                <input id="text" type="email" name="user_email" placeholder="Email ID"><br><br>

                <input id="text" type="password" name="password" placeholder="Password"><br><br>

                <input id="button" type="submit" value="Login"><br><br>

                

                <a href="signup.php">Click to sign Up</a>
            </form>
        </div>


    </body>

</html>