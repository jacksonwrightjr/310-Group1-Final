<?php
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

$apt = $_POST['apt_del'];

$sql_del="DELETE FROM appointment WHERE apt_id = $apt";
if(mysqli_query($con, $sql_del))
    {
        Print '<script>alert("Appointment deleted!");</script>';     
        Print '<script>window.location.assign("userhome.php");</script>';
    }
    else
    {
        Print '<script>alert("Appointment not deleted");</script>';     
        Print '<script>window.location.assign("userhome.php");</script>';
    }
?>