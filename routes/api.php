<?php

require_once 'core/Router.php';
require_once 'controllers/CustomerController.php';
require_once 'controllers/CartController.php';
require_once 'controllers/BillController.php';
require_once 'controllers/OrderingController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/ProductImageController.php';
require_once 'controllers/MainProductController.php';
require_once 'controllers/AdminController.php';
require_once 'controllers/CategoryController.php';

// إنشاء كائن Router
$router = new Router();

// تعريف مسارات العملاء (Customers)
$router->add('/customers', 'CustomerController@index');
$router->add('/customers/create', 'CustomerController@create');
$router->add('/customers/show/{id}', 'CustomerController@show');
$router->add('/customers/update/{id}', 'CustomerController@update');
$router->add('/customers/delete/{id}', 'CustomerController@delete');

// تعريف مسارات العربات (Carts)
$router->add('/carts', 'CartController@index');
$router->add('/carts/create', 'CartController@create');
$router->add('/carts/show/{id}', 'CartController@show');
$router->add('/carts/update/{id}', 'CartController@update');
$router->add('/carts/delete/{id}', 'CartController@delete');

// تعريف مسارات الفواتير (Bills)
$router->add('/bills', 'BillController@index');
$router->add('/bills/create', 'BillController@create');
$router->add('/bills/show/{id}', 'BillController@show');
$router->add('/bills/update/{id}', 'BillController@update');
$router->add('/bills/delete/{id}', 'BillController@delete');

// تعريف مسارات الطلبات (Orderings)
$router->add('/orderings', 'OrderingController@index');
$router->add('/orderings/create', 'OrderingController@create');
$router->add('/orderings/show/{id}', 'OrderingController@show');
$router->add('/orderings/update/{id}', 'OrderingController@update');
$router->add('/orderings/delete/{id}', 'OrderingController@delete');

// تعريف مسارات المنتجات (Products)
$router->add('/products', 'ProductController@index');
$router->add('/products/create', 'ProductController@create');
$router->add('/products/show/{id}', 'ProductController@show');
$router->add('/products/update/{id}', 'ProductController@update');
$router->add('/products/delete/{id}', 'ProductController@delete');

// تعريف مسارات صور المنتجات (Product Images)
$router->add('/product_images', 'ProductImageController@index');
$router->add('/product_images/create', 'ProductImageController@create');
$router->add('/product_images/show/{id}', 'ProductImageController@show');
$router->add('/product_images/update/{id}', 'ProductImageController@update');
$router->add('/product_images/delete/{id}', 'ProductImageController@delete');

// تعريف مسارات المنتجات الرئيسية (Main Products)
$router->add('/main_products', 'MainProductController@index');
$router->add('/main_products/create', 'MainProductController@create');
$router->add('/main_products/show/{id}', 'MainProductController@show');
$router->add('/main_products/update/{id}', 'MainProductController@update');
$router->add('/main_products/delete/{id}', 'MainProductController@delete');

// تعريف مسارات المسؤولين (Admins)
$router->add('/admins', 'AdminController@index');
$router->add('/admins/create', 'AdminController@create');
$router->add('/admins/show/{id}', 'AdminController@show');
$router->add('/admins/update/{id}', 'AdminController@update');
$router->add('/admins/delete/{id}', 'AdminController@delete');

// تعريف مسارات الفئات (Categories)
$router->add('/categories', 'CategoryController@index');
$router->add('/categories/create', 'CategoryController@create');
$router->add('/categories/show/{id}', 'CategoryController@show');
$router->add('/categories/update/{id}', 'CategoryController@update');
$router->add('/categories/delete/{id}', 'CategoryController@delete');

// تنفيذ التوجيهات
$router->dispatch($_SERVER['REQUEST_URI']);
