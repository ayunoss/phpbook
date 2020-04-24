<?php
namespace app;
use app\View;

class Router
{
    protected $routes = [];
    protected $params = [];

//  достаем пути из массива web.php и передаем для записи
    function __construct() {
        $arr = require "routes/web.php";
        foreach ($arr as $key => $val) {
            $this->addRoute($key, $val);
        }
    }
//  добавляем пути из массива web.php в $routes
    public function addRoute($route, $params) {
        $this->routes[$route] = $params;
    }
//  проверяем существование такого пути по ключу === 'REQUEST_URI' в файле web.php
    public function match() {
        //удаляем / из начала/конца строки запроса
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            $route = preg_replace('/{([a-z]+):([^\}]+)}/','(?P<\1>\2)', $route);
            $route = '#^'.$route.'$#';
            if (preg_match($route, $url, $matches)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }
//  генерируем путь по 'name' из web.php для ссылок в шаблонах
    public function generatePathName($name) {
        foreach ($this->routes as $path => $params) {
            if (in_array($name, $params)) {
                $url = "http://ayunoss.phpbook/".$path;
                return $url;
            }
        }
    }
//  подготавливаем action с методом отправки по http, если метод не задан просто возвращаем 'action' из web.php
    public function prepareAction($action) {
        if (is_array($action)) {
            $method = $_SERVER['REQUEST_METHOD'];
            $action = $action[$method];
        }
        return $action;
    }
//  запускаем нужный метод
    public function runAction() {
        if ($this->match()) {
            $path = 'app\controllers\\'.ucfirst($this->params['controller']).'Controller';
            //var_dump($path);
            if (class_exists($path)) {
                $action = $this->prepareAction($this->params['action']) . 'Action';
                //var_dump($action);
                if (method_exists($path, $action)) {
                    $controller = new $path($this->params);
                    $controller->$action();
                    //var_dump($controller);
                } else {
                    View::errorCode(404);
                }
            } else {
                View::errorCode(404);
            }
        } else {
            View::errorCode(404);
        }
    }
}