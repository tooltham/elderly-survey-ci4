<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Authentication
$routes->get('/login', 'Auth::index');
$routes->post('/loginAuth', 'Auth::loginAuth');
$routes->get('/logout', 'Auth::logout');

// Dashboard (Test)
$routes->get('/dashboard', 'Dashboard::index');

// Respondents Data
$routes->get('/respondents/create', 'Respondent::create');
$routes->post('/respondents/store', 'Respondent::store');

// CRUD Routes
$routes->get('/respondents', 'Respondent::index');          // หน้ารายการ
$routes->get('/respondents/edit/(:num)', 'Respondent::edit/$1'); // หน้าแก้ไข
$routes->post('/respondents/update/(:num)', 'Respondent::update/$1'); // สั่งอัปเดต
$routes->get('/respondents/delete/(:num)', 'Respondent::delete/$1'); // สั่งลบ

// User Management Routes
$routes->get('/users', 'Users::index');
$routes->get('/users/create', 'Users::create');
$routes->post('/users/store', 'Users::store');
$routes->get('/users/edit/(:num)', 'Users::edit/$1');
$routes->post('/users/update/(:num)', 'Users::update/$1');
$routes->get('/users/delete/(:num)', 'Users::delete/$1');

// Search Routes
$routes->get('/search', 'Search::index');
