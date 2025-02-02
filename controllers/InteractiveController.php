<?php

require_once 'models/Interactive.php';
require_once 'models/Product.php';
require_once 'core/Response.php';
require_once 'core/Request.php';

class InteractiveController {
    
    public function index() {
        $interactives = Interactive::all();
        Response::send(200, $interactives);
    }
    
    public function create() {
        $data = Request::getJsonData();
        $interactive = new Interactive();
        $interactive->customer_id = $data['customer_id'];
        $interactive->product_id = $data['product_id'];
        $interactive->save();
        $product = new Product();
        $product->id = $data['product_id'];
        $product->interactive();
        Response::send(201, $interactive);
    }
    
    public function show($id) {
        $interactive = Interactive::find($id);
        if ($interactive) {
            Response::send(200, $interactive);
        } else {
            Response::send(404, ['message' => 'Interactive not found']);
        }
    }
    
    public function update($id) {
        $data = Request::getJsonData();
        $interactive = Interactive::find($id);
        if ($interactive) {
            $interactive->customer_id = $data['customer_id'];
            $interactive->product_id = $data['product_id'];
            $interactive->save();
            Response::send(200, $interactive);
        } else {
            Response::send(404, ['message' => 'Interactive not found']);
        }
    }
    
    public function delete($id) {
        $interactive = Interactive::find($id);
        if ($interactive) {
            $interactive->delete();
            Response::send(204, null);
        } else {
            Response::send(404, ['message' => 'Interactive not found']);
        }
    }
}