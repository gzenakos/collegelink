<?php

// Initialize a PDO connection to database
$pdo = new PDO('mysql:host=127.0.0.1;dbname=hotel;charset=UTF8', 'hotel', 'password', [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"]);

// Prepare statement
$statement = $pdo->prepare('SELECT * FROM user');

// Execute statement
$statement->execute();

// Fetch results
$allRecords = $statement->fetchAll(PDO::FETCH_ASSOC);
print_r($allRecords);
