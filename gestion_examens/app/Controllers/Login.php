<?php

namespace App\Controllers;

use App\Models\LoginModel;
use CodeIgniter\Controller;

class Login extends BaseController
{
    public function login()
    {
        // Retourne la vue du formulaire de connexion
        return view('pages-login');
    }

    public function loginAction()
    {
        // Récupérer les données du formulaire
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Log de débogage pour vérifier les données
        log_message('debug', "Username: $username");

        // Vérifier si le formulaire a bien des données
        if (empty($username) || empty($password)) {
            log_message('debug', "Error: Username or Password is empty.");
            return redirect()->back()->with('error', 'Username and Password are required.');
        }

        // Charger le modèle
        $loginModel = new LoginModel();

        // Vérifier si l'utilisateur existe avec le username
        $user = $loginModel->where('username', $username)->first();

        // Log pour vérifier si l'utilisateur existe
        log_message('debug', "User found: " . print_r($user, true));

        // Si l'utilisateur n'existe pas
        if (!$user) {
            log_message('debug', "Error: User not found.");
            return redirect()->back()->with('error', 'Invalid username or password.');
        }

        // Comparer le mot de passe saisi avec le mot de passe haché stocké
        if (password_verify($password, $user['password'])) {
            log_message('debug', "Password is correct.");

            // Authentification réussie, démarrer la session
            session()->set('user_id', $user['idCompte']); // Utilise idCompte comme clé primaire
            session()->set('username', $user['username']);
            session()->set('role', $user['idRole']); // Stocke également le rôle si nécessaire

            // Log pour vérifier la session
            log_message('debug', "User logged in: " . print_r(session()->get(), true));

            // Rediriger vers le tableau de bord
            return redirect()->to('/dashboard');
        } else {
            log_message('debug', "Error: Password is incorrect.");
            // Si le mot de passe est incorrect
            return redirect()->back()->with('error', 'Invalid username or password.');
        }
    }
}