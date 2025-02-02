<?php

require_once 'models/Ordering.php';
require_once 'core/Response.php';
require_once 'core/Request.php';

class OrderingController {
    
    // للحصول على جميع الطلبات
    public function index() {
        $orderings = Ordering::all();
        Response::send(200, $orderings);
    }
    
    // لإنشاء طلب جديد
    public function create() {
        $data = Request::getJsonData();
        $ordering = new Ordering();
        $ordering->customer_id = $data['customer_id'];
        $ordering->product_id = $data['product_id'];
        $ordering->quantity = $data['quantity'];
        $ordering->total_price = $data['total_price'];
        $ordering->status = $data['status'];
        $ordering->save();
        Response::send(201, $ordering);
    }
    
    // للحصول على طلب حسب المعرف
    public function show($id) {
        $ordering = Ordering::find($id);
        if ($ordering) {
            Response::send(200, $ordering);
        } else {
            Response::send(404, ['message' => 'Ordering not found']);
        }
    }
    
    // لتحديث بيانات طلب
    public function update($id) {
        $data = Request::getJsonData();
        $ordering = Ordering::find($id);
        if ($ordering) {
            $ordering->customer_id = $data['customer_id'];
            $ordering->product_id = $data['product_id'];
            $ordering->quantity = $data['quantity'];
            $ordering->total_price = $data['total_price'];
            $ordering->status = $data['status'];
            $ordering->save();
            Response::send(200, $ordering);
        } else {
            Response::send(404, ['message' => 'Ordering not found']);
        }
    }
    
    // لحذف طلب
    public function delete($id) {
        $ordering = Ordering::find($id);
        if ($ordering) {
            $ordering->delete();
            Response::send(204, null);
        } else {
            Response::send(404, ['message' => 'Ordering not found']);
        }
    }
}
