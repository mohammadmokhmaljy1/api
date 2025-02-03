<?php

// class Router {
//     private $routes = [];

//     public function add($uri, $controllerAction) {
//         $this->routes[$uri] = $controllerAction;
//     }

//     public function dispatch($uri) {
//         foreach ($this->routes as $route => $controllerAction) {
//             if (preg_match("#^$route$#", $uri, $matches)) {
//                 list($controller, $action) = explode('@', $controllerAction);
//                 if (class_exists($controller)) {
//                     $controllerObject = new $controller();
//                     if (method_exists($controllerObject, $action)) {
//                         return call_user_func_array([$controllerObject, $action], array_slice($matches, 1));
//                     } else {
//                         http_response_code(404);
//                         echo "Action not found!";
//                         return;
//                     }
//                 } else {
//                     http_response_code(404);
//                     echo "Controller not found!";
//                     return;
//                 }
//             }
//         }
//         http_response_code(404);
//         echo "Route not found!";
//     }
// }

class Router {
    private $routes = [];

    public function add($uri, $controllerAction) {
        $this->routes[$uri] = $controllerAction;
    }

    public function dispatch($uri) {
        foreach ($this->routes as $route => $controllerAction) {
            if (preg_match("#^$route$#", $uri, $matches)) {
                list($controller, $action) = explode('@', $controllerAction);
                if (class_exists($controller)) {
                    $controllerObject = new $controller();
                    if (method_exists($controllerObject, $action)) {
                        return call_user_func_array([$controllerObject, $action], array_slice($matches, 1));
                    } else {
                        $this->sendResponse(404, "Action not found!");
                        return;
                    }
                } else {
                    $this->sendResponse(404, "Controller not found!");
                    return;
                }
            }
        }
        $this->sendResponse(404, "Route not found!");
    }

    private function sendResponse($statusCode, $message) {
        http_response_code($statusCode);
        echo $message;
    }
}