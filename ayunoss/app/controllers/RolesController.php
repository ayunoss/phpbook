<?php
namespace app\controllers;

use app\Controller;
use app\models\Permissions;

class RolesController extends Controller {
//  отображаем список ролей и их разрешений
    public function showRolesAction() {
        $roles = $this->model->getAllRoles();
        $perms = $this->model->getPermsForRole();
        $this->view->render('Roles list', $roles, $perms);
    }
//  отображаем страницу добавления новой роли
    public function addRoleAction() {
        $this->view->render('Add new Role');
    }
//  заносим новую роль в бд
    public function executeAddingRoleAction() {
        $roleName = filter_var(trim($_POST['role_name']), FILTER_SANITIZE_STRING);
        $this->model->addRole($roleName);
        $this->view::redirect('root/roles');
    }

}