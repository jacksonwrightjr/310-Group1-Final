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
        <h2>Home Page</h2>
        <p>Hello <?php Print "$user"?>!</p> <!--Displays user's name-->
        <a href="logout.php">Click here to go logout</a>
        <a href="scheduleApp.php">Click here to schedule an appointment</a>
    	<h2 style="align: center">Appointments</h2>
        <table style="border: 1px" width="100%">
            <tr>
                <th>Appointment Number</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Doctor</th>
                <th>Service</th>
                <th>Price</th>
                <th>Comments</th>
                <th>Review</th>
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

            $query = "SELECT * FROM appointment WHERE user_id = (SELECT profile_id FROM profile WHERE username = '$user' AND is_admin = 0)";
            $result = mysqli_query($con, $query); // Select rows with same username
            $exists = mysqli_num_rows($result); // count the number of rows, if greater than zero then username exists
            // //printf("Result set has %d rows.\n",$exists);
            if($exists > 0) //IF there are no returning rows or no existing username
            {
                $count = 1;
                while ($row = mysqli_fetch_array($result)) {
                    // get doctor info
                    $getDoctorName = "SELECT user_fname, user_lname FROM profile WHERE profile_id = $row[7]";
                    $docresult = mysqli_query($con, $getDoctorName); // Select rows with same username
                    $doctor = mysqli_fetch_array($docresult);
                    // get service info
                    $getServiceName = "SELECT service_name FROM service WHERE service_id = $row[5]";
                    $serviceresult = mysqli_query($con, $getServiceName); // Select rows with same username
                    $service = mysqli_fetch_array($serviceresult);
                    echo "<tr>
                            <th>$count</th>
                            <th>$row[1]</th>
                            <th>$row[2]</th>
                            <th>$doctor[0] $doctor[1]</th>
                            <th>$service[0]</th>
                            <th>$$row[4]</th>
                            <th><a href='comment.php'>Leave a comment</a></th>
                            <th><a href='review.php'>Leave a review</a></th>
                        </tr>";
                    $count += 1;
                }
            }

        ?>
		</table>
	</body>
</html>