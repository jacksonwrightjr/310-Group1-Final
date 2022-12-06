<html>
    <head>
        <title>My first PHP Website</title>
    </head>
    <body>
        <h2>Schedule Appointment</h2>
        <a href="logout.php">Click here to go logout</a><br>
        <form action="scheduleApp.php" method="POST">
            Select a service: <select name="service" id="service">
                <option value="consultation">Consultation</option>
                <option value="teeth_cleaning">Teeth Cleaning</option>
                <option value="teeth_whitening">Teeth Whitening</option>
                <option value="tooth_extraction">Tooth Extraction</option>
                <option value="root_canal">Root Canal</option>
            </select>
            Select a dentist: <select name="dentist" id="dentist">
                <option value="Gage">Gage</option>
                <option value="Jackson">Jackson</option>
                <option value="Kieran">Kieran</option>
                <option value="Shane">Shane</option>
            </select>
            Choose a time for your appointment: 
            <?php
                date_default_timezone_set("America/Chicago");
                $dt = new DateTime();
                echo '<input type="datetime-local" name="apptime" value="' . $dt->format('Y-m-d H:i') . '" min="' . $dt->format('Y-m-d H:i') . '"/>';
            ?> 
            <input type="submit" value="Submit"/>
        </form>
    	
	</body>
</html>

<?php
if($_POST) {

    $serviceTimes = array();
    $serviceTimes['consultation'] = 30;
    $serviceTimes['teeth_cleaning'] = 45;
    $serviceTimes['teeth_whitening'] = 45;
    $serviceTimes['tooth_extraction'] = 60;
    $serviceTimes['root_canal'] = 120;

    $service = $_POST['service'];
    $dentist = $_POST['dentist'];
    $apptime = $_POST['apptime'];
    $finish_time = date("Y/m/d H:i", strtotime("+$serviceTimes[$service] minutes"));

    echo $serviceTimes[$service];
    echo $service;
    echo $dentist;
    echo $apptime;
    echo $finish_time;
}
?>