<?php

require_once 'core/Database.php';

class ProductImage {
    public $id;
    public $product_id;
    public $image_url;

    public static function all() {
        $db = Database::getConnection();
        $query = $db->query("SELECT * FROM product_image");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function find($id) {
        $db = Database::getConnection();
        $query = $db->prepare("SELECT * FROM product_image WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function save() {
        $db = Database::getConnection();
        if ($this->id) {
            $query = $db->prepare("UPDATE product_image SET product_id = ?, image_url = ? WHERE id = ?");
            return $query->execute([$this->product_id, $this->image_url, $this->id]);
        } else {
            $query = $db->prepare("INSERT INTO product_image (product_id, image_url) VALUES (?, ?)");
            $query->execute([$this->product_id, $this->image_url]);
            $this->id = $db->lastInsertId();
            return $this;
        }
    }

    public function delete() {
        $db = Database::getConnection();
        $query = $db->prepare("DELETE FROM product_image WHERE id = ?");
        return $query->execute([$this->id]);
    }
}
