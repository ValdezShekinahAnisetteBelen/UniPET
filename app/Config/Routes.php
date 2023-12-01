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
$routes->get('api/getPetIdsByCustomerId/(:num)', 'AppointmentController::getPetIdsByCustomerId/$1');
$routes->get('api/getPetDataById/(:num)', 'AppointmentController::getPetDataById/$1');


$routes->get('/getData1', 'AppointmentController::getData1');
$routes->post('/save', 'AppointmentController::save');
$routes->get('api/user', 'UserController::homepage');
$routes->get('api/product/details/(:segment)', 'Product::getProductDetails/$1');
// $routes->get('api_get_appointments/(:any)', 'AppointmentController::api_get_appointments/$1');
// In your CodeIgniter 4 routes file (app/Config/Routes.php or similar)
$routes->get('getData1/(:segment)', 'AppointmentController::getData1/$1');
$routes->post('api/updatePetData/(:num)', 'AppointmentController::updateUserDataAndPetData/$1');
$routes->post('api/cart/update/(:segment)', 'CartController::updateItem/$1');
$routes->post('api/cart/purchase', 'PurchaseController::purchase');
$routes->post('api/transaction/save', 'TransactionController::saveTransaction');
$routes->get('/getData2', 'TransactionController::getData2');
// In your server-side route
$routes->get('getData3/(:num)', 'PurchaseController::getData3/$1');
$routes->post('api/publish/save', 'OrderHistoryController::saveOrder');
$routes->get('api/appointments/distribution/(:any)', 'AppointmentController::getAppointmentDistributionByArea/$1');
$routes->get('api/best/products/(:any)', 'OrderHistoryController::getBestSellingProductsByYear/$1');
$routes->get('api/orders', 'OrderHistoryController::getOrders');
$routes->post('api/edit-status', 'OrderHistoryController::editStatus');
$routes->get('api/products/(:num)', 'Product::getProductDetails2/$1');
$routes->get('api/customers/(:num)', 'UserController::getCustomerDetails/$1');
$routes->get('api/transactions/(:num)', 'TransactionController::getTransactionDetails/$1');
// app/Config/Routes.php

$routes->post('api/edit-status2', 'Product::editStatus2');
$routes->delete('api/order-history/delete-orders/(:num)', 'OrderHistoryController::deleteOrdersByCustomer/$1');

$routes->delete('api/checkout1/delete/(:num)', 'PurchaseController::delete/$1');
// Add this route to handle the cancelOrder method
$routes->get('api/cart/get-by-customer-id/(:num)', 'CartController::getCartByCustomerId/$1');

$routes->delete('api/cancel-order/(:num)/(:num)', 'OrderController::cancelOrder/$1/$2');



















