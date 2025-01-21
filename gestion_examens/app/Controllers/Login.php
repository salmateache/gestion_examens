<?php

namespace App\Controllers;

use App\Models\LoginModel;
use App\Models\EtudiantModel;
use CodeIgniter\Controller;

class Login extends BaseController
{
    public function login()
    {
        return view('pages-login'); // Vue du formulaire de connexion
    }

    public function loginAction()
    {
        // Récupérer les données du formulaire
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Vérification des champs vides
        if (empty($username) || empty($password)) {
            return redirect()->back()->with('error', 'Username and Password are required.');
        }

        // Charger le modèle utilisateur
        $loginModel = new LoginModel();
        $user = $loginModel->where('username', $username)->first();

        // Vérifier si l'utilisateur existe
        if (!$user) {
            return redirect()->back()->with('error', 'Invalid username or password.');
        }

        // Comparer le mot de passe
        if (password_verify($password, $user['password'])) {
            // Démarrer la session
            $sessionData = [
                'idUtilisateur' => $user['idCompte'], 
                'username' => $user['username'],
                'role' => $user['idRole']
            ];

            // Si c'est un étudiant (idRole = 2), on récupère `idEtudiant` depuis la table `etudiant`
            if ($user['idRole'] == 2) {
                $etudiantModel = new EtudiantModel();
                $etudiant = $etudiantModel->where('idUtilisateur', $user['idCompte'])->first();

                if ($etudiant) {
                    $sessionData['idEtudiant'] = $etudiant['idEtudiant'];
                } else {
                    return redirect()->back()->with('error', 'Compte étudiant non trouvé.');
                }
            }

            // Stocker les données dans la session
            session()->set($sessionData);

            // Vérifier que les données sont bien stockées (DEBUG)
            log_message('debug', "Session Data: " . print_r(session()->get(), true));

            return redirect()->to('/dashboard'); // Rediriger vers le tableau de bord
        } else {
            return redirect()->back()->with('error', 'Invalid username or password.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
