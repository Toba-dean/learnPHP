<?php

namespace app\models;

use app\Database;
use app\helpers\UtilHelper;


// This is the the Product schema like the MONGO DB schema!!
class Product {
  public ?int $id = null;
  public string $title;
  public string $description;
  public float $price;
  public array $imageFile;
  public ?string $imagePath = null;

  // get the data from the input and set it to the variables
  function load($data) {
    $this->id = $data['id'] ?? null;
    $this->title = $data['title'];
    $this->description = $data['mydesc'] ?? "";
    $this->price = $data['price'];
    $this->imageFile = $data['imageFile'] ?? null;
    $this->imagePath = $data['img'] ?? null;
  }

  // check for errors and save it into the DB
  function save() {
    $errors = [];

    if (!$this->title) {
      $errors[] = 'Product title is required';
    }

    if (!$this->price) {
      $errors[] = 'Product price is required';
    }

    if (!is_dir(__DIR__ . '/../public/images')) {
      mkdir(__DIR__ . '/../public/images');
    }

    if (empty($errors)) {
      if ($this->imageFile && $this->imageFile['tmp_name']) {
        if ($this->imagePath) {
           unlink(__DIR__ . '/../public/' . $this->imagePath);
        }

        $this->imagePath = 'images/' . UtilHelper::randomString(8) . '/' . $this->imageFile['name'];
        mkdir(dirname(__DIR__ . '/../public/' . $this->imagePath));
        move_uploaded_file($this->imageFile['tmp_name'], __DIR__ . '/../public/' . $this->imagePath);
      }

      $db = Database::$db;

      // if no errors either update the DB or create a new product.
      if ($this->id) {
        $db->updateProduct($this);
      } else {
          $db->createProduct($this);
      }
    }

    return $errors;
  }
}