<?php
namespace app;

use app\models\Rbac;
use app\Db;
use http\Header;

abstract class Controller {

    public $route;
    public $view;
    public $db;
    public $model;
    public $rbac;

//  $route - передается из метода runAction и равен $this->params
    public function __construct($route) {
        $this->route = $route;
        $this->rbac = new Rbac();
        // проверяем есть ли у пользователя доступ к просмотру страницы
        if ($this->checkAccess() === false) {
            $this->view::errorCode(403);
        }

        $this->db = new Db();
        $this->view = new View($route);
        // подключаемся к одноименной модели данного контроллера
        $this->model = $this->loadModel($route['controller']);
    }
//  возвращаем путь к модели определенного контроллера
    public function loadModel($name) {
        $path = 'app\models\\'.ucfirst($name);
        if (class_exists($path)) {
            return new $path;
        }
    }
//  проверяем доступ пользователя к запрашиваемой странице
    public function checkAccess() {
        $user_id = $this->isAuth();
        if ($user_id === '1') {
            return true;
        }
        $data = $this->rbac->getRoleNPerms($user_id);
        foreach ($data as $permission) {
            if ($permission['perm_name'] === $this->route['name']) return true;
        }
        return false;
    }
//  проверяем авторизирован ли пользователь, если да - возвращаем его id
    public function isAuth() {
        if (isset($_SESSION['logged_in'])) {
            return $_SESSION['user_id'];
        } else {
            return 0;
        }
    }

}