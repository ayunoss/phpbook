<?php
namespace app\models;

use app\Db;
use http\Exception\BadMethodCallException;
use app\models\Roles;

class Users {

//  добавляем нового пользователя в бд
    public static function addUser($userData) {
        $db = new Db();
        $role = new Roles();
        $newUser = $db->queryPDO("
        INSERT INTO Users 
        VALUES (NULL, '{$userData['login']}', '{$userData['email']}', '{$userData['phone']}', '{$userData['password']}', '{$userData['reset']}')
        ");
        $newUserRole = $role->setDefaultRole($db->lastInsertId());
    }
//  валидируем введенные данные
    public static function validateSignUpData($email, $password, $password_confirm) {
        $errors = [];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['invalid_email'] = "Invalid mail address";
        }
        if ($password != $password_confirm) {
            $errors['pwd_not_match'] = "Passwords do not match";
        }
        if (count($errors) > 0) return $errors;
    }
//  получаем данные о запрошенном пользователе
    public static function getUser($login, $password, $email) {
        $db = new Db();
        $user = $db->getDataViaPDO("SELECT * FROM Users WHERE (login = '{$login}' AND password = '{$password}')
                        OR (email = '{$email}' AND password = '{$password}')");
        return $user;
    }
//  получаем информацию о запрошенном пользователе
    public static function getUserInfo($userId) {
        $db = new Db();
        $userInfo = [];
        $userInfo['user'] = $db->getDataViaPDO("SELECT * FROM Users WHERE id = '{$userId}'");;
        $userInfo['info'] = $db->getDataViaPDO("SELECT * FROM User_info WHERE user_id = '{$userId}'");;
        return $userInfo;
    }
//  валидируем информацию о пользователе
    public static function validateUserInfo($firstName, $lastName, $birthdate, $address, $about) {
        $errors = [];

        if (!isset($firstName) || !isset($lastName) || !isset($birthdate) || !isset($address) || !isset($about)) {
            $errors['empty_data'] = "Please fill in this item";
        }
        if (count($errors) > 0) return $errors;
    }

    public static function addUserInfo($userInfo) {
        $db = new Db();
        $newUserInfo = $db->queryPDO("
        INSERT INTO User_info 
        VALUES ('{$userInfo['user_id']}', '{$userInfo['firstName']}', '{$userInfo['lastName']}',
         '{$userInfo['birthdate']}', '{$userInfo['age']}', '{$userInfo['address']}', '{$userInfo['about']}',
          '{$userInfo['links']}')");
    }

    public static function uploadUserInfo($userInfo) {
        $db = new Db();
        $userInfo = $db->queryPDO("UPDATE User_info 
                                    SET first_name='{$userInfo['firstName']}',
                                     last_name='{$userInfo['lastName']}',
                                      birthdate='{$userInfo['birthdate']}',
                                       age='{$userInfo['age']}',
                                       address='{$userInfo['address']}',
                                        about='{$userInfo['about']}',
                                         links='{$userInfo['links']}'
                                          WHERE user_id='{$userInfo['user_id']}}'");
    }


    public static function deleteUser($userId) {
        $db = new Db();
        $users = $db->getDataViaPDO("DELETE FROM Users WHERE id = '{$userId}'");
    }
}