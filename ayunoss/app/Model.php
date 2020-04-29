<?php

namespace app;

use app\Db;

abstract class Model {

    public $db;

    public function __construct() {
        $this->db = new Db();
    }

    public function sendMail($mail_to, $subject, $message, $headers) {// отправляем письмо
        $res = mail($mail_to, $subject, $message, $headers);
    }
}