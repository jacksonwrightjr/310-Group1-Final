<html>
    <head>
        <title>Services</title>
        <link rel = "stylesheet" href = "style.css">
        <!-- <link rel= "icon" type = "image" href = "img/tooth.png"> -->
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    </head>
    
    <body style="background-color:rgb(232, 231, 220);">
    <div class = "topnav">
    <a style="font-family: Arial, Helvetica, sans-serif; font-weight:bold">Aggie Dentistry</a>
    <a style="font-family: Arial, Helvetica, sans-serif; font-weight:bold" href = "userhome.php"> Home </a>
    


    <div class="topnav-right">
    <a style="font-family: Arial, Helvetica, sans-serif; font-weight:bold" href = "logout.php"> Logout </a>
    </div>
    </div>
    <div style = "margin-left:auto;margin-right:auto;" class = "imgcontainer">

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
        <p>Here is a list of available services for you, <?php Print "$user"?>.</p>
        <!-- <a href="logout.php">Click here to go logout</a>
        <a href="scheduleApp.php">Click here to schedule an appointment</a> -->
        <h2 style="align: center">Services</h2>
        <?php
        // database connection vars
        $servername = "localhost";
        $db_username = "root";
        $db_password = "root";
        $dbname = "310-project";

        // boolean for is the user is admin or not
        $isAdmin = false;
        $userid = $_SESSION['userid'];

        // Create connection
        $con = new mysqli($servername, $db_username, $db_password, $dbname);

        // Check connection
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }
        // see if the user is admin or user
            $query = "SELECT is_admin FROM profile WHERE username = '$user' AND profile_id = $userid";
            $result = mysqli_query($con, $query); // Select rows with same username
            $exists = mysqli_num_rows($result); // count the number of rows, if greater than zero then username exists
            // printf("Result set has %d rows.\n",$exists);
            if($exists > 0) //IF there are no returning rows or no existing username
            {
                $row = mysqli_fetch_array($result);
                if ($row[0] == 1) {
                    // ADMIN
                    $isAdmin = true;
                } else {
                    // USER (NOT ADMIN)
                    $isAdmin = false;
                }
            }
            ?>
            <?php if($isAdmin == true) : ?>
                <a href="createService.php">Create a Service</a>
                <table style="border: 1px" width="100%">
                <tr>
                    <th>Service Number</th>
                    <th>Service Est. Time</th>
                    <th>Service Name</th>
                    <th>Service Price</th>
                    <th>Service Description</th>
                    <th></th>
                </tr>   
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

                    $query = "SELECT * FROM service";
                    $result = mysqli_query($con, $query); // Select rows with same username
                    $exists = mysqli_num_rows($result); // count the number of rows, if greater than zero then username exists
                    // //printf("Result set has %d rows.\n",$exists);
                    if($exists > 0) //IF there are no returning rows or no existing username
                    {
                        $count = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>
                                    <th><p>$row[0]</p></th>
                                    <th>$row[1]</th>
                                    <th>$row[2]</th>
                                    <th>$row[3]</th>
                                    <th>$row[4]</th>
                                    <th><form action='deleteService.php' method='post'><input type='hidden' name='delete'
                                    value=$row[0]><input type='submit' value='DELETE'>
                                    </form></th>
                                </tr>";
                            $count += 1;
                        }
                    }

                ?>
                </table>
            <?php elseif($isAdmin == false) : ?>
                <table style="border: 1px" width="100%">
                <tr>
                    <th>Service Number</th>
                    <th>Service Est. Time</th>
                    <th>Service Name</th>
                    <th>Service Price</th>
                    <th>Service Description</th>
                </tr>   
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

                    $query = "SELECT * FROM service";
                    $result = mysqli_query($con, $query); // Select rows with same username
                    $exists = mysqli_num_rows($result); // count the number of rows, if greater than zero then username exists
                    // //printf("Result set has %d rows.\n",$exists);
                    if($exists > 0) //IF there are no returning rows or no existing username
                    {
                        $count = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            // get doctor info
                            // $getDoctorName = "SELECT user_fname, user_lname FROM profile WHERE profile_id = $row[7]";
                            // $docresult = mysqli_query($con, $getDoctorName); // Select rows with same username
                            // $doctor = mysqli_fetch_array($docresult);
                            // get service info
                            // $getServiceName = "SELECT service_name FROM service WHERE service_id = $row[5]";
                            // $serviceresult = mysqli_query($con, $getServiceName); // Select rows with same username
                            // $service = mysqli_fetch_array($serviceresult);
                            echo "<tr>
                                    <th><p>$row[0]</p></th>
                                    <th>$row[1]</th>
                                    <th>$row[2]</th>
                                    <th>$row[3]</th>
                                    <th>$row[4]</th>
                                </tr>";
                            $count += 1;
                        }
                    }

                ?>
                </table>
            <?php endif; ?>
            </div> 
	</body>
</html>