<?php
require_once 'core/Database.php';

class Customer {
    public $id;
    public $name;
    public $email;
    public $phone;
    public $reg_date;
    public $password;
    public $default_currency;

    public static function all() {
        $db = Database::getConnection();
        $query = $db->query("SELECT * FROM customer");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function find($id) {
        $db = Database::getConnection();
        $query = $db->prepare("SELECT * FROM customer WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public static function login($name, $password) {
        $db = Database::getConnection();
        $query = $db->prepare("SELECT * FROM customer WHERE `name` = ? AND `password` = ? ");
        $query->execute([$name, $password]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function save() {
        $db = Database::getConnection();
        if ($this->id) {
            $query = $db->prepare("UPDATE `customer` SET `name`= ? ,`email`= ? ,`phone`= ? ,`reg_date`= ? ,`password`= ? ,`default_currency`= ? WHERE `id` = ?");
            return $query->execute([$this->name, $this->email, $this->phone, $this->reg_date, $this->password, $this->default_currency , $this->id]);
        } else {
            $query = $db->prepare("INSERT INTO `customer`(`name`, `email`, `phone`, `reg_date`, `password`, `default_currency`) VALUES (?, ?, ?, ?, ?, ?)");
            $query->execute([$this->name, $this->email, $this->phone, $this->reg_date, $this->password, $this->default_currency]);
            $this->id = $db->lastInsertId();
            return $this;
        }
    }

    public function  changePassword() {
        $db = Database::getConnection();
        if ($this->id) {
            $query = $db->prepare("UPDATE `customer` SET `password`= ? WHERE `id` = ?");
            return $query->execute([$this->password, $this->id]);
        }
    }

    public function delete() {
        $db = Database::getConnection();
        $query = $db->prepare("DELETE FROM customer WHERE id = ?");
        return $query->execute([$this->id]);
    }
}