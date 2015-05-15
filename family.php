<?php
session_start();


   
     
    function getAllParticipants(){
    
        
                    require 'includes/dbConnection.php'; 
                    $dbConn = getConnection();
        

                    $sql = "SELECT * FROM familyMembers
                            WHERE userID = :userID"; 

                    $namedParameters = array();         
                    $namedParameters[":userID"]= $_SESSION['userID']; 


                    $stmt = $dbConn->prepare($sql); 
                    $stmt->execute($namedParameters); 
                    return $stmt->fetchAll();  

        
        }

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
}



?>

<!DOCTYPE html>
<html>
<head>
	<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <meta name="viewport" content="width=device-width">
	<link rel="stylesheet" type="text/css" href="css/style.css">
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
      <!--add this to every page as well for parse DB*/-->
      <script type="text/javascript" src="http://www.parsecdn.com/js/parse-1.4.2.min.js"></script>
    
    <title>DoD Beneficiary Sign Up Page</title>
</head>
<body>
    
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Family</title>
      <nav>
        <a  id="navlinks" href="dashboard.php"><img src="img/dashboard.png" width="35" height="35"></a>
		<a  id="navlinks" href="familySignup.php"> &nbsp; Add a Family Member&nbsp; </a>
		<a  id="navlinks" href="family.php"> &nbsp;Family Page&nbsp; </a>
		
        <a  id="logout" href="includes/logout.php"> (Logout: <?=$_SESSION['username']?>) &nbsp;  </a>
		</nav>
</head>
<body>
    
       <br><br>
	<h1>Family Members</h1>
    
    <?php 
    

    $allParticipants = getAllParticipants();

       echo $_SESSION['userID'];
        echo "<table>";
        echo "<th>First Name</th>";
        echo "<th>Last Name</th>";
        echo "<th>Date of Birth</th>"; 
        echo "<th>Gender</th>"; 
     

        foreach ($allParticipants as $participant){ 
            echo "<tr> <td>" . $participant['firstName'] . "</td> ";
            echo "<td>" . $participant['lastName'] . "</td> ";
            echo "<td>" . $participant['dob'] . "</td> ";
            echo "<td>" . $participant['gender'] . "</td> ";
            echo "<td> <input type='button' value='update'> </td> ";
            echo "</tr>";
            
          } 

       echo "</table>";
    


?> 
</body>
</html>