<?php
namespace app\controllers;
use app\Controller;
use app\models\Images;
use app\View;

class ImagesController extends Controller
{
//  отображаем галерею изображений
    public function showAction() {
        $images = Images::findImg("storage/images");
        $this->view->render('Images Library', $images);
    }
//  отображаем форму загрузки изображений
    public function downloadFormAction() {
        $this->view->render('Download images');
    }

//  загружаем картинку через форму
    public function downloadImgAction() {
        if(isset($_FILES['image'])){
            $filePath = "storage/images/".$_FILES['image']['name'];
            $file = $_FILES['image']['tmp_name'];
            Images::donwloadImg($filePath, $file);
        }
    }
}