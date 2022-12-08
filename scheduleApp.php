<html>
    <head>
        <title>Schedule</title>
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
        <h2>Schedule an Appointment</h2>
        <!-- <a href="logout.php">Click here to go logout</a><br> -->
        <form action="scheduleApp.php" method="POST">
            Select a service: <select name="service" id="service">
                <option value="Consultation">Consultation</option>
                <option value="Teeth Cleaning">Teeth Cleaning</option>
                <option value="Teeth Whitening">Teeth Whitening</option>
                <option value="Tooth Extraction">Tooth Extraction</option>
                <option value="Root Canal">Root Canal</option>
            </select>
            <br>
            <br>
            Select a dentist: <select name="dentist" id="dentist">
                <option value="Gage Broberg">Gage Broberg</option>
                <option value="Jackson Wright">Jackson Wright</option>
                <option value="Kieran Bierne">Kieran Bierne</option>
                <option value="Shane Brown">Shane Brown</option>
            </select>
            <br>
            <br>
            Choose a time for your appointment: 
            <?php
                session_start(); //starts the session
                date_default_timezone_set("America/Chicago");
                $dt = new DateTime();
                echo '<input type="datetime-local" name="apptime" value="' . $dt->format('Y-m-d H:i:s') . '" min="' . $dt->format('Y-m-d H:i:s') . '"/>';
            ?> 
            <input type="submit" value="Submit"/>
        </form>
            </div>
	</body>
</html>

<?php
if($_POST) {

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

    // Setting the times in minutes for services
    $serviceTimes = array();
    $serviceTimes['Consultation'] = 30;
    $serviceTimes['Teeth Cleaning'] = 45;
    $serviceTimes['Teeth Whitening'] = 45;
    $serviceTimes['Tooth Extraction'] = 60;
    $serviceTimes['Root Canal'] = 120;

    // Setting the prices in dollars per service
    $servicePrice = array();
    $servicePrice['Consultation'] = 50;
    $servicePrice['Teeth Cleaning'] = 80;
    $servicePrice['Teeth Whitening'] = 100;
    $servicePrice['Tooth Extraction'] = 200;
    $servicePrice['Root Canal'] = 300;

    // Setting othe appointment information for post request
    $service = $_POST['service'];
    $dentistFullName = explode(" ", $_POST['dentist']);
    $dentistFirstName = $dentistFullName[0];
    $dentistLastName = $dentistFullName[1];
    $appDateTime = $_POST['apptime'];
    $appDate = DateTime::createFromFormat("Y-m-d\TH:i:s", $appDateTime)->format("Y-m-d");
    $app_start_time = DateTime::createFromFormat("Y-m-d\TH:i:s", $appDateTime)->format("H:i:s");
    $app_finish_time = date("H:i:s", strtotime("+$serviceTimes[$service] minutes"));
    $user = $_SESSION['user'];

    echo $serviceTimes[$service] . "\n";
    echo $service . "\n";
    echo $dentistFirstName . "\n";
    echo $dentistLastName . "\n";
    echo $appDate . "\n";
    echo $app_start_time . "\n";
    echo $app_finish_time . "\n";
    echo $servicePrice[$service] . "\n";

    $sql = "INSERT INTO appointment (apt_id, apt_date, apt_start_time, apt_end_time, apt_price, service_id, user_id, admin_id, comment_id, review_id) 
            VALUES (0, 
            '$appDate', 
            '$app_start_time', 
            '$app_finish_time', 
            $servicePrice[$service], 
            (SELECT service_id FROM service WHERE service_name = '$service'),
            (SELECT profile_id FROM profile WHERE username = '$user' AND is_admin = 0), 
            (SELECT profile_id FROM profile WHERE user_fname = '$dentistFirstName' AND user_lname = '$dentistLastName' AND is_admin = 1), 
            NULL, 
            NULL)";

    echo $sql;

    // insert in database 
    if($con->query($sql) === TRUE)
    {
        Print '<script>alert("Appointment registered!");</script>';     
        Print '<script>window.location.assign("userhome.php");</script>';
    }
    else
    {
        Print '<script>alert("Appointment not registered");</script>';     
        Print '<script>window.location.assign("scheduleApp.php");</script>';
    }
}
?>