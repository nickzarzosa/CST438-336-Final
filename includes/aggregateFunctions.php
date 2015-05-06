<?php

session_start(); 
    require 'dbConnection.php'; 

    if(isset($_POST['reportGender'])) { 
     
    
     
    $dbConn = getConnection(); 

    $sql = "SELECT firstname, lastname, age, gender FROM users where gender = (:gender)"; //sql statement to fetch all users who are male
    $namedParameters = array();
                
    $namedParameters[":gender"]  = $_POST['gender']; 

$stmt = $dbConn->prepare($sql);
$stmt->execute($namedParameters);
$result = $stmt->fetch();
        
        if (empty($result)) { 
        echo "Error";
    } else { 
         
         echo "Printing users who are ";
         echo $_POST['gender'];
         print_r($result);
         
          
    }



    }

?>