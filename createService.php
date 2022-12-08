<html>
    <head>
        <title>My first PHP Website</title>
    </head>
    <?php
    session_start(); //starts the session
    if($_SESSION['user']){ // checks if the user is logged in  
    }
    else{
        header("location: index.php"); // redirects if user is not logged in
    }
    $user = $_SESSION['user']; //assigns user value
    ?>
    <body>
        <h2>Create a new Service</h2>
        <a href="service.php">Back to Service Page</a>
        <a href="logout.php">Click here to go logout</a>
        
        <form action="createService.php" method="post">
        Service Est. Time: <input type="text" name="serviceEstTime"><br>
        Service Name: <input type="text" name="serviceName"><br>
        Service Price: <input type="text" name="servicePrice"><br>
        Service Description: <input type="text" name="serviceDesc"><br>
        <input type="submit">
        </form>

	</body>
</html>

<?php
if ($_POST) {
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

    $serviceEstTime = $_POST['serviceEstTime'];
    $serviceName = $_POST['serviceName'];
    $servicePrice = $_POST['servicePrice'];
    $serviceDesc = $_POST['serviceDesc'];

    $sql = "INSERT INTO service (service_id, service_est_time, service_name, service_price, service_description)
            VALUES (0,
            $serviceEstTime,
            '$serviceName',
            $servicePrice,
            '$serviceDesc'
            )";

    echo $sql;

    // insert in database 
    if(mysqli_query($con, $sql))
    {
        Print '<script>alert("Service created!");</script>';     
        Print '<script>window.location.assign("service.php");</script>';
    }
    else
    {
        Print '<script>alert("Service not created");</script>';     
        Print '<script>window.location.assign("createService.php");</script>';
    }
}
?>