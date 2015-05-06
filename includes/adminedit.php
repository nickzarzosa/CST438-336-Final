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
            dataType: "json",
            data: { },
            success: function(data,status) {
                 
              },
              complete: function(data,status) { //optional, used for debugging purposes
                  alert(status);
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
        <a href="reports.php">Go back to reports</a>
        <form method="post">
            Username:<input type="text" name="collegeName" value="<?=$result['username']?>"><br/>
            First name: <input type="text" name="email" value="<?=$result['firstName']?>"><br/>
            Last name: <input type="text" name="phone" value="<?=$result['lastName']?>"><br/>
            Last Deployment: <input type="text" name="street"value="<?=$result['lastDeployment']?>"><br/>
            pay Grade: <input type="text" name="city" value="<?=$result['payGrade']?>"><br/>
            email: <input type="text" name="zip" value="<?=$result['email']?>"><br/>

            
            <input type="submit" name="updateform" value="Update">
        </form>
      
    </div>

    <footer>
     <p>&copy; Copyright  by </p>
    </footer>
  </div>
</body>
</html>
