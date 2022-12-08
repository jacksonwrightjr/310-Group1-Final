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

$serviceID = $_POST['delete'];

$sql_del="DELETE FROM service WHERE service_id = $serviceID";
if(mysqli_query($con, $sql_del))
    {
        Print '<script>alert("Service deleted!");</script>';     
        Print '<script>window.location.assign("service.php");</script>';
    }
    else
    {
        Print '<script>alert("Service not deleted");</script>';     
        Print '<script>window.location.assign("service.php");</script>';
    }
?>