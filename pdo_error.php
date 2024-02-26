<?php

// Initialize a PDO connection to database
$pdo = new PDO('mysql:host=127.0.0.1;dbname=hotel;charset=UTF8', 'hotel', 'password', [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"]);

// Prepare statement
$statement = $pdo->prepare('INSERT INTO user (user_id, name, email, password) VALUES (:user_id, :name, :email, :password)');

// Bind parameters
$userId = 11;
$name = 'John';
$email = 'john@doe.com';
$password = 'password';
$statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
$statement->bindParam(':name', $name, PDO::PARAM_STR);
$statement->bindParam(':email', $email, PDO::PARAM_STR);
$statement->bindParam(':password', $password, PDO::PARAM_STR);

// Execute statement
$rows = $statement->execute();

// Check if the record has been inserted
var_dump($rows == 1);
print_r($statement->errorInfo());
