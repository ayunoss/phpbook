<?php
namespace app\models;

use app\View;

class Images {
//  загрузка файла картинки на локальный сервер
    public static function donwloadImg($path, $file) {
        $filePath = $file;
        copy($filePath, "{$path}");
        View::redirect("images");
    }
//  поиск картинки по пути
    public static function findImg($path) {
        $files = scandir($path);
        $images = [];
        foreach ($files as $image) {
            if (($image == '.') || ($image == '..')) continue;
            $images[] = $image;
        }
        $urls = self::getImgUrl($images);
        return $urls;
    }
//  получение пути (url) по которому хранится нужная картинка
    public static function getImgUrl($images) {
        if($images != []) {
            $urls = [];
            for($i = 0; $i < count($images); $i++){
                $urls[] = "storage/images/".$images[$i];
            }
            return $urls;
        }
    }
}