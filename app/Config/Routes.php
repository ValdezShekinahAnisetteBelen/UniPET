<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->match(['post', 'get'], '/api/login', 'UserController::login');
$routes->match(['post', 'get'], '/api/register', 'UserController::register');
$routes->get('/getData', 'Product::getData');
$routes->post('api/products', 'Product::create');
$routes->post('api/cart/add-to-cart', 'CartController::addToCart');
$routes->delete('api/cart/delete/(:num)', 'CartController::del/$1');
$routes->get('/getData1', 'AppointmentController::getData1');
$routes->post('/save', 'AppointmentController::save');
$routes->get('api/user', 'UserController::homepage');
$routes->get('api/product/details/(:segment)', 'Product::getProductDetails/$1');
// $routes->get('api_get_appointments/(:any)', 'AppointmentController::api_get_appointments/$1');
// In your CodeIgniter 4 routes file (app/Config/Routes.php or similar)
$routes->get('getData1/(:segment)', 'AppointmentController::getData1/$1');
$routes->post('api/updatePetData/(:num)', 'AppointmentController::updateUserDataAndPetData/$1');
$routes->delete('api/cart/delete/(:num)', 'CartController::del/$1');
$routes->post('api/cart/update/(:segment)', 'CartController::updateItem/$1');
$routes->post('api/cart/purchase', 'PurchaseController::purchase');
$routes->post('api/transaction/save', 'TransactionController::saveTransaction');
$routes->get('/getData2', 'TransactionController::getData2');
// In your server-side route
$routes->get('getData3/(:num)', 'PurchaseController::getData3/$1');
$routes->post('api/publish/save', 'OrderHistoryController::saveOrder');












