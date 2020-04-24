<?php
namespace app\models;

use app\Db;

class Permissions {

    protected $db;
    public $permissions = [];

    public function __construct() {
        $this->db = new Db();
        $arr = require "config/permissions.php";
        foreach ($arr as $key => $val) {
            $this->getConfig($key, $val);
        }
    }
//  выводи все доступные разрешения
    public function getPerms() {
        $perms = $this->db->getAssocDataViaPDO("SELECT * FROM Permissions");
        return $perms;
    }
//  добавляем новое разрешение в бд
    public function addPerm($permName) {
        $newPerm = $this->db->queryPDO("INSERT INTO Permissions VALUES (NULL, '{$permName}')");
    }
//  заносим новые разрешений для роли в бд
    public function setPermissions2Role($role_id, $permissions) {
        foreach($permissions as $val) {
            $this->db->queryPDO("INSERT INTO Role_perm VALUES ('{$role_id}', '{$val}')");
        }
    }
//  достаем данные из конфига
    public function getConfig($name, $params) {
        $this->permissions[$name] = $params;
    }
//  достаем разрешения из конфига для конкретного пользователя
    public function getPermissionsConfig($perms) {
        $config = [];
        foreach ($perms as $key => $perm) {
            if(array_key_exists($perm, $this->permissions)) {
                $config[$perm] = $this->permissions[$perm];
            }
        }
        return $config;
    }
}