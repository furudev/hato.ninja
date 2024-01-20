<?php

declare(strict_types=1);

namespace App\Core;

use App\Models\Route;

class Router
{
  protected array $routes = [];

  public function addRoute(Route $route): void
  {
    $this->routes[$route->path] = [
      'controller' => $route->controller,
      'action' => $route->action,
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
