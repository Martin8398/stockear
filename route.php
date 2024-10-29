<?php

// Controller call

require_once './libs/router.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/api');
$router = new router();


// Clear route example

//$router->addRoute('','','','') -> ('endpoint',CRUD','controller','method')

// User routes

$router->addRoute('users', 'GET', 'UserController', 'getUsers');
$router->addRoute('users/:ID', 'GET', 'UserController', 'getUser');
$router->addRoute('users', 'POST', 'UserController', 'addUser');
$router->addRoute('users/:ID', 'PUT', 'UserController', 'updateUser');
$router->addRoute('users/:ID', 'DELETE', 'UserController', 'deleteUser');

// Clients routes

$router->addRoute('clients', 'GET', 'ClientController', 'getClientes');
$router->addRoute('clients/:ID', 'GET', 'ClientController', 'getClient');
$router->addRoute('clients', 'POST', 'ClientController', 'addClient');
$router->addRoute('clients/:ID', 'PUT', 'ClientController', 'updateClient');
$router->addRoute('clients/:ID', 'DELETE', 'ClientController', 'deleteClient');

// Items routes

$router->addRoute('products', 'GET', 'ItemController', 'getItems');
$router->addRoute('products/:ID', 'GET', 'ItemController', 'getItem');
$router->addRoute('products', 'POST', 'ItemController', 'addItem');
$router->addRoute('products/:ID', 'PUT', 'ItemController', 'UpdateItem');
$router->addRoute('products/:ID', 'DELETE', 'ItemController', 'deleteItem');

// Category routes

$router->addRoute('category', 'GET', 'CategoryController', 'getCategories');
$router->addRoute('category/:ID', 'GET', 'CategoryController', 'getCategory');
$router->addRoute('category', 'POST', 'CategoryController', 'addCategory');
$router->addRoute('category/:ID', 'PUT', 'CategoryController', 'UpdateCategory');
$router->addRoute('category/:ID', 'DELETE', 'CategoryController', 'deleteCategory');

// Sales routes

$router->addRoute('sale', 'GET', 'saleController', 'getSales');
$router->addRoute('sale/:ID', 'GET', 'saleController', 'getSale');
$router->addRoute('sale', 'POST', 'saleController', 'addSale');
$router->addRoute('sale/:ID', 'PUT', 'saleController', 'UpdateSale');
$router->addRoute('sale/:ID', 'DELETE', 'saleController', 'deleteSale');

// Sale detail

$router->addRoute('sales/info', 'GET', 'InfoSaleController', 'getInfoSales');
$router->addRoute('sales/:ID/info', 'GET', 'InfoSaleController', 'getInfoSale');
$router->addRoute('sales/info', 'POST', 'InfoSaleController', 'addInfoSale');
$router->addRoute('sales/info/:ID', 'PUT', 'InfoSaleController', 'updateInfoSale');
$router->addRoute('sales/info/:ID', 'DELETE', 'InfoSaleController', 'deleteInfoSale');

// Auth routes

$router->addRoute('auth/login', 'POST', 'AuthController', 'login');
$router->addRoute('auth/logout', 'POST', 'AuthController', 'logout');

// Execute route

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
