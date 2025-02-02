<?php

require_once 'models/Cart.php';
require_once 'core/Response.php';
require_once 'core/Request.php';

class CartController {
    
    // للحصول على جميع العربات
    public function index() {
        $carts = Cart::all();
        Response::send(200, $carts);
    }
    
    // لإنشاء عربة جديدة
    public function create() {
        $data = Request::getJsonData();
        $cart = new Cart();
        $cart->customer_id = $data['customer_id'];
        $cart->product_id = $data['product_id'];
        $cart->quantity = $data['quantity'];
        $cart->save();
        Response::send(201, $cart);
    }
    
    // للحصول على عربة حسب المعرف
    public function show($id) {
        $cart = Cart::find($id);
        if ($cart) {
            Response::send(200, $cart);
        } else {
            Response::send(404, ['message' => 'Cart not found']);
        }
    }
    
    // لتحديث بيانات عربة
    public function update($id) {
        $data = Request::getJsonData();
        $cart = Cart::find($id);
        if ($cart) {
            $cart->customer_id = $data['customer_id'];
            $cart->product_id = $data['product_id'];
            $cart->quantity = $data['quantity'];
            $cart->save();
            Response::send(200, $cart);
        } else {
            Response::send(404, ['message' => 'Cart not found']);
        }
    }
    
    // لحذف عربة
    public function delete($id) {
        $cart = Cart::find($id);
        if ($cart) {
            $cart->delete();
            Response::send(204, null);
        } else {
            Response::send(404, ['message' => 'Cart not found']);
        }
    }
}
