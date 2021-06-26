<?php
class App
{
    protected $controller = 'SiteController';
    protected $method = 'index';
    protected $params = [];
    public function __construct()
    {
        $url = $this->parseUrl();
        if (isset($url[0])) {
            if (file_exists('controllers/' . $url[0] . 'Controller.php')) {
                $this->controller = $url[0] . 'Controller'; //cart . controller = cartcontroller
                unset($url[0]);
                if (isset($url[1])) {
                    $this->method = $url[1];
                    unset($url[1]);
                }
            } else {
                $this->controller = "NotFoundController";
            }
        }
        require_once 'controllers/' . $this->controller . '.php';
        $controllerObject = new $this->controller;
        if (!method_exists($this->controller, $this->method) && $this->controller !== "NotFoundController") {
            $this->controller = "NotFoundController";
            require_once 'controllers/' . $this->controller . '.php';
            $controllerObject = new $this->controller;
            $this->method = 'index';
        }
        $this->params = $url ? array_values($url) : [];

        call_user_func_array(array($controllerObject, $this->method), $this->params);
    }


    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}