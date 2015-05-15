<?php

session_start();


    
if(isset($_SESSION['deleted'])){

        echo "<br> <br><br><br> <div id='deleted'> User: ".$_SESSION['deleted']." Deleted </div>";
        unset($_SESSION['deleted']);
        unset($_SESSION['deletedUser']);
}

require 'includes/dbConnection.php'; 

if(!isset($_SESSION['usernameAdmin'])){

header("Location: adminLogin.php");

}


function getAllUsers(){
    
            $dbConn = getConnection(); 
            $sql = "SELECT username FROM users "; 
            $stmt = $dbConn->prepare($sql); 
            $stmt->execute(); 
            return $stmt->fetchAll(); 
        
}

  
if(isset($_SESSION['created'])){
    
        
        echo "<br> <br><br><br> <div id='deleted'>";
         echo" Success You have signedup! " ;
    
        echo"  <br />Under User Name: " . $_SESSION['created'] . "</div>";
        

        unset($_SESSION['created']);
        
}
   
    
   
 	

?>

<!DOCTYPE html>
<html>
<head>
    <title>DoD Beneficiary ADMIN Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    
   <script>
      $(function() {
        $( "#accordion" ).accordion({
      heightStyle: "content"
        });
      });
      </script>
    
        <nav>
        <a  id="navlinks" href="adminDashboard.php"><img src="img/dashboard.png" width="35" height="35"></a>
		<a  id="navlinks" href="Index.html"> &nbsp; Home Page &nbsp; </a>
        <a  id="logout" href="includes/logout.php"> (Logout: <?=$_SESSION['usernameAdmin']?>) &nbsp;  </a>
		</nav>
          
      
</head>
<body>
    
       <br><br><br>
    
    
    
    
<div id="container">
    
   

 
<div id="accordion">
    <h3>Welcome <?=$_SESSION['name']?>!</h3>
  <div>
    <p>
    <center><h3>DoD Beneficiary Website</h3></center>
    <img id='profilePicDash' src='img/DMDC_Seal.png' alt='Unknown user' >
	<center><h4> ADMIN Dashboard </h4> </center>
    </p>
  </div>
  <h3>ADD Users</h3>
  <div>
    <p>
     <div id="addUserForm">
    	<form action="includes/adminSignup.php" method="post">
            
            <div id="field">Username: <input type="text" name="username" id="username"> <span id="usernameError"></span> <br /></div>
    		<div id="field">Password: <input type="password" name="password" id="password"> <span id="passwordError"></span> <br /></div>
			<div id="field">Re-Type Password: <input type="password" id="password2"> <span id="passwordError2"></span> <br /></div>
            <div id="field">Email: <input type="email" name="email" id="email"> <span id="emailError"></span><br /></div>
            <div id="field">First Name: <input type="text" name="firstname" id="firstName"> <span id="firstNameError"></span><br /></div>
            <div id="field">Last Name: <input type="text" name="lastname" id="lastName"> <span id="lastNameError"></span><br /></div>
            <div id="field">Gender: <select name="gender" id="gender">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    </select> <span id="genderError"></span><br /></div>
            <div id="field">Phone Number: <input type="text" name="phone" id="phone"> <span id="phoneError"></span><br /></div>
            <div id="field">Pay Grade: <input type="text" name="pay" id="pay"> <span id="payGradeError"></span><br /></div>
            <div id="field">Date of Birth: <input type="date" name="dob" id="dob"> <span id="dobError"></span><br /></div>
            <div id="field">Age: <input type="text" name="age" id="age"> <span id="ageError"></span><br /></div>
            <div id="field">Date of Last Deployment: <input type="date" name="lastDeployment" id="lastDeployment"> <span id="deploymentError"></span><br /></div>
            
    		<input id="btn" type="submit" value="Sign Up!" id="signUp"> <br />
       </form>
   
    </div> 
    </p>
  </div>
    <h3>Search & Edit Users</h3>
  <div>
    <p>
        Search for user by username to edit:
       
          
          
      
      <form method="post" action="includes/adminedit.php">
      <?php 
        
         // Fills in select options with users horrah!
        $userName = getAllUsers();
        

        echo "<select name='username' id='username'>";

        foreach ($userName as $user){ 
          echo '<option value="'.$user['username'].'">'.$user['username'].'</option>'; 
          } 
        
        echo "</select>";
        
         
        ?>
          <input type="submit" value="Search!" name="search" id="btn">
          </form>
    </p>
  </div>
     
    <h3>Delete User</h3>
  <div>
    <p>
     Delete User:
      <form method="post" action="includes/deleteProcess.php">
          <?php 
        
         // Fills in select options with users horrah!
        $userName1 = getAllUsers();
        

        echo "<select name='username' id='username'>";

        foreach ($userName1 as $user1){ 
          echo '<option value="'.$user1['username'].'">'.$user1['username'].'</option>'; 
          } 
        
        echo "</select>";
        
         
        ?>
          
          <input type="submit" value="Delete!" name="delete" id="btn">
      </form>
    </p>
  </div>
  
  <h3>Reports</h3>
  <div>
    <p>
		<!-- 
        <form action="includes/aggregateFunctions.php" method="post">
            
           
            <div id="field">Gender: <select name="gender" id="gender">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    </select> <span id="genderError"></span><br /></div>
    		<input type="submit" value="Report on this Gender!" id="reportGender"> <br />
            
       </form> -->
		
		<?php
			 //require database connection
			$dbConn = getConnection(); //connects with database and tables
			$sql = "SELECT COUNT(gender)FROM users WHERE gender = 'M'"; //aggregate function to count the number of males  
			$namedParameters = array();
			$stmt = $dbConn->prepare($sql);
			$stmt->execute($namedParameters);
			$result = $stmt->fetch();
			$numOfMen = $result['COUNT(gender)'];
			echo "Users who are male: " . $numOfMen;
			
			
			echo " <br>";
			echo " <br>";
			$sql = "SELECT COUNT(gender)FROM users WHERE gender = 'F'"; //aggregate function to count the number of females  
			$namedParameters = array();
			$stmt = $dbConn->prepare($sql);
			$stmt->execute($namedParameters);
			$result = $stmt->fetch();
			$numOfWomen = $result['COUNT(gender)'];
			echo "Users who are female: " . $numOfWomen; 
			
			echo " <br>";
			echo " <br>";
			$sql = "SELECT AVG(age) FROM users"; //aggregate function to calculate average age from male/female users  
			$namedParameters = array();
			$stmt = $dbConn->prepare($sql);
			$stmt->execute($namedParameters);
			$result = $stmt->fetch();
			$averageAge = $result['AVG(age)'];
			echo "Average age of users: " . $averageAge; 
		
?>
		
    
    </p>
  </div>
</div>
 	 </div>	
		


    
</body>
</html>