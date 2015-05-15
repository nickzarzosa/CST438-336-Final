<?php

session_start();

require 'includes/dbConnection.php'; 
     
    $dbConn = getConnection();


if(!isset($_SESSION['username'])){

header("Location: login.html");

}

 


//get info fromt he database about the user
$selecteduser = $_SESSION['username'];
$sql = "SELECT * FROM users WHERE username = :username";
$namedparameters = array();
$namedparameters[':username']=$selecteduser;
$stmt = $dbConn->prepare($sql);
$stmt->execute($namedparameters);
$result = $stmt->fetch();



?>

<!DOCTYPE html>
<html>
<head>
    <title>DoD Beneficiary Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    
        <nav>
        <a  id="navlinks" href="dashboard.php"><img src="img/dashboard.png" width="35" height="35"></a>
		<a  id="navlinks" href="familySignup.php"> &nbsp; Add a Family Member&nbsp; </a>
		<a  id="navlinks" href="family.php"> &nbsp;Family Page&nbsp; </a>
        <a  id="logout" href="includes/logout.php"> (Logout: <?=$_SESSION['username']?>) &nbsp;  </a>
		</nav>
    
       <script>
      $(function() {
        $( "#accordion" ).accordion({
      heightStyle: "content"
        });
      });
      </script>
    
</head>
<body>
    <br><br><br>
   
   
       
    <div>
       <h1> </h1>  
    </div>
    <div id="container">
        
    
    <div id="accordion">
        <h3>DoD Benefits Dash </h3>
        <p>
          <?php  
    if(empty($_SESSION['profilePictureDir'])){

      echo "<img id='profilePicDash' src='img/unknown.jpg' alt='Unknown user' ></img>";

      } else{
      echo "<img id='profilePicDash' src='img/profile/" . $_SESSION['username'] . "/" . $_SESSION['profilePictureDir'] . "'>";
      }
    ?>
        
        <span id="welcome">Welcome <?=$_SESSION['username']?>!</span>
        </p>
        
       
        <h3> Edit Personal Information</h3><div>
        <p> 

        
        <form method="get">
            
            <div id="field">
                Username:<input type="text" name="username" id="username" value="<?=$result['username']?>"><br/></div>
            <div id="field">First name: <input type="text" name="firstName" id="firstName" value="<?=$result['firstName']?>"><br/></div>
            <div id="field">Last name: <input type="text" name="lastName" id="lastName" value="<?=$result['lastName']?>"><br/></div>
            <div id="field">Last Deployment: <input type="date" name="lastDeployment" id="lastDeployment" value="<?=$result['lastDeployment']?>"><br/></div>
            <div id="field">pay Grade: <input type="text" name="payGrade" id="payGrade" value="<?=$result['payGrade']?>"><br/></div>
            <div id="field">email: <input type="text" name="email" id="email" value="<?=$result['email']?>"><br/></div>

            
            <input type="submit" id="updateform" name="updateform" value="Update">
            
        </form>
        

        
        </p>
        </div>
        
        <h3>Profile Picture</h3>
    <div>
    <p>
    <!-- user can upload documents to the database -->
      <form method="post" action="includes/uploadProfilePic.php" enctype="multipart/form-data">

      Select image: <input type="file" name="fileName" />

      <input type="submit"  value="Upload Profile" name="uploadProfilePic"/>

      </form>

      <?php

      if(empty($_SESSION['profilePictureDir'])){

      echo "<img width='500' height='400' src='img/unknown.jpg' alt='Unknown user' ></img>";

      } else{

      // display user's profile picture

      echo "<img width='500' height='400' src=img/profile/" . $_SESSION['username'] . "/" . $_SESSION['profilePictureDir'];
       }

      ?>
    </p>
  </div>
  <h3>ID Card</h3>
  <div>
    <p>
    <!-- user can upload documents to the database -->
      <form method="post" action="includes/uploadID.php" enctype="multipart/form-data">

      Select image: <input type="file" name="fileName" />

      <input type="submit"  value="Upload ID Card" name="uploadForm"/>

      </form>

      <?php

      if(empty($_SESSION['IDCardImg'])){

      echo "<img width='500' height='400' src='img/Sample-ID.jpg' alt='Unknown user' ></img>";

      } else{

      // display user's profile picture

      echo "<img width='500' height='400' src=img/id/" . $_SESSION['username'] . "/" . $_SESSION['IDCardImg'];
       }

      ?>
    </p>
  </div>
  <h3>Birth Certifcate</h3>
  <div>
    <p>
    <!-- user can upload documents to the database -->
      <form method="post" action="includes/uploadBirthCert.php" enctype="multipart/form-data">

      Select image: <input type="file" name="fileName" />

      <input type="submit"  value="Upload Birth Certificate" name="uploadForm"/>

      </form>

      <?php

      if(empty($_SESSION['birthCertificateImg'])){

      echo "<img width='500' height='400' src='img/birthCertificate.jpg' alt='Unknown user' ></img>";

      } else{

      // display user's profile picture

      echo "<img width='500' height='400' src=img/birthCertificates/" . $_SESSION['username'] . "/" . $_SESSION['birthCertificateImg'];
       }

      ?>
    </p>
  </div>
    
  <h3>Form</h3>
  <div>
    <p>
    <!-- user can upload documents to the database -->
      <form method="post" action="includes/uploadForm.php" enctype="multipart/form-data">

      Select image: <input type="file" name="fileName" />

      <input type="submit"  value="Upload Form" name="uploadForm"/>

      </form>
    
      <?php

      if(empty($_SESSION['formImg'])){

      echo "<img width='500' height='400' src='img/form.jpg' alt='Unknown user' ></img>";

      } else{

      // display user's profile picture

      echo "<img width='500' height='400' src=img/form/" . $_SESSION['username'] . "/" . $_SESSION['formImg'];
       }

      ?>
    </p>
   
  </div>
  
</div>

    </div>

  <script>
           
          
            
	function edituserdetails() 
	{        
    
        
     
      $.ajax({
            type: "get",
            url: "includes/admineditsearch.php",
            dataType: "text",
            
            data: {"username":$("#username").val(),"firstName":$("#firstName").val(),"lastName":$("#lastName").val(),"lastDeployment":$("#lastDeployment").val(),"payGrade":$("#payGrade").val(),"email":$("#email").val()},
            success: function(data,status) {
                 alert("User Info Changed");
              },
              complete: function(data,status) { //optional, used for debugging purposes
                 // alert(status);
              }
         });
	}

   </script>
		
		<script>
        $("#updateform").click(edituserdetails);
    </script>

    
</body>
</html>