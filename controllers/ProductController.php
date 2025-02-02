<?php

require_once 'models/Product.php';
require_once 'core/Response.php';
require_once 'core/Request.php';

class ProductController {
    public function index() {
        $products = Product::allForDash();
        Response::send(200, $products);
    }
    
    public function create() {
        $data = Request::getJsonData();
        $product = new Product();
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->price = $data['price'];
        $product->category_id = $data['category_id'];
        $product->save();
        Response::send(201, $product);
    }
    
    public function show($id) {
        $product = Product::find($id);
        if ($product) {
            Response::send(200, $product);
        } else {
            Response::send(404, ['message' => 'Product not found']);
        }
    }
    
    public function update($id) {
        $data = Request::getJsonData();
        $product = Product::find($id);
        if ($product) {
            $product->name = $data['name'];
            $product->description = $data['description'];
            $product->price = $data['price'];
            $product->category_id = $data['category_id'];
            $product->save();
            Response::send(200, $product);
        } else {
            Response::send(404, ['message' => 'Product not found']);
        }
    }
    
    public function delete($id) {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            Response::send(204, null);
        } else {
            Response::send(404, ['message' => 'Product not found']);
        }
    }
}