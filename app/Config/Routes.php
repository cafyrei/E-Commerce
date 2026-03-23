<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Authorization
$routes->match(['get', 'post'], 'login', 'Auth::login');
$routes->match(['get', 'post'], 'signup', 'Auth::signup');

$routes->get('product-details', 'Home::productDetails');
$routes->get('catalog', 'Home::productCatalog');
$routes->get('checkout', 'Home::checkout');
$routes->get('profile', 'Home::profile');
$routes->get('signup', 'Home::signup');
$routes->get('home2', 'Home::home2');
$routes->get('about', 'Home::about');
$routes->get('contact', 'Home::contact');
$routes->get('admin_signin', 'Home::adminSignin'); // admin
