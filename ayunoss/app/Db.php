<?php
namespace app;
use PDO;

class Db {

    public $db;
    protected $connect;

//  достаем данные для подключения к бд и записываем реузльтат соединения в $connect
    public function __construct() {
        $config = require "config/db.php";
        foreach ($config as $key => $val) {
            $this->connect[$key] = $val;
        }
        $this->db = self::connectViaPDO();
       // $this->db = self::connectViaMysqli();
    }
//  устанавливаем соединение с бд через ПДО
    public function connectViaPDO() {
        try {
            return $connect = new PDO('mysql:host='.$this->connect['host'].';dbname='.$this->connect['dbname'].'', $this->connect['user'], $this->connect['password']);
        } catch (\PDOException $e) {
            echo 'Сonnection failed'.$e->getMessage();
        }
    }
//  достаем данные в виде двумерного ассоц массива из бд и возвращаем в виде обычного ассоциативного
    public function getDataViaPDO($sql) {
        $request   = $this->queryPDO($sql);
        $assocData = $request->fetchAll(PDO::FETCH_ASSOC);
        if($assocData != null){
            $result = $this->transformArray($assocData);
            return $result;
        }
    }
    public function getAssocDataViaPDO($sql) {
        $request   = $this->queryPDO($sql);
        $assocData = $request->fetchAll(PDO::FETCH_ASSOC);
        return $assocData;
    }
//  делаем запрос в бд через подготовленный запрос
    public function queryPDO($sql, $params = []) {
        $request = $this->db->prepare($sql);
        if(!empty($params)) {
            foreach ($params as $key => $val) {
                $request->bindValue(':'.$key, $val);
            }
        }
        $request->execute();
        return $request;
    }
//  получаем id последней внесенной записи
    public function lastInsertId() {
        return $this->db->lastInsertId();
    }

//  устанавливаем соединение с бд через mysqli
    public function connectViaMysqli() {
        $connect = mysqli_connect($this->connect['host'],$this->connect['user'],$this->connect['password'], $this->connect['dbname']);
    }

    public function getDataViaMysqli($sql) {
        //
    }

    public function queryMysqli() {
        //
    }
//  преобразуем двумерный ассоц массив данных в одномерный ассоц массив
    public function transformArray($arr) {
        $assocArr = $arr[0];
        $assoc    = [];
        foreach ($assocArr as $key => $value) {
            $assoc[$key] = $value;
        }
        return $assoc;
    }


}