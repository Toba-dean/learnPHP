<?php

require_once "functions.php";

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'products_crud';

try {
  // connect to DB
  $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


  // Set all the variables to an empty string 
  $errors = [];
  $title = '';
  $description = '';
  $price = '';

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // get the image from the FILE super global
    $image = $_FILES['image'] ?? null;
    $imagePath = '';

    // check if there is no images directory then create a images dir 
    if (!is_dir('images')) {
      mkdir('images');
    }

    if ($image && $image['tmp_name']) {
      $imagePath = 'images/' . randomString(8) . '/' . $image['name'];

      // this get the path name from the imagepath
      mkdir(dirname($imagePath));

      // move uploaded img from the super global FILE temp_name into the imagePath folder
      move_uploaded_file($image['tmp_name'], $imagePath);
    }

    // if no title and price push the value to the error array
    if (!$title) {
      $errors[] = 'Product title is required';
    }

    if (!$price) {
      $errors[] = 'Product price is required';
    }

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
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$conn = null;

?>


<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link href="app.css" rel="stylesheet" />
  <title>Products CRUD</title>
</head>

<body>
  <h1>Create new Product</h1>

  <p>
    <a href="index.php" class="btn btn-default">Back to products</a>
  </p>

  <?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
      <?php foreach ($errors as $error) : ?>
        <div><?php echo $error ?></div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <form method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label>Product Image</label><br>
      <input type="file" name="image">
    </div>
    <div class="form-group">
      <label>Product title</label>
      <input type="text" name="title" class="form-control" value="<?php echo $title ?>">
    </div>
    <div class="form-group">
      <label>Product description</label>
      <textarea class="form-control" name="description"><?php echo $description ?></textarea>
    </div>
    <div class="form-group">
      <label>Product price</label>
      <input type="number" step=".01" name="price" class="form-control" value="<?php echo $price ?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

</body>

</html>