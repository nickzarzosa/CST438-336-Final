<?php
require 'dbConnection.php';
$dbConn = getConnection();

$sql = "UPDATE users SET username = :username,
                          firstName = :firstName,
                          lastName = :lastName,
                          lastDeployment = :lastDeployment,
                          payGrade = :payGrade,
                          email = :email
                      WHERE username = :username";
$namedparameters = array();
$namedparameters[':username'] = $_GET['username'];
$namedparameters[':firstName'] = $_GET['firstName'];
$namedparameters[':lastName'] = $_GET['lastName'];
$namedparameters[':lastDeployment'] = $_GET['lastDeployment'];
$namedparameters[':payGrade'] = $_GET['payGrade'];
$namedparameters[':email'] = $_GET['email'];

$stmt= $dbConn->prepare($sql);
$stmt->execute($namedparameters);
echo "user info updated";


?>