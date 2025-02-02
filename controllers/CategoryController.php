<?php

require_once 'models/Category.php';
require_once 'core/Response.php';
require_once 'core/Request.php';

class CategoryController {
    
    // للحصول على جميع الفئات
    public function index() {
        $categories = Category::all();
        Response::send(200, $categories);
    }
    
    // لإنشاء فئة جديدة
    public function create() {
        $data = Request::getJsonData();
        $category = new Category();
        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->save();
        Response::send(201, $category);
    }
    
    // للحصول على فئة حسب المعرف
    public function show($id) {
        $category = Category::find($id);
        if ($category) {
            Response::send(200, $category);
        } else {
            Response::send(404, ['message' => 'Category not found']);
        }
    }
    
    // لتحديث بيانات فئة
    public function update($id) {
        $data = Request::getJsonData();
        $category = Category::find($id);
        if ($category) {
            $category->name = $data['name'];
            $category->description = $data['description'];
            $category->save();
            Response::send(200, $category);
        } else {
            Response::send(404, ['message' => 'Category not found']);
        }
    }
    
    // لحذف فئة
    public function delete($id) {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            Response::send(204, null);
        } else {
            Response::send(404, ['message' => 'Category not found']);
        }
    }
}
