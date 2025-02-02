<?php

require_once 'core/Database.php';

class MainProduct {
    public $id;
    public $name;
    public $description;
    public $price;
    public $interactives;
    public $category_id;

    public static function all() {
        $db = Database::getConnection();
        $query = $db->query("SELECT main_product.*, category.name as 'category_name' FROM main_product inner join category ON main_product.category_id = category.id;");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }


    public static function find($id) {
        $db = Database::getConnection();
        $query = $db->prepare("SELECT * FROM main_product WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function save() {
        $db = Database::getConnection();
        if ($this->id) {
            $query = $db->prepare("UPDATE `main_product` SET `name`= ? ,`description`= ? ,`category_id`= ? WHERE `id` = ?");
            return $query->execute([$this->name, $this->description, $this->category_id, $this->id]);
        } else {
            $query = $db->prepare("INSERT INTO `main_product`(`name`, `description`, `category_id`) VALUES (?, ?, ?);");
            $query->execute([$this->name, $this->description, $this->category_id]);
            $this->id = $db->lastInsertId();
            return $this;
        }
    }

    public function delete() {
        $db = Database::getConnection();
        $query = $db->prepare("DELETE FROM main_product WHERE id = ?");
        return $query->execute([$this->id]);
    }
}