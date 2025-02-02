<?php
require_once 'core/Database.php';

class Cart {
    public $id;
    public $customer_id;
    public $product_id;

    public static function all() {
        $db = Database::getConnection();
        $query = $db->query("SELECT * FROM cart");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function find($id) {
        $db = Database::getConnection();
        $query = $db->prepare("SELECT * FROM cart WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function save() {
        $db = Database::getConnection();
        if ($this->id) {
            $query = $db->prepare("UPDATE cart SET customer_id = ?, product_id = ? WHERE id = ?");
            return $query->execute([$this->customer_id, $this->product_id, $this->id]);
        } else {
            $query = $db->prepare("INSERT INTO carts (customer_id, product_id) VALUES (?, ?)");
            $query->execute([$this->customer_id, $this->product_id]);
            $this->id = $db->lastInsertId();
            return $this;
        }
    }

    public function delete() {
        $db = Database::getConnection();
        $query = $db->prepare("DELETE FROM carts WHERE id = ?");
        return $query->execute([$this->id]);
    }
}
