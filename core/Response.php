<?php

class Response {
    // لإرسال استجابة JSON
    public static function send($status, $data) {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }

    // لإرسال استجابة نصية
    public static function sendText($status, $message) {
        http_response_code($status);
        header('Content-Type: text/plain');
        echo $message;
        exit();
    }
}
