<?php 
session_start(); 

if (!isset($_SESSION['username'])) {
    header("Location: login.html");
}
     
    require 'dbConnection.php'; 
     
    $dbConn = getConnection(); 
     
    




$sql= "Insert INTO familyMembers (firstname, lastname, gender, dob) VALUES ( :fName, :lName, :gender, :dob)"; // using named parameters
$stmt = $dbConn -> prepare($sql); // preparing statement

$stmt -> execute( array(":fName" => $_POST['firstname'],
                          ":lName" => $_POST['lastname'],
                          ":gender" => $_POST['gender'],
                          ":dob" =>$_POST['dob'],
                          
                       ));

    echo" Success! " ;

    echo"  <br />First Name: " . $_POST['firstname'];
    echo"  <br />Last Name: " . $_POST['lastname'];
    echo"  <br />Email: " . $_POST['gender'];


    
    ?>