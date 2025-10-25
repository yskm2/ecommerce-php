<?php
namespace App;

/**
 * Router - Gestión de rutas
 * 
 * VENTAJAS:
 * - Mapeo limpio de URLs a Controladores
 * - Fácil de mantener y extender
 * - Separa GET de POST
 */
class Router {
    private $routes = [];
    
    /**
     * Registrar ruta GET
     */
    public function get($route, $controller, $method) {
        $this->routes['GET'][$route] = [
            'controller' => $controller,
            'method' => $method
        ];
    }
    
    /**
     * Registrar ruta POST
     */
    public function post($route, $controller, $method) {
        $this->routes['POST'][$route] = [
            'controller' => $controller,
            'method' => $method
        ];
    }
    
    /**
     * Despachar la ruta solicitada
     */
    public function dispatch() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $route = $_GET['route'] ?? 'home';
        
        // Buscar la ruta
        if (isset($this->routes[$requestMethod][$route])) {
            $routeInfo = $this->routes[$requestMethod][$route];
            
            // Instanciar controlador y llamar al método
            $controllerName = $routeInfo['controller'];
            $methodName = $routeInfo['method'];
            
            $controller = new $controllerName();
            return $controller->$methodName();
        }
        
        // Ruta no encontrada
        $this->notFound();
    }
    
    /**
     * Página 404
     */
    private function notFound() {
        http_response_code(404);
        echo "<h1>404 - Página no encontrada</h1>";
        exit;
    }
}