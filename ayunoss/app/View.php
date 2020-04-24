<?php
namespace app;

class View
{
    public $path;
    public $route;
    public $layout = 'default';
    public $router;

//  $route - передается из метода runAction и равен $this->params
    public function __construct($route) {
        $this->route = $route;
        $this->router = new Router();
        $action = $this->router->prepareAction($route['action']);
        $this->path = $route['controller'].'/'.$action;
        //$this->layout = $action;
    }
//  отображаем страницу
    public function render($title, $data = [], $data2 = [], $data3 = []) {
        // достаем данные для отображения, если они есть
        extract($data);
        extract($data2);
        extract($data3);
        //  генерируем путь по 'name' из web.php для ссылок в шаблонах
        $generateUrl = function($name) {
            return $this->router->generatePathName($name);
        };
        // путь для шаблона
        $path = 'resources/views/'.$this->path.'.php';
        if (file_exists($path)) {
            ob_start();
            require $path;
            $content = ob_get_clean();
            require 'resources/views/layouts/'.$this->layout.'.php';
        } else {
            echo $this->path.' is not found';
        }
    }
//  отображаем страницу с ошибкой
    public static function errorCode($code) {
        http_response_code($code);
        $path = 'resources/views/errors/'.$code.'.php';
        if (file_exists($path)) {
            require $path;
        }
        exit();
    }
//  отображаем сообщение об ошибке
    public static function errorMessage($message) {
        return $error = $message;
    }
//  отправляем заголовок на редирект
    public static function redirect($url, $errors = []) {
        header('location: /'.$url);
        exit();
    }
}