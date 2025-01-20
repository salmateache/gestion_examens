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
$routes->get('profile', 'Profile::index');
$routes->post('profile/update', 'Profile::update'); // Cette route était doublée

// Routes spécifiques pour le professeur
$routes->post('professeur/profile', 'ProfesseurController::profile');
$routes->post('professeur/updateProfile', 'ProfesseurController::updateProfile');
$routes->post('professeur/changePassword', 'ProfesseurController::changePassword');

$routes->get('login/logout', 'Login::logout');

$routes->get('/notes', 'Notes::index');