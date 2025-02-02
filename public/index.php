<?php

require_once '../core/Router.php';

// إنشاء كائن من الراوتر
$router = new Router();

// إضافة المسارات (Routes)
$router->add('/', 'HomeController@index');
$router->add('/admin', 'AdminController@index');
$router->add('/admin/create', 'AdminController@create');
$router->add('/admin/show/(\d+)', 'AdminController@show');
$router->add('/admin/update/(\d+)', 'AdminController@update');
$router->add('/admin/delete/(\d+)', 'AdminController@delete');

$router->add('/bill', 'BillController@index');
$router->add('/bill/create', 'BillController@create');
$router->add('/bill/show/(\d+)', 'BillController@show');
$router->add('/bill/update/(\d+)', 'BillController@update');
$router->add('/bill/delete/(\d+)', 'BillController@delete');

$router->add('/cart', 'CartController@index');
$router->add('/cart/create', 'CartController@create');
$router->add('/cart/show/(\d+)', 'CartController@show');
$router->add('/cart/update/(\d+)', 'CartController@update');
$router->add('/cart/delete/(\d+)', 'CartController@delete');

$router->add('/category', 'CategoryController@index');
$router->add('/category/create', 'CategoryController@create');
$router->add('/category/show/(\d+)', 'CategoryController@show');
$router->add('/category/update/(\d+)', 'CategoryController@update');
$router->add('/category/delete/(\d+)', 'CategoryController@delete');

$router->add('/main-product', 'MainProductController@index');
$router->add('/main-product/create', 'MainProductController@create');
$router->add('/main-product/show/(\d+)', 'MainProductController@show');
$router->add('/main-product/update/(\d+)', 'MainProductController@update');
$router->add('/main-product/delete/(\d+)', 'MainProductController@delete');

$router->add('/ordering', 'OrderingController@index');
$router->add('/ordering/create', 'OrderingController@create');
$router->add('/ordering/show/(\d+)', 'OrderingController@show');
$router->add('/ordering/update/(\d+)', 'OrderingController@update');
$router->add('/ordering/delete/(\d+)', 'OrderingController@delete');

$router->add('/product', 'ProductController@index');
$router->add('/product/create', 'ProductController@create');
$router->add('/product/show/(\d+)', 'ProductController@show');
$router->add('/product/update/(\d+)', 'ProductController@update');
$router->add('/product/delete/(\d+)', 'ProductController@delete');

$router->add('/product-image', 'ProductImageController@index');
$router->add('/product-image/create', 'ProductImageController@create');
$router->add('/product-image/show/(\d+)', 'ProductImageController@show');
$router->add('/product-image/update/(\d+)', 'ProductImageController@update');
$router->add('/product-image/delete/(\d+)', 'ProductImageController@delete');

// توزيع الطلبات بناءً على المسارات
$router->dispatch($_SERVER['REQUEST_URI']);