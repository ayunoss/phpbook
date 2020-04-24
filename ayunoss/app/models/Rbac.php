<?php
namespace app\models;

use app\Db;
use app\models\Roles;
use app\models\Permissions;

class Rbac
{
    protected $db;
    protected $role;
    protected $permission;

    public function __construct() {
        $this->db = new Db();
        $this->role = new Roles();
    }
//  получаем все данные о пользователях
    public function getUsers() {
        $users = $this->db->getAssocDataViaPDO("SELECT * FROM Users");
        return $users;
    }
//  назначаем роль пользователю
    public function setRole2User($user_id, $role_id) {
        $userRole = $this->role->setRole($user_id, $role_id);
    }
//  достаем всех пользователей и их роли и разрешения
    public function getAllUserRoleNPerm() {
        $data = $this->db->getAssocDataViaPDO("SELECT user_id, Roles.role_name, Permissions.perm_name FROM User_roles INNER JOIN Roles ON User_roles.role_id = Roles.id INNER JOIN Role_perm ON Roles.id = Role_perm.role_id INNER JOIN Permissions ON Permissions.id = Role_perm.perm_id");
        return $data;
    }
//  достаем роль и разрешения конкретного пользователя
    public function getRoleNPerms($user_id) {
        $data = $this->db->getAssocDataViaPDO("SELECT User_roles.role_id, Roles.role_name, Permissions.perm_name FROM User_roles INNER JOIN Roles ON User_roles.role_id = Roles.id INNER JOIN Role_perm ON Roles.id = Role_perm.role_id INNER JOIN Permissions ON Permissions.id = Role_perm.perm_id WHERE user_id = '{$user_id}'");
        return $data;
    }

}