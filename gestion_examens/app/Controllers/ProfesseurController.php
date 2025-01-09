<?php

namespace App\Controllers;

use App\Models\ProfesseurModel;
use CodeIgniter\Controller;

class ProfesseurController extends Controller
{
    public function profile()
{
    $session = session();
    $idUtilisateur = $session->get('idUtilisateur'); // Vérifie la même clé que dans LoginController

    if (!$idUtilisateur) {
        return redirect()->to('/login')->with('error', 'Veuillez vous connecter.');
    }

    $professeurModel = new ProfesseurModel();
    $data['professeur'] = $professeurModel->getProfesseurByIdUtilisateur($idUtilisateur);
    $data['modules'] = $professeurModel->getModulesByProfesseur($professeur['idProfesseur']);

    return view('users_profile', $data);
}


    public function updateProfile()
    {
        $session = session();
        $idUtilisateur = $session->get('idUtilisateur');

        // Charger le modèle
        $professeurModel = new ProfesseurModel();

        // Récupérer les données du formulaire
        $data = [
            'nom' => $this->request->getPost('First'),
            'prenom' => $this->request->getPost('Last'),
            'email' => $this->request->getPost('email'),
            'departement' => $this->request->getPost('Department'),
        ];

        // Mettre à jour le profil du professeur
        $professeurModel->updateProfesseur($idUtilisateur, $data);

        // Rediriger avec un message de succès
        return redirect()->to('/professeur/profile')->with('success', 'Profil mis à jour avec succès');
    }

    public function changePassword()
    {
        $session = session();
        $idUtilisateur = $session->get('idUtilisateur');

        // Charger le modèle
        $professeurModel = new ProfesseurModel();

        // Récupérer les mots de passe du formulaire
        $currentPassword = $this->request->getPost('password');
        $newPassword = $this->request->getPost('newpassword');
        $renewPassword = $this->request->getPost('renewpassword');

        // Vérifier le mot de passe actuel
        if (!$professeurModel->verifyPassword($idUtilisateur, $currentPassword)) {
            return redirect()->back()->with('error', 'Mot de passe actuel incorrect');
        }

        // Vérifier si les nouveaux mots de passe correspondent
        if ($newPassword !== $renewPassword) {
            return redirect()->back()->with('error', 'Les nouveaux mots de passe ne correspondent pas');
        }

        // Mettre à jour le mot de passe
        $professeurModel->updatePassword($idUtilisateur, $newPassword);

        // Rediriger avec un message de succès
        return redirect()->to('/professeur/profile')->with('success', 'Mot de passe changé avec succès');
    }
}
