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
        <a href="logout.php">Click here to go logout</a><br/><br/>
        <form action="add.php" method="POST">
            Add more to list: <input type="text" name="details" /> <br/>
            Public post? <input type="checkbox" name="public[]" value="yes" /> <br/>
            <input type="submit" value="Add to list"/>
        </form>
    	<h2 style="align: center">My list</h2>
    	<table style="border: 1px" width="100%">
		<tr>
			<th>Id</th>
			<th>Details</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		</table>
	</body>
</html>