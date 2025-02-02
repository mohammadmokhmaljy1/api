<?php

require_once 'models/MainProduct.php';
require_once 'core/Response.php';
require_once 'core/Request.php';

class MainProductController {
    
    // للحصول على جميع المنتجات الرئيسية
    public function index() {
        $mainProducts = MainProduct::all();
        Response::send(200, $mainProducts);
    }
    
    // لإنشاء منتج رئيسي جديد
    public function create() {
        $data = Request::getJsonData();
        $mainProduct = new MainProduct();
        $mainProduct->name = $data['name'];
        $mainProduct->description = $data['description'];
        $mainProduct->price = $data['price'];
        $mainProduct->save();
        Response::send(201, $mainProduct);
    }
    
    // للحصول على منتج رئيسي حسب المعرف
    public function show($id) {
        $mainProduct = MainProduct::find($id);
        if ($mainProduct) {
            Response::send(200, $mainProduct);
        } else {
            Response::send(404, ['message' => 'Main Product not found']);
        }
    }
    
    // لتحديث بيانات منتج رئيسي
    public function update($id) {
        $data = Request::getJsonData();
        $mainProduct = MainProduct::find($id);
        if ($mainProduct) {
            $mainProduct->name = $data['name'];
            $mainProduct->description = $data['description'];
            $mainProduct->price = $data['price'];
            $mainProduct->save();
            Response::send(200, $mainProduct);
        } else {
            Response::send(404, ['message' => 'Main Product not found']);
        }
    }
    
    // لحذف منتج رئيسي
    public function delete($id) {
        $mainProduct = MainProduct::find($id);
        if ($mainProduct) {
            $mainProduct->delete();
            Response::send(204, null);
        } else {
            Response::send(404, ['message' => 'Main Product not found']);
        }
    }
}
