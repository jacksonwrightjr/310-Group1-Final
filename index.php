<html>
    <head>
        <title>Login</title>
        <link rel = "stylesheet" href = "style.css">
        <!-- <link rel= "icon" type = "image" href = "img/tooth.png"> -->
        <link rel="icon" type="image/x-icon" href="img/favicon.ico">

    </head>
    <body style="background-color:rgb(232, 231, 220);">
    <div class = "topnav">
    <a style="font-family: Arial, Helvetica, sans-serif; font-weight:bold">Aggie Dentistry</a>

    <div class="topnav-right">
    <a href = "#googleMapsElement" style="font-family: Arial, Helvetica, sans-serif; font-weight:bold">Need Directions?</a>
    </div>
  </div>

        <!-- <a href="login.php"> Click here to login
        <a href="register.php"> Click here to register -->
        <div class = "imgcontainer" style = "margin-left:auto;margin-right:auto;">
          <img src="img/tooth.png" alt="Tooth logo" style="height:30%;width: 20%; text-align: center;" alt="Avatar" class="avatar">
          <p style="font-family: Arial, Helvetica, sans-serif; font-weight:bold">Welcome to the Aggieland Dentistry Portal! Sign in or <a href="register.php">create an account</a>.</p>
        </div>

        <form action="checklogin.php" method="POST" style = "text-align:center">
          <div class="container">

             Enter Username: <input type="text" name="username" required="required" /> <br/>
             Enter Password: <input type="password" name="password" required="required" /> <br/>
             <button type="submit" value="Login"> <b style="font-family: Arial, Helvetica, sans-serif; font-weight:bold; font-size:medium;">Login </b></button>

             <!-- <label for="uname"><b style="font-family: Arial, Helvetica, sans-serif; font-weight:bold">Username: </b></label>
            <input type="text" placeholder="Enter Username" name="id" required>
            <br>
            <br>
            <label for="psw"><b style="font-family: Arial, Helvetica, sans-serif; font-weight:bold">Password: </b></label>
            <input type="password"  placeholder="Enter Password" name="pass" required>
            <br>
            <button type="submit" value="Submit"> <b style="font-family: Arial, Helvetica, sans-serif; font-weight:bold">Login </b></button> -->

           </div>
        </form>


        
        <ul>
        <div style = "margin-left:auto;margin-right:auto; list-style-type:none;" class = "container">
        <iframe  id = "googleMapsElement" style = "margin-left:auto;margin-right:auto;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3433.769723482185!2d-96.3415445!3d30.612257799999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86468398550f7f1d%3A0x9dc3b5de86caa9a4!2sMemorial%20Student%20Center%2C%20275%20Joe%20Routt%20Blvd%2C%20College%20Station%2C%20TX%2077840!5e0!3m2!1sen!2sus!4v1670523414518!5m2!1sen!2sus" width="600" height="450" style="border:0; align-text:center;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        </ul>
    
    <!-- <div class="footer"><strong style="color: white;">Thank you for visiting Aggieland Dentistry!</strong></div> -->
    </body>
</html>
