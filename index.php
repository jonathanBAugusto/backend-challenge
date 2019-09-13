<?php

include 'autoload.php';

use controllers\CustomersController;
use controllers\OrderItemsController;
use controllers\OrdersController;
use controllers\ProductsController;
use models\Customer;
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
$router->get("/v1/products/{id}", function($id) {
  return $id;
});
$router->post('/v1/products', function($request) {
  $content = $request->getContent();
  return isset($content) ? ProductsController::post(Product::fromJson($content)) : "Sem dados para processar";
});
$router->post('/v1/customers', function($request) {
  $content = $request->getContent();
  return isset($content) ? CustomersController::post(Customer::fromJson($content)) : "Sem dados para processar";
});
$router->get('/v1/orders', function($request) {
  return json_encode(OrdersController::get());
});
$router->post('/v1/orders', function($request) {
  $content = $request->getContent();
  return isset($content) ? OrdersController::post($content) : "Sem dados para processar";
});
$router->put('/v1/orders/{id}', function($request) {
  $content = $request->getContent();
  return isset($content) ? OrdersController::post($content) : "Sem dados para processar";
});