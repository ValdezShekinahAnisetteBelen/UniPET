<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->match(['post', 'get'], '/api/login', 'UserController::login');
$routes->match(['post', 'get'], 'api/register', 'UserController::register');
$routes->get('/getData', 'Product::getData');
$routes->post('api/products', 'Product::create');
$routes->post('api/add-to-cart', 'CartController::addToCart');
$routes->post('api/cart/delete', 'CartController::deleteCartItem');
$routes->get('/getData1', 'AppointmentController::getData1');
$routes->post('/save', 'AppointmentController::save');






