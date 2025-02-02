<?php

require_once 'models/Bill.php';
require_once 'core/Response.php';
require_once 'core/Request.php';

class BillController {
    
    public function index() {
        $bills = Bill::all();
        Response::send(200, $bills);
    }
    
    public function create() {
        $data = Request::getJsonData();
        $bill = new Bill();
        $bill->customer_id = $data['customer_id'];
        $bill->bill_date = $data['bill_date'];
        $bill->delivery_date = $data['delivery_date'];
        $bill->delivery_state = $data['delivery_state'];
        $bill->total_price = $data['total_price'];
        $bill->save();
        Response::send(201, $bill);
    }
    
    public function show($id) {
        $bill = Bill::find($id);
        if ($bill) {
            Response::send(200, $bill);
        } else {
            Response::send(404, ['message' => 'Bill not found']);
        }
    }
    
    public function update($id) {
        $data = Request::getJsonData();
        $bill = Bill::find($id);
        if ($bill) {
            $bill->customer_id = $data['customer_id'];
            $bill->total_amount = $data['total_amount'];
            $bill->status = $data['status'];
            $bill->save();
            Response::send(200, $bill);
        } else {
            Response::send(404, ['message' => 'Bill not found']);
        }
    }
    
    public function delete($id) {
        $bill = Bill::find($id);
        if ($bill) {
            $bill->delete();
            Response::send(204, null);
        } else {
            Response::send(404, ['message' => 'Bill not found']);
        }
    }
}
