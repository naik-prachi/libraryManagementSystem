<?php 


    // to check if the user is logged in, if not redirect to  login page.
    function check_login($con){
        // check if session value is set
        if(isset($_SESSION['user_id'])){
            $id = $_SESSION['user_id'];
            $query = "select * from users where user_id = '$id' limit 1";

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
        exit;                                    // makes sure that the code doesn't continue
    }

    // to find random values for ids
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

    // to return the count of borrowed books by the user
    function get_user_borrowed_book_count()
{
    include ("../connection.php");
    $user_data = check_login($con);
    $user_issue_book_count = 0;
    $query = "select count(*) as user_issue_book_count from issuedbook where college_id = $user_data[college_id]";
    $query_run = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($query_run)) {
        $user_issue_book_count = $row['user_issue_book_count'];
    }
    return ($user_issue_book_count);
}

    // to return the count of the user's books that are due soon 
function get_user_book_due_count()
{
    include ("../connection.php");
    $user_data = check_login($con);
    $user_due_book_count = 0;
    $query = "select count(*) as user_due_book_count from issuedbook where due_date = CURDATE()";
    $query_run = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($query_run)) {
        $user_due_book_count = $row['user_due_book_count'];
    }
    return ($user_due_book_count);
}

// to return the count of user's boooks that are past due date
function get_user_past_due_count()
{
    include ("../connection.php");
    $user_past_due_count = 0;
    $query = "SELECT count(*) as user_past_due_count from issuedbook where due_date < CURDATE()";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $user_past_due_count = $row['user_past_due_count'];
    }
    return ($user_past_due_count);
}

// to show the records of all the books issued by the user
function view_students_book_due()
{
    include ("../connection.php");
    $user_data = check_login($con);

    // join table books and issuedbook
    $query = "select * from issuedbook i 
                join books b 
                where i.ISBN = b.ISBN and college_id = $user_data[college_id]";
    return ($query);
}

// $due_today = 0;
// $query = "SELECT count(*) AS due_today count 
//         from issuedbook where due_date = CURDATE() 
//         AND college_id = $user_data[college_id]";
// $result = mysqli_query($con, $query);
// if ($due_today > 0) {
//     // display alert box
//     echo '<script>alert("BOOK(s) due today! Please return on time to avoid fine.")</script>';    
// }


