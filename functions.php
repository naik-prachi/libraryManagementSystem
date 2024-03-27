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

// get count of borrowed copies
function get_borrowed_book_count()
{
    include ("../connection.php");
    $borrowed_book_count = 0;
    $query = "SELECT sum(borrowed_copies) AS borrowed_copy_count FROM books";
    $query_run = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($query_run)) {
        $borrowed_book_count = $row['borrowed_copy_count'];
    }
    return ($borrowed_book_count);
}

// to return count of books that are past their due
function get_past_due_count()
{
    include ("../connection.php");
    $past_due_count = 0;
    $query = "SELECT count(*) AS past_due_count 
            FROM issuedbook
            WHERE due_date < CURDATE() AND returned_date IS NULL";
    $query_run = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($query_run)) {
        $past_due_count = $row['past_due_count'];
    }
    return ($past_due_count);
}

// to return count of books that are due for return
function get_due_book_count()
{
    include ("../connection.php");
    $due_book_count = 0;
    $query = "SELECT count(*) as due_book_count from issuedbook where due_date = CURDATE()";
    $query_run = mysqli_query($con, $query);
    while ($row = mysqli_fetch_assoc($query_run)) {
        $due_book_count = $row['due_book_count'];
    }
    return ($due_book_count);
}

// view of students due to return book today
function view_issued_book()
{
    include ("../connection.php");
    $user_data = check_login($con);

    // join table books and issuedbook
    $query = "SELECT * FROM issuedbook i 
          JOIN books b ON i.ISBN = b.ISBN 
          JOIN users u ON i.college_id = u.college_id
          WHERE i.due_date > CURDATE() AND i.returned_date IS NULL";

    return ($query);
}

// to show students/faculties whos books are due today
function view_students_due_today()
{
    include ("../connection.php");

    // join table books and issuedbook
    $query = "SELECT * FROM issuedbook i 
          JOIN books b ON i.ISBN = b.ISBN 
          JOIN users u ON i.college_id = u.college_id
          WHERE i.due_date = CURDATE() AND i.returned_date IS NULL";

    return ($query);
}

// to show details of students and faculty who have past due books
function view_students_past_due()
{
    include ("../connection.php");

    // join table books and issuedbook
    $query = "SELECT * FROM issuedbook i 
          JOIN books b ON i.ISBN = b.ISBN 
          JOIN users u ON i.college_id = u.college_id
          WHERE i.due_date < CURDATE() AND i.returned_date IS NULL";

    return ($query);
}

// VIEW to view details of students and faculties
function view_student_faculty()
{
    include ("../connection.php");
    // Query the view_student_faculty to retrieve user details
$query = "SELECT * FROM view_student_faculty";

    return ($query);
}

    function view_all_books()
{
    include ("../connection.php");
    // Query the view_student_faculty to retrieve user details
$query = "SELECT ISBN, book_title, book_author, book_subject, available_copies FROM books";

    return ($query);
}


