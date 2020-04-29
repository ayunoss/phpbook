<?php
namespace app\controllers;

use app\Controller;
use app\models\Permissions;
use app\models\Roles;

class RolesController extends Controller {

    /** @var $model Roles */
    public $model;

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
//  создаем новую роль
    public function executeAddingRoleAction() {
        $roleName = filter_var(trim($_POST['role_name']), FILTER_SANITIZE_STRING);
        $this->model->addRole($roleName);
        $this->view::redirect('root/roles');
    }
//  удаляем роль
    public function deleteRoleAction() {
        $role_id = $_GET['id'];
        $this->model->deleteRole($role_id);
        $this->view::redirect('root/roles');
    }

}