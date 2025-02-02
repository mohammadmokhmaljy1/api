<?php

require_once 'models/Admin.php';
require_once 'core/Response.php';
require_once 'core/Request.php';

class AdminController {
    
    public function index() {
        $admins = Admin::all();
        Response::send(200, $admins);
    }
    
    public function create() {
        $data = Request::getJsonData();
        $admin = new Admin();
        $admin->name = $data['name'];
        $admin->permission = $data['permission'];
        $admin->password = password_hash($data['password'], PASSWORD_BCRYPT);
        $admin->save();
        Response::send(201, $admin);
    }
    
    public function show($id) {
        $admin = Admin::findAdminById($id);
        if ($admin) {
            Response::send(200, $admin);
        } else {
            Response::send(404, ['message' => 'Admin not found']);
        }
    }

    public function login($name, $password) {
        $admin = Admin::login($name, $password);
        if ($admin) {
            Response::send(200, $admin);
        } else {
            Response::send(404, ['message' => 'Admin not found']);
        }
    }

    public function update($id) {
        $data = Request::getJsonData();
        if (!isset($data['name'], $data['permission'])) {
            Response::send(400, ['message' => 'Invalid input data']);
            return;
        }
        $admin = Admin::findAdminById($id);
        if (!$admin) {
            Response::send(404, ['message' => 'Admin not found']);
            return;
        }
        $admin->name = htmlspecialchars($data['name'], ENT_QUOTES, 'UTF-8');
        $admin->permission = htmlspecialchars($data['permission'], ENT_QUOTES, 'UTF-8');
        if (!empty($data['password'])) {
            $admin->password = password_hash($data['password'], PASSWORD_BCRYPT);
        }

        $admin->save();
        Response::send(200, $admin);
    }
    
    
    public function delete($id) {
        $admin = Admin::findAdminById($id);
        if ($admin) {
            $admin->delete();
            Response::send(204, null);
        } else {
            Response::send(404, ['message' => 'Admin not found']);
        }
    }
}