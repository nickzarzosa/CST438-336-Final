<?php

require 'dbConnection.php'; //require database connection
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

?>