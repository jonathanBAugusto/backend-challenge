<?php

include 'autoload.php';

use controllers\ProductController;
use routes\Request;
use routes\Router;

$router = new Router(new Request);
$router->get('/', function() {
  return <<<HTML
  <h1>Hello world</h1>
HTML;
});
$router->get("/v1/products", function() {
  return json_encode(ProductController::get());
});
$router->post('/v1/products', function($request) {
  var_dump($request->getBody());
});