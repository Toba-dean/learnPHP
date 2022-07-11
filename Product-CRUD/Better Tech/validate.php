<?php

$title = $_POST['title'];
$description = $_POST['description'];
$price = $_POST['price'];

// get the image from the FILE super global
$image = $_FILES['image'] ?? null;
$imagePath = $product['img'];

// check if there is no images directory then create a images dir 
if (!is_dir('images')) {
  mkdir('images');
}

if ($image && $image['tmp_name']) {
  if ($product['img']) {
    unlink($product['img']);
  }
  $imagePath = 'images/' . randomString(8) . '/' . $image['name'];
  mkdir(dirname($imagePath));
  move_uploaded_file($image['tmp_name'], $imagePath);
}

// if no title and price push the value to the error array
if (!$title) {
  $errors[] = 'Product title is required';
}

if (!$price) {
  $errors[] = 'Product price is required';
}
