<?php
require_once 'core/Database.php';

class Category {
    public $id;
    public $name;
    public $image;
    public $description;

    public static function all() {
        $db = Database::getConnection();
        $query = $db->query("SELECT * FROM category");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function find($id) {
        $db = Database::getConnection();
        $query = $db->prepare("SELECT * FROM category WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function save() {
        $db = Database::getConnection();
        if ($this->id) {
            $query = $db->prepare("UPDATE `category` SET `name` = ?, `description` = ?, `image` = ? WHERE id = ?");
            return $query->execute([$this->name, $this->description, $this->image, $this->id]);
        } else {
            $query = $db->prepare("INSERT INTO `category` (`name`, `description`, `image`) VALUES (?, ?, ?)");
            $query->execute([$this->name, $this->description, $this->image]);
            $this->id = $db->lastInsertId();
            return $this;
        }
    }

    public function delete() {
        $db = Database::getConnection();
        $query = $db->prepare("DELETE FROM category WHERE id = ?");
        return $query->execute([$this->id]);
    }
}
