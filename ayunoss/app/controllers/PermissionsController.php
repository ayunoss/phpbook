<?php
namespace app\controllers;

use app\Controller;
use app\models\Roles;

class PermissionsController extends Controller {
//  отображаем список разрешений
    public function showPermsAction() {
        $perms = $this->model->getPerms();
        $this->view->render('Permissions list', $perms);
    }
//  добавляем новое разрешение в бд
    public function addPermsAction() {
        $permName = filter_var(trim($_POST['perm_name']), FILTER_SANITIZE_STRING);
        $this->model->addPerm($permName);
        $this->view::redirect('root/permissions');
    }
//  отображаем страницу назначения разрешений для роли
    public function setPermissionsAction() {
        $role = new Roles();
        $roles = $role->getAllRoles();
        $perms = $this->model->getPerms();
        $this->view->render('Set permissions to role', $roles, $perms);
    }
//  устанавливаем разрешения для выбранной роли
    public function asignPermissionsAction() {
        $role_id = filter_var(trim($_POST['chooseRole']), FILTER_SANITIZE_STRING);
        $permissions = $_POST['setPermission'];
        $exec = $this->model->setPermissions2Role($role_id, $permissions);
        $this->view::redirect('root/roles');
    }
}