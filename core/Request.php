<?php

class Request {
    // لجلب بيانات الطلب كـ JSON
    public static function getJsonData() {
        return json_decode(file_get_contents('php://input'), true);
    }

    // للحصول على متغير معين من بيانات POST
    public static function post($key, $default = null) {
        return $_POST[$key] ?? $default;
    }

    // للحصول على متغير معين من بيانات GET
    public static function get($key, $default = null) {
        return $_GET[$key] ?? $default;
    }

    // للحصول على جميع بيانات POST
    public static function allPost() {
        return $_POST;
    }

    // للحصول على جميع بيانات GET
    public static function allGet() {
        return $_GET;
    }
}
