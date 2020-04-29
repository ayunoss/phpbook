<?php

namespace app\controllers;

use app\Controller;
use app\models\Main;

class MainController extends Controller
{
    /** @var $model Main */
    public $model;

//  отображаем главную страницу
    public function indexAction()
    {
        $this->view->render('ayunoss.phpbook');
    }
//  отображаем страницу с древом папок этого проекта
    public function getDirectoriesTreeAction()
    {
        $path = '/home/ayunoss/Projects/phpbook/ayunoss';
        $data = $this->model->getDirectoriesTree($path, '');
        $this->view->render('Directory tree');
    }
//  отображаем форму обратной связи
    public function feedbackAction() {
        $this->view->render("Contact us");
    }
//  отправляем обратную связь на почту администратора
    public function sendFeedbackAction() {
        $username        = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
        $email           = trim($_POST['email']);
        $phonenumber     = filter_var(trim($_POST['phonenumber']), FILTER_SANITIZE_STRING);
        $feedback        = filter_var(trim($_POST['feedback']), FILTER_SANITIZE_STRING);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors = ['invalid_email' => 'Invalid email. Please try again. '];
            echo json_encode(["status" => "error", "errors" => $errors]);
            return;
        }
        $this->model->sendFeedback($username, $email, $phonenumber, $feedback);
        echo json_encode(['status' => 'success']);
    }
}