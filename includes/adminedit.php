<?php
session_start();

if(!isset($_SESSION['usernameAdmin'])){
header("Location: adminLogin.php");
}
require 'dbConnection.php';

//get info fromt he database about the user
$selecteduser = $_SESSION['founduser'];
$dbConn = getConnection();
$sql = "SELECT * FROM users WHERE username = :username";
$namedparameters = array();
$namedparameters[':username']=$selecteduser;
$stmt = $dbConn->prepare($sql);
$stmt->execute($namedparameters);
$result = $stmt->fetch();


//print_r($result);


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>adminedit</title>
  <meta name="description" content="">
  <meta name="author" content="zarz2942">
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <meta name="viewport" content="width=device-width; initial-scale=1.0">

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>  
    
  <script>
	function edituserdetails() 
	{        
    
     
      $.ajax({
            type: "get",
            url: "admineditsearch.php",
            dataType: "text",
            
            data: {"username":$("#username").val(),"firstName":$("#firstName").val(),"lastName":$("#lastName").val(),"lastDeployment":$("#lastDeployment").val(),"payGrade":$("#payGrade").val(),"email":$("#email").val()},
            success: function(data,status) {
                 //alert(data);
              },
              complete: function(data,status) { //optional, used for debugging purposes
                 // alert(status);
              }
         });
	}

   </script>
</head>

<body>
  <div>
        <nav>
        <a  id="navlinks" href="../adminDashboard.php"><img src="../img/dashboard.png" width="35" height="35"></a>
		<a  id="navlinks" href="../Index.html"> &nbsp; Home Page &nbsp; </a>
        <a  id="logout" href="logout.php"> (Logout: <?=$_SESSION['usernameAdmin']?>) &nbsp;  </a>
		</nav>
    <header>
        <br><br>
      <h1>Edit User</h1>
    </header>
 
    <div>
        <div id="fieldsetDivAdmin1">
            
        
        
        <form method="get">
            <div id="field">
                Username:<input type="text" name="username" id="username" value="<?=$result['username']?>"><br/></div>
            <div id="field">First name: <input type="text" name="firstName" id="firstName" value="<?=$result['firstName']?>"><br/></div>
            <div id="field">Last name: <input type="text" name="lastName" id="lastName" value="<?=$result['lastName']?>"><br/></div>
            <div id="field">Last Deployment: <input type="text" name="lastDeployment" id="lastDeployment" value="<?=$result['lastDeployment']?>"><br/></div>
            <div id="field">pay Grade: <input type="text" name="payGrade" id="payGrade" value="<?=$result['payGrade']?>"><br/></div>
            <div id="field">email: <input type="text" name="email" id="email" value="<?=$result['email']?>"><br/></div>

            
            <input type="submit" id="updateform" name="updateform" value="Update">
            <a href="../adminDashboard.php" ><input type="button" value="Back to Admin Dashboard" ></a>
        </form>
      </div>
    </div>
    <script>
        $("#updateform").click(edituserdetails);
    </script>

    <footer>
    
    </footer>
  </div>
</body>
</html>
