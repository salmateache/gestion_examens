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
$routes->post('register/createAccount', 'Register::createAccount');
$routes->get('notes', 'Note::index');
$routes->get('profile', 'Profile::index');

$routes->get('/professeur/profile', 'ProfesseurController::profile');
$routes->post('/professeur/updateProfile', 'ProfesseurController::updateProfile');
$routes->post('/professeur/changePassword', 'ProfesseurController::changePassword');

$routes->get('/professeur/profile', 'ProfesseurController::profile');
$routes->post('/professeur/profile', 'ProfesseurController::updateProfile');

$routes->post('/profile/update', 'Profile::update');
$routes->get('/profile', 'Profile::index');
$routes->get('/professeur/profile', 'ProfesseurController::profile');