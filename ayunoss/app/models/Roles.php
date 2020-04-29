<?php
namespace app\models;

use app\Db;
use app\models\Permissions;

class Roles {

    protected $db;
    protected $perm;

    public function __construct() {
        $this->db   = new Db();
        $this->perm = new Permissions();
    }

//  назначаем стандартную роль для зарегистрированных пользователей
    public function setDefaultRole($user_id) {
        $userRole    = 4;
        $defaultRole = $this->db->queryPDO("INSERT INTO User_roles VALUES ('{$user_id}', '{$userRole}')");
    }
//  устанавливаем роль пользователю
    public function setRole($user_id, $role_id) {
        $userRole = $this->db->queryPDO("UPDATE User_roles SET role_id='{$role_id}' WHERE user_id='{$user_id}'");
    }

//  загружаем роли всех пользователей
    public function getAllUserRoles() {
        $userRoles = $this->db->getAssocDataViaPDO("SELECT * FROM User_roles");
        return $userRoles;
    }

//  загружаем список всех доступных ролей
    public function getAllRoles() {
        $roles = $this->db->getAssocDataViaPDO("SELECT * FROM Roles");
        return $roles;
    }

//  добавляем новую роль в бд
    public function addRole($roleName) {
        $newRole = $this->db->queryPDO("INSERT INTO Roles VALUES (NULL, '{$roleName}')");
    }

//  достаем все имена ролей и разрешения для них
    public function getPermsForRole() {
        $names = $this->db->getAssocDataViaPDO("SELECT role_name, Permissions.perm_name FROM Roles INNER JOIN Role_perm ON Roles.id = Role_perm.role_id INNER JOIN Permissions ON Permissions.id = Role_perm.perm_id");
        return $names;
    }

//  удаляем роль и все ее связи из бд
    public function deleteRole($role_id) {
        $user_id = $this->db->getDataViaPDO("SELECT user_id FROM User_roles WHERE role_id = '{$role_id}'");
        $role    = $this->db->getDataViaPDO("DELETE FROM Roles WHERE id = '{$role_id}'");
        $user    = $this->db->getDataViaPDO("DELETE FROM User_roles WHERE role_id='{$role_id}'");
        $perms   = $this->db->getDataViaPDO("DELETE FROM Role_perm WHERE role_id='{$role_id}'");
        foreach ($user_id as $value) {
            $user_perms = $this->db->getDataViaPDO("DELETE FROM User_perm WHERE user_id = '{$value}'");
        }
    }
}