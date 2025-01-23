<?php

use CodeIgniter\Router\RouteCollection;
/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::login');

$routes->get('/dashboard', 'Dashboard::index');

$routes->get('login', 'Login::login');
$routes->post('login/loginAction', 'Login::loginAction');
$routes->post('profile/update2', to: 'Profile::update2');
$routes->get('register', 'Register::register');
$routes->post('register/createAccount', 'Register::createAccount');
$routes->get('profile', 'Profile::index');
$routes->post('profile/update', 'Profile::update'); // Cette route était doublée
$routes->post('reclamations/updateStatut', 'Reclamations::updateStatut');
$routes->get('reclamations/download/(:num)', 'ReclamationsController::download/$1');

// Routes spécifiques pour le professeur
$routes->post('professeur/profile', 'ProfesseurController::profile');
$routes->post('professeur/updateProfile', 'ProfesseurController::updateProfile');
$routes->post('professeur/changePassword', 'ProfesseurController::changePassword');

$routes->get('login/logout', 'Login::logout');

$routes->get('/notes', 'Notes::index');
$routes->post('notes/submit', 'Notes::submitReclamation');
$routes->get('/reclamations', 'Reclamations::index'); // Étudiants
$routes->get('/reclamationsProf', 'Reclamations::indexProf'); // Professeurs