<?php
declare(strict_types=1);
session_start();
require_once __DIR__ . "/env/settings.php";
require_once __DIR__ . "/vendor/autoload.php";

use OnlineShop\App\Router;

error_reporting(E_ALL);
ini_set('display_errors', '2');
define('BASE_URL', '/online-shop/');

$mainControllerNameSpace = 'OnlineShop\\Controllers\\MainController';
$cartControllerNameSpace = 'OnlineShop\\Controllers\\CartController';
$productsControllerNameSpace = 'OnlineShop\\Controllers\\ProductsController';
$usersControllerNameSpace = 'OnlineShop\\Controllers\\UsersController';
$categoriesControllerNameSpace = 'OnlineShop\\Controllers\\CategoriesController';

Router::add(BASE_URL, 'get', $mainControllerNameSpace, 'index');
Router::add(BASE_URL.'login', 'get', $usersControllerNameSpace, 'login');
Router::add(BASE_URL.'login', 'post', $usersControllerNameSpace, 'authenticate');
Router::add(BASE_URL.'logout', 'get', $usersControllerNameSpace, 'logout');
Router::add(BASE_URL.'register', 'get', $usersControllerNameSpace, 'index');
Router::add(BASE_URL.'register', 'post', $usersControllerNameSpace, 'add');
Router::add(BASE_URL.'cart', 'get', $cartControllerNameSpace, 'index');
Router::add(BASE_URL.'cart/remove/{id}', 'get', $cartControllerNameSpace, 'delete');
Router::add(BASE_URL.'cart/update/{id}', 'post', $cartControllerNameSpace, 'edit');
Router::add(BASE_URL.'checkout', 'get', $cartControllerNameSpace, 'checkout');
Router::add(BASE_URL.'placeorder', 'post', $cartControllerNameSpace, 'placeorder');
Router::add(BASE_URL.'thankyou', 'get', $cartControllerNameSpace, 'thankyou');
Router::add(BASE_URL.'notfound', 'get', $mainControllerNameSpace, 'pageNotFound');
Router::add(BASE_URL.'products/all', 'get', $productsControllerNameSpace, 'allProducts');
Router::add(BASE_URL.'product/{id}', 'get', $productsControllerNameSpace, 'index');
Router::add(BASE_URL.'product/{id}', 'post', $cartControllerNameSpace, 'add');
Router::add(BASE_URL.'category/{id}', 'get', $categoriesControllerNameSpace, 'index');

Router::run();