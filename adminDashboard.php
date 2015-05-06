<?php

session_start();



if(!isset($_SESSION['usernameAdmin'])){

header("Location: adminLogin.php");

}


?>

<!DOCTYPE html>
<html>
<head>
    <title>DoD Beneficiary ADMIN Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <meta name="viewport" content="width=device-width">
	
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
      <!--add this to every page as well for parse DB*/-->
      <script type="text/javascript" src="http://www.parsecdn.com/js/parse-1.4.2.min.js"></script>
    
    
        <nav>
        <a  id="navlinks" href="dashboard.php"><img src="img/dashboard.png" width="35" height="35"></a>
		<a  id="navlinks" href="Index.html"> &nbsp; Home Page &nbsp; </a>
        <a  id="logout" href="includes/logout.php"> (Logout: <?=$_SESSION['usernameAdmin']?>) &nbsp;  </a>
		</nav>
          
      
</head>
<body>
	<h1> ADMIN Dashboard </h1> 
    <h4> Welcome <?=$_SESSION['name']?>!  </h4>
    <img src="img/todo.png">
    
		
		<br />
    Test: <?=$_SESSION['IDCardImg']?> 
       
	
	<!-- display documents from database from a table -->
<H1>ID Card</H1>
    
      <!-- user can upload documents to the database -->
      <form method="post" action="includes/uploadID.php" enctype="multipart/form-data">

      Select image: <input type="file" name="fileName" />

      <input type="submit"  value="upload" name="uploadForm"/>

      </form>

      <?php

      if(empty($_SESSION['IDCardImg'])){

      echo "<img width='500' height='400' src='img/Sample-ID.jpg' alt='Unknown user' ></img>";

      } else{

      // display user's profile picture

      echo "<img src=img/" . $_SESSION['username'] . "/" . $_SESSION['IDCardImg'];
       }

      ?>



    
</body>
</html>