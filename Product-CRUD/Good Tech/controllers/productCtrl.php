<?php

namespace app\controllers;

use app\models\Product;
use app\Router;

class ProductCtrl
{

  static function index(Router $router)
  {
    $keyword = $_GET['search'] ?? '';
    $products = $router->database->getProducts($keyword);
    $router->render_view('products/index', [
      'products' => $products,
      'keyword' => $keyword
    ]);
  }

  static function create(Router $router)
  {
    $errors = [];
    $productData = [
      'title' => '',
      'mydesc' => '',
      'img' => '',
      'price' => '',
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $productData['title'] = $_POST['title'];
      $productData['mydesc'] = $_POST['description'];
      $productData['price'] = (float)$_POST['price'];
      $productData['imageFile'] = $_FILES['image'] ?? null;

      $product = new Product();
      $product->load($productData);
      $errors = $product->save();

      if (empty($errors)) {
        header('Location: /products');
        exit;
      }
    }
    $router->render_view('products/create', [
      'product' => $productData,
      'errors' => $errors
    ]);
  }

  static function update(Router $router)
  {
    $errors = [];

    $id = $_GET['id'] ?? null;
    if (!$id) {
      header('Location: /products');
      exit;
    }

    $productData = $router->database->getProductById($id);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $productData['title'] = $_POST['title'];
      $productData['mydesc'] = $_POST['description'];
      $productData['price'] = (float)$_POST['price'];
      $productData['imageFile'] = $_FILES['image'] ?? null;

      $product = new Product();
      $product->load($productData);
      $errors = $product->save();

      if (empty($errors)) {
        header('Location: /products');
        exit;
      }
    }

    $router->render_view('products/update', [
      'product' => $productData,
      'errors' => $errors
    ]);
  }

  static function delete(Router $router)
  {
    $id = $_POST['id'] ?? null;
    if (!$id) {
      header('Location: /products');
      exit;
    }

    if ($router->database->deleteProduct($id)) {
      header('Location: /products');
      exit;
    }
  }
}
