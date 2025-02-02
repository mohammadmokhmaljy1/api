<?php

require_once 'models/Category.php';
require_once 'core/Response.php';
require_once 'core/Request.php';

class CategoryController {
    
    public function index() {
        $categories = Category::all();
        Response::send(200, $categories);
    }
    
    public function create() {
        $data = Request::getJsonData();
        $category = new Category();
        $category->name = $data['name'];
        $category->description = $data['description'];
        $category->save();
        Response::send(201, $category);
    }
    
    public function show($id) {
        $category = Category::find($id);
        if ($category) {
            Response::send(200, $category);
        } else {
            Response::send(404, ['message' => 'Category not found']);
        }
    }
    
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