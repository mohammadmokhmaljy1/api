<?php

class Database {
    private static $instance = null;
    private $connection;

    private function __construct() {
        $config = require 'config/config.php';
        $this->connection = new PDO(
            "mysql:host={$config['database']['host']};dbname={$config['database']['dbname']};charset={$config['database']['charset']}",
            $config['database']['username'],
            $config['database']['password']
        );
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getConnection() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance->connection;
    }

    private function __clone() {}

    private function __wakeup() {}
}
