<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::login');

$routes->get('/dashboard', 'Dashboard::index');

$routes->get('login', 'Login::login');

$routes->post('login/loginAction', 'Login::loginAction');

$routes->get('register', 'Register::register');