<?php

class Router {

    private $routers;

    public function __construct() {
        $routesPath = ROOT . '/config/routes.php';
        $this->routers = include ($routesPath);
    }

    private function getURI() {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return preg_replace("~/online_shop/~", '', $_SERVER['REQUEST_URI']);
            // return trim($_SERVER['REQUEST_URI'], "/online_shop/");
        }
    }

    public function run() {
        $uri = $this->getURI();

        foreach ($this->routers as $uriPattern => $path) {

            if (preg_match("~$uriPattern~", $uri)) {
                $way = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $way);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));

                $parametrs = $segments;
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once $controllerFile;
                }
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parametrs);

                if ($result != NULL) {
                    break;
                }
            }
        }
    }
}
