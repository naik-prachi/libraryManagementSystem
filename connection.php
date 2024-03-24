<!-- establishing db connection -->

<?php

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $dbname = "library_managment_system";

    // to connect to a database
    // if condition to catch any erros thrown during db connection
    if(!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)){
        die("Failed to connect!");
    }
   