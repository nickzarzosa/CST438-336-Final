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
    
       <br><br>
	<h1> ADMIN Dashboard </h1> 
    
    <img src="img/todo.png">
    
	

 
<div id="accordion">
    <h3>Welcome <?=$_SESSION['name']?>!</h3>
  <div>
    <p>
    Administrate:
    </p>
  </div>
  <h3>ADD Users</h3>
  <div>
    <p>
     <div id="familyForm">
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
            
    		<input type="submit" value="Sign Up!" id="signUp"> <br />
       </form>
   
    </div> 
    </p>
  </div>
    <h3>Search and Edit Users</h3>
  <div>
    <p>
        Search for User:
      <form method="post" action="includes/adminSearch.php"> 
          <input type="text" name="username" id="username"><br>
          <input type="submit" value="Search!" name="search" id="search">
      </form>
      
      
    </p>
  </div>
  <h3>Delete User</h3>
  <div>
    <p>
     Delete User:
      <form method="post" action="includes/deleteProcess.php"> 
          <input type="text" name="username" id="username"><br>
          <input type="submit" value="Delete!" name="delete" id="delete">
      </form>
    </p>
  </div>
  <h3>Edit Users</h3>
  <div>
    <p>
    Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis.
    Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero
    ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis
    lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui.
    </p>
    <ul>
      <li>List item one</li>
      <li>List item two</li>
      <li>List item three</li>
    </ul>
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

			require 'includes/dbConnection.php'; //require database connection
			$dbConn = getConnection(); //connects with database and tables

			$sql = "SELECT COUNT(gender)FROM users WHERE gender = 'M'"; //aggregate function to count the number of males  
			$namedParameters = array();

			$stmt = $dbConn->prepare($sql);
			$stmt->execute($namedParameters);
			$result = $stmt->fetch();

			$numOfMen = $result['COUNT(gender)'];

			echo "Printing users who are male: " . $numOfMen;
			print_r($result);


			$sql = "SELECT COUNT(gender)FROM users WHERE gender = 'F'"; //aggregate function to count the number of females  
			$namedParameters = array();

			$stmt = $dbConn->prepare($sql);
			$stmt->execute($namedParameters);
			$result = $stmt->fetch();

			$numOfWomen = $result['COUNT(gender)'];

			echo "Printing users who are female: " . $numOfWomen; 
			print_r($result);

			$sql = "SELECT AVG(age) FROM users"; //aggregate function to calculate average age from male/female users  
			$namedParameters = array();

			$stmt = $dbConn->prepare($sql);
			$stmt->execute($namedParameters);
			$result = $stmt->fetch();

			echo "Printing average age of users"; 
			print_r($result);

?>
		
    
    </p>
  </div>
</div>
 	
		


    
</body>
</html>