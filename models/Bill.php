<?php
require_once 'core/Database.php';

class Bill {
    public $id;
    public $customer_id;
    public $bill_date;
    public $delivery_date;
    public $delivery_state;
    public $total_price;

    public static function all() {
        $db = Database::getConnection();
        $query = $db->query("SELECT * FROM bill");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function find($id) {
        $db = Database::getConnection();
        $query = $db->prepare("SELECT * FROM bill WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public static function findBillByCustomerId($customer_id) {
        $db = Database::getConnection();
        $query = $db->prepare("SELECT * FROM bill WHERE customer_id = ?");
        $query->execute([$customer_id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function save() {
        $db = Database::getConnection();
        if ($this->id) {
            $query = $db->prepare("UPDATE `bill` SET `customer_id`= ? ,`bill_date`= ? ,`delivery_date`= ? ,`delivery_state`= ? ,`total_price`= ? WHERE `id` = ?");
            return $query->execute([$this->customer_id, $this->bill_date, $this->delivery_date, $this->delivery_state, $this->total_price , $this->id]);
        } else {
            $query = $db->prepare("INSERT INTO `bill`(`customer_id`, `bill_date`, `delivery_date`, `delivery_state`, `total_price`) VALUES (?, ?, ?, ?, ?)");
            $query->execute([$this->customer_id, $this->bill_date, $this->delivery_date, $this->delivery_state, $this->total_price]);
            $this->id = $db->lastInsertId();
            return $this;
        }
    }

    public function delete() {
        $db = Database::getConnection();
        $query = $db->prepare("DELETE FROM bill WHERE id = ?");
        return $query->execute([$this->id]);
    }
}
