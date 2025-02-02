<?php

require_once 'models/ProductImage.php';
require_once 'core/Response.php';
require_once 'core/Request.php';

class ProductImageController {
    
    // للحصول على جميع صور المنتجات
    public function index() {
        $productImages = ProductImage::all();
        Response::send(200, $productImages);
    }
    
    // لإنشاء صورة منتج جديدة
    public function create() {
        $data = Request::getJsonData();
        $productImage = new ProductImage();
        $productImage->product_id = $data['product_id'];
        $productImage->image_url = $data['image_url'];
        $productImage->save();
        Response::send(201, $productImage);
    }
    
    // للحصول على صورة منتج حسب المعرف
    public function show($id) {
        $productImage = ProductImage::find($id);
        if ($productImage) {
            Response::send(200, $productImage);
        } else {
            Response::send(404, ['message' => 'Product Image not found']);
        }
    }
    
    // لتحديث بيانات صورة منتج
    public function update($id) {
        $data = Request::getJsonData();
        $productImage = ProductImage::find($id);
        if ($productImage) {
            $productImage->product_id = $data['product_id'];
            $productImage->image_url = $data['image_url'];
            $productImage->save();
            Response::send(200, $productImage);
        } else {
            Response::send(404, ['message' => 'Product Image not found']);
        }
    }
    
    // لحذف صورة منتج
    public function delete($id) {
        $productImage = ProductImage::find($id);
        if ($productImage) {
            $productImage->delete();
            Response::send(204, null);
        } else {
            Response::send(404, ['message' => 'Product Image not found']);
        }
    }
}
