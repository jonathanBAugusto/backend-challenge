<?php

include 'autoload.php';

use controllers\ProductsController;
use models\Product;
use routes\Request;
use routes\Router;

$router = new Router(new Request);
$router->get('/', function() {
  return <<<HTML
  <h1>Hello world</h1>
HTML;
});
$router->get("/v1/products", function() {
  return json_encode(ProductsController::get());
});
$router->post('/v1/products', function($request) {
  $content = $request->getContent();
  return isset($content) ? ProductsController::post(Product::fromJson($content)) : "Sem dados para processar";
});