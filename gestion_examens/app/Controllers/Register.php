<?php

namespace App\Controllers;

use App\Models\RegisterModel;
use App\Models\LoginModel;

class Register extends BaseController
{

    public function register()
    {
        
        return view('pages-register');
    }
    public function createAccount()
    {
        // Validation des données du formulaire
        if (!$this->validate([
            'name' => 'required',
            'email' => 'required|valid_email|is_unique[utilisateur.email]', // Email unique pour la table utilisateur
            'username' => 'required|is_unique[compte.username]', // Username unique pour la table compte
            'password' => 'required|min_length[6]',
            'birthdate' => 'required',
            'role' => 'required' // Le rôle est désormais obligatoire
        ])) {
            return redirect()->back()->withInput()->with('error', $this->validator->listErrors());
        }

        // Récupération des données du formulaire
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $birthdate = $this->request->getPost('birthdate');
        $role = $this->request->getPost('role'); // Récupérer le rôle (étudiant ou professeur)
        

        // Déterminer l'ID du rôle en fonction du rôle sélectionné
        $idRole = ($role === 'étudiant') ? 2 : 1; // Si l'utilisateur est étudiant, idRole = 2, sinon 1 pour professeur

        // Charger les modèles
        $userModel = new RegisterModel();
        $loginModel = new LoginModel();

        // Insérer dans la table `utilisateur`
        $userData = [
            'nom_complet' => $name,
            'email' => $email,
            'dateNaissance' => $birthdate,
            'idRole' => $idRole // Utilisation du rôle dynamique
        ];
        $userId = $userModel->insert($userData);

        if ($userId) {
            // Insérer dans la table `compte`
            $accountData = [
                'username' => $username,
                'password' => $password, // Mot de passe haché
                'etat' => 'Active',
                'idUtilisateur' => $userId,
                'idRole' => $idRole // Id du rôle pour la table `compte`
            ];
            $loginModel->insert($accountData);

            return redirect()->to(base_url('login'))->with('success', 'Votre compte a été créé avec succès!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Une erreur est survenue lors de la création de l\'utilisateur.');
        }
    }

}
