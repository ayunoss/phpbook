<?php
namespace app\models;

use app\Db;
use app\Model;
use http\Exception\BadMethodCallException;
use app\models\Roles;

class Users extends Model {

//  добавляем нового пользователя в бд
    public static function addUser($userData) {
        $db = new Db();
        $role = new Roles();
        $newUser = $db->queryPDO("
        INSERT INTO Users 
        VALUES (NULL, '{$userData['login']}', '{$userData['email']}', '{$userData['phone']}', 
        '{$userData['password']}', '{$userData['reset']}', '0')");
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
        return $errors;
    }

//  отправляем письмо для подтверждения почты пользователя
    public function sendSignupConfirmationMail($to, $login, $code) {
        $subject  = "Confirm your email address";
        $message  = "<h1>Thank you for joining us!</h1>";
        $message .= "<h2>Please follow the <b>link below</b> to confirm your email address</h2>";
        $message .= "<p>";
        $message .= "http://ayunoss.phpbook/verification/?login=".$login."&secret_key=".$code;
        $message .= "</p>";
        $message .= "<p>";
        $message .=  "Please don't answer to this message. This mail was send automatically.";
        $message .= "</p>";
        $headers  = "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: <admin@ayunoss.phpbook>\r\n";
        $this->sendMail($to, $subject, $message, $headers);
        return;
    }

//  меняем статус почты на подтвержденный в бд
    public static function verifyMail($login, $key) {
        $db          = new Db();
        $is_verified = $db->queryPDO("UPDATE Users SET is_verified='1' WHERE login='{$login}'");
        return true;
    }

//  выполняем верификацию ссылки
    public static function verifyUserLink($login, $key) {
        $db           = new Db();
        $verification = $db->getDataViaPDO("SELECT pwd_reset_token FROM Users WHERE login = '{$login}'");
        if ($key !== $verification['pwd_reset_token']) {
            return false;
        }
    }

//  получаем данные о  запрошенном пользователе
    public static function getUser($login, $password, $email) {
        $db   = new Db();
        $user = $db->getDataViaPDO("SELECT * FROM Users WHERE (login = '{$login}' AND password = '{$password}')
        OR (email = '{$email}' AND password = '{$password}')");
        return $user;
    }

//  получаем информацию о запрошенном пользователе
    public static function getUserInfo($userId) {
        $db       = new Db();
        $userInfo = [];
        $userInfo['user'] = $db->getDataViaPDO("SELECT * FROM Users WHERE id = '{$userId}'");
        $userInfo['info'] = $db->getDataViaPDO("SELECT * FROM User_info WHERE user_id = '{$userId}'");
        return $userInfo;
    }

//  валидируем информацию о пользователе
    public static function validateUserInfo($firstName, $lastName, $birthdate, $address, $about) {
        $errors = [];
        if (!isset($firstName) || !isset($lastName) || !isset($birthdate) || !isset($address) || !isset($about)) {
            $errors['empty_data'] = "Please fill in this item";
        }
        return $errors;
    }

//  вносим информацию о пользователе в бд
    public static function addUserInfo($userInfo) {
        $db          = new Db();
        $newUserInfo = $db->queryPDO("
        INSERT INTO User_info 
        VALUES ('{$userInfo['user_id']}', '{$userInfo['firstName']}', '{$userInfo['lastName']}',
        '{$userInfo['birthdate']}', '{$userInfo['age']}', '{$userInfo['address']}', '{$userInfo['about']}',
        '{$userInfo['links']}')");
    }

//  редактрируем информацию о пользователе в бд
    public static function uploadUserInfo($userInfo) {
        $db       = new Db();
        $userInfo = $db->queryPDO("
        UPDATE User_info 
        SET first_name='{$userInfo['firstName']}', last_name='{$userInfo['lastName']}',
        birthdate='{$userInfo['birthdate']}', age='{$userInfo['age']}', address='{$userInfo['address']}',
        about='{$userInfo['about']}', links='{$userInfo['links']}' WHERE user_id='{$userInfo['user_id']}}'");
    }

//  удаляем пользователя, его информацию, роль и разрешения из бд
    public static function deleteUser($userId) {
        $db    = new Db();
        $user  = $db->getDataViaPDO("DELETE FROM Users WHERE id = '{$userId}'");
        $info  = $db->getDataViaPDO("DELETE FROM User_info WHERE user_id='{$userId}'");
        $role  = $db->getDataViaPDO("DELETE FROM User_roles WHERE user_id='{$userId}'");
        $perms = $db->getDataViaPDO("DELETE FROM User_perm WHERE user_id='{$userId}'");
    }

//  проверяем существует ли такой пользователь
    public static function issetUser($email) {
        $db           = new Db();
        $verification = $db->getDataViaPDO("SELECT * FROM Users WHERE email = '{$email}'");
        return $verification;
    }

//  отправлем письмо для восстановления пароля
    public function sendRecoveryMail($to, $login, $code) {
        $subject  = "Password recovery";
        $message  = "<h1>Reset your password !</h1>";
        $message .= "<h2>Please follow the <b>link below</b> to create new password to your account.</h2>";
        $message .= "<p>";
        $message .= "http://ayunoss.phpbook/reset-password/?login=".$login."&secret_key=".$code;
        $message .= "</p>";
        $message .= "<p>";
        $message .=  "Please don't answer to this message. This mail was send automatically.";
        $message .= "</p>";
        $headers  = "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: <admin@ayunoss.phpbook>\r\n";
        $this->sendMail($to, $subject, $message, $headers);
        return;
    }

//  меняем пароль в бд
    public static function resetPassword($login, $newpwd) {
        $db       = new Db();
        $password = $db->queryPDO("UPDATE Users SET password='{$newpwd}' WHERE login='{$login}'");
    }
}