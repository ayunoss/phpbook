<?php
namespace app\controllers;

use app\Controller;
use app\models\Permissions;
use app\models\Rbac;
use app\models\Roles;

class RbacController extends Controller {

    /** @var $model Rbac */
    public $model;

//  отображаем страницу со всеми данными о пользователях
    public function getUsersAction() {
        $users    = $this->model->getUsers();
        $rbacData = $this->model->getAllUserRoleNPerm();
        $this->view->render('Users List', $users, $rbacData);
    }
//  отображаем страницу выбора роли для пользователя
    public function setRoleAction() {
        $role    = new Roles();
        $roles   = $role->getAllRoles();
        $user_id = $this->model->getUsers();
        $this->view->render('Set User Role', $roles, $user_id);
    }
//  назначаем пользователю роль
    public function asignRoleAction() {
        $user_id = filter_var(trim($_POST['user_id']), FILTER_SANITIZE_STRING);
        $role_id = filter_var(trim($_POST['selectRole']), FILTER_SANITIZE_STRING);
        $this->model->setRole2User($user_id, $role_id);
        $this->view::redirect('root/users');
    }
}