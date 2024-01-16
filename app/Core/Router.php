<?php

declare(strict_types=1);

namespace Core;

use Core\Response;

class Router
{
  protected $routes = [];

  private function _add(string $method, string $uri, string $controller)
  {
    $this->routes[] = [
      'uri' => $uri,
      'controller' => $controller,
      'method' => $method,
    ];
  }

  public function get(string $uri, string $controller)
  {
    $this->_add('GET', $uri, $controller);
  }

  public function post(string $uri, string $controller)
  {
    $this->_add('POST', $uri, $controller);
  }

  public function route($uri, $method)
  {
    foreach ($this->routes as $route) {
      if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
        return require base_path($route['controller']);
      }
    }

    $this->_abort();
  }

  private function _abort($code = Response::NOT_FOUND)
  {
    abort($code);
  }
}
