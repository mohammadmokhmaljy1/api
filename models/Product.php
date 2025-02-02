<?php

require_once 'core/Database.php';

class Product {
    public $id;
    public $main_product_id;
    public $size;
    public $color;
    public $in_stock;
    public $gender;
    public $price;
    public $main_image;

    public static function allForDash() {
        $db = Database::getConnection();
        $query = $db->query("SELECT product.* , main_product.name as 'product_name' FROM product inner join main_product ON main_product.id = product.main_product_id;");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function mostPayedProducts() {
        $db = Database::getConnection();
        $query = $db->query("SELECT COUNT(`product_id`), product.id, product.main_image, product.price FROM `ordering` INNER JOIN `product` ON (ordering.product_id = product.id) GROUP BY `product_id` ORDER BY COUNT(`product_id`) DESC LIMIT 7;");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function mostLikedProducts() {
        $db = Database::getConnection();
        $query = $db->query("SELECT id, main_image, price, interactives FROM `product` ORDER BY product.interactives DESC LIMIT 7;");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function allProductForCust() {
        $db = Database::getConnection();
        $query = $db->query("SELECT product.*, main_product.name, main_product.description as 'product_name', main_product.description as 'prod_description', category.name as 'cate_name'
        FROM product inner join main_product ON main_product.id = product.main_product_id
        inner JOIN category on category.id = main_product.category_id");
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public static function find($id) {
        $db = Database::getConnection();
        $query = $db->prepare("SELECT * FROM product WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function interactive(){
        $db = Database::getConnection();
        if ($this->id) {
            $query = $db->prepare("UPDATE `product` SET interactive = interactive + 1 WHERE `id` = ?");
            return $query->execute([$this->id]);
        }
    }

    public function save() {
        $db = Database::getConnection();
        if ($this->id) {
            $query = $db->prepare("UPDATE `product` SET `main_product_id`= ? ,`size`= ? ,`color`= ?, `in_stock` = ?, `price` = ? ,`gender`= ?, `main_image` = ? WHERE `id` = ?");
            return $query->execute([$this->main_product_id, $this->size, $this->color, $this->in_stock, $this->price, $this->gender, $this->main_image, $this->id]);
        } else {
            $query = $db->prepare("INSERT INTO `product`(`main_product_id`, `size`, `color`, `stored`, `price`, `gender`, `main_image`) VALUES (?, ?, ?, 1,  ?, ?, ?)");
            $query->execute([$this->main_product_id, $this->size, $this->color, $this->price, $this->gender, $this->main_image]);
            $this->id = $db->lastInsertId();
            return $this;
        }
    }

    public function delete() {
        $db = Database::getConnection();
        $query = $db->prepare("DELETE FROM product WHERE id = ?");
        return $query->execute([$this->id]);
    }
}
