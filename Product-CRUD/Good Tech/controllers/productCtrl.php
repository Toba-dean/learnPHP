<?php

namespace app\controllers;

use app\models\Product;
use app\Router;

// Controller collects all the data to be rendered to the page from the Database and then renders the view.
class ProductCtrl
{

  // get the products when the index page is rendered
  static function index(Router $router)
  {
    $keyword = $_GET['search'] ?? '';
    $products = $router->database->getProducts($keyword);
    $router->render_view('products/index', [
      'products' => $products,
      'keyword' => $keyword
    ]);
  }

  // on routing to the create page
  static function create(Router $router)
  {
    // when the method is GET, then the rendered page should have all it input empty
    $errors = [];
    $productData = [
      'title' => '',
      'mydesc' => '',
      'img' => '',
      'price' => '',
    ];

    // if method is POST then the product data that is entered into the input fields should be inserted to the database.
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $productData['title'] = $_POST['title'];
      $productData['mydesc'] = $_POST['description'];
      $productData['price'] = (float)$_POST['price'];
      $productData['imageFile'] = $_FILES['image'] ?? null;

      // this sets the entered values into the Product model schema then loads it i.e sets it, checks for errors, saves it into the database.
      $product = new Product();
      $product->load($productData);
      $errors = $product->save();

      if (empty($errors)) {
        header('Location: /products');
        exit;
      }
    }

    // render the correct data from the correct method
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
