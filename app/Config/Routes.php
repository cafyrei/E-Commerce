<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('login', 'Home::login');
$routes->get('product-details', 'Home::productDetails');
$routes->get('signup', 'Home::signup');
$routes->get('home2', 'Home::home2');
$routes->get('about', 'Home::about');
$routes->get('contact', 'Home::contact');
$routes->get('admin_signin', 'Home::adminSignin'); // admin