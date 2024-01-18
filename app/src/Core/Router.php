<?php

declare(strict_types=1);

namespace App\Core;

class Router
{
  protected $routes = [];

  public function addRoute(string $route, mixed $controller, string $action): void
  {
    $this->routes[$route] = [
      'controller' => $controller,
      'action' => $action,
    ];
  }

  public function dispatch(string $uri)
  {
    if (!array_key_exists($uri, $this->routes)) {
      $json = new JSON();
      $json->response(['status' => Response::NOT_FOUND]);
    }

    $controller = $this->routes[$uri]['controller'];
    $action = $this->routes[$uri]['action'];

    $controller = new $controller();
    $controller->$action();
  }
}
