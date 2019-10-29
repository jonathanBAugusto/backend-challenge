<?php

namespace routes;

class Router
{
  private $request;
  private $supportedHttpMethods = array(
    "GET",
    "POST",
    "PUT"
  );
  function __construct(IRequest $request)
  {
    $this->request = $request;
  }
  function __call($name, $args)
  {
    list($route, $method) = $args;
    if (!in_array(strtoupper($name), $this->supportedHttpMethods)) {
      $this->invalidMethodHandler();
    }
    $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
  }
  private function formatRoute($route)
  {
    $result = rtrim($route, '/');
    if ($result === '') {
      return '/';
    }
    return $result;
  }
  private function invalidMethodHandler()
  {
    header("{$this->request->serverProtocol} 405 Method Not Allowed");
  }
  private function defaultRequestHandler()
  {
    header("{$this->request->serverProtocol} 404 Not Found");
  }
  function resolve()
  {
    $methodDictionary = $this->{strtolower($this->request->requestMethod)};
    $formatedRoute = $this->formatRoute($this->request->requestUri);
    $this->getMethodWithVars($methodDictionary, $formatedRoute);
    $method = $methodDictionary[$formatedRoute];
    if (is_null($method)) {
      $this->defaultRequestHandler();
      return;
    }
    echo call_user_func_array($method, array($this->request));
  }

  function getMethodWithVars($methods, $route)
  {
    if(isset($methods[$route]))
      return $methods[$route];
    $eachsMethod = explode('/', $route);
    $routeFinal = null;
    foreach ($eachsMethod as $value) {
      $routeFinal .= isset($routeFinal) ? ('/' . $value) : $value;
      echo($routeFinal);
      if(!isset($methods[$routeFinal])){
        $routeBef = str_replace('/' . $value, '', $routeFinal);
        if(isset($methods[$routeBef . '{'])){
          echo('OPA');
          if (strpos($value, '{') && strpos($value, '}')) 
          {
            var_dump($routeBef . $value);
          }
        }
      }else 
        echo('CERTO');
    }
    die();
  }
  function __destruct()
  {
    $this->resolve();
  }
}
