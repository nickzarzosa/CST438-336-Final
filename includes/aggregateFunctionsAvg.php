<?php

require 'dbConnection.php'; //require database connection
$dbConn = getConnection(); //connects with database and tables

$sql = "SELECT AVG(age) FROM users"; //aggregate function to calculate average age from male/female users  
$namedParameters = array();

$stmt = $dbConn->prepare($sql);
$stmt->execute($namedParameters);
$result = $stmt->fetch();

echo "Printing average age of users"; 
print_r($result);

?>