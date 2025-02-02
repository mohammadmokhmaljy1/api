<?php

class Helpers {
    
    // لتحويل النص إلى صيغة آمنة للعرض في HTML
    public static function escape($string) {
        return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
    }

    // لإنشاء رابط آمن
    public static function url($path) {
        return 'http://' . $_SERVER['HTTP_HOST'] . '/' . trim($path, '/');
    }

    // للتحقق مما إذا كان المستخدم مسجلاً الدخول
    public static function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    // لتحويل تاريخ إلى صيغة قابلة للقراءة
    public static function formatDate($date) {
        return date('F j, Y, g:i a', strtotime($date));
    }
}
