<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'products_crud';

try {
  // connect to DB
  $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  return $conn;
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$conn = null;

?>