<?php

namespace app\controllers;


use app\Controller;
use app\models\Main;

class MainController extends Controller
{
    public $model;

//    public function __construct($route)
//    {
//        parent::__construct($route);
//        $this->model = new Main();
//    }

//  отображаем главную страницу
    public function indexAction()
    {
        $this->view->render('Welcome');
    }
//  отображаем страницу с древом папок этого проекта
    public function getDirectoriesTreeAction()
    {
        $path = '/home/ayunoss/Projects/phpbook/ayunoss';
        $data = $this->model->getDirectoriesTree($path, '');
        $this->view->render('Directory tree');
    }

    public function feedbackAction() {

    }
}