<?php

class Router
{
    protected $routes = [];

    public function get($uri, $controller)
    {

        $this->add($uri, $controller, 'GET');
    }
    public function post($uri, $controller)
    {
        $this->add($uri, $controller, 'POST');
    }

    public function put($uri, $controller)
    {
        $this->add($uri, $controller, 'PUT');
    }

    public function delete($uri, $controller)
    {
        $this->add($uri, $controller, 'DELETE');
    }



    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                require $route['controller'];
            }
        }
    }

    public function add($uri, $controller, $method)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];

        return $this;
    }

    public function only($key) {
        if ($key=== "auth") {
            $isLogged = $_SESSION['isLogged'] ?? false;
            
        }

    }
}

$router = new Router();
require base_path('/src/router/routes.php');
// uri and method come from the index.php file where the router is required
$router->route(
    $uri,
    $method
);
