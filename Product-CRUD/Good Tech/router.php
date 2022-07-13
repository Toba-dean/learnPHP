<?php

namespace app;


// this gets the method being called resolves it by setting the function to be invoked then generate the view to render.
class Router {
  public array $getRoutes = [];
  public array $postRoutes = [];

  public ?Database $database;

  function __construct() {
    $this->database = new Database();
  }

  function get($url, $fn) {
    $this->getRoutes[$url] = $fn;
  }

  function post($url, $fn) {
    $this->postRoutes[$url] = $fn;
  }

  function resolve() {
    $method = strtolower($_SERVER['REQUEST_METHOD']);
    $url = $_SERVER['PATH_INFO'] ?? '/';

    if($method === 'get') {
      $fn = $this->getRoutes[$url] ?? null;
    }else {
      $fn = $this->postRoutes[$url] ?? null;
    }

    if (!$fn) {
      echo 'Page not found';
      exit;
    }

    call_user_func($fn, $this);
  }

  function render_view($view, $params = []) {
    foreach($params as $key => $val) {
      $$key = $val;
    }

    ob_start();
    include_once __DIR__."/view/$view.php";
    $content = ob_get_clean();
    include_once __DIR__."/view/layout.php";
  }
}