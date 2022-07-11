<?php

require_once "../../function.php";
$conn = require_once '../../database.php';

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'products_crud';

$errors = [];
$title = '';
$description = '';
$price = '';
$product = [
  'img' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  require_once '../../validate.php';

  // if error is empty then insert the values into the product table
  if (empty($errors)) {
    $statement = $conn->prepare(
      "INSERT INTO product (title, img, mydesc, price, reg_date)
      VALUES (:title, :img, :mydesc, :price, :date)"
    );
    $statement->bindValue(':title', $title);
    $statement->bindValue(':img', $imagePath);
    $statement->bindValue(':mydesc', $description);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':date', date('Y-m-d H:i:s'));

    $statement->execute();

    // redirect to the index page on submit
    header('Location: index.php');
  }
}


$conn = null;

?>

<?php require_once '../../view/header.php'; ?>

<h1>Create new Product</h1>

<?php require_once "../../view/form.php"; ?>

</body>

</html>