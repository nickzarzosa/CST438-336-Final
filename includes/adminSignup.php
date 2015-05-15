<?php 
session_start(); 

     
    require 'dbConnection.php'; 
     
    $dbConn = getConnection(); 
     
    




$sql= "Insert INTO users (username, password, email, firstname, lastname, gender, dob, age, phone, lastDeployment, payGrade) 
VALUES (:username, :password, :email, :firstname, :lastname, :gender, :dob, :age, :phone, :lastDeployment, :payGrade)"; // using named parameters

$stmt = $dbConn -> prepare($sql); // preparing statement

$stmt -> execute( array(":username" => $_POST['username'],
                          ":password" => sha1($_POST['password']),
                          ":firstname" => $_POST['firstname'],
                          ":lastname" => $_POST['lastname'],
                          ":gender" => $_POST['gender'],
                          ":dob" =>$_POST['dob'],
                          ":age" =>$_POST['age'],
                          ":email" => $_POST['email'],
                          ":phone" => $_POST['phone'],
                          ":lastDeployment" => $_POST['lastDeployment'],
                          ":payGrade" => $_POST['pay'],
                       ));

    $_SESSION['created'] = $_POST['username'];

   
    
        
    header("Location: ../adminDashboard.php");

    

    
    ?>

<!DOCTYPE html>
<html>
<head>
    <title>DoD Beneficiary ADMIN Dashboard</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    
       <nav>
        <a  id="navlinks" href="../adminDashboard.php"><img src="../img/dashboard.png" width="35" height="35"></a>
		<a  id="navlinks" href="../Index.html"> &nbsp; Home Page &nbsp; </a>
        <a  id="logout" href="logout.php"> (Logout: <?=$_SESSION['usernameAdmin']?>) &nbsp;  </a>
		</nav>
      
</head>
<body>
    
       <br><br>
	<h1> ADMIN Dashboard </h1>
  
		


    
</body>
</html>
