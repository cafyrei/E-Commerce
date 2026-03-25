<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Authorization
$routes->match(['get', 'post'], 'login', 'Auth::login');
$routes->match(['get', 'post'], 'signup', 'Auth::signup');
$routes->get('logout', 'Auth::logout');

// User
$routes->get('profile', 'User::profile');
$routes->post('user/updateProfile', 'User::updateProfile');
$routes->post('user/updatePassword', 'User::updatePassword');
$routes->post('user/updateAddress', 'User::updateAddress');
$routes->post('user/deleteAddress/(:num)', 'User::deleteAddress/$1');

// Catalog
$routes->get('catalog', 'Catalog::index');

// Admin
$routes->get('admin', 'Admin\Admin::index');
$routes->get('admin/deleteUser/(:num)', 'Admin\Admin::deleteUser/$1');
$routes->get('admin/deleteProduct/(:num)', 'Admin\Admin::deleteProduct/$1');

// Product Details
$routes->get('product-details/(:num)', 'Home::productDetails/$1');

// Adding Cart
$routes->post('cart/add', 'CartController::add');

// Buying Product
$routes->post('buy-now', 'CartController::buyNow');
$routes->get('checkout', 'CartController::checkout');
$routes->post('checkout/process', 'CartController::processCheckout');

// Removing Product
$routes->get('cart/remove/(:num)', 'CartController::remove/$1');

$routes->get('signup', 'Home::signup');
$routes->get('home2', 'Home::home2');
$routes->get('about', 'Home::about');
$routes->get('contact', 'Home::contact');
$routes->get('admin_signin', 'Home::adminSignin'); // admin
