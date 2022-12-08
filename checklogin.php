<?php
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $bool = true;

    // database connection vars
    $servername = "localhost";
    $db_username = "root";
    $db_password = "root";
    $dbname = "310-project";

// test comment2

    // Create connection
    $con = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $query = "SELECT * FROM profile WHERE username='$username'";
    $result = mysqli_query($con, $query); // Select rows with same username
    $exists = mysqli_num_rows($result); // count the number of rows, if greater than zero then username exists
    //printf("Result set has %d rows.\n",$exists);
    $table_users = "";
    $table_password = "";
    if($exists > 0) //IF there are no returning rows or no existing username
    {
       while ($row = mysqli_fetch_array($result)) {
            $table_users = $row[1];     // the first username row is 
                                                // passed on to $table_users, 
                                                // and so on until the query is finished
            $table_password = $row[2];  // the first password row is passed on 
                                               // to $table_password, and so on 
                                               // until the query is finished

            echo $table_users;
            echo $table_password;

            if($username == $table_users)  {
                if($password == $table_password) {
                    $_SESSION['user'] = $username;
                    $_SESSION['userid'] = $row[0];    // set the username in a session. 
                                                    // This serves as a global variable
                    header("location: userhome.php");     // redirects the user to the authenticated 
                                                    // home page
                }
                else {
                    Print '<script>alert("Incorrect Password!");</script>';        // Prompts the user
                    Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
                }
            }
        }
    } else {
        Print '<script>alert("Incorrect username!");</script>';        // Prompts the user
        Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
    }
?>
