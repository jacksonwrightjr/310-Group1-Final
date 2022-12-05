<html>
    <head>
        <title>My first PHP Website</title>
    </head>
    <body>
        <h2>Registration Page</h2>
        <a href="index.php">Click here to go back</a>
        <form action="register.php" method="POST">
           Enter Username: <input type="text" 
           name="username" required="required" /> <br/>
           Enter password: <input type="password" 
           name="password" required="required" /> <br/>
           Enter First Name: <input type="text" 
           name="first_name" required="required" /> <br/>
           Enter Last Name: <input type="text" 
           name="last_name" required="required" /> <br/>
           Enter Phone Number: <input type="text" 
           name="phone_num" required="required" /> <br/>
           Enter Admin Access Code: <input type="text" 
           name="access_code"/> <br/>
           <input type="submit" value="Register"/>
        </form>
    </body>
</html>

<?php
if($_POST) {

    $bool = true;

    // Save the username and password
    $username = $_POST['username'];
    $password = $_POST['password'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_num = $_POST['phone_num'];
    $date = date('Y-m-d');
    $access_code = $_POST['access_code'];
   
    // database connection vars
    $servername = "localhost";
    $db_username = "root";
    $db_password = "root";
    $dbname = "310-project";

    // Create connection
    $con = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $query = "SELECT * FROM profile";
    $result = mysqli_query($con, $query);

    while($row = mysqli_fetch_array($result, MYSQLI_NUM)) //display all rows from query
    {
        $table_users = $row[1]; // the first username row 
                                // is passed on to $table_users, 
                                // and so on until the query is finished
        if($username == $table_users)     // checks if there are any matching fields
        {
            $bool = false; // sets bool to false
            Print "<script>alert('Username has been taken!');</script>";     //Prompts the user
            Print "<script>window.location.assign('register.php');</script>";
                                            
        }
    }

    if($bool) // checks if bool is true
    {
        $is_admin = 0;
        if (isset($access_code) && $access_code == 1) {
            $is_admin = 1;
        } 
        $sql = "INSERT INTO profile (profile_id, username, password, user_fname, user_lname, user_phone, date_created, is_admin) VALUES (0, '$username', '$password', '$first_name', '$last_name', '$phone_num', '$date', '$is_admin')";
        // insert in database 
        if($con->query($sql) === TRUE)
        {
            Print '<script>alert("Successfully Registered!");</script>';     
            Print '<script>window.location.assign("register.php");</script>';
        }
        else
        {
            Print '<script>alert("Profile not registered");</script>';     
            Print '<script>window.location.assign("register.php");</script>';
        }
    }
}
?>