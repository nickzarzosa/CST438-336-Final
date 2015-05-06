<?php

require 'dbConnectioin.php'; //require database connection
$dbConn = getConnection(); //connects with database and tables

$sql = "SELECT COUNT(gender)FROM users WHERE gender = 'M'"; //aggregate function to count the number of males  
$namedParameters = array();

$stmt = $dbConn->prepare($sql);
$stmt->execute($namedParameters);
$result = $stmt->fetch();

echo "Printing users who are male" 
print_r($result);

$sql = "SELECT COUNT(gender)FROM users WHERE gender = 'F'"; //aggregate function to count the number of females  
$namedParameters = array();

$stmt = $dbConn->prepare($sql);
$stmt->execute($namedParameters);
$result = $stmt->fetch();

echo "Printing users who are male" 
print_r($result);

?>