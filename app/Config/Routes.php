<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/getData', 'Product::getData');
$routes->post('api/products', 'Product::create');
$routes->post('api/add-to-cart', 'CartController::addToCart');
$routes->post('/del', 'CartController::del');



