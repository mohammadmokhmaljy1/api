<?php

require_once 'core/Database.php';

class Ordering {
    public $id;
    public $product_id;
    public $bill_id;
    public $quantity;

    public static function all() {
        $db = Database::getConnection();
        $query = $db->query("SELECT * FROM ordering");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function find($id) {
        $db = Database::getConnection();
        $query = $db->prepare("SELECT * FROM ordering WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function save() {
        $db = Database::getConnection();
        if ($this->id) {
            $query = $db->prepare("UPDATE `ordering` SET `product_id`= ? ,`bill_id`= ? ,`quantity`= ? WHERE `id` = ?");
            return $query->execute([$this->product_id,$this->bill_id, $this->quantity, $this->id]);
        } else {
            $query = $db->prepare("INSERT INTO `ordering`(`product_id`, `bill_id`, `quantity`) VALUES (?, ?, ?)");
            $query->execute([$this->product_id, $this->bill_id,$this->quantity]);
            $this->id = $db->lastInsertId();
            return $this;
        }
    }

    public function delete() {
        $db = Database::getConnection();
        $query = $db->prepare("DELETE FROM ordering WHERE id = ?");
        return $query->execute([$this->id]);
    }
}
