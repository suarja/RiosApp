<?php


// function routeToController($routes)
// {
//     $uri = $_SERVER['REQUEST_URI'];
//     // Normalize the URI to ensure routing works as expected
//     $uri = parse_url($uri, PHP_URL_PATH);

//     if (array_key_exists($uri, $routes)) {
//         require $routes[$uri];
//     } else {
//         http_response_code(404);
//         echo "404 Not Found";
//     }
// }

class Router
{
    protected $routes = [];

    public function get($uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'GET'
        ];
    }
    public function post($uri, $controller)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => 'POST'
        ];
    }
    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                require $route['controller'];
            }
        }
    }
}
