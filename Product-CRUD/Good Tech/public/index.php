<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\controllers\ProductCtrl;
use app\Router;

$router = new Router();

$router->get('/', [ProductCtrl::class, 'index']);
$router->get('/products', [ProductCtrl::class, 'index']);
$router->get('/products/index', [ProductCtrl::class, 'index']);
$router->get('/products/create', [ProductCtrl::class, 'create']);
$router->post('/products/create', [ProductCtrl::class, 'create']);
$router->get('/products/update', [ProductCtrl::class, 'update']);
$router->post('/products/update', [ProductCtrl::class, 'update']);
$router->post('/products/delete', [ProductCtrl::class, 'delete']);

$router->resolve();
