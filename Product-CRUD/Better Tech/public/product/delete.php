<?php

$conn = require_once '../../database.php';

$id = $_POST['id'] ?? null;
if (!$id) {
  header('Location: index.php');
  exit;
}

$statement = $conn->prepare('DELETE FROM product WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();

header('Location: index.php');
