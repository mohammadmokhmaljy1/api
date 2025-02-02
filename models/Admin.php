<?php
require_once 'core/Database.php';
class Admin {
    public $id;
    public $name;
    public $password;
    public $last_login;
    public $permission;
    public static function all() {
        $db = Database::getConnection();
        $query = $db->query("SELECT * FROM `admin`");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function login($name, $password) {
        $db = Database::getConnection();
        $query = $db->prepare("SELECT * FROM `admin` WHERE `name` = ? AND `password` = ?");
        $query->execute([$name, $password]);
        $query2 = $db->prepare("UPDATE `admin` SET `last_login` = DATE(NOW()) WHERE `name` = ? AND `password` = ?");
        $query2->execute([$name, $password]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public static function findAdminById($id) {
        $db = Database::getConnection();
        $query = $db->prepare("SELECT * FROM `admin` WHERE `id` = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function save() {
        $db = Database::getConnection();
        if ($this->id) {
            $query = $db->prepare("UPDATE `admin` SET `name` = ?, `password` = ?, `permission` = ? WHERE id = ?");
            return $query->execute([$this->name, $this->password, $this->permission ,$this->id]);
        } else {
            $query = $db->prepare("INSERT INTO `admin` (`name`, `password`, `last_login`, `permission`) VALUES (?, ?, NOW(), ?);");
            $query->execute([$this->name, $this->password, $this->permission]);
            $this->id = $db->lastInsertId();
            return $this;
        }
    }

    public function delete() {
        $db = Database::getConnection();
        $query = $db->prepare("DELETE FROM `admin` WHERE id = ?");
        return $query->execute([$this->id]);
    }
}