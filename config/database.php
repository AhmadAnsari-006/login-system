<?php
$host = "localhost";
$dbname = "login_system";
$username = "root";
$password = "";
try {
  $pdo = new PDO(
    "mysql:host=$host; dbname=$dbname; charset=utf8mb4",// DSN(Data Source Name)
    $username,
    $password
  );
  $pdo->setAttribute(//Exception mode, helps to debug and catch error
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
  );
}catch(PDOException $e){
  die("Database Connection Failed: " . $e->getMessage());
}