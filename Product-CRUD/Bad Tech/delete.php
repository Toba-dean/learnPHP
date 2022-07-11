<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'products_crud';

try {
  // connect to DB
  $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // the id is passed from the index.php as an input.
  $id = $_POST['id'] ?? null;
  if (!$id) {
    header('Location: index.php');
    exit;
  }

  $statement = $conn->prepare('DELETE FROM product WHERE id = :id');
  $statement->bindValue(':id', $id);
  $statement->execute();

  header('Location: index.php');
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
