<?php

namespace app;

use app\models\Product;
use PDO;

// this does all the Database manipulation
class Database {
  public $pdo;
  public static ?Database $db;

  function __construct() {
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'products_crud';

    $this->pdo = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    self::$db = $this;
  }

  function getProducts($keyword = '') {
    if ($keyword) {
      // filter on keyword search 
      $statement = $this->pdo->prepare('SELECT * FROM product WHERE title LIKE :title ORDER BY reg_date DESC');
      $statement->bindValue(":title", "%$keyword%");
    } else {
      // fetch all the data from the database
      $statement = $this->pdo->prepare("SELECT * FROM product ORDER BY reg_date DESC");
    }
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  function getProductById($id) {
    $statement = $this->pdo->prepare('SELECT * FROM product WHERE id = :id');
    $statement->bindValue(':id', $id);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  function deleteProduct($id) {
    $statement = $this->pdo->prepare('DELETE FROM product WHERE id = :id');
    $statement->bindValue(':id', $id);

    return $statement->execute();
  }

  function updateProduct(Product $product) {
    $statement = $this->pdo->prepare(
      "UPDATE product SET title = :title, img = :img, mydesc = :mydesc, price = :price
      WHERE id = :id"
    );
    $statement->bindValue(':title', $product->title);
    $statement->bindValue(':img', $product->imagePath);
    $statement->bindValue(':mydesc', $product->description);
    $statement->bindValue(':price', $product->price);
    $statement->bindValue(':id', $product->id);

    $statement->execute();
  }

  function createProduct(Product $product) {
    $statement = $this->pdo->prepare(
      "INSERT INTO product (title, img, mydesc, price, reg_date)
      VALUES (:title, :img, :mydesc, :price, :date)"
    );
    $statement->bindValue(':title', $product->title);
    $statement->bindValue(':img', $product->imagePath);
    $statement->bindValue(':mydesc', $product->description);
    $statement->bindValue(':price', $product->price);
    $statement->bindValue(':date',date('Y-m-d H:i:s'));

    $statement->execute();
  }
}