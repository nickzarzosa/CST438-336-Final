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
    <header>
      <h1>Edit User</h1>
    </header>
 
    <div>
        <a href="adminSearch.php">Go back to reports</a>
        <form method="get">
            Username:<input type="text" name="username" id="username" value="<?=$result['username']?>"><br/>
            First name: <input type="text" name="firstName" id="firstName" value="<?=$result['firstName']?>"><br/>
            Last name: <input type="text" name="lastName" id="lastName" value="<?=$result['lastName']?>"><br/>
            Last Deployment: <input type="text" name="lastDeployment" id="lastDeployment" value="<?=$result['lastDeployment']?>"><br/>
            pay Grade: <input type="text" name="payGrade" id="payGrade" value="<?=$result['payGrade']?>"><br/>
            email: <input type="text" name="email" id="email" value="<?=$result['email']?>"><br/>

            
            <input type="submit" id="updateform" name="updateform" value="Update">
        </form>
      
    </div>
    <script>
        $("#updateform").click(edituserdetails);
    </script>

    <footer>
     <p>&copy; Copyright  by </p>
    </footer>
  </div>
</body>
</html>
