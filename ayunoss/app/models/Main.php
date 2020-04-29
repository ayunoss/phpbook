<?php
namespace app\models;

use app\Model;

class Main extends Model {

    public $icons = [];

    public function __construct()
    {
        $arr = require "config/mimes.php";
        foreach ($arr as $key => $val) {
            $this->getIcons($key, $val);
        }
    }
//  подключение конфига с иконками для древа
    public function getIcons($mime, $icon) {
        $this->icons[$mime] = $icon;
    }
//  отображаем страницу древа папок данного проекта
    public function getDirectoriesTree($root, $tab) {
        $files = scandir($root);
        foreach($files as $file) {
            // Отбрасываем текущий и каталог выше
            if (($file == '.') || ($file == '..')) continue;
            $path = $root.'/'.$file; //Получаем полный путь к файлу
            // Если это директория
            if (is_dir($path)) {
                // Выводим, делая заданный отступ, название директории
                echo $tab.$this->icons['folder'].$file."<br />";
                // С помощью рекурсии выводим содержимое полученной директории
                $this->getDirectoriesTree($path, $tab.'&nbsp;&nbsp;&nbsp;&nbsp;');
            }
            // Если это файл - выводим название файла
            else {
                $filesMime = pathinfo($path);
                // проверяем есть ли иконка для расширения данного файла
                if(array_key_exists($filesMime['extension'], $this->icons)){
                    echo $tab.$this->icons[$filesMime['extension']].$file."<br />";
                }
                else echo $tab.$this->icons['other'].$file."<br />";
            }
        }
    }
//  отправляем  на почту администратора
    public function sendFeedback($name, $email, $phonenumber, $text) {
        $to       = "sereneva@yandex.ru";
        $subject  = "Feedback from, ".$name;
        $message  = "<h2>Feedback from, ".$name."</h2>";
        $message .= "<p><b>".$text."</b></p>";
        $message .= "<p> User phonenumber: ".$phonenumber."</p>";
        $message .= "<p> User email: ".$email."</p>";
        $headers  = "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: <".$email.">\r\n";
        $this->sendMail($to, $subject, $message, $headers);
        return;
    }
}