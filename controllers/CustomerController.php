<?php

require_once 'models/Customer.php';
require_once 'core/Response.php';
require_once 'core/Request.php';

class CustomerController {
    
    public function index() {
        $customers = Customer::all();
        Response::send(200, $customers);
    }
    
    public function create() {
        $data = Request::getJsonData();
        $customer = new Customer();
        $customer->name = $data['name'];
        $customer->email = $data['email'];
        $customer->phone = $data['phone'];
        $customer->reg_date = $data['reg_date'];
        $customer->password = password_hash($data['password'], PASSWORD_ARGON2ID);
        $customer->default_currency = $data['default_currency'];
        $customer->save();
        Response::send(201, $customer);
    }
    
    public function show($id) {
        $customer = Customer::find($id);
        if ($customer) {
            Response::send(200, $customer);
        } else {
            Response::send(404, ['message' => 'Customer not found']);
        }
    }
    
    public function update($id) {
        $data = Request::getJsonData();
        $customer = Customer::find($id);
        if ($customer) {
            $customer->name = $data['name'];
            $customer->email = $data['email'];
            $customer->phone = $data['phone'];
            $customer->reg_date = $data['reg_date'];
            $customer->default_currency = $data['default_currency'];
            
            if (!empty($data['password'])) {
                $customer->password = password_hash($data['password'], PASSWORD_ARGON2ID);
            }
            
            $customer->save();
            Response::send(200, $customer);
        } else {
            Response::send(404, ['message' => 'Customer not found']);
        }
    }
    
    public function delete($id) {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();
            Response::send(204, null);
        } else {
            Response::send(404, ['message' => 'Customer not found']);
        }
    }
    
    public static function login($name, $password) {
        $db = Database::getConnection();
        $query = $db->prepare("SELECT * FROM customer WHERE `name` = ?");
        $query->execute([$name]);
        $customer = $query->fetch(PDO::FETCH_OBJ);
    
        if ($customer && password_verify($password, $customer->password)) {
            return $customer;
        }
        return false;
    }    
    
    public function changePassword($id) {
        $data = Request::getJsonData();
        $customer = Customer::find($id);
        if ($customer) {
            $customer->password = password_hash($data['password'], PASSWORD_ARGON2ID);
            $customer->changePassword();
            Response::send(200, $customer);
        } else {
            Response::send(404, ['message' => 'Customer not found']);
        }
    }
}