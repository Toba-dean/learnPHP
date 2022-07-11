<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'products_crud';

try {
  // connect to DB
  $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $keyword = $_GET['search'] ?? '';

  if ($keyword) {
    // filter on keyword search 
    $statement = $conn->prepare('SELECT * FROM product WHERE title LIKE :title ORDER BY reg_date DESC');
    $statement->bindValue(":title", "%$keyword%");
  } else {
    // fetch all the data from the database
    $statement = $conn->prepare("SELECT * FROM product ORDER BY reg_date DESC");
  }

  $statement->execute();
  $products = $statement->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

$conn = null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link href="app.css" rel="stylesheet" />
  <title>Document</title>
</head>

<body>

  <h1>Products CRUD</h1>

  <p>
    <a href="create.php" type="button" class="btn btn-sm btn-success">Add Product</a>
  </p>

  <!-- Search bar -->
  <form action="" method="get">
    <div class="input-group mb-3">
      <input type="text" name="search" class="form-control" placeholder="Search" value="<?php echo $keyword ?>">
      <div class="input-group-append">
        <button class="btn btn-success" type="submit">Search</button>
      </div>
    </div>
  </form>

  <table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">Title</th>
        <th scope="col">Price</th>
        <th scope="col">Create Date</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $i => $product) { ?>
        <tr>
          <th scope="row"><?php echo $i + 1 ?></th>
          <td>
            <?php if ($product['img']) : ?>
              <img src="<?php echo $product['img'] ?>" alt="<?php echo $product['title'] ?>" class="product-img">
            <?php endif; ?>
          </td>
          <td><?php echo $product['title'] ?></td>
          <td><?php echo "$" . $product['price'] ?></td>
          <td><?php echo $product['reg_date'] ?></td>
          <td>
            <a href="update.php?id=<?php echo $product['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
            <form method="post" action="delete.php" style="display: inline-block">
              <input type="hidden" name="id" value="<?php echo $product['id'] ?>" />
              <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
            </form>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>

</body>

</html>