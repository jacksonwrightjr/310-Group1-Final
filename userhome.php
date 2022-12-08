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
        <h2 style="align: center">Available Services</h2>
        <a href="service.php">See Offered Services</a>
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
            <form action='userhome.php' method='POST'>
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
            $appIds = array();
            // //printf("Result set has %d rows.\n",$exists);
            if($exists > 0) //IF there are no returning rows or no existing username
            {
                $count = 1;
                while ($row = mysqli_fetch_array($result)) {
                    // add the appId to array
                    $appIds[$count - 1] = $row[0];
                    // get doctor info
                    $getDoctorName = "SELECT user_fname, user_lname FROM profile WHERE profile_id = $row[7]";
                    $docresult = mysqli_query($con, $getDoctorName); // Select rows with same username
                    $doctor = mysqli_fetch_array($docresult);
                    $doctors[$count - 1] = $doctor;
                    // get service info
                    $getServiceName = "SELECT service_name FROM service WHERE service_id = $row[5]";
                    $serviceresult = mysqli_query($con, $getServiceName); // Select rows with same username
                    $service = mysqli_fetch_array($serviceresult);
                    // get comment info
                    if(!is_null($row[8])) {
                        $getComment = "SELECT comment_value FROM comment WHERE comment_id = $row[8]";
                        $commentresult = mysqli_query($con, $getComment); // Select rows with same username
                        $comment = mysqli_fetch_array($commentresult);
                    } else {
                        $getComment = "SELECT comment_value FROM comment WHERE comment_id = NULL";
                        $commentresult = mysqli_query($con, $getComment); // Select rows with same username
                        $comment = mysqli_fetch_array($commentresult);
                    }
                    echo "<tr>
                            <th>$count</th>
                            <th>$row[1]</th>
                            <th>$row[2]</th>
                            <th>$doctor[0] $doctor[1]</th>
                            <th>$service[0]</th>
                            <th>$row[4]</th>
                            <th><textarea name='comment$row[0]' cols='40' rows='5'>$comment[0]</textarea><input type='submit' value='Submit'/></th>
                            <th><a href='review.php'>Leave a review</a></th>
                            <form action='deleteService.php' method='post'><input type='hidden' name='delete'
                                value=$row[0]><input type='submit' value='DELETE'>
                            </form>
                        </tr>";
                    $count += 1;
                }
            }

        ?>
        </form>
		</table>
	</body>
</html>

<?php
if($_POST) {
    $date = date('Y-m-d H:i:s');
    for ($x = 0; $x < $exists; $x++) {
        // echo $appIds[$x];
        // echo $doctors[$x][0];
        $doctorFirstName = $doctors[$x][0];
        $doctorLastName = $doctors[$x][1];
        $comment = $_POST["comment$appIds[$x]"];
        echo $comment;
        // echo $comment;
        $sql = "INSERT INTO comment (comment_id, comment_date, comment_value, user_id, admin_id, apt_id) VALUES (0, '$date', '$comment', (SELECT profile_id FROM profile WHERE username = '$user' AND is_admin = 0), (SELECT profile_id FROM profile WHERE user_fname = '$doctorFirstName' AND user_lname = '$doctorLastName' AND is_admin = 1), $appIds[$x])";
        echo $sql;
        // $sql = "UPDATE appointment SET comment_id WHERE clause to select which records to change";
        if($con->query($sql) === TRUE) {
            Print '<script>alert("Successfully added comment!");</script>';     
            Print '<script>window.location.assign("userhome.php");</script>';
        } else {
            Print '<script>alert("Comment not added!");</script>';     
            Print '<script>window.location.assign("userhome.php");</script>';
        }
    }
}
?>