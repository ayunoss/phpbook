<?php
namespace app\controllers;
use app\Controller;
use app\models\Main;
use app\models\Users;

class UsersController extends Controller {

    /** @var $model Users */
    public $model;

//  отображаем форму регистрации
    public function registerAction() {
        $this->view->render('Sign up');
    }

//  выполняем регистрацию пользователя via ajax
    public function executeRegisterAction() {
        $username        = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
        $email           = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $phonenumber     = filter_var(trim($_POST['phonenumber']), FILTER_SANITIZE_STRING);
        $password        = filter_var(trim($_POST['passwordsignup']), FILTER_SANITIZE_STRING);
        $passwordconfirm = filter_var(trim($_POST['password_confirm']), FILTER_SANITIZE_STRING);
        // выполняем валидацию пароля и почты
        $errors          = Users::validateSignUpData($email, $password, $passwordconfirm);
        // если не проходит валидацию перенаправляем снова на форму регистрации
        if (count($errors) > 0) {
            echo json_encode(['status' => 'error', 'errors' => $errors]);
            return;
        }
        // если валидация успешна хэшируем пароль и создаем массив с данными пользователя
        $passwordHash = md5($password);
        $resetToken   = md5($username).md5($phonenumber);
        $userData     = [
            'login'    => $username,
            'phone'    => $phonenumber,
            'email'    => $email,
            'password' => $passwordHash,
            'reset'    => $resetToken,
        ];
        // заносим нового пользователя в базу данных
        Users::addUser($userData);
        // отправляем письмо с ссылкой для подтверждения регистрации
        $this->model->sendSignupConfirmationMail($email, $username, $resetToken);
        echo json_encode(['status' => 'success']);
        //$this->view::redirect('login');
    }

//  выполняем подтверждение почты пользователя
    public function verifyUserEmailAction() {
        $login        = $_GET['login'];
        $secretKey    = $_GET['secret_key'];
        $verification = Users::verifyUserLink($login, $secretKey);
        if ($verification === false) {
            $this->view::errorCode(403);
        }
        Users::verifyMail($login);
        $this->view::redirect('login');
    }

//  отображаем форму авторизации
    public function loginAction() {
        $this->view->render('Sign in');
    }

//  выполняем авторизацию пользователя
    public function authAction() {
        $login           = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
        $passwordHash    = md5(filter_var(trim($_POST['passwordlogin']), FILTER_SANITIZE_STRING));
        $email           = filter_var(trim($_POST['login']), FILTER_SANITIZE_EMAIL);
        $user            = Users::getUser($login, $passwordHash, $email);
        // если такой пользователь не существует перенаправляем снова на страницу авторизации
        if(!isset($user)){
            $this->view::redirect('login');
        }
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['username']  = $login;
        $_SESSION['logged_in'] = true;
        // если пользователь явл-ся администратором создаем сессию для админа
        if($user['username'] === 'admin' || $user['email'] === 'admintest@bk.ru') {
            $_SESSION['access_admin'] = true;
        }
        $this->view::redirect('personal-account');
    }

//  отображаем страницу пользователя
    public function accountAction() {
        if (isset($_SESSION['logged_in'])){
            $userData = Users::getUserInfo($_SESSION['user_id']);
            $userInfo = [];
            // добавляем данные о пользователе в массив для передачи в шаблон
            foreach ($userData['user'] as $key => $value) {
                $userInfo[$key] = $value;
            }
            // если есть информация о пользователе, добавляем ее массив данных для передачи в шаблон
            if($userData['info'] !== null) {
                foreach ($userData['info'] as $key => $value) {
                    $userInfo[$key] = $value;
                }
            }
            $this->view->render('Personal account', $userInfo);
        } else $this->view::redirect('login');
    }

//  отображаем страницу добавления данных пользователя
    public function userInfoAction() {
        $this->view->render('Add your personal info');
    }

//  выполняем загрузку данных пользователя
    public function addUserInfoAction() {
        $firstName           = filter_var(trim($_POST['firstName']), FILTER_SANITIZE_STRING);
        $lastName            = filter_var(trim($_POST['lastName']), FILTER_SANITIZE_STRING);
        $birthdate           = filter_var(trim($_POST['birthdate']), FILTER_SANITIZE_STRING);
        $address             = filter_var(trim($_POST['address']), FILTER_SANITIZE_STRING);
        $about               = filter_var(trim($_POST['about']), FILTER_SANITIZE_STRING);
        $links               = filter_var(trim($_POST['links']), FILTER_SANITIZE_STRING);
        $errors = Users::validateUserInfo($firstName, $lastName, $birthdate, $address, $about);
        if(count($errors) > 0) {
            echo json_encode(['status' => 'error', 'errors' => $errors]);
            return;
        }
        $age     = $this->getUserAge($birthdate);
        $user_id = $_GET['id'];
        $userInfo = [
            'firstName' => $firstName,
            'lastName'  => $lastName,
            'birthdate' => $birthdate,
            'age'       => $age,
            'address'   => $address,
            'about'     => $about,
            'links'     => $links,
            'user_id'   => $user_id,
        ];

        $result = Users::addUserInfo($userInfo);
    }

//  отображаем страницу обновления данных пользователя
    public function uploadInfoAction() {
        $user_id  = $_GET['id'];
        $userData = Users::getUserInfo($user_id);
        $this->view->render('Upload your personal info', $userData['info']);
    }

//  выполняем обновление данных пользователя
    public function uploadUserInfoAction() {
        $firstName           = filter_var(trim($_POST['firstName']), FILTER_SANITIZE_STRING);
        $lastName            = filter_var(trim($_POST['lastName']), FILTER_SANITIZE_STRING);
        $birthdate           = filter_var(trim($_POST['birthdate']), FILTER_SANITIZE_STRING);
        $address             = filter_var(trim($_POST['address']), FILTER_SANITIZE_STRING);
        $about               = filter_var(trim($_POST['about']), FILTER_SANITIZE_STRING);
        $links               = filter_var(trim($_POST['links']), FILTER_SANITIZE_STRING);
        $age                 = $this->getUserAge($birthdate);
        $user_id             = $_GET['id'];

        $userInfo = [
            'firstName' => $firstName,
            'lastName'  => $lastName,
            'birthdate' => $birthdate,
            'age'       => $age,
            'address'   => $address,
            'about'     => $about,
            'links'     => $links,
            'user_id'   => $user_id,
        ];
        $result = Users::uploadUserInfo($userInfo);
        $this->view::redirect('personal-account');
    }

//  получаем возраст пользоателя по его дате рождения
    public function getUserAge($birthdate) {
        $date_today    = date("Y-m-d");
        $you_date_unix = strtotime($birthdate);
        $now_date_unix = strtotime($date_today);
        $years         = ($now_date_unix - $you_date_unix) / (60*60*24*365); // Расчитываем года
        $age           = floor($years);
        return $age;
    }

//  выход из учетной записи и уничтожение сессии пользователя
    public function logoutAction() {
        unset($_SESSION['logged_in']);
        unset($_SESSION['access_admin']);
        if(isset($_GET['logout'])) {
            session_destroy();
            exit;
        }
        $this->view::redirect('login');
    }

//  удаление учетной записи пользователя
    public function deleteUserAction() {
        $user_id = $_GET['id'];
        $this->model->deleteUser($user_id);
        $this->view::redirect('root/users');
    }

//  отображаем страницу восстановления пароля
    public function forgetPasswordAction() {
        $this->view->render("Recovery password");
    }

//  отправляем письмо для восстановления пароля via ajax
    public function sendRecoveryLinkAction() {
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
        $user  = Users::issetUser($email);

        if ($user === null) {
            $errors = ['invalid_email' => 'There are no registered users with this email address. Please try again.'];
            echo json_encode(['status' => 'error', 'errors' => $errors]);
            return;
        }
        $this->model->sendRecoveryMail($email, $user['login'], $user['pwd_reset_token']);
        echo json_encode(['status' => 'success']);
    }

//  отображаем форму для изменения пароля
    public function recoveryPasswordAction() {
        $this->view->render("Recovery password");
    }

//  заменяем пароль в бд via ajax
    public function resetPasswordAction() {
        $login          = $_GET['login'];
        $reset_token    = $_GET['secret_key'];
        $verification   = Users::verifyUserLink($login, $reset_token);

        if ($verification === false) {
            $this->view::errorCode(403);
        }
        $newpwd         = md5(filter_var(trim($_POST['newpwd']), FILTER_SANITIZE_STRING));
        $newpwd_confirm = md5(filter_var(trim($_POST['newpwd_confirm']), FILTER_SANITIZE_STRING));

        if ($newpwd !== $newpwd_confirm) {
            $errors = ['invalid_pwd' => 'Passwords do not match. Please try again.'];
            echo json_encode(['status' => 'error', 'errors' => $errors]);
            return;
        }
        Users::resetPassword($login, $newpwd);
        echo json_encode(['status' => 'success']);
    }
}