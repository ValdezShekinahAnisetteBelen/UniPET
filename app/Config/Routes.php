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
$routes->put('/api/updateUserData', 'AppointmentController::updateUserData');










