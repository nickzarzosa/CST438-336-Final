<?php


session_start();



if(!isset($_SESSION['username'])){

header("Location: login.html");

}

require 'dbConnection.php';

if(isset($_POST['uploadForm'])){

echo $_FILES['fileName']['name'] . "\n";


echo $_FILES['fileName']['tmp_name'] . "\n";


echo $_FILES['fileName']['size'];

echo $_FILES['fileName']['type'];




$path = "../img/id/" . $_SESSION['username'];

if(!file_exists($path)){ // check whether the user's folder exists

mkdir($path);

}


echo "\n" . $path;

$pathOfPic = $path . "/" . $_FILES['fileName']['name'];

echo "\nPath of pic: " . $path . "/" . $_FILES['fileName']['name'];

move_uploaded_file($_FILES['fileName']['tmp_name'],   '../img/id/' . $_SESSION['username'] . "/" . $_FILES['fileName']['name']);

echo "<a href='../dashboard.php'> Back to Dash </a>";
    
// update database with the name of the file for the profile picture

$dbConn = getConnection();

        $sql = "UPDATE users SET IDCardImg='" . $_FILES['fileName']['name'] . "'WHERE username='" .$_SESSION['username']. "'";

        $stmt = $dbConn -> prepare($sql);

        $stmt -> execute();
    
     //Reset Session Variables to reset images!
    $username = $_SESSION['username'];;
    
    session_unset();
    
    $sql1 = "SELECT * FROM users
            WHERE username = :username "; 
            
             
    $namedParameters1 = array();         
    $namedParameters1[":username"]= $username;
    
    
     
    $stmt1 = $dbConn->prepare($sql1); 
    $stmt1->execute($namedParameters1); 
    $result1 = $stmt1->fetch(); 
     
    
         
        $_SESSION["username"] = $result1["username"]; 
        $_SESSION["userID"] = $result1["userID"]; 
        $_SESSION["IDCardImg"] = $result1["IDCardImg"]; 
        $_SESSION["birthCertificateImg"] = $result1["birthCertDir"];
        $_SESSION["formImg"] = $result1["formDir"];
        $_SESSION["profilePictureDir"] = $result1["profilePictureDir"];
        
       header("Location: ../dashboard.php"); 

}



?>