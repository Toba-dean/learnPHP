<?php

require_once "../../function.php";
$conn = require_once '../../database.php';

$id = $_GET['id'] ?? null;
if (!$id) {
  header('Location: index.php');
  exit;
}

$statement = $conn->prepare('SELECT * FROM product WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();

$product = $statement->fetch(PDO::FETCH_ASSOC);

$title = $product['title'];
$description = $product['mydesc'];
$price = $product['price'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  require_once '../../validate.php';

  // if error is empty then insert the values into the product table
  if (empty($errors)) {
    $statement = $conn->prepare(
      "UPDATE product SET title = :title, img = :img, mydesc = :mydesc, price = :price
      WHERE id = :id"
    );
    $statement->bindValue(':title', $title);
    $statement->bindValue(':img', $imagePath);
    $statement->bindValue(':mydesc', $description);
    $statement->bindValue(':price', $price);
    $statement->bindValue(':id', $id);

    $statement->execute();

    // redirect to the index page on submit
    header('Location: index.php');
  }
}

$conn = null;

?>

<?php require_once '../../view/header.php'; ?>

<h1>Update Product: <b><?php echo $product['title'] ?></b></h1>

<?php require_once "../../view/form.php"; ?>

</body>

</html>