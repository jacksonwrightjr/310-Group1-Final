<html>
    <head>
        <title>Homepage</title>
        <link rel = "stylesheet" href = "style.css">
        <!-- <link rel= "icon" type = "image" href = "img/tooth.png"> -->
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    </head>
    <body style="background-color:rgb(232, 231, 220);">

    <div class = "topnav">
    <a style="font-family: Arial, Helvetica, sans-serif; font-weight:bold">Aggie Dentistry</a>
    <a style="font-family: Arial, Helvetica, sans-serif; font-weight:bold" href = "userhome.php"> Home </a>
    <a style="font-family: Arial, Helvetica, sans-serif; font-weight:bold" href = "profile.php"> Profile </a>

    <div class="topnav-right">
    <a style="font-family: Arial, Helvetica, sans-serif; font-weight:bold" href = "logout.php"> Logout </a>
    </div>
    </div>
	    
    <?php
    session_start(); //starts the session
    if($_SESSION['user']){ // checks if the user is logged in  
    }
    else{
        header("location: index.php"); // redirects if user is not logged in
    }
    $user = $_SESSION['user']; //assigns user value
    $isAdmin = $_SESSION['admin'];
    $userid = $_SESSION['userid'];
    ?>
    <body>
    <div style = "text-align:center;">
        <!-- <a href="logout.php">Click here to go logout</a> -->
        
    	<h2 style="align: center">Profile</h2>
        </div>

        <?php if($isAdmin == 1) : ?>
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

                    $query = "SELECT * FROM profile WHERE profile_id = $userid AND username = '$user'";
                    $result = mysqli_query($con, $query); // Select rows with same username
                    $exists = mysqli_num_rows($result); // count the number of rows, if greater than zero then username exists
                    // //printf("Result set has %d rows.\n",$exists);
                    if($exists > 0) //IF there are no returning rows or no existing username
                    {
                        $count = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            Print "<p style = 'text-align:center; font-family: Arial, Helvetica, sans-serif;'>User Name: $row[1]</p>
                            <p style = 'text-align:center; font-family: Arial, Helvetica, sans-serif;'>First Name: $row[3]</p>
                            <p style = 'text-align:center; font-family: Arial, Helvetica, sans-serif;'>Last Name: $row[4]</p>
                            <p style = 'text-align:center; font-family: Arial, Helvetica, sans-serif;'>Phone Number: $row[5]</p>
                            <p style = 'text-align:center; font-family: Arial, Helvetica, sans-serif;'>Date Joined: $row[6]</p>
                            <p style = 'text-align:center; font-family: Arial, Helvetica, sans-serif;'>Account Type: ADMIN</p>";
                            $count += 1;
                        }
                    }

                ?>
            
        <?php elseif($isAdmin == 0) : ?> 
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

                    $query = "SELECT * FROM profile WHERE profile_id = $userid AND username = '$user'";
                    $result = mysqli_query($con, $query); // Select rows with same username
                    $exists = mysqli_num_rows($result); // count the number of rows, if greater than zero then username exists
                    // //printf("Result set has %d rows.\n",$exists);
                    if($exists > 0) //IF there are no returning rows or no existing username
                    {
                        $count = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            Print "<p style = 'text-align:center; font-family: Arial, Helvetica, sans-serif;'>User Name: $row[1]</p>
                            <p style = 'text-align:center; font-family: Arial, Helvetica, sans-serif;'>First Name: $row[3]</p>
                            <p style = 'text-align:center; font-family: Arial, Helvetica, sans-serif;'>Last Name: $row[4]</p>
                            <p style = 'text-align:center; font-family: Arial, Helvetica, sans-serif;'>Phone Number: $row[5]</p>
                            <p style = 'text-align:center; font-family: Arial, Helvetica, sans-serif;'>Date Joined: $row[6]</p>
                            <p style = 'text-align:center; font-family: Arial, Helvetica, sans-serif;'>Account Type: USER</p>";
                            $count += 1;
                        }
                    }

                ?>
        <?php endif; ?>

        
	</body>
</html>
