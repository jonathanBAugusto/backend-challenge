<?php

include 'autoload.php';

use routes\Request;
use routes\Router;

$router = new Router(new Request);
$router->get('/', function() {
  return <<<HTML
  <h1>Hello world</h1>
HTML;
});
$router->get("/v1/products", function($request) {
  return '[
    {
      "id": 1,
      "sku": 8552515751438644,
      "name": "Casaco Jaqueta Outletdri Inverno Jacquard",
      "price": 109.90,
      "created_at": "2018-08-27T02:11:43Z",
      "updated_at": "2018-08-27T02:30:20Z"
    },
    {
      "id": 2,
      "sku": 8552515751438645,
      "name": "Camiseta Colcci Estampada Azul",
      "price": 79.90,
      "created_at": "2018-08-27T02:11:43Z",
      "updated_at": "2018-08-27T02:30:20Z"
    }
  ]';
});
$router->post('/data', function($request) {
  return json_encode($request->getBody());
});