<?php 

    function check_login($con){
        // check if session value is set
        if(isset($_SESSION['user_id'])){
            $id = $_SESSION['user_id'];
            $query = "select * from userss where user_id = '$id' limit 1";

            // read from the database and get a result
            $result = mysqli_query($con, $query);

            // check if the result is positive & no. of rows is greater than zero
            if($result && mysqli_num_rows($result) > 0){
                $user_data = mysqli_fetch_assoc($result);       // assoc -> associated array
                return $user_data;
            }
        }

        // redirect to login
        header("Location: login.php");
        die;                                    // makes sure that the code doesn't continue
    }

    function random_num($length){
        $text = '';

        if($length < 5){
            $length = 5;
        }

        // gets  a random number + 4 should be smaller than $length, hence why $length is min 5
        $len = rand(4, $length);

        for ($i=0; $i < $len; $i++) { 
            # code...
            // adds to the text
            $text .= rand(0, 9);
        }
        return $text;
    }