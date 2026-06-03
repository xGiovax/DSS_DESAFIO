<?php
class Router {
    public function route() {
        $url = $_GET['url'] ?? 'auth/login';
        $url = rtrim($url, '/');
        $parts = explode('/', $url);

        $controller = ucfirst($parts[0] ?? 'auth') . 'Controller';
        $method     = $parts[1] ?? 'index';

        $controllerFile = __DIR__ . '/../controllers/' . $controller . '.php';

        if (file_exists($controllerFile)) {
            require_once $controllerFile;
            $obj = new $controller();
            if (method_exists($obj, $method)) {
                $obj->$method();
            } else {
                $this->error404();
            }
        } else {
            $this->error404();
        }
    }

    private function error404() {
        http_response_code(404);
        echo "<h1>404 - Página no encontrada</h1>";
    }
}
?>