<html>
    <head>
        <title>Create Service</title>
        <link rel = "stylesheet" href = "style.css">
        <!-- <link rel= "icon" type = "image" href = "img/tooth.png"> -->
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">
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
    <body style="background-color:rgb(232, 231, 220);">
    <div class = "topnav">
    <a style="font-family: Arial, Helvetica, sans-serif; font-weight:bold">Aggie Dentistry</a>
    <a style="font-family: Arial, Helvetica, sans-serif; font-weight:bold" href = "userhome.php"> Home </a>
    <a style="font-family: Arial, Helvetica, sans-serif; font-weight:bold" href = "service.php"> Back to Service Page </a>



    <div class="topnav-right">
    <a style="font-family: Arial, Helvetica, sans-serif; font-weight:bold" href = "logout.php"> Logout </a>
    </div>
    </div>
    <div style = "margin-left:auto;margin-right:auto;" class = "imgcontainer">
        <h2>Create a new Service</h2>
        
        <form action="createService.php" method="post">
        Service Est. Time: <input type="text" name="serviceEstTime"><br>
        Service Name: <input type="text" name="serviceName"><br>
        Service Price: <input type="text" name="servicePrice"><br>
        Service Description: <input type="text" name="serviceDesc"><br>
        <input type="submit">
        </form>
    </div>
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