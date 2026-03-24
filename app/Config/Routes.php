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

// Product Details
$routes->get('product-details/(:num)', 'Home::productDetails/$1');
$routes->get('catalog', 'Home::productCatalog');
$routes->get('checkout', 'Home::checkout');
$routes->get('signup', 'Home::signup');
$routes->get('home2', 'Home::home2');
$routes->get('about', 'Home::about');
$routes->get('contact', 'Home::contact');
$routes->get('admin_signin', 'Home::adminSignin'); // admin
