<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
}



?>

<!DOCTYPE html>
<html>
<head>
    <title>DoD Beneficiary Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <meta name="viewport" content="width=device-width">
	
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
      <!--add this to every page as well for parse DB*/-->
      <script type="text/javascript" src="http://www.parsecdn.com/js/parse-1.4.2.min.js"></script>
</head>
<body>
     
	<h1> Required Documents </h1> 
<div id="user-info">
        Signed in as: <?=$_SESSION['username']?> (<a href="logout.php" class="log-out">Log out</a>)<br><br>
      </div>
    
		<nav>
		<a href="logout.php"> Logout </a>
		<a href="signup.html"> Sign Up Page </a>
		<a href="family.html"> Family Page </a>
		<a href="profile.html"> Profile </a>
		</nav>
		<br />
    
       
	
	<!-- display documents from database from a table -->
	<!-- user can upload documents to the database -->
<form method="post" enctype="multipart/form-data"> 
	Select a File to upload:<br> 
		<input type="file" name="fileName" /> <br />
		<input type="submit"  name="uploadForm" value="Upload File" /> 
</form>

    
</body>
</html>