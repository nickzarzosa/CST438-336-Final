<?php
session_start();

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
    
    <title>DoD Beneficiary Family Sign Up Page</title>
</head>
<body>
	<header>
        <nav>
        <a  id="navlinks" href="dashboard.php"><img src="img/dashboard.png" width="35" height="35"></a>
		<a  id="navlinks" href="familySignup.php"> &nbsp; Add a Family Member&nbsp; </a>
		<a  id="navlinks" href="family.php"> &nbsp;Family Page&nbsp; </a>
		<a  id="navlinks" href="profile.php"> &nbsp;Profile&nbsp; </a>
        <a  id="logout" href="includes/logout.php"> (Logout: <?=$_SESSION['username']?>) &nbsp;  </a>
		</nav>
      
    </header>

    <br><br><br><br>
    <?php  
    if(empty($_SESSION['profilePictureDir'])){

      echo "<img id='profilePicDash' src='img/unknown.jpg' alt='Unknown user' ></img>";

      } else{
      echo "<img id='profilePicDash' src='img/profile/" . $_SESSION['username'] . "/" . $_SESSION['profilePictureDir'] . "'>";
      }
    ?>
    <h1>Add a Family Member</h1>
    <div id="familyForm2">
    	<form action="includes/familySignupProcess.php" method="post">
    		
			
            First Name: <input type="text" name="firstname" id="firstname"> <span id="firstNameError"></span><br />
            Last Name: <input type="text" name="lastname" id="lastname"> <span id="lastNameError"></span><br />
            Gender: <select name="gender" id="gender">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    </select> <span id="genderError"></span><br />
            Date of Birth: <input type="date" name="dob" id="dob"> <span id="dobError"></span><br />
            <div >
                <br>
                <input id="btn" type="submit" value="Add Family Member" name="familySignUp"> <br />
            </div>
    		
        </form>
    </div> 
    
   
		
	\
    

</body>
</html>