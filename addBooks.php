<?php
    session_start();

    include("connection.php");  //connecting to the database
    include("functions.php");   //calling the functions

    // check if the user has clicked on the post button
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // something was posted
        // collect the data from post variable

        $book_no = $_POST['book_no'];
        $book_title = $_POST['book_title'];
        $book_author = $_POST['book_author'];
        $book_subject = $_POST['book_subject'];
        $total_copies = $_POST['total_copies'];
        $available_copies = $_POST['available_copies'];

        // check if both are not empty
        if(!empty($book_no) && !empty($book_title) && !empty($book_author) && !empty($book_subject) && !empty($total_copies) && !empty($available_copies)){
            
            // save to db
            $book_id = random_num(20);
            $query = "insert into books (book_id, book_no, book_title, book_author, book_subject, total_copies, available_copies) values ('$book_id', '$book_no', '$book_title', '$book_author', '$book_subject', '$total_copies', '$available_copies')";

            mysqli_query($con, $query);

            // redirect the user to the login page
            echo ('Successful');
            
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
    <title>Add Books</title>
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
                Add Books
            </div>
            <!-- usertype dropdown menu-->

            <input id="text" type="number" name="book_no" placeholder="Bno"><br><br>
            <input id="text" type="text" name="book_title" placeholder="Book title"><br><br>
            <input id="text" type="text" name="book_author" placeholder="Author"><br><br>
            <input id="text" type="text" name="book_subject" placeholder="Book subject"><br><br>
            <input id="text" type="text" name="total_copies" placeholder="Total copies"><br><br>
            <input id="text" type="text" name="available_copies" placeholder="Currently available copied"><br><br>
            

            <input id="button" type="submit" value="Add"><br><br>

            <a href="">Update Book</a>
        </form>
    </div>
</body>
</html>