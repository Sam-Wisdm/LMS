<?php
use app\core\Request;
use app\core\Response;

// namespace app\core;
// require_once './Request.php';
// require_once './Response.php';

class Router {
    // public $request = new Request();
    // public $response = new Response();
    protected array $routes = [];

    public function get($path, $callback)  {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback)  {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve($uri) {
        $route = parse_url($uri, PHP_URL_PATH);
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        
        if (array_key_exists($method, $this->routes) && array_key_exists($route, $this->routes[$method])) {
            // Call the callback function associated with the route
            $callback = $this->routes[$method][$route];
            $callback();
        } else {
            // Route not found
            http_response_code(404);
            echo "404";
            // echo "<script>console.log('404')</script>";
            header("Location: http://localhost:{$_SERVER['SERVER_PORT']}/views/_404.php");
            exit;
        }
    }

}