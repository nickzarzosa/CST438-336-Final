<?php

require 'dbConnectioin.php'; //require database connection
$dbConn = getConnection(); //connects with database and tables

$sql = "SELECT firstname, lastname, age, gender FROM users where gender = 'M'"; //sql statement to fetch all users who are male
$namedParameters = array();

$stmt = $dbConn->prepare($sql);
$stmt->execute($namedParameters);
$result = $stmt->fetch();

 echo "Printing users who are male" . print_r($result);

$sql = "SELECT firstname, lastname, age, gender FROM users where gender = 'F'"; //sql statement to fetch all users who are female
$namedParameters = array();

$stmt = $dbConn->prepare($sql);
$stmt->execute($namedParameters);
$result = $stmt->fetch();

echo "Printing users who are female" . print_r($result);

?>